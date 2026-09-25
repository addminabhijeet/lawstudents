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
            'description' => 'Test gallery',
            'group_name' => 'test-group',
        ]);
        $this->assertDatabaseHas('galleries', ['group_name' => 'test-group']);
    }

    public function test_can_list_gallery(): void
    {
        Gallery::factory()->count(3)->create();
        $this->assertDatabaseCount('galleries', 3);
    }

    public function test_can_delete_gallery(): void
    {
        $gallery = Gallery::factory()->create();
        $gallery->update(['delete' => 0]);
        $this->assertEquals(0, $gallery->delete);
    }

    public function test_can_create_clientele(): void
    {
        Clientele::factory()->create([
            'description' => 'Clientele material',
        ]);
        $this->assertDatabaseCount('clienteles', 1);
    }

    public function test_can_list_clientele(): void
    {
        Clientele::factory()->count(5)->create(['delete' => 0]);
        $this->assertDatabaseCount('clienteles', 5);
    }

    public function test_gallery_soft_delete(): void
    {
        $gallery = Gallery::factory()->create(['delete' => 1]);
        $gallery->update(['delete' => 0]);
        $this->assertEquals(0, $gallery->delete);
    }
}
