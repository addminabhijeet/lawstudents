@extends('activity.layout')
@section('title', 'Monthly Renewals')
@section('activity-content')
<form class="activity-filters" method="GET">
    <input type="hidden" name="per_page" value="{{ $students->perPage() }}">
    <label>Month<input class="form-control" type="month" name="month" value="{{ $month->format('Y-m') }}" required></label>
    <label>Payment<select class="form-select" name="state"><option value="unpaid" @selected(request('state', 'unpaid') === 'unpaid')>No paid invoice</option><option value="all" @selected(request('state') === 'all')>All approved students</option></select></label>
    <button type="submit" class="btn btn-primary"><i class="feather-filter me-2" aria-hidden="true"></i>Apply</button>
</form>
<div class="activity-stats"><div><span>Approved students</span><strong>{{ $eligibleCount }}</strong></div><div><span>With a paid invoice this month</span><strong>{{ $paidCount }}</strong></div><div><span>Without a paid invoice</span><strong>{{ $eligibleCount - $paidCount }}</strong></div></div>
<p class="small text-muted">Current approved, active students with admissions created by the selected month. Payment month follows the invoice issue date. Historical status changes before tracking began are unavailable.</p>
<div class="table-responsive"><table class="table"><thead><tr><th scope="col">No.</th><th>Student</th><th>Contact</th><th>Monthly invoices</th><th>Last recorded student activity</th><th>Actions</th></tr></thead><tbody>
@forelse($students as $student)
<tr>
    <td>{{ $students->firstItem() + $loop->index }}</td>
    <td>{{ $student->name }}<br>#{{ $student->id }}</td><td>{{ $student->email }}<br>{{ $student->admission?->phone }}</td>
    <td>
        @forelse($student->payments as $payment)
            {{ $payment->invoice_number }}: {{ $payment->payment_status }}<br>
        @empty
            No invoice issued
        @endforelse
    </td>
    <td>{{ $student->last_activity_at ? \Carbon\Carbon::parse($student->last_activity_at)->timezone(config('activity.timezone'))->format('d M Y H:i') : 'No activity recorded' }}</td>
    <td><a href="{{ route('admin.activity.events', ['student_id' => $student->id]) }}">Journey</a><br><a href="{{ route('admin.viewstudent', $student->id) }}">Student details</a></td>
</tr>
@empty
<tr><td colspan="6">No students match this selection.</td></tr>
@endforelse
</tbody></table></div>
@include('admin.partials.pagination', ['paginator' => $students])
@endsection
