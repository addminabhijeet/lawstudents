@extends('activity.layout')
@section('title', 'Activity Timeline')
@section('activity-content')
<form method="GET" class="activity-filters">
    @include('activity.date-filter')
    <label>Panel<select name="panel" class="form-select"><option value="">All</option>@foreach(['website', 'student', 'admin', 'api'] as $panel)<option @selected(request('panel') === $panel)>{{ $panel }}</option>@endforeach</select></label>
    <label>Actor<select name="actor_type" class="form-select"><option value="">All</option>@foreach(['visitor', 'student', 'admin', 'user'] as $actor)<option @selected(request('actor_type') === $actor)>{{ $actor }}</option>@endforeach</select></label>
    <label>Actor ID<input name="actor_id" type="number" min="1" class="form-control" value="{{ request('actor_id') }}"></label>
    <label>Student ID<input name="student_id" type="number" min="1" class="form-control" value="{{ request('student_id') }}"></label>
    <label>Visitor ID<input name="visitor_id" class="form-control" value="{{ request('visitor_id') }}"></label>
    <label>Event<input name="event" class="form-control" value="{{ request('event') }}"></label>
    <button class="btn btn-primary" type="submit"><i class="feather-filter me-2" aria-hidden="true"></i>Apply</button>
    <a href="{{ route('admin.activity.events') }}">Clear</a>
</form>
@include('activity.event-table')
@endsection
