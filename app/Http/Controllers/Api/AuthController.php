<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ForgotPasswordMail;
use App\Models\Traits\ApiResponser;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;

class AuthController extends Controller
{
    use ApiResponser;

    public function login(Request $request)
    {

        $attributes = $request->validate([

            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (! Auth::attempt($attributes)) {
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
        $token       = $user->createToken('APIToken');
        $accessToken = $token->plainTextToken;

        $auth_token = explode('|', $accessToken)[1];
        return $this->success([
            'token'         => $auth_token,
            'accountStatus' => $accountStatus,
        ], 'Login Successfully', 200);
    }
    public function register(Request $request)
    {
        // Manual validation
        $validator = Validator::make($request->only('first_name', 'last_name', 'email', 'phone', 'password'), [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            'email'      => ['required', 'string', 'email:filter', 'max:255', 'unique:users,email'],
            'phone'      => ['required', 'unique:users,phone'],
            'password'   => ['required', 'string', 'min:6'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // return first error message
                'errors'  => $validator->errors(),          // all errors if needed
            ], 422);
        }

        $phone            = $request->phone;
        $phoneWithoutPlus = str_replace('+', '', $phone);

        DB::beginTransaction();
        try {
            // Create user
            $user = User::create([
                'first_name'         => $request->first_name,
                'last_name'          => $request->last_name,
                'name'               => $request->first_name . ' ' . $request->last_name,
                'email'              => $request->email,
                'phone'              => $phoneWithoutPlus,
                'gender'             => $request->gender == 'male' ? 0 : 1,
                'password'           => Hash::make($request['password']),
                'status'             => 1,
                'address'            => $request->address,
                'city'               => $request->city,
                'state'              => $request->state,
                'zip_code'           => $request->zip_code,
                'shifts'             => $request->shift,
                'experience'         => $request->experience,
                'reffered_by'        => $request->reffered_by,
                'qualification_type' => $request->qualification_type,
            ]);

            $user->syncRoles([3]);

            // Generate username
            $username       = intval(config('app.initial_username')) + $user->id;
            $user->username = strval($username);
            $user->save();

            // Handle resume upload
            if ($request->hasFile('resume')) {
                $filename     = Storage::disk('cms')->putFile('', $request->resume);
                $user->resume = $filename;
                $user->save();
            }

            // Generate OTP
            $otp       = mt_rand(1000, 9999);
            $user->otp = $otp;
            $user->save();

            // Send OTP (reuse resendCode logic)
            if (config('ums.otp_via_sms')) {
                try {
                    $client = new Client(config('ums.twilio.sid'), config('ums.twilio.token'));
                    $client->messages->create(
                        '+' . $phoneWithoutPlus,
                        ['from' => config('ums.twilio.from'), 'body' => "Your account verification code: $otp"]
                    );
                } catch (\Exception $e) {
                    \Log::error("Twilio SMS error: " . $e->getMessage());
                }
            }

            if (config('ums.otp_via_email')) {
                try {
                    Mail::send('mail.otp', ['otp' => $otp, 'user' => $user], function ($m) use ($user) {
                        $m->to($user->email, $user->name)
                            ->subject('Your Verification Code');
                    });
                } catch (\Exception $e) {
                    \Log::error("Mail error: " . $e->getMessage());
                }
            }

            DB::commit();

            // Generate API token
            $token       = $user->createToken('APIToken');
            $accessToken = $token->plainTextToken;
            $auth_token  = explode('|', $accessToken)[1];

            return $this->success(
                ['auth_token' => $auth_token],
                'Registered Successfully, Please verify your account with OTP',
                200
            );

        } catch (\Exception $e) {
            DB::rollBack();
            return $this->error('Registration failed: ' . $e->getMessage(), 500);
        }
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
            $user->otp               = null;
            $user->update();

            return $this->success([], 'Congrats!! Account verified', 200);
        } else {
            return $this->error('Invalid code!! please enter the correct one', 403);
        }
    }
    public function resendCode(Request $request)
    {
        $data = $request->validate([
            'email'    => 'required|exists:users,email',
            'phone_no' => 'required',
        ]);

        $otp = mt_rand(1000, 9999);

        $user = User::where('email', $request->email)
            ->orWhere('phone', str_replace('+', '', $request->phone_no))
            ->first();

        if (! $user) {
            return $this->error('User not found', 404);
        }

        // Save OTP once
        $user->otp = $otp;
        $user->save();

        if (config('ums.otp_via_sms')) {
            try {
                $phoneWithoutPlus = str_replace('+', '', $request->phone_no);

                $client = new Client(
                    config('ums.twilio.sid'),
                    config('ums.twilio.token')
                );

                $client->messages->create(
                    $phoneWithoutPlus,
                    [
                        'from' => config('ums.twilio.from'),
                        'body' => "Your account verification code: $otp",
                    ]
                );
            } catch (\Exception $e) {
                \Log::error("Twilio SMS error: " . $e->getMessage());
            }
        }

        if (config('ums.otp_via_email')) {
            try {
                Mail::send('mail.otp', ['otp' => $otp, 'user' => $user], function ($m) use ($user) {
                    $m->to($user->email, $user->name)
                        ->subject('Your Verification Code');
                });
            } catch (\Exception $e) {
                \Log::error("Mail error: " . $e->getMessage());
            }
        }

        return $this->success('Code sent', 200);
    }

    public function sendResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => ['required', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(), // return first error message
                'errors'  => $validator->errors(),          // all errors if needed
            ], 422);
        }

