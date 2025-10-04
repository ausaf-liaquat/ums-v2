<?php

return [
    // Stripe (your existing keys)
    'key'           => env('STRIPE_KEY'),
    'secret'        => env('STRIPE_SECRET'),

    'otp_via_sms'   => env('OTP_VIA_SMS', true),
    'otp_via_email' => env('OTP_VIA_EMAIL', true),
    // Twilio config
    'twilio'        => [
        'sid'   => env('TWILIO_SID'),
        'token' => env('TWILIO_TOKEN'),
        'from'  => env('TWILIO_FROM'),
    ],
];
