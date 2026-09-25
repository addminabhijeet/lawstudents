<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class ApiRateLimiting
{
    public function handle(Request $request, Closure $next)
    {
        if (!config('security.api_rate_limit.enabled')) {
            return $next($request);
        }

        $user = $request->user();
        $identifier = $user ? "user_{$user->id}" : $request->ip();

        // Per minute limit
        $perMinuteKey = "api_limit_per_minute:{$identifier}";
        $perMinuteLimit = config('security.api_rate_limit.requests_per_minute');

        if (RateLimiter::tooManyAttempts($perMinuteKey, $perMinuteLimit)) {
            return response()->json([
                'success' => false,
                'message' => 'Too many requests. Please try again later.',
                'error' => 'rate_limit_exceeded',
            ], 429)->header('Retry-After', RateLimiter::availableIn($perMinuteKey));
        }

        RateLimiter::hit($perMinuteKey, 60); // 60 second decay

        // Per hour limit
        $perHourKey = "api_limit_per_hour:{$identifier}";
        $perHourLimit = config('security.api_rate_limit.requests_per_hour');

        if (RateLimiter::tooManyAttempts($perHourKey, $perHourLimit)) {
            return response()->json([
                'success' => false,
                'message' => 'Hourly rate limit exceeded.',
                'error' => 'rate_limit_exceeded',
            ], 429);
        }

        RateLimiter::hit($perHourKey, 3600); // 1 hour decay

        return $next($request);
    }
}
