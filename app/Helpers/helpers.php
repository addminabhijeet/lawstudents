<?php

/**
 * Global helper functions for the application
 * These functions can be used in Blade templates and PHP code
 */

if (!function_exists('assetUrl')) {
    /**
     * Generate a full asset URL that works on both localhost and production
     *
     * @param string $path The asset path (e.g., 'img/logo.png' or '/img/logo.png')
     * @return string The full asset URL
     */
    function assetUrl($path)
    {
        return \App\Helpers\AssetHelper::assetUrl($path);
    }
}

if (!function_exists('imgUrl')) {
    /**
     * Generate a full image URL
     *
     * @param string $imagePath The image path
     * @return string The full image URL
     */
    function imgUrl($imagePath)
    {
        return \App\Helpers\AssetHelper::img($imagePath);
    }
}

if (!function_exists('cssUrl')) {
    /**
     * Generate a full CSS URL
     *
     * @param string $cssPath The CSS path
     * @return string The full CSS URL
     */
    function cssUrl($cssPath)
    {
        return \App\Helpers\AssetHelper::css($cssPath);
    }
}

if (!function_exists('jsUrl')) {
    /**
     * Generate a full JavaScript URL
     *
     * @param string $jsPath The JavaScript path
     * @return string The full JavaScript URL
     */
    function jsUrl($jsPath)
    {
        return \App\Helpers\AssetHelper::js($jsPath);
    }
}

if (!function_exists('getAppUrl')) {
    /**
     * Get the application URL configured for current environment
     *
     * @return string The APP_URL
     */
    function getAppUrl()
    {
        return rtrim(config('app.url'), '/');
    }
}

if (!function_exists('assetPath')) {
    /**
     * Get just the asset path without the full URL
     * Useful when you need to pass the path to other functions
     *
     * @param string $path The asset path
     * @return string The path
     */
    function assetPath($path)
    {
        return '/' . ltrim($path, '/');
    }
}
