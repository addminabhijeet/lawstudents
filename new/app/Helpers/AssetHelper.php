<?php

namespace App\Helpers;

class AssetHelper
{
    /**
     * Get the correct asset URL that works on both localhost and live server
     *
     * @param string $path The asset path (e.g., '/img/logo.png' or 'img/logo.png')
     * @return string The full asset URL
     */
    public static function assetUrl($path)
    {
        // Remove leading slash if present
        $path = ltrim($path, '/');

        // Get the APP_URL from config
        $appUrl = rtrim(config('app.url'), '/');

        // Return full URL with app URL as base
        return $appUrl . '/' . $path;
    }

    /**
     * Alias for assetUrl - shorter name
     */
    public static function url($path)
    {
        return self::assetUrl($path);
    }

    /**
     * Get asset URL with proper handling for both local and production
     * Useful for <img> tags and other resources
     */
    public static function img($imagePath)
    {
        return self::assetUrl('img/' . ltrim($imagePath, '/'));
    }

    /**
     * Get CSS asset URL
     */
    public static function css($cssPath)
    {
        return self::assetUrl('css/' . ltrim($cssPath, '/'));
    }

    /**
     * Get JavaScript asset URL
     */
    public static function js($jsPath)
    {
        return self::assetUrl('js/' . ltrim($jsPath, '/'));
    }
}
