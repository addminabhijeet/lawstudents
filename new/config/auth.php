<?php

return [

    'defaults' => [
        'guard' => env('AUTH_GUARD', 'web'),
        'passwords' => env('AUTH_PASSWORD_BROKER', 'users'),
    ],

    'guards' => [

        // ===== EXISTING GUARD (DO NOT TOUCH) =====
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        // ===== NEW ADMIN GUARD =====
        'admin' => [
            'driver' => 'session',
            'provider' => 'admins',
        ],

        // ===== NEW STUDENT GUARD =====
        'student' => [
            'driver' => 'session',
            'provider' => 'students',
        ],
    ],

    'providers' => [

        // ===== EXISTING PROVIDER (UNCHANGED) =====
        'users' => [
            'driver' => 'eloquent',
            'model' => env('AUTH_MODEL', App\Models\User::class),
        ],

        // ===== NEW ADMIN PROVIDER =====
        'admins' => [
            'driver' => 'eloquent',
            'model' => App\Models\Admin::class,
        ],

        // ===== NEW STUDENT PROVIDER =====
        'students' => [
            'driver' => 'eloquent',
            'model' => App\Models\Student::class,
        ],
    ],

    'passwords' => [

        // EXISTING PASSWORD BROKER
        'users' => [
            'provider' => 'users',
            'table' => env('AUTH_PASSWORD_RESET_TOKEN_TABLE', 'password_reset_tokens'),
            'expire' => 60,
            'throttle' => 60,
        ],

        // OPTIONAL (if you want reset password later)
        'admins' => [
            'provider' => 'admins',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],

        'students' => [
            'provider' => 'students',
            'table' => 'password_reset_tokens',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    'password_timeout' => env('AUTH_PASSWORD_TIMEOUT', 10800),

];
