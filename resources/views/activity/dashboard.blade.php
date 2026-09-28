@extends('activity.layout')
@section('activity-content')
<form class="activity-filters" method="GET">
    @include('activity.date-filter')
    <button class="btn btn-primary" type="submit"><i class="feather-filter me-2" aria-hidden="true"></i>Apply</button>
</form>
<div class="activity-stats">
    <div><span>Awaiting first response over {{ $target }}h</span><strong>{{ number_format($waiting) }}</strong><a href="{{ route('admin.activity.leads', ['overdue' => 1]) }}">View enquiries</a></div>
    <div><span>Average recorded first response</span><strong>{{ $responseHours === null ? 'No responses' : number_format($responseHours, 1).'h' }}</strong></div>
    <div><span>Form starts without a submit attempt after 30m</span><strong>{{ number_format($unfinished) }}</strong></div>
</div>
<section class="activity-section">
    <h2>Visitor to Admission</h2>
    <table class="table"><thead><tr><th>Stage</th><th>Unique browsers</th><th>Share of visitors</th></tr></thead><tbody>
        @foreach ($funnel as $stage => $count)
            <tr><td>{{ $stage }}</td><td>{{ number_format($count) }}</td><td><meter min="0" max="{{ max(1, reset($funnel)) }}" value="{{ $count }}" aria-label="{{ $stage }}"></meter> {{ reset($funnel) ? number_format($count / reset($funnel) * 100, 1) : 0 }}%</td></tr>
        @endforeach
    </tbody></table>
    <p class="text-muted small">Browser counts cover visits and enquiries in the selected dates, with the latest linked admission status. Shared devices and blocked browser events can affect counts. A pause or missing submission does not establish why someone left.</p>
</section>
<div class="activity-columns">
    <section class="activity-section"><h2>Most Visited Pages</h2><div class="table-responsive"><table class="table"><thead><tr><th>Panel / page</th><th>Views</th><th>Browsers</th></tr></thead><tbody>
        @forelse ($pages as $page)<tr><td><span class="badge bg-light text-dark">{{ $page->panel }}</span> {{ $page->path }}</td><td>{{ $page->views }}</td><td>{{ $page->visitors }}</td></tr>
        @empty<tr><td colspan="3">No visits recorded in this period.</td></tr>@endforelse
    </tbody></table></div></section>
    <section class="activity-section"><h2>Form Friction</h2><div class="table-responsive"><table class="table"><thead><tr><th>Page</th><th>Event</th><th>Count</th></tr></thead><tbody>
        @forelse ($friction as $item)<tr><td>{{ $item->path }}</td><td>{{ str_replace('_', ' ', $item->event) }}</td><td>{{ $item->total }}</td></tr>
        @empty<tr><td colspan="3">No form errors recorded in this period.</td></tr>@endforelse
    </tbody></table></div></section>
</div>
<section class="activity-section"><h2>Admin Follow-ups</h2>
<table class="table"><thead><tr><th>Admin</th><th>Recorded actions</th><th>Enquiries handled</th><th>Contact recorded</th></tr></thead><tbody>
    @forelse ($staff as $row)<tr><td>{{ $row['name'] }}</td><td>{{ $row['actions'] }}</td><td>{{ $row['leads'] }}</td><td>{{ $row['contacted'] }}</td></tr>
    @empty<tr><td colspan="4">No follow-ups recorded in this period.</td></tr>@endforelse
</tbody></table>
<p class="text-muted small">First response measures the time until an admin records contact with the student. Assignments, opening a record, and unanswered calls do not count as contact.</p>
</section>
@endsection
