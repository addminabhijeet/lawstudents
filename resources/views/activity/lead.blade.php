@extends('activity.layout')
@section('title', 'Enquiry #'.$lead->id)
@section('activity-content')
<div class="activity-columns">
    <section class="activity-section"><h2>{{ $lead->name }}</h2>
        <dl class="activity-facts">
            <dt>Email</dt><dd>{{ $lead->email ?: '-' }}</dd><dt>Phone</dt><dd>{{ $lead->phone ?: '-' }}</dd>
            <dt>Course interest</dt><dd>{{ $lead->course_interest ?: '-' }}</dd><dt>Source</dt><dd>{{ str_replace('_', ' ', $lead->source) }}</dd>
            <dt>Submitted</dt><dd>{{ $lead->submitted_at->timezone(config('activity.timezone'))->format('d M Y H:i') }}</dd>
            <dt>Status</dt><dd>{{ str_replace('_', ' ', $lead->status) }}</dd>
            <dt>First contact recorded</dt><dd>{{ $lead->first_response_at?->timezone(config('activity.timezone'))->format('d M Y H:i') ?: 'Awaiting contact' }}</dd>
            <dt>Assigned to</dt><dd>{{ $lead->assignedAdmin?->name ?: 'Unassigned' }}</dd>
        </dl>
        <div class="activity-actions">
            @if($lead->phone)<a class="btn btn-outline-primary" data-track="call-lead" href="tel:{{ preg_replace('/[^+0-9]/', '', $lead->phone) }}"><i class="feather-phone me-2" aria-hidden="true"></i>Call</a>@endif
            @if($lead->email)<a class="btn btn-outline-primary" data-track="email-lead" href="mailto:{{ $lead->email }}"><i class="feather-mail me-2" aria-hidden="true"></i>Email</a>@endif
            @if($lead->student_id)
                <a class="btn btn-primary" href="{{ route('admin.editstudent', $lead->student_id) }}">Open student #{{ $lead->student_id }}</a>
                @if($lead->student?->admission)<a class="btn btn-outline-primary" href="{{ route('admin.editadmission', $lead->student->admission->id) }}">Complete admission</a>@endif
            @else
                <a class="btn btn-primary" data-track="start-admission" href="{{ route('admin.addstudent', ['lead' => $lead->id]) }}">Start registration</a>
            @endif
        </div>
    </section>
    <section class="activity-section"><h2>Record Follow-up</h2>
        <form method="POST" action="{{ route('admin.activity.follow-up', $lead) }}" class="activity-form" id="lead-follow-up">
            @csrf
            <label>Outcome<select name="outcome" class="form-select" required>
                @foreach(['contacted' => 'Spoke / replied to student', 'no_answer' => 'No answer', 'awaiting_student' => 'Waiting for student', 'admission_started' => 'Admission in progress', 'assigned' => 'Assigned / internal note', 'closed' => 'Closed'] as $value => $label)<option value="{{ $value }}" @selected(old('outcome') === $value)>{{ $label }}</option>@endforeach
            </select></label>
            <label>Assigned admin<select class="form-select" name="assigned_admin_id"><option value="">Current owner / me</option>@foreach($admins as $admin)<option value="{{ $admin->id }}" @selected((int)old('assigned_admin_id', $lead->assigned_admin_id) === $admin->id)>{{ $admin->name }}</option>@endforeach</select></label>
            @if(!$lead->student_id)
                <label>Existing student ID (optional)<input class="form-control" name="student_id" type="number" min="1" value="{{ old('student_id') }}"></label>
                @foreach($matches as $match)<p class="small">Matching email: {{ $match->name }}, student #{{ $match->id }}</p>@endforeach
            @endif
            <label>Next follow-up ({{ config('activity.timezone') }})<input class="form-control" type="datetime-local" name="next_follow_up_at" value="{{ old('next_follow_up_at', $lead->next_follow_up_at?->timezone(config('activity.timezone'))->format('Y-m-d\TH:i')) }}"></label>
            <label>Notes<textarea class="form-control" name="note" rows="3" maxlength="2000">{{ old('note') }}</textarea></label>
            <button class="btn btn-primary" type="submit"><i class="feather-save me-2" aria-hidden="true"></i>Save follow-up</button>
        </form>
    </section>
</div>
<section class="activity-section"><h2>Contact History</h2>
    @forelse($followUps as $follow)
        <article class="activity-follow-up"><span class="text-muted me-2">{{ $followUps->firstItem() + $loop->index }}.</span><strong>{{ $follow->admin?->name ?: 'Admin #'.$follow->admin_id }}</strong> &middot; {{ str_replace('_', ' ', $follow->outcome) }}
            <time>{{ $follow->created_at->timezone(config('activity.timezone'))->format('d M Y H:i') }}</time><p>{{ $follow->note }}</p></article>
    @empty<p>No contact recorded yet.</p>@endforelse
    @include('admin.partials.pagination', ['paginator' => $followUps])
</section>
<section class="activity-section"><h2>Journey</h2>@include('activity.event-table')</section>
@endsection
