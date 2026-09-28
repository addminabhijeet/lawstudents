<?php

namespace App\Providers;

use App\Models\ActivityEvent;
use App\Models\AdmissionLead;
use App\Models\LeadFollowUp;
use App\Models\Student;
use App\Services\ActivityTracker;
use App\Services\AdmissionLeadService;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ActivityServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        foreach (['created', 'updated', 'deleted'] as $action) {
            Event::listen('eloquent.'.$action.': App\\Models\\*', function ($eventName, $payload) use ($action) {
                $request = request();
                if (!config('activity.enabled') || !$request->attributes->has('_activity_request_id')) {
                    return;
                }
                $model = $payload[0];
                if ($model instanceof ActivityEvent) {
                    return;
                }
                $tracker = app(ActivityTracker::class);
                try {
                    $changes = $action === 'updated' ? $model->getChanges() : $model->getAttributes();
                    $metadata = ['changed_fields' => $tracker->fields(array_keys($changes))];
                    foreach (['admission_status', 'payment_status'] as $field) {
                        if (array_key_exists($field, $changes)) {
                            $allowed = ['pending', 'approved', 'rejected', 'paid', 'partial', 'failed', 'cancelled'];
                            $metadata[$field] = in_array($model->$field, $allowed, true) ? $model->$field : 'other';
                            $old = $model->getRawOriginal($field);
                            $metadata['previous_'.$field] = in_array($old, $allowed, true) ? $old : null;
                        }
                    }
                    $tracker->record($request, strtolower(class_basename($model)).'_'.$action, [
                        'source' => 'model', 'subject_type' => class_basename($model), 'subject_id' => $model->getKey(),
                        'student_id' => $model instanceof Student ? $model->id : ($model->student_id ?? null),
                        'metadata' => $metadata,
                    ]);
                    if (!$model instanceof AdmissionLead && !$model instanceof LeadFollowUp) {
                        app(AdmissionLeadService::class)->sync($model, $request, $action);
                    }
                } catch (\Throwable $e) {
                    $tracker->failed($request, $e);
                }
            });
        }
        foreach ([\Illuminate\Auth\Events\Login::class => 'login_success',
            \Illuminate\Auth\Events\Failed::class => 'login_failed',
            \Illuminate\Auth\Events\Logout::class => 'logout'] as $class => $name) {
            Event::listen($class, function ($event) use ($name) {
                if (!request()->attributes->has('_activity_request_id')) return;
                app(ActivityTracker::class)->record(request(), $name, [
                    'source' => 'auth', 'actor_type' => $event->guard === 'web' ? 'user' : $event->guard,
                    'actor_id' => $name === 'login_failed' ? null : $event->user?->getAuthIdentifier(),
                    'student_id' => $name !== 'login_failed' && $event->guard === 'student' ? $event->user?->getAuthIdentifier() : null,
                ]);
            });
        }
        View::composer('student.add', function ($view) {
            $lead = auth('admin')->check() && request()->filled('lead')
                ? AdmissionLead::find(request()->integer('lead')) : null;
            $view->with('admissionLead', $lead);
        });
    }
}
