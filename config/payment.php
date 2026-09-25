<?php

return [
    // Payment gateway
    'gateway' => env('PAYMENT_GATEWAY', 'razorpay'),

    // Razorpay configuration
    'razorpay' => [
        'key_id' => env('RAZORPAY_KEY_ID'),
        'key_secret' => env('RAZORPAY_KEY_SECRET'),
    ],

    // Payment timeout in seconds
    'timeout_seconds' => 300,

    // Retry attempts for failed payments
    'retry_attempts' => 3,

    // Webhook settings
    'webhook' => [
        'enabled' => env('PAYMENT_WEBHOOK_ENABLED', true),
        'timeout' => 30,
    ],

    // Currency
    'currency' => env('PAYMENT_CURRENCY', 'INR'),

    // Tax rate (percentage)
    'tax_rate' => env('PAYMENT_TAX_RATE', 18),

    // Payment statuses
    'statuses' => [
        'pending' => 'pending',
        'processing' => 'processing',
        'completed' => 'completed',
        'failed' => 'failed',
        'refunded' => 'refunded',
    ],
];
