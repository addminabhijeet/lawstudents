<?php

namespace App\Services;

use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\RateLimiter;

class OtpSecurityService
{
    /**
     * Verify OTP with strict type comparison (prevents type juggling)
     *
     * @param string $userProvidedOtp
     * @param string $sessionKey
     * @return bool
     */
    public static function verifyEmailOtp(string $userProvidedOtp, string $sessionKey = 'email_otp'): bool
    {
        $storedOtp = Session::get($sessionKey);

        // Strict comparison with string casting to prevent type juggling
        return (string)$userProvidedOtp === (string)$storedOtp;
    }

    /**
     * Verify Phone OTP with strict type comparison
     *
     * @param string $userProvidedOtp
     * @param string $sessionKey
     * @return bool
     */
    public static function verifyPhoneOtp(string $userProvidedOtp, string $sessionKey = 'phone_otp'): bool
    {
        $storedOtp = Session::get($sessionKey);

        // Strict comparison with string casting to prevent type juggling
        return (string)$userProvidedOtp === (string)$storedOtp;
    }

    /**
     * Check if OTP sending is rate limited (prevent spam)
     *
     * @param string $identifier (email or phone)
     * @param int $maxAttempts
     * @param int $decayMinutes
     * @return bool
     */
    public static function isRateLimited(string $identifier, int $maxAttempts = 3, int $decayMinutes = 1): bool
    {
        $key = "otp.{$identifier}";

        if (RateLimiter::tooManyAttempts($key, $maxAttempts)) {
            return true;
        }

        RateLimiter::hit($key, $decayMinutes * 60);
        return false;
    }

    /**
     * Clear rate limit for an identifier
     *
     * @param string $identifier
     * @return void
     */
    public static function clearRateLimit(string $identifier): void
    {
        RateLimiter::clear("otp.{$identifier}");
    }

    /**
     * Clean up OTP session data after verification
     *
     * @param string $type ('email' or 'phone')
     * @return void
     */
    public static function clearOtpSession(string $type = 'email'): void
    {
        if ($type === 'email') {
            Session::forget(['email_otp', 'otp_email', 'email_verified']);
        } elseif ($type === 'phone') {
            Session::forget(['phone_otp', 'otp_phone', 'phone_verified']);
        }
    }

    /**
     * Validate OTP format (6 digits)
     *
     * @param mixed $otp
     * @return bool
     */
    public static function isValidOtpFormat($otp): bool
    {
        return is_numeric($otp) && strlen((string)$otp) === 6;
    }
}