        $otp = mt_rand(1000, 9999);

        $user = User::where('email', $request->email)
            ->orWhere('phone', str_replace('+', '', $request->phone_no))
            ->first();

        if (! $user) {
            return $this->error('User not found', 404);
        }

        // Save OTP once
        $user->otp = $otp;
        $user->save();

        if (config('ums.otp_via_sms')) {
            try {
                $phoneWithoutPlus = str_replace('+', '', $request->phone_no);

                $client = new Client(
                    config('ums.twilio.sid'),
                    config('ums.twilio.token')
                );

                $client->messages->create(
                    $phoneWithoutPlus,
                    [
                        'from' => config('ums.twilio.from'),
                        'body' => "Your account verification code: $otp",
                    ]
                );
            } catch (\Exception $e) {
                \Log::error("Twilio SMS error: " . $e->getMessage());
            }
        }

        if (config('ums.otp_via_email')) {
            try {
                Mail::send('mail.otp', ['otp' => $otp, 'user' => $user], function ($m) use ($user) {
                    $m->to($user->email, $user->name)
                        ->subject('Your Verification Code');
                });
            } catch (\Exception $e) {
                \Log::error("Mail error: " . $e->getMessage());
            }
        }

        return $this->success('Code sent on your email', 200);
        // $data = $request->validate([
        //     'phone_no' => 'required|exists:users,phone',
        // ]);
        // $phone            = $request->phone_no;
        // $phoneWithoutPlus = str_replace('+', '', $phone);
        // // Generate random code
        // $otp           = mt_rand(1000, 9999);
        // $account_sid   = config('twilio.sid');
        // $auth_token    = config('twilio.token');
        // $twilio_number = config('twilio.from_number');
        // $client        = new Client($account_sid, $auth_token);
        // $message       = "Your account verification code: $otp";
        // $client->messages->create(
        //     $phoneWithoutPlus,
        //     ['from' => $twilio_number, 'body' => $message]
        // );

        // $user      = User::wherePhone($phoneWithoutPlus)->first();
        // $user->otp = $otp;
        // $user->save();
        // return $this->success($request->all(), 200);
    }
    public function checkResetCode(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'code'  => ['required', 'string'],
            'email' => ['required', 'exists:users,email'],
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
                'errors'  => $validator->errors(),
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        // Validation ensures $user exists, so no need for extra null check
        if ($user->otp === $request->code) {
            $user->update(['otp' => null]);

            return response()->json([
                'success' => true,
                'message' => 'Code Matched. Change your password',
            ], 200);
        }

        return response()->json([
            'success' => false,
            'message' => 'Code Mismatch. Please try again.',
        ], 422); // better than 500
    }

    public function forget_password(Request $request)
    {

        $credentials   = request()->validate(['email' => 'required|email']);
        $data['user']  = User::whereEmail($request->email)->first();
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
                'email'      => $request->email,
                'token'      => $data['token'],
                'created_at' => Carbon::now(),
            ]);
        } else {
            DB::table('password_resets')->insert([
                'email'      => $request->email,
                'token'      => $data['token'],
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

            'email'    => 'required|email',
            'password' => 'required|min:6|confirmed',
        ]);

        // $tokenData = DB::table('password_resets')
        //     ->where('token', $request->route()->parameter('token'))->first();

        // if (!$tokenData) {
        //     return $this->error('This password reset token is invalid.', 404);
        // }

        $user = User::where('email', $request->email)->first();

        if (! $user) {
            return $this->error('We can\'t find user with this email.', 404);
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // DB::table('password_resets')
        //     ->where('token', $request->route()->parameter('token'))->delete();

        return $this->success('Password updated successfully', 200);
    }
}
