<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class AdminAuditLogging
{
    public function handle(Request $request, Closure $next)
    {
        // Only log admin routes
        if (!$request->user() || !auth()->guard('admin')->check()) {
            return $next($request);
        }

        $admin = auth()->guard('admin')->user();

        // Log admin action
        if (config('security.audit_log.enabled')) {
            $this->logAdminAction($request, $admin);
        }

        $response = $next($request);

        return $response;
    }

    protected function logAdminAction(Request $request, $admin): void
    {
        Log::channel('admin_activity')->info('Admin Action', [
            'admin_id' => $admin->id,
            'admin_email' => $admin->email,
            'method' => $request->method(),
            'path' => $request->path(),
            'ip' => $request->ip(),
            'user_agent' => $request->userAgent(),
            'parameters' => $this->getSafeParameters($request),
            'timestamp' => now(),
        ]);
    }

    protected function getSafeParameters(Request $request): array
    {
        $excluded = ['password', 'token', 'secret', 'api_key', 'credit_card'];
        $params = $request->all();

        foreach ($excluded as $key) {
            if (isset($params[$key])) {
                $params[$key] = '***REDACTED***';
            }
        }

        return $params;
    }
}
