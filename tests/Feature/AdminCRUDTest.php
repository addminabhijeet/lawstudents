<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Course;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminCRUDTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role_id' => 1]);
    }

    public function test_admin_can_create_course(): void
    {
        $category = Category::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->post('/admin/course-store', [
                'category_id' => $category->id,
                'title' => 'New Course',
                'description' => 'Test course',
                'price' => 999,
                'duration' => 30,
            ]);

        $this->assertDatabaseHas('courses', [
            'title' => 'New Course',
            'price' => 999,
        ]);
    }

    public function test_admin_can_update_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->post("/admin/course-update/{$course->id}", [
                'category_id' => $course->category_id,
                'title' => 'Updated Course',
                'description' => 'Updated description',
            ]);

        $course->refresh();
        $this->assertEquals('Updated Course', $course->title);
    }

    public function test_admin_can_delete_course(): void
    {
        $course = Course::factory()->create();

        $response = $this->actingAs($this->admin, 'admin')
            ->delete("/admin/course-delete/{$course->id}");

        $course->refresh();
        $this->assertEquals(0, $course->delete);
    }

    public function test_admin_can_create_category(): void
    {
        $response = $this->actingAs($this->admin, 'admin')
            ->post('/admin/category-store', [
                'name' => 'New Category',
            ]);

        $this->assertDatabaseHas('categories', [
            'name' => 'New Category',
        ]);
    }

    public function test_admin_cannot_create_duplicate_category(): void
    {
        Category::factory()->create(['name' => 'Existing Category']);

        $response = $this->actingAs($this->admin, 'admin')
            ->post('/admin/category-store', [
                'name' => 'Existing Category',
            ]);

        $response->assertSessionHasErrors('name');
    }

    public function test_student_cannot_access_admin_crud(): void
    {
        $student = \App\Models\Student::factory()->create();

        $response = $this->actingAs($student, 'student')
            ->post('/admin/course-store', [
                'category_id' => 1,
                'title' => 'Hacked Course',
            ]);

        $response->assertStatus(302); // Redirect
    }
}
