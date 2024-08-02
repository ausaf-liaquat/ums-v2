<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\ResetPasswordCode;
use App\Models\Traits\ApiResponser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {

        $attributes = $request->validate([

            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!Auth::attempt($attributes)) {
            return $this->error('Credentials not match', 401);
        }

        $user = Auth::user();

        if ($user->hasRole(['super admin']) || $user->hasRole(['facility'])) {
            Auth::logout();
            return $this->error('Unauthorized', 401);
        }
        $accountStatus = "verified";
        if (getLoggedInUser()->email_verified_at == null) {
            // $userEmail = getLoggedInUser()->email;
            // auth()->logout();
            // return $this->error('Please verify your account with Phone no', 401);
            $accountStatus = "unverified";
        }
        $token = $user->createToken('APIToken');
        $accessToken = $token->plainTextToken;

        $auth_token = explode('|', $accessToken)[1];
        return $this->success([
            'token' => $auth_token,
            'accountStatus' => $accountStatus,
        ], 'Login Successfully', 200);
    }
    public function register(Request $request)
    {
        $attributes = $request->validate([
            'first_name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email:filter', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
        ]);
        $phone = $request->phone;
        $phoneWithoutPlus = str_replace('+', '', $phone);

        $data = [
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name'  => $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'phone' => $phoneWithoutPlus,
            'gender' => $request->gender == 'male' ? 0 : 1,
            'password' => Hash::make($request['password']),
            'status' => 1,
            'zip_code' => $request->zip_code,
            'shifts' => $request->shift,
            'experience' => $request->experience,
            'reffered_by' => $request->reffered_by,
            'qualification_type' => $request->qualification_type,
        ];

        $user = User::create($data);
        $user->syncRoles([3]);
        $username = intval(config('app.initial_username')) + $user->id;
        $user->username = strval($username);
        $user->save();
        if ($request->hasFile('resume')) {
            $filename = Storage::disk('cms')->putFile('', $request->resume);

            $user->resume = $filename;
            // $user->email_verified_at =now();
            $user->save();
        }

        $otp = mt_rand(1000, 9999);


        // Generate random code

        $account_sid = config('twilio.sid');
        $auth_token = config('twilio.token');
        $twilio_number = config('twilio.from_number');
        $client = new Client($account_sid, $auth_token);
        $message = "Your account verification code: $otp";

        $client->messages->create(
            '+' . $phoneWithoutPlus,
            ['from' => $twilio_number, 'body' => $message]
        );
        // // Create a new code
        // ResetPasswordCode::create([
        //     'phone'=>$request->phone,
        //     'code'=>$otp
        // ]);
        $user->otp = $otp;

        $user->save();

        $token = $user->createToken('APIToken');
        $accessToken = $token->plainTextToken;
        $auth_token = explode('|', $accessToken)[1];
        return $this->success(['auth_token' => $auth_token], 'Registered Successfully, Please verify your account with Phone no', 200);
    }
    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'integer|required',
        ]);
        $user = Auth::user();
        // if ($user->is_verified !== 'active') {
        //     return response()->json([
        //         'message' => 'Your account has been inactive/suspended by our admin, please contact support for further details'
        //     ], 401);
        // }
        $otp = $user->otp;
        if ($request->input('otp') === $otp) {
            // $user->is_verified = 'active';

            $user->email_verified_at = \Carbon\Carbon::now();
            $user->otp = null;
            $user->update();

            return $this->success([], 'Congrats!! Account verified', 200);
        } else {
            return $this->error('Invalid code!! please enter the correct one', 403);
        }
    }
    public function resendCode(Request $request)
    {
        $data = $request->validate([
            'phone_no' => 'required|exists:users,phone',
        ]);



        // Generate random code
        $otp = mt_rand(1000, 9999);
        $account_sid = config('twilio.sid');
        $auth_token = config('twilio.token');
        $twilio_number = config('twilio.from_number');
        $client = new Client($account_sid, $auth_token);
        $message = "Your account verification code: $otp";
        $client->messages->create(
            $request->phone_no,
            ['from' => $twilio_number, 'body' => $message]
        );

        $user = User::wherePhone($request->phone_no)->first();
        $user->otp = $otp;
        $user->save();
        return $this->success('Code sent', 200);
    }

    public function sendResetCode(Request $request)
    {
        $data = $request->validate([
            'phone_no' => 'required|exists:users,phone',
        ]);

        // Generate random code
        $otp = mt_rand(1000, 9999);
        $account_sid = config('twilio.sid');
        $auth_token = config('twilio.token');
        $twilio_number = config('twilio.from_number');
        $client = new Client($account_sid, $auth_token);
        $message = "Your account verification code: $otp";
        $client->messages->create(
            $request->phone_no,
            ['from' => $twilio_number, 'body' => $message]
        );

        $user = User::wherePhone($request->phone_no)->first();
        $user->otp = $otp;
        $user->save();
        return $this->success('Code sent', 200);
    }
    public function checkResetCode(Request $request)
    {
        $request->validate([
            'code' => 'required|string',
            'phone_no' => 'required|exists:users,phone',
        ]);

        // find the code
        $passwordReset = ResetPasswordCode::firstWhere('phone_no', $request->phone_no);

        if ($passwordReset->code == $request->code) {
            User::wherePhone($request->phone_no)->first();
            $passwordReset->delete();
            return $this->success('Code Matched. Change your password', 200);
        } else {
            return $this->error('Code Mismatch. Please try again.', 500);
        }
    }
    public function forget_password(Request $request)
    {

        $credentials = request()->validate(['email' => 'required|email']);
        $data['user'] = User::whereEmail($request->email)->first();
        $data['token'] = encrypt($data['user']->email . '' . $data['user']->id);

        $data['link'] = route('password.resetApi', ['token' => $data['token'], 'email' => $request->email]);

        Mail::to($data['user']->email)
            ->send(new ForgotPasswordMail(
                'emails.forgot_password',
                'Reset Password Notification',
                $data
            ));

        $user = DB::table('password_resets')->where('email', $request->email)->first();

        if ($user) {
            DB::table('password_resets')->where('email', $user->email)->update([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_resets')->insert([
                'email' => $request->email,
                'token' => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        }

        return $this->success([], 'Reset password link sent on your email id', 200);
    }
    public function newPassword(Request $request)
    {
        // return $request;
        return $this->success(['token' => $request->route()->parameter('token'), 'email' => $request->input('email')], 'Reset password ', 200);
    }

    public function newPasswordstore(Request $request)
    {
        // if (!$request->route()->parameter('token')) {
        //     return $this->error('Token not found.', 404);
        // }
        $request->validate([

            'email' => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // $tokenData = DB::table('password_resets')
        //     ->where('token', $request->route()->parameter('token'))->first();

        // if (!$tokenData) {
        //     return $this->error('This password reset token is invalid.', 404);
        // }

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            return $this->error('We can\'t find user with this email.', 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // DB::table('password_resets')
        //     ->where('token', $request->route()->parameter('token'))->delete();

        return $this->success('Password updated successfully', 200);
    }
}
