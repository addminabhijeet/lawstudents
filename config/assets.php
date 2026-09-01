<?php

/**
 * Asset configuration for handling URLs on both localhost and live server
 * This ensures images and resources load correctly regardless of environment
 */

return [
    /**
     * Asset base paths
     * These paths work on both localhost and production server
     */
    'base_url' => rtrim(env('APP_URL', 'http://localhost'), '/'),

    /**
     * Asset directories
     */
    'paths' => [
        'images' => '/img',
        'css' => '/css',
        'js' => '/js',
        'fonts' => '/fonts',
        'videos' => '/videos',
    ],

    /**
     * CDN settings (for future use)
     */
    'use_cdn' => false,
    'cdn_url' => env('CDN_URL', ''),
];
