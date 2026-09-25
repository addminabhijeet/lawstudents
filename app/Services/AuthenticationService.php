<?php

namespace App\Services;

use App\Exceptions\OtpException;
use App\Models\Student;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class AuthenticationService
{
    protected OtpSecurityService $otpSecurityService;
    protected NotificationService $notificationService;

    public function __construct(
        OtpSecurityService $otpSecurityService,
        NotificationService $notificationService
    ) {
        $this->otpSecurityService = $otpSecurityService;
        $this->notificationService = $notificationService;
    }

    /**
     * Generate and send OTP to email
     */
    public function sendEmailOtp(string $email): array
    {
        try {
            // Check rate limiting
            if ($this->otpSecurityService->isRateLimited($email, config('otp.max_attempts'), config('otp.throttle_minutes'))) {
                throw new OtpException(
                    'Too many OTP requests. Please wait ' . config('otp.throttle_minutes') . ' minute(s) before trying again.',
                    OtpException::RATE_LIMITED,
                    429
                );
            }

            // Generate OTP
            $otp = random_int(config('otp.min'), config('otp.max'));

            // Store in session
            session(['email_otp' => $otp, 'otp_email' => $email]);

            // Send via email
            $this->notificationService->sendOtpEmail($email, $otp);

            Log::info('OTP sent to email', ['email' => $email]);

            return [
                'success' => true,
                'message' => 'OTP sent to your email address',
                'validity_minutes' => config('otp.validity_minutes'),
            ];
        } catch (OtpException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to send email OTP', ['email' => $email, 'error' => $e->getMessage()]);
            throw new OtpException('Failed to send OTP', OtpException::OTP_NOT_SENT);
        }
    }

    /**
     * Generate and send OTP to phone
     */
    public function sendPhoneOtp(string $phone): array
    {
        try {
            // Check rate limiting
            if ($this->otpSecurityService->isRateLimited($phone, config('otp.max_attempts'), config('otp.throttle_minutes'))) {
                throw new OtpException(
                    'Too many OTP requests. Please wait ' . config('otp.throttle_minutes') . ' minute(s) before trying again.',
                    OtpException::RATE_LIMITED,
                    429
                );
            }

            // Generate OTP
            $otp = random_int(config('otp.min'), config('otp.max'));

            // Store in session
            session(['phone_otp' => $otp, 'otp_phone' => $phone]);

            // Send via SMS
            $this->notificationService->sendOtpSms($phone, $otp);

            Log::info('OTP sent to phone', ['phone' => $phone]);

            return [
                'success' => true,
                'message' => 'OTP sent to your phone',
                'validity_minutes' => config('otp.validity_minutes'),
            ];
        } catch (OtpException $e) {
            throw $e;
        } catch (\Exception $e) {
            Log::error('Failed to send phone OTP', ['phone' => $phone, 'error' => $e->getMessage()]);
            throw new OtpException('Failed to send OTP', OtpException::OTP_NOT_SENT);
        }
    }

    /**
     * Verify email OTP
     */
    public function verifyEmailOtp(string $otp): array
    {
        if (!$this->otpSecurityService->isValidOtpFormat($otp)) {
            throw new OtpException('OTP must be 6 digits', OtpException::INVALID_FORMAT);
        }

        if (!$this->otpSecurityService->verifyEmailOtp($otp)) {
            throw new OtpException('Invalid OTP', OtpException::INVALID_OTP);
        }

        // OTP verified
        session(['email_verified' => true]);
        $this->otpSecurityService->clearRateLimit(session('otp_email'));

        Log::info('Email OTP verified', ['email' => session('otp_email')]);

        return [
            'success' => true,
            'message' => 'Email verified successfully',
        ];
    }

    /**
     * Verify phone OTP
     */
    public function verifyPhoneOtp(string $otp): array
    {
        if (!$this->otpSecurityService->isValidOtpFormat($otp)) {
            throw new OtpException('OTP must be 6 digits', OtpException::INVALID_FORMAT);
        }

        if (!$this->otpSecurityService->verifyPhoneOtp($otp)) {
            throw new OtpException('Invalid OTP', OtpException::INVALID_OTP);
        }

        // OTP verified
        session(['phone_verified' => true]);
        $this->otpSecurityService->clearRateLimit(session('otp_phone'));

        Log::info('Phone OTP verified', ['phone' => session('otp_phone')]);

        return [
            'success' => true,
            'message' => 'Phone verified successfully',
        ];
    }

    /**
     * Authenticate student with credentials
     */
    public function authenticateStudent(string $email, string $password): Student
    {
        $student = Student::where('email', $email)->first();

        if (!$student || !password_verify($password, $student->password)) {
            Log::warning('Failed login attempt', ['email' => $email]);
            throw new OtpException('Invalid email or password', OtpException::INVALID_OTP, 401);
        }

        if ($student->deleted) {
            throw new OtpException('This account has been deactivated', OtpException::INVALID_OTP, 403);
        }

        Log::info('Student authenticated', ['student_id' => $student->id]);

        return $student;
    }

    /**
     * Clear OTP session data
     */
    public function clearOtpSession(string $type = 'email'): void
    {
        $this->otpSecurityService->clearOtpSession($type);
    }
}
