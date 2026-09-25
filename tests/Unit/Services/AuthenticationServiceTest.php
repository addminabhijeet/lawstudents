<?php

namespace Tests\Unit\Services;

use Tests\TestCase;
use App\Services\AuthenticationService;
use App\Services\OtpSecurityService;
use App\Services\NotificationService;
use App\Exceptions\OtpException;
use Mockery;

class AuthenticationServiceTest extends TestCase
{
    protected AuthenticationService $authService;
    protected OtpSecurityService $otpService;
    protected NotificationService $notificationService;

    protected function setUp(): void
    {
        parent::setUp();

        $this->otpService = Mockery::mock(OtpSecurityService::class);
        $this->notificationService = Mockery::mock(NotificationService::class);

        $this->authService = new AuthenticationService(
            $this->otpService,
            $this->notificationService
        );
    }

    public function test_send_email_otp_success()
    {
        $email = 'test@example.com';

        $this->otpService
            ->shouldReceive('isRateLimited')
            ->once()
            ->with($email, config('otp.max_attempts'), config('otp.throttle_minutes'))
            ->andReturn(false);

        $this->notificationService
            ->shouldReceive('sendOtpEmail')
            ->once()
            ->with($email, Mockery::any())
            ->andReturn(true);

        $result = $this->authService->sendEmailOtp($email);

        $this->assertTrue($result['success']);
        $this->assertArrayHasKey('message', $result);
        $this->assertArrayHasKey('validity_minutes', $result);
    }

    public function test_send_email_otp_rate_limited()
    {
        $email = 'test@example.com';

        $this->otpService
            ->shouldReceive('isRateLimited')
            ->once()
            ->andReturn(true);

        $this->expectException(OtpException::class);

        $this->authService->sendEmailOtp($email);
    }

    public function test_verify_email_otp_invalid_format()
    {
        $this->otpService
            ->shouldReceive('isValidOtpFormat')
            ->once()
            ->with('12345') // Invalid - 5 digits
            ->andReturn(false);

        $this->expectException(OtpException::class);

        $this->authService->verifyEmailOtp('12345');
    }

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }
}
