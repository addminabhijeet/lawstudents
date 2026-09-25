<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;

class CourseApiTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        // Skip migrations that have index issues
        $this->artisan('migrate:reset', ['--database' => 'testing']);
        $this->artisan('migrate:refresh', ['--database' => 'testing', '--step' => 1]);
    }

    public function test_get_courses_list()
    {
        Course::factory()->count(3)->create(['is_published' => true, 'is_archived' => false]);

        $response = $this->getJson('/api/v1/courses');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['*' => ['id', 'title', 'description']],
            'meta' => ['current_page', 'per_page', 'total', 'last_page'],
        ]);
    }

    public function test_get_single_course()
    {
        $course = Course::factory()->create();

        $response = $this->getJson("/api/v1/courses/{$course->id}");

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['id', 'title', 'description'],
        ]);
    }

    public function test_get_nonexistent_course_returns_404()
    {
        $response = $this->getJson('/api/v1/courses/999');

        $response->assertStatus(404);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }

    public function test_search_courses()
    {
        Course::factory()->create([
            'title' => 'Constitutional Law',
            'is_published' => true,
            'is_archived' => false,
        ]);

        $response = $this->getJson('/api/v1/courses/search?q=Constitutional');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['*' => ['id', 'title']],
            'meta',
        ]);
    }

    public function test_search_with_short_query_fails()
    {
        $response = $this->getJson('/api/v1/courses/search?q=ab');

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }

    public function test_get_featured_courses()
    {
        Course::factory()->count(6)->create([
            'is_featured' => true,
            'is_published' => true,
            'is_archived' => false,
        ]);

        $response = $this->getJson('/api/v1/courses/featured');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['*' => ['id', 'title']],
        ]);
    }
}
