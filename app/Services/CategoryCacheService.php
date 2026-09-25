<?php

namespace App\Services;

use App\Models\Category;
use Illuminate\Support\Facades\Cache;

/**
 * Caches the hierarchical category tree to avoid repeated DB queries.
 * Invalidates cache when categories are created, updated, or deleted.
 */
class CategoryCacheService
{
    private const CACHE_KEY = 'category_tree';
    private const CACHE_TTL = 60 * 60; // 1 hour

    /**
     * Get the cached category tree (root categories with children).
     * Falls back to DB if cache misses.
     */
    public static function getTree()
    {
        return Cache::remember(self::CACHE_KEY, self::CACHE_TTL, function () {
            return Category::with([
                'courses' => function ($query) {
                    $query->where('delete', 1);
                },
                'children' => function ($query) {
                    $query->where('status', 1)->where('delete', 1);
                }
            ])
                ->where('delete', 1)
                ->whereNull('parent_id')
                ->orderBy('sort_order')
                ->get();
        });
    }

    /**
     * Clear the category cache (call when categories change).
     */
    public static function flush()
    {
        Cache::forget(self::CACHE_KEY);
    }

    /**
     * Get all categories (paginated).
     */
    public static function getAllPaginated($perPage = 10)
    {
        // Don't cache paginated results; they're user-specific
        return Category::where('delete', 1)
            ->paginate($perPage);
    }
}
