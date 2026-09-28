<?php

return [
    'enabled' => env('ACTIVITY_TRACKING_ENABLED', true),
    'cookie_days' => 90,
    'retention_days' => (int) env('ACTIVITY_RETENTION_DAYS', 180),
    'response_target_hours' => (int) env('ADMISSION_RESPONSE_TARGET_HOURS', 24),
    'timezone' => env('ACTIVITY_TIMEZONE', 'Asia/Kolkata'),
];
