<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // X-Content-Type-Options: Prevent MIME type sniffing
        $response->header('X-Content-Type-Options', 'nosniff');

        // X-Frame-Options: Clickjacking protection
        $response->header('X-Frame-Options', 'SAMEORIGIN');

        // X-XSS-Protection: Enable XSS protection
        $response->header('X-XSS-Protection', '1; mode=block');

        // Referrer-Policy: Control referrer information
        $response->header('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions-Policy: Control browser features
        $response->header('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Strict-Transport-Security: HTTPS enforcement (in production only)
        if ($request->secure()) {
            $response->header('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
        }

        // Content-Security-Policy (if enabled)
        if (config('security.csp.enabled')) {
            $csp = "default-src 'self'; "
                  . "script-src 'self' 'unsafe-inline' 'unsafe-eval' cdn.jsdelivr.net cdnjs.cloudflare.com; "
                  . "style-src 'self' 'unsafe-inline' fonts.googleapis.com cdnjs.cloudflare.com; "
                  . "font-src 'self' fonts.gstatic.com cdnjs.cloudflare.com; "
                  . "img-src 'self' data: https:; "
                  . "connect-src 'self' https:; "
                  . "form-action 'self';";

            if (config('security.csp.report_only')) {
                $response->header('Content-Security-Policy-Report-Only', $csp);
            } else {
                $response->header('Content-Security-Policy', $csp);
            }
        }

        return $response;
    }
}
