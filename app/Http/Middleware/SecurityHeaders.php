<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        // headers->set() works for every response type, including the
        // BinaryFileResponse returned by file downloads (->header() does not).

        // X-Content-Type-Options: Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');

        // X-Frame-Options: Clickjacking protection
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');

        // X-XSS-Protection: the legacy auditor is itself exploitable; modern
        // guidance (OWASP) is to switch it off and rely on escaping/CSP.
        $response->headers->set('X-XSS-Protection', '0');

        // Referrer-Policy: Control referrer information
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');

        // Permissions-Policy: Control browser features
        $response->headers->set('Permissions-Policy', 'geolocation=(), microphone=(), camera=()');

        // Strict-Transport-Security: HTTPS enforcement (in production only)
        if ($request->secure()) {
            $response->headers->set('Strict-Transport-Security', 'max-age=31536000; includeSubDomains');
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
                $response->headers->set('Content-Security-Policy-Report-Only', $csp);
            } else {
                $response->headers->set('Content-Security-Policy', $csp);
            }
        }

        return $response;
    }
}
