<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Symfony\Component\HttpFoundation\Response;

class ThrottleOtpRequests
{
    /**
     * Max OTP sending attempts per user per minute
     */
    private const MAX_ATTEMPTS = 3;

    /**
     * Decay time in minutes
     */
    private const DECAY_MINUTES = 1;

    public function handle(Request $request, Closure $next): Response
    {
        // Apply rate limiting to OTP endpoints
        if ($request->is('admin/send-email-otp') || $request->is('admin/send-phone-otp')) {
            $identifier = $request->is('admin/send-email-otp')
                ? $request->input('email', 'unknown')
                : $request->input('phone', 'unknown');

            $key = "otp.{$identifier}";

            if (RateLimiter::tooManyAttempts($key, self::MAX_ATTEMPTS)) {
                return response()->json([
                    'success' => false,
                    'message' => 'Too many OTP requests. Please try again in ' .
                                 ceil(RateLimiter::availableIn($key) / 60) . ' minute(s).'
                ], 429);
            }

            RateLimiter::hit($key, self::DECAY_MINUTES * 60);
        }

        return $next($request);
    }
}
