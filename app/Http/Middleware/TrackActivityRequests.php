<?php

namespace App\Http\Middleware;

use App\Services\ActivityTracker;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class TrackActivityRequests
{
    public function handle(Request $request, Closure $next): Response
    {
        $request->attributes->set('_activity_started', microtime(true));
        $request->attributes->set('_activity_request_id', (string) Str::uuid());
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        app(ActivityTracker::class)->requestCompleted($request, $response);
    }
}
