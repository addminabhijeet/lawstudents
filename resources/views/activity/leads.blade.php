@extends('activity.layout')
@section('title', 'Admission Enquiries')
@section('activity-content')
<form method="GET" class="activity-filters">
    <input type="hidden" name="per_page" value="{{ $leads->perPage() }}">
    <label>Name, email or phone<input class="form-control" name="q" value="{{ request('q') }}"></label>
    <label>Status<select name="status" class="form-select"><option value="">All</option>@foreach(['new', 'contacted', 'awaiting_student', 'admission_started', 'enrolled', 'closed'] as $status)<option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst(str_replace('_', ' ', $status)) }}</option>@endforeach</select></label>
    <label class="d-flex gap-2 align-items-center"><input type="checkbox" name="overdue" value="1" @checked(request('overdue'))>Overdue only</label>
    <button type="submit" class="btn btn-primary"><i class="feather-search me-2" aria-hidden="true"></i>Search</button>
</form>
<div class="table-responsive"><table class="table table-hover"><thead><tr><th scope="col">No.</th><th>Enquiry</th><th>Contact</th><th>Interest</th><th>Status / owner</th><th>Waiting / first response</th><th>Follow-up due</th></tr></thead><tbody>
    @forelse ($leads as $lead)<tr>
        <td>{{ $leads->firstItem() + $loop->index }}</td>
        <td><a href="{{ route('admin.activity.lead', $lead) }}">#{{ $lead->id }} {{ $lead->name }}</a><br><small>{{ $lead->submitted_at->timezone(config('activity.timezone'))->format('d M Y H:i') }}</small></td>
        <td>{{ $lead->phone ?: '-' }}<br>{{ $lead->email ?: '-' }}</td><td>{{ $lead->course_interest ?: '-' }}</td>
        <td>{{ str_replace('_', ' ', $lead->status) }}<br><small>{{ $lead->assignedAdmin?->name ?: 'Unassigned' }}</small></td>
        <td>{{ number_format($lead->submitted_at->diffInMinutes($lead->first_response_at ?? now()) / 60, 1) }}h {{ $lead->first_response_at ? 'to contact' : 'without recorded contact' }}</td>
        <td class="{{ $lead->next_follow_up_at?->isPast() ? 'text-danger' : '' }}">{{ $lead->next_follow_up_at?->timezone(config('activity.timezone'))->format('d M Y H:i') ?? '-' }}</td>
    </tr>@empty<tr><td colspan="7">No enquiries match these filters.</td></tr>@endforelse
</tbody></table></div>
@include('admin.partials.pagination', ['paginator' => $leads])
@endsection
