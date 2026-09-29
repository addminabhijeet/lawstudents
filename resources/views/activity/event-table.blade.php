<div class="table-responsive"><table class="table table-hover activity-table">
    <thead><tr><th scope="col">No.</th><th>Time ({{ config('activity.timezone') }})</th><th>Who</th><th>Action</th><th>Page / record</th><th>Details</th></tr></thead>
    <tbody>@forelse ($events as $event)
        <tr>
            <td>{{ $events->firstItem() + $loop->index }}</td>
            <td>{{ $event->occurred_at->timezone(config('activity.timezone'))->format('d M Y H:i:s') }}</td>
            <td><a href="{{ route('admin.activity.events', $event->actor_id ? ['actor_type' => $event->actor_type, 'actor_id' => $event->actor_id] : ['visitor_id' => $event->visitor_id]) }}">{{ ucfirst($event->actor_type) }} {{ $event->actor_id ? '#'.$event->actor_id : substr($event->visitor_id ?? '', 0, 8) }}</a>
                @if($event->student_id)<br><a href="{{ route('admin.activity.events', ['student_id' => $event->student_id]) }}">Student #{{ $event->student_id }}</a>@endif</td>
            <td>{{ str_replace('_', ' ', $event->event) }}<br><small class="text-muted">{{ $event->source }} / {{ $event->panel }}</small></td>
            <td>{{ $event->method }} {{ $event->path }}@if($event->subject_type)<br>{{ $event->subject_type }} #{{ $event->subject_id }}@endif</td>
            <td>
                @if($event->status_code)
                    HTTP {{ $event->status_code }}
                @endif
                @if($event->duration_ms !== null)
                    {{ $event->duration_ms }}ms
                @endif
                @if($event->metadata)
                    <details><summary>Event details</summary><pre>{{ json_encode($event->metadata, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) }}</pre></details>
                @endif
            </td>
        </tr>
    @empty
        <tr><td colspan="6">No matching activity.</td></tr>
    @endforelse</tbody>
</table></div>
@include('admin.partials.pagination', ['paginator' => $events])
