<?php

namespace Tests\Feature;

use App\Models\Gallery;
use App\Models\Clientele;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GalleryClienteleTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role_id' => 1]);
    }

    public function test_can_create_gallery(): void
    {
        Gallery::factory()->create([
            'image' => 'gallery/test.jpg',
        ]);
        $this->assertDatabaseHas('gallery', ['image' => 'gallery/test.jpg']);
    }

    public function test_gallery_list(): void
    {
        Gallery::factory()->count(3)->create();
        $count = \DB::table('gallery')->count();
        $this->assertEquals(3, $count);
    }

    public function test_can_create_clientele(): void
    {
        Clientele::factory()->create([
            'description' => 'Clientele material',
        ]);
        $this->assertDatabaseCount('clienteles', 1);
    }

    public function test_clientele_list(): void
    {
        Clientele::factory()->count(5)->create();
        $this->assertDatabaseCount('clienteles', 5);
    }
}
