<?php

namespace App\Http\Middleware;

use App\Services\ActivityTracker;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ActivityBrowserContext
{
    public function handle(Request $request, Closure $next): Response
    {
        $tracker = app(ActivityTracker::class);
        if (!config('activity.enabled')) {
            return $next($request);
        }
        try {
            $tracker->prepare($request);
        } catch (\Throwable $e) {
            $tracker->failed($request, $e);
        }
        $response = $next($request);
        try {
            if ($request->attributes->get('_activity_failed')) {
                return $response;
            }
            $context = $tracker->context($request);
            $response->headers->setCookie(cookie('ls_visitor', $context['visitor_id'], config('activity.cookie_days') * 1440,
                '/', null, $request->isSecure(), true, false, 'lax'));
            if ($response->getStatusCode() < 400 && !$response->isRedirection()
                && str_contains($response->headers->get('Content-Type', ''), 'text/html')
                && is_string($body = $response->getContent()) && ($position = strripos($body, '</body>')) !== false) {
                $script = view('activity.browser', ['activityContext' => $tracker->browserContext($request)])->render();
                $response->setContent(substr_replace($body, $script, $position, 0));
                // The context and CSRF token belong to this visitor, never a shared cache entry.
                $response->headers->set('Cache-Control', 'private, no-store');
            }
        } catch (\Throwable $e) {
            $tracker->failed($request, $e);
        }
        return $response;
    }
}
