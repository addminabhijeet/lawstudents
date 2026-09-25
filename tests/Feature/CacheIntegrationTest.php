<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Services\CategoryCacheService;
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

    public function test_category_cache_service_is_available(): void
    {
        $this->assertTrue(class_exists(\App\Services\CategoryCacheService::class));
    }

    public function test_site_page_cache_service_is_available(): void
    {
        $this->assertTrue(class_exists(\App\Services\SitePageCacheService::class));
    }

    public function test_cache_can_be_flushed(): void
    {
        Cache::put('test_key', 'test_value');
        Cache::forget('test_key');
        $this->assertNull(Cache::get('test_key'));
    }

    public function test_mail_queue_interface_implemented(): void
    {
        $mail = new \App\Mail\StudentOtpMail('123456');
        $this->assertTrue($mail instanceof \Illuminate\Contracts\Queue\ShouldQueue);
    }
}
