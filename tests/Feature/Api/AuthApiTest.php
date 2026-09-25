<?php

namespace Tests\Feature\Api;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AuthApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_send_email_otp_with_valid_email()
    {
        $response = $this->postJson('/api/v1/auth/send-email-otp', [
            'email' => 'test@example.com',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data' => ['success', 'message', 'validity_minutes'],
        ]);
    }

    public function test_send_email_otp_with_invalid_email()
    {
        $response = $this->postJson('/api/v1/auth/send-email-otp', [
            'email' => 'invalid-email',
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error', 'details']);
    }

    public function test_send_email_otp_without_email()
    {
        $response = $this->postJson('/api/v1/auth/send-email-otp', []);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }

    public function test_send_phone_otp_with_valid_phone()
    {
        $response = $this->postJson('/api/v1/auth/send-phone-otp', [
            'phone' => '9876543210',
        ]);

        $response->assertStatus(200);
        $response->assertJsonStructure([
            'success',
            'message',
            'data',
        ]);
    }

    public function test_send_phone_otp_with_invalid_phone()
    {
        $response = $this->postJson('/api/v1/auth/send-phone-otp', [
            'phone' => '12345', // Too short
        ]);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }

    public function test_verify_email_otp_with_invalid_format()
    {
        $response = $this->postJson('/api/v1/auth/verify-email-otp', [
            'otp' => '12345', // 5 digits instead of 6
        ]);

        $response->assertStatus(422);
    }

    public function test_verify_email_otp_without_otp()
    {
        $response = $this->postJson('/api/v1/auth/verify-email-otp', []);

        $response->assertStatus(422);
        $response->assertJsonStructure(['success', 'message', 'error']);
    }
}
