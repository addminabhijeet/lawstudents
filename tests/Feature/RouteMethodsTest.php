<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Payment;
use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RouteMethodsTest extends TestCase
{
    use RefreshDatabase;

    protected User $admin;

    protected function setUp(): void
    {
        parent::setUp();
        $this->admin = User::factory()->create(['role_id' => 1]);
    }

    public function test_admin_can_access_admin_routes(): void
    {
        $response = $this->actingAs($this->admin, 'admin')->get('/admin');
        $this->assertIn($response->getStatusCode(), [200, 302]);
    }

    public function test_student_redirected_from_admin(): void
    {
        $student = Student::factory()->create();
        $response = $this->actingAs($student, 'student')->get('/admin');
        $this->assertIn($response->getStatusCode(), [302, 403]);
    }

    public function test_payment_model_creates_correctly(): void
    {
        $student = Student::factory()->create();
        $payment = Payment::factory()->create(['student_id' => $student->id]);
        $this->assertDatabaseHas('payments', ['student_id' => $student->id]);
    }

    public function test_multiple_payments_per_student(): void
    {
        $student = Student::factory()->create();
        Payment::factory()->count(3)->create(['student_id' => $student->id]);
        $this->assertEquals(3, $student->payments()->count());
    }

    public function test_admin_role_id_is_one(): void
    {
        $this->assertEquals(1, $this->admin->role_id);
    }
}
