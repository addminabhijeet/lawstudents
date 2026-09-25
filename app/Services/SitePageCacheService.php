<?php

namespace App\Services;

use App\Models\SitePage;
use Illuminate\Support\Facades\Cache;

/**
 * Caches static site pages (Privacy Policy, Terms of Service, etc.)
 * to avoid repeated DB queries for every page load.
 */
class SitePageCacheService
{
    private const CACHE_PREFIX = 'site_page_';
    private const CACHE_TTL = 60 * 60 * 24; // 24 hours

    /**
     * Get a site page by slug. Falls back to DB if cache misses.
     */
    public static function getBySlug(string $slug)
    {
        return Cache::remember(self::CACHE_PREFIX . $slug, self::CACHE_TTL, function () use ($slug) {
            return SitePage::where('slug', $slug)->first();
        });
    }

    /**
     * Clear cache for a specific page (call when page is updated).
     */
    public static function flushPage(string $slug)
    {
        Cache::forget(self::CACHE_PREFIX . $slug);
    }

    /**
     * Clear all site page caches.
     */
    public static function flushAll()
    {
        // In production, use: Cache::tags(['site_pages'])->flush()
        // For now, clear each known page
        $slugs = ['privacy-policy', 'terms-of-service', 'disclaimer', 'refund-policy'];
        foreach ($slugs as $slug) {
            self::flushPage($slug);
        }
    }
}
