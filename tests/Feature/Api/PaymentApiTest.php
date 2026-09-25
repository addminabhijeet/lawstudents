<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use App\Models\Student;
use App\Models\Course;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Sanctum\Sanctum;

class PaymentApiTest extends TestCase
{
    use RefreshDatabase;

    protected Student $student;
    protected Course $course;

    protected function setUp(): void
    {
        parent::setUp();

        $this->student = Student::factory()->create();
        $this->course = Course::factory()->create(['price' => 999.99]);
    }

    public function test_initiate_payment_requires_authentication()
    {
        $response = $this->postJson('/api/v1/payments/initiate', [
            'course_id' => $this->course->id,
        ]);

        $response->assertStatus(401);
    }

    public function test_initiate_payment_with_valid_course()
    {
        Sanctum::actingAs($this->student);

        $response = $this->postJson('/api/v1/payments/initiate', [
            'course_id' => $this->course->id,
        ]);

        $response->assertStatus(201);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['success', 'payment_id', 'amount', 'currency'],
        ]);
    }

    public function test_initiate_payment_with_nonexistent_course()
    {
        Sanctum::actingAs($this->student);

        $response = $this->postJson('/api/v1/payments/initiate', [
            'course_id' => 999,
        ]);

        $response->assertStatus(422);
    }

    public function test_initiate_payment_without_course_id()
    {
        Sanctum::actingAs($this->student);

        $response = $this->postJson('/api/v1/payments/initiate', []);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }

    public function test_get_payment_history_requires_authentication()
    {
        $response = $this->getJson('/api/v1/payments/history');

        $response->assertStatus(401);
    }

    public function test_get_payment_history_authenticated()
    {
        Sanctum::actingAs($this->student);

        $response = $this->getJson('/api/v1/payments/history');

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
            'meta' => ['current_page', 'per_page', 'total'],
        ]);
    }
}
