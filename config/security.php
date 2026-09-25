<?php

return [
    // Password policy
    'password' => [
        'min_length' => 8,
        'require_uppercase' => true,
        'require_numbers' => true,
        'require_special_chars' => true,
        'prevent_reuse_count' => 5, // Can't reuse last N passwords
    ],

    // Admin settings
    'admin' => [
        'password_expiration_days' => 90,
        'force_password_change_on_first_login' => true,
        'require_2fa' => env('ADMIN_REQUIRE_2FA', true),
    ],

    // API rate limiting
    'api_rate_limit' => [
        'enabled' => true,
        'requests_per_minute' => env('API_RATE_LIMIT_PER_MINUTE', 60),
        'requests_per_hour' => env('API_RATE_LIMIT_PER_HOUR', 1000),
    ],

    // Session security
    'session' => [
        'secure_cookies' => env('SESSION_SECURE_COOKIES', true),
        'http_only' => true,
        'same_site' => 'strict',
        'timeout_minutes' => env('SESSION_LIFETIME', 120),
    ],

    // CORS settings
    'cors' => [
        'enabled' => env('CORS_ENABLED', false),
        'allowed_origins' => explode(',', env('CORS_ALLOWED_ORIGINS', '')),
        'allowed_methods' => ['GET', 'POST', 'PUT', 'DELETE', 'PATCH', 'OPTIONS'],
        'allowed_headers' => ['*'],
        'max_age' => 3600,
    ],

    // Content Security Policy
    'csp' => [
        'enabled' => env('CSP_ENABLED', true),
        'report_only' => env('CSP_REPORT_ONLY', false),
    ],

    // File upload security
    'file_upload' => [
        'max_size_mb' => 50,
        'scan_for_malware' => env('SCAN_MALWARE', false),
        'store_outside_web_root' => true,
        'require_signed_urls' => true,
    ],

    // Admin logging
    'audit_log' => [
        'enabled' => true,
        'log_all_changes' => true,
        'retention_days' => 90,
    ],
];
