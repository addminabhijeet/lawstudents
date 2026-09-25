<?php

namespace Tests\Feature;

use App\Models\Student;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OtpThrottlingTest extends TestCase
{
    use RefreshDatabase;

    public function test_otp_requests_are_throttled(): void
    {
        $student = Student::factory()->create();

        // First 5 requests should succeed (or be queued)
        for ($i = 0; $i < 5; $i++) {
            $response = $this->actingAs($student, 'student')
                ->post('/student/send-otp', ['phone' => '1234567890']);
            $response->assertStatus(200);
        }

        // 6th request should be throttled
        $response = $this->actingAs($student, 'student')
            ->post('/student/send-otp', ['phone' => '1234567890']);
        
        // Should get 429 Too Many Requests or redirect
        $this->assertTrue($response->status() === 429 || $response->status() === 302);
    }
}
