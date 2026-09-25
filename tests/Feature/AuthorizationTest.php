<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AuthorizationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_authorization_on_student_routes(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')
            ->get('/student/dashboard');

        $response->assertStatus(200);
    }

    public function test_student_cannot_access_other_student_data(): void
    {
        $student1 = Student::factory()->create();
        $student2 = Student::factory()->create();

        $response = $this->actingAs($student1, 'student')
            ->get("/student/profile/{$student2->id}");

        // Should be forbidden or redirected
        $this->assertIn($response->getStatusCode(), [403, 302, 404]);
    }

    public function test_admin_can_access_student_data(): void
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $student = Student::factory()->create();

        $response = $this->actingAs($admin, 'admin')
            ->get("/admin/view-student/{$student->id}");

        $response->assertStatus(200);
    }

    public function test_guest_redirected_to_login(): void
    {
        $response = $this->get('/admin');

        $response->assertRedirect('/login');
    }

    public function test_student_guard_prevents_admin_access(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')
            ->get('/admin/list-student');

        $response->assertStatus(302);
    }
}
