<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Lets the Contact page show its Google Maps frame.
 *
 * SecurityHeaders' Content-Security-Policy has no frame-src, so frames fall back to
 * default-src 'self' and the browser refused the map. This adds a frame-src that
 * keeps same-site frames and allows only Google Maps (maps.google.com redirects the
 * embed to www.google.com). Everything else in the policy is left as it is.
 *
 * Registered at the front of the web group so it wraps SecurityHeaders and runs
 * after the policy has been set.
 */
class AllowMapEmbeds
{
    private const FRAME_SRC = "frame-src 'self' https://maps.google.com https://www.google.com";

    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        foreach (['Content-Security-Policy', 'Content-Security-Policy-Report-Only'] as $header) {
            $policy = $response->headers->get($header);
            if ($policy && ! preg_match('/(^|;)\s*frame-src\s/i', $policy)) {
                $response->headers->set($header, rtrim(trim($policy), ';') . '; ' . self::FRAME_SRC . ';');
            }
        }

        return $response;
    }
}
