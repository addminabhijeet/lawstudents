<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GuardIsolationTest extends TestCase
{
    use RefreshDatabase;

    public function test_student_cannot_access_admin_dashboard(): void
    {
        $student = Student::factory()->create();
        $response = $this->actingAs($student, 'student')->get('/admin');
        $response->assertStatus(302); // Redirects
    }

    public function test_admin_cannot_access_student_panel(): void
    {
        $admin = User::factory()->create(['role_id' => 1]);
        $response = $this->actingAs($admin, 'admin')->get('/student');
        $response->assertStatus(302); // Redirects
    }

    public function test_unauthenticated_redirects_to_login(): void
    {
        $response = $this->get('/admin');
        $response->assertStatus(302);
        $response->assertRedirect('/login');
    }
}
