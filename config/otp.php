<?php

return [
    // OTP validity period in minutes
    'validity_minutes' => env('OTP_VALIDITY_MINUTES', 10),

    // Maximum OTP verification attempts
    'max_attempts' => env('OTP_MAX_ATTEMPTS', 3),

    // Rate limit throttle window in minutes
    'throttle_minutes' => env('OTP_THROTTLE_MINUTES', 1),

    // OTP length
    'length' => 6,

    // OTP code range
    'min' => 100000,
    'max' => 999999,

    // SMS provider
    'sms_provider' => env('SMS_PROVIDER', 'fast2sms'),

    // Email settings
    'from_email' => env('MAIL_FROM_ADDRESS', 'noreply@lawstudents.com'),
    'from_name' => env('MAIL_FROM_NAME', 'Law Students'),
];
