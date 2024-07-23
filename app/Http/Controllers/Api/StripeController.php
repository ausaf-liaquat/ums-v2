<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Traits\ApiResponser;
use App\Models\User;
use Illuminate\Http\Request;

class StripeController extends Controller
{

    use ApiResponser;

    public function stripeConnectedAccount(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );

        $acc = $stripe->accounts->create([
            'type'          => 'express',
            'email'         => $request->input('email'),   // Email address associated with the account
            'business_type' => 'individual',               // Business type (individual, company)
            'individual'    => [
                'first_name' => $request->input('first_name'),
                'last_name'  => $request->input('last_name'),
                'ssn_last_4' => $request->input('ssn_last_4'),   // Last 4 digits of SSN
                'phone'      => $request->input('phone'),
                'dob'        => [
                    'day' => $request->input('dob_day'), // Day of birth
                    'month' => $request->input('dob_month'), // Month of birth
                    'year' => $request->input('dob_year'), // Year of birth
                ],
                'address' => [
                    'line1' => $request->input('address_line1'), // Address line 1
                    'line2' => $request->input('address_line2'), // Address line 2 (optional)
                    'city' => $request->input('address_city'), // City
                    'state' => $request->input('address_state'), // State
                    'postal_code' => $request->input('address_postal_code'), // Postal code
                ],
            ],
            'external_account' => [
                'object' => 'bank_account', // Bank account or debit card
                'country' => 'US', // Country of the bank account or debit card
                'currency' => 'usd', // Currency of the bank account or debit card
                'routing_number' => $request->input('bank_routing_number'), // Routing number
                'account_number' => $request->input('bank_account_number'), // Bank account number
            ],

            'metadata' => [
                'industry' => $request->input('industry'), // Industry
            ],
            'business_profile' => [
                'url' => $request->input('business_url'), // URL of the business (optional)
            ],
            'capabilities' => [
                'card_payments' => ['requested' => true],
                'transfers' => ['requested' => true],
            ],
        ]);

        $account  =  $stripe->accountLinks->create([
            'account' => $acc->id,
            'refresh_url' => 'https://uniquemedsvcs.com/',
            'return_url' => 'https://uniquemedsvcs.com/',
            'type' => 'account_onboarding',
        ]);

        // auth()->user();
        User::find(auth()->user()->id)->update(['stripe_account_id' => $acc->id]);


        return $this->success(['onboardingLink' => $account->url], 'Account Connected Successfully', 200);
    }
    public function stripeConnectedAccountLogin(Request $request)
    {
        $stripe = new \Stripe\StripeClient(
            env('STRIPE_SECRET_KEY')
        );

        $loginLink = $stripe->accounts->createLoginLink(
            auth()->user()->stripe_account_id,
            []
        );

        return $this->success(['login_link' => $loginLink], 'Account Connected Login Link', 200);
    }
}
