<?php

namespace App\Http\Controllers;

use App\Services\ActivityTracker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class ActivityEventController extends Controller
{
    public function store(Request $request, ActivityTracker $tracker)
    {
        if (!config('activity.enabled')) {
            return response()->noContent();
        }
        $data = $request->validate([
            'context' => 'required|string|max:6000',
            'events' => 'required|array|min:1|max:30',
            'events.*.id' => 'required|uuid',
            'events.*.event' => 'required|in:page_visible,page_engagement,page_leave,click,form_start,field_completed,field_invalid,form_submit_attempt',
            'events.*.elapsed_ms' => 'required|integer|min:0|max:86400000',
            'events.*.form' => 'nullable|string|max:100',
            'events.*.field' => 'nullable|string|max:80',
            'events.*.target' => 'nullable|string|max:200',
            'events.*.active_ms' => 'nullable|integer|min:0|max:60000',
            'events.*.scroll_percent' => 'nullable|integer|min:0|max:100',
        ]);
        try {
            $context = json_decode(Crypt::decryptString($data['context']), true, 512, JSON_THROW_ON_ERROR);
        } catch (\Throwable) {
            abort(422, 'Invalid activity context.');
        }
        $current = $tracker->context($request);
        $actor = $tracker->actor($request, $context['panel']);
        abort_unless(($context['expires'] ?? 0) >= time()
            && $context['visitor_id'] === $current['visitor_id']
            && $context['actor_type'] === $actor['actor_type']
            && $context['actor_id'] === $actor['actor_id'], 403);
        unset($context['expires']);
        foreach ($data['events'] as $event) {
            $metadata = ['elapsed_ms' => $event['elapsed_ms']];
            foreach (['form', 'field', 'target'] as $key) {
                // Browser descriptors contain only structural IDs; never text, hrefs or field values.
                $value = $event[$key] ?? null;
                if ($value && preg_match('/^[a-zA-Z0-9_.:#\[\]-]+$/D', $value) && $tracker->fields([$value])) {
                    $metadata[$key] = $value;
                }
            }
            foreach (['active_ms', 'scroll_percent'] as $key) {
                if (isset($event[$key])) {
                    $metadata[$key] = $event[$key];
                }
            }
            $saved = $tracker->record($request, $event['event'], array_merge($context, [
                'event_id' => $event['id'], 'source' => 'browser', 'metadata' => $metadata,
            ]));
            if (!$saved) {
                return response()->json(['message' => 'Tracking temporarily unavailable.'], 503);
            }
        }
        return response()->noContent();
    }
}
