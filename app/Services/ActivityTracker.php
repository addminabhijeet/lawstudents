<?php

namespace App\Services;

use App\Models\ActivityEvent;
use App\Models\Student;
use App\Models\StudentAdmission;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class ActivityTracker
{
    public function enabled(Request $request): bool
    {
        return config('activity.enabled') && !$request->attributes->get('_activity_failed')
            && !$request->is('up', 'assets/*', 'build/*', 'storage/*', 'favicon.ico', 'robots.txt', '_activity/events');
    }

    public function prepare(Request $request): void
    {
        if ($request->attributes->has('_activity_context')) {
            return;
        }
        $visitor = $request->cookie('ls_visitor');
        $visitor = is_string($visitor) && Str::isUuid($visitor) ? $visitor : (string) Str::uuid();
        $visit = null;
        if ($request->hasSession()) {
            $visit = $request->session()->get('activity_visit');
            $last = $request->session()->get('activity_last_seen', 0);
            if (!$visit || time() - $last > 1800) {
                $visit = (string) Str::uuid();
            }
            $request->session()->put(['activity_visit' => $visit, 'activity_last_seen' => time()]);
        }
        $request->attributes->set('_activity_context', [
            'visitor_id' => $visitor, 'visit_id' => $visit,
            'request_id' => $request->attributes->get('_activity_request_id', (string) Str::uuid()),
            'panel' => $this->panel($request),
            'path' => $this->path($request),
            'route_name' => $request->route()?->getName(),
        ]);
        $request->attributes->set('_activity_actor', $this->actor($request));
    }

    public function panel(Request $request): string
    {
        return $request->is('admin', 'admin/*') ? 'admin'
            : ($request->is('student', 'student/*') ? 'student' : ($request->is('api/*') ? 'api' : 'website'));
    }

    public function actor(Request $request, ?string $panel = null): array
    {
        $panel ??= $this->panel($request);
        // A browser may have both sessions. Only the guard for this panel owns its actions.
        $guards = match ($panel) {
            'admin' => ['admin'], 'student' => ['student'], default => ['student', 'admin', 'web'],
        };
        foreach ($guards as $guard) {
            if (Auth::guard($guard)->check()) {
                return ['actor_type' => $guard === 'web' ? 'user' : $guard, 'actor_id' => Auth::guard($guard)->id()];
            }
        }
        $user = $request->user();
        if ($panel === 'api' && $user) {
            return ['actor_type' => $user instanceof Student ? 'student' : 'user', 'actor_id' => $user->getAuthIdentifier()];
        }
        return ['actor_type' => 'visitor', 'actor_id' => null];
    }

    public function context(Request $request): array
    {
        $this->prepare($request);
        $actor = $this->actor($request);
        if ($actor['actor_type'] === 'visitor') {
            $actor = $request->attributes->get('_activity_actor', $actor);
        }
        return array_merge($request->attributes->get('_activity_context'), $actor, [
            'student_id' => $actor['actor_type'] === 'student' ? $actor['actor_id'] : $this->subjectStudent($request),
        ]);
    }

    public function path(Request $request): string
    {
        // Route templates avoid recording reset tokens, email addresses or arbitrary URL input.
        return '/'.ltrim($request->route()?->uri() ?? '[unmatched]', '/');
    }

    public function fields(array $keys): array
    {
        return array_values(array_filter(array_slice($keys, 0, 80), fn ($key) => is_string($key)
            && preg_match('/^[a-zA-Z][a-zA-Z0-9_.\[\]-]{0,79}$/D', $key)
            && !preg_match('/password|secret|token|otp|cookie|authorization|card|cvv|aadhaar|pan_number|signature|photo|marksheet|id_proof/i', $key)));
    }

    public function record(Request $request, string $event, array $attributes = []): ?ActivityEvent
    {
        if (!config('activity.enabled') || $request->attributes->get('_activity_failed')) {
            return null;
        }
        try {
            $data = array_merge($this->context($request), [
                'event_id' => (string) Str::uuid(), 'event' => $event, 'source' => 'server',
                'method' => $request->method(), 'occurred_at' => now(), 'created_at' => now(),
            ], $attributes);
            return ActivityEvent::firstOrCreate(['event_id' => $data['event_id']], $data);
        } catch (\Throwable $e) {
            $this->failed($request, $e);
            return null;
        }
    }

    public function requestCompleted(Request $request, Response $response): void
    {
        if (!$this->enabled($request)) {
            return;
        }
        try {
            $errors = $request->hasSession() ? $request->session()->get('errors') : null;
            $errorFields = $errors instanceof \Illuminate\Support\ViewErrorBag
                ? $this->fields($errors->getBag('default')->keys()) : [];
            $failed = $response->getStatusCode() >= 400 || $errorFields
                || ($request->hasSession() && $request->session()->has('error'));
            $event = $request->isMethod('GET') ? 'page_view' : ($failed ? 'form_failed' : 'request_completed');
            $this->record($request, $event, [
                'status_code' => $response->getStatusCode(),
                'duration_ms' => min(4294967295, (int) round((microtime(true) - $request->attributes->get('_activity_started', microtime(true))) * 1000)),
                'metadata' => [
                    'input_fields' => $this->fields(array_keys($request->except('_token', '_method'))),
                    'validation_fields' => $errorFields,
                    'referrer_host' => substr((string) parse_url($request->headers->get('referer', ''), PHP_URL_HOST), 0, 200),
                    'outcome' => $failed ? 'failed' : 'completed',
                    'route_ids' => collect($request->route()?->parameters() ?? [])->filter(fn ($value) => is_scalar($value) && ctype_digit((string) $value))->all(),
                ],
            ]);
        } catch (\Throwable $e) {
            $this->failed($request, $e);
        }
    }

    public function browserContext(Request $request): string
    {
        return Crypt::encryptString(json_encode(array_merge($this->context($request), [
            'page_id' => (string) Str::uuid(), 'expires' => time() + 86400,
        ]), JSON_THROW_ON_ERROR));
    }

    public function failed(Request $request, \Throwable $error): void
    {
        $request->attributes->set('_activity_failed', true);
        // Exception messages can contain SQL values. Only log the class and correlation ID.
        Log::warning('Activity tracking unavailable', [
            'exception' => get_class($error), 'request_id' => $request->attributes->get('_activity_request_id'),
        ]);
    }

    private function subjectStudent(Request $request): ?int
    {
        if ($this->panel($request) !== 'admin') {
            return null;
        }
        $id = $request->route('id');
        if (!is_scalar($id) || !ctype_digit((string) $id)) {
            return null;
        }
        $route = $request->route()?->getName() ?? '';
        if (str_contains($route, 'admission') || str_contains($route, 'admsubmit')) {
            return StudentAdmission::whereKey($id)->value('student_id');
        }
        if (str_contains($route, 'payment')) {
            return Payment::whereKey($id)->value('student_id');
        }
        return str_contains($route, 'student') || str_contains($route, 'stusubmit') ? (int) $id : null;
    }
}
