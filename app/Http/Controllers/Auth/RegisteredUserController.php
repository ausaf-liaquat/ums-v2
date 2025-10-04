<?php
namespace App\Http\Controllers\Auth;

use App\Events\Frontend\UserRegistered;
use App\Http\Controllers\Controller;
use App\Models\Facilities\Facility;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'facility_name'        => ['required', 'string', 'max:255'],
            'unit'                 => ['required', 'string', 'max:255'],
            'address'              => ['required', 'string', 'max:500'],
            'phone'                => ['required', 'string'],
            'state'                => ['required', 'string', 'max:100'],
            'city'                 => ['required', 'string', 'max:100'],
            'zip_code'             => ['required', 'string', 'max:20'],
            'email'                => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password'             => ['required', 'confirmed', Rules\Password::defaults()],
            'referred_by'          => ['required', 'string', 'max:255'],
            'clinician_type'       => ['required', 'array', 'min:1'],
            'passcode'             => ['required', 'string', 'max:100'],
            'facility_unit'        => ['nullable', 'string'],
            // 'g-recaptcha-response' => 'required|recaptchav3:registered,0.9',
        ], [
            'facility_name.required'           => 'The facility name is required.',
            'facility_name.string'             => 'The facility name must be a valid string.',
            'facility_name.max'                => 'The facility name should not exceed 255 characters.',

            'unit.required'                    => 'The unit field is required.',
            'unit.string'                      => 'The unit must be a valid string.',
            'unit.max'                         => 'The unit should not exceed 255 characters.',

            'address.required'                 => 'The address field is required.',
            'address.string'                   => 'The address must be a valid string.',
            'address.max'                      => 'The address should not exceed 500 characters.',

            'phone.required'                   => 'The phone number is required.',
            'phone.regex'                      => 'The phone number format is invalid. Enter a valid number (10-15 digits).',

            'state.required'                   => 'The state field is required.',
            'state.string'                     => 'The state must be a valid string.',
            'state.max'                        => 'The state should not exceed 100 characters.',

            'city.required'                    => 'The city field is required.',
            'city.string'                      => 'The city must be a valid string.',
            'city.max'                         => 'The city should not exceed 100 characters.',

            'zip_code.required'                => 'The zip code is required.',
            'zip_code.string'                  => 'The zip code must be a valid string.',
            'zip_code.max'                     => 'The zip code should not exceed 20 characters.',

            'email.required'                   => 'The email address is required.',
            'email.email'                      => 'Enter a valid email address.',
            'email.max'                        => 'The email should not exceed 255 characters.',
            'email.unique'                     => 'This email is already registered.',

            'password.required'                => 'The password field is required.',
            'password.confirmed'               => 'The password confirmation does not match.',

            'referred_by.required'             => 'The referred by field is required.',
            'referred_by.string'               => 'The referred by must be a valid string.',
            'referred_by.max'                  => 'The referred by field should not exceed 255 characters.',

            'clinician_type.required'          => 'Please select at least one clinician type.',
            'clinician_type.array'             => 'The clinician type must be a valid selection.',

            'passcode.required'                => 'The verbal passcode field is required.',
            'passcode.string'                  => 'The verbal passcode must be a valid string.',
            'passcode.max'                     => 'The verbal passcode should not exceed 100 characters.',

            'facility_unit.required'           => 'The facility unit count is required.',
            'facility_unit.numeric'            => 'The facility unit must be a number.',
            'facility_unit.min'                => 'The facility must have at least one unit.',

            // 'g-recaptcha-response.required'    => 'Google reCAPTCHA verification is required.',
            // 'g-recaptcha-response.recaptchav3' => 'Google reCAPTCHA verification failed.',
        ]);

        $user = User::create([
            'name'     => $request->facility_name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'mobile'   => $request->phone,
            'address'  => $request->address,
        ]);

        // username
        $username       = intval(config('app.initial_username')) + $user->id;
        $user->username = strval($username);
        $user->save();

        $user->syncRoles([2]);

        $facility = Facility::create([
            'user_id'            => $user->id,
            'unit'               => $request->unit,
            // 'state_id' => $request->state_id,
            // 'city_id' => $request->city_id,
            'zip_code'           => $request->zip_code,
            'state'              => $request->state,
            'city'               => $request->city,
            'referred_by'        => $request->referred_by,
            'passcode'           => $request->passcode,
            'how_many_unit_need' => $request->facility_unit,
        ]);

        $facility->clinician_types()->sync($request->clinician_type);

        $user->createAsStripeCustomer();

        $user->sendEmailVerificationNotification();

        event(new UserRegistered($request, $user));

        Auth::login($user);

        return redirect(route('home'));
    }
}
