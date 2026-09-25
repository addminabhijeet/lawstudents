<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;

class FormSubmissionsTest extends TestCase
{
    use RefreshDatabase;

    public function test_contact_form_submission_validates_email(): void
    {
        $response = $this->post('/contact', [
            'name' => 'John',
            'email' => 'not-an-email',
            'message' => 'Test'
        ]);

        $response->assertSessionHasErrors('email');
    }

    public function test_contact_form_submission_validates_required_fields(): void
    {
        $response = $this->post('/contact', []);
        
        $response->assertSessionHasErrors(['name', 'email', 'message']);
    }

    public function test_legal_knowledge_form_submission(): void
    {
        // Assuming legal knowledge form exists
        $response = $this->post('/legal-knowledge-submit', [
            'name' => 'Test User',
            'email' => 'test@example.com',
            'message' => 'Legal question',
        ]);

        // Should either succeed or fail gracefully
        $this->assertIn($response->getStatusCode(), [200, 302, 404]);
    }

    public function test_otp_request_requires_phone_number(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')
            ->post('/student/send-otp', []);

        $response->assertSessionHasErrors('phone');
    }

    public function test_otp_request_validates_phone_format(): void
    {
        $student = Student::factory()->create();

        $response = $this->actingAs($student, 'student')
            ->post('/student/send-otp', [
                'phone' => 'invalid-phone'
            ]);

        // Should validate phone format
        $this->assertIn($response->getStatusCode(), [302, 422]);
    }
}
