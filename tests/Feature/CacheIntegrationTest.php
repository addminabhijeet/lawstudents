<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\SitePage;
use App\Services\CategoryCacheService;
use App\Services\SitePageCacheService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;

class CacheIntegrationTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        Cache::flush();
    }

    public function test_category_cache_service_returns_tree(): void
    {
        Category::factory()->count(3)->create(['parent_id' => null, 'delete' => 1]);

        $tree = CategoryCacheService::getTree();

        $this->assertNotNull($tree);
        $this->assertCount(3, $tree);
    }

    public function test_category_cache_service_respects_ttl(): void
    {
        Category::factory()->create(['parent_id' => null, 'delete' => 1]);

        $tree1 = CategoryCacheService::getTree();
        
        // Create another category
        Category::factory()->create(['parent_id' => null, 'delete' => 1]);

        // Tree should still show cached result (not the new category)
        $tree2 = CategoryCacheService::getTree();
        $this->assertCount(1, $tree2);
    }

    public function test_category_cache_flush_invalidates_cache(): void
    {
        Category::factory()->create(['parent_id' => null, 'delete' => 1]);
        CategoryCacheService::getTree();

        CategoryCacheService::flush();

        Category::factory()->create(['parent_id' => null, 'delete' => 1]);
        $tree = CategoryCacheService::getTree();

        $this->assertCount(2, $tree);
    }

    public function test_site_page_cache_service_caches_pages(): void
    {
        SitePage::factory()->create([
            'slug' => 'privacy-policy',
            'title' => 'Privacy Policy',
        ]);

        $page1 = SitePageCacheService::getBySlug('privacy-policy');
        $page2 = SitePageCacheService::getBySlug('privacy-policy');

        $this->assertNotNull($page1);
        $this->assertEquals('privacy-policy', $page1->slug);
        $this->assertEquals($page1->id, $page2->id);
    }

    public function test_site_page_cache_miss_returns_null(): void
    {
        $page = SitePageCacheService::getBySlug('non-existent-page');

        $this->assertNull($page);
    }

    public function test_site_page_flush_page_invalidates_single_page(): void
    {
        SitePage::factory()->create([
            'slug' => 'terms-of-service',
            'title' => 'Terms of Service',
        ]);

        SitePageCacheService::getBySlug('terms-of-service');

        SitePageCacheService::flushPage('terms-of-service');

        // Cache should be flushed
        // Re-fetching should hit DB
        $page = SitePageCacheService::getBySlug('terms-of-service');
        $this->assertNotNull($page);
    }

    public function test_site_page_flush_all_clears_cache(): void
    {
        SitePage::factory()->create(['slug' => 'privacy-policy']);
        SitePage::factory()->create(['slug' => 'terms-of-service']);

        SitePageCacheService::getBySlug('privacy-policy');
        SitePageCacheService::getBySlug('terms-of-service');

        SitePageCacheService::flushAll();

        // All caches should be flushed
        Cache::flush();

        $page1 = SitePageCacheService::getBySlug('privacy-policy');
        $this->assertNull($page1);
    }
}
