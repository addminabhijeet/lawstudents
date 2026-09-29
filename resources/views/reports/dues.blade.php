@include('layouts.partials.admin.dashboard')
@php
    $inr = fn ($n) => \App\Support\AdminPanel::inr((float) $n);
    $tabs = [
        'all' => ['All unpaid', 'list'],
        'overdue' => ['Overdue', 'alert-circle'],
        'soon' => ['Due in 7 days', 'clock'],
        'partial' => ['Part paid', 'pie-chart'],
        'undated' => ['No due date', 'calendar'],
    ];
    $today = now()->startOfDay();
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Fees Due</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Fees Due</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.reports.export', 'dues') }}" class="btn btn-primary">
                            <i class="feather-download me-2"></i><span>Download all as CSV</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="main-content">

            <p class="ls-lead">Students whose newest invoice is not fully paid. Each student appears once, with what is still to collect.</p>

            <div class="ls-dues-tabs" role="tablist" aria-label="Filter unpaid fees">
                @foreach ($tabs as $key => [$label, $ico])
                    <a role="tab" aria-selected="{{ $filter === $key ? 'true' : 'false' }}"
                       class="ls-dues-tab {{ $filter === $key ? 'is-on' : '' }} {{ $key === 'overdue' && $totals[$key]['count'] ? 'is-alert' : '' }}"
                       href="{{ route('admin.reports.dues', array_filter(['filter' => $key === 'all' ? null : $key, 'q' => $q ?: null, 'per_page' => $rows->perPage()])) }}">
                        <span class="ls-dues-tab__label"><i class="feather-{{ $ico }}" aria-hidden="true"></i>{{ $label }}</span>
                        <strong>{{ $totals[$key]['count'] }}</strong>
                        <small>{{ $inr($totals[$key]['amount']) }}</small>
                    </a>
                @endforeach
            </div>

            <div class="card stretch stretch-full">
                <div class="card-body p-0">
                    <form method="GET" action="{{ route('admin.reports.dues') }}" class="ls-dues-search">
                        @if ($filter !== 'all')<input type="hidden" name="filter" value="{{ $filter }}">@endif
                        <input type="hidden" name="per_page" value="{{ $rows->perPage() }}">
                        <label class="ls-find">
                            <span class="visually-hidden">Search students</span>
                            <i class="feather-search" aria-hidden="true"></i>
                            <input type="search" name="q" value="{{ $q }}" placeholder="Search name, email, phone or invoice" autocomplete="off">
                        </label>
                        <button class="btn btn-light-brand" type="submit">Search</button>
                        @if ($q)<a class="ls-linkbtn" href="{{ route('admin.reports.dues', array_filter(['filter' => $filter === 'all' ? null : $filter, 'per_page' => $rows->perPage()])) }}">Clear</a>@endif
                    </form>

                    <div class="table-responsive">
                        <table class="table table-hover" id="duesList" data-ls-tools="basic">
                            <thead>
                                <tr>
                                    <th class="wd-30">#</th>
                                    <th>Student</th>
                                    <th>Invoice</th>
                                    <th>Due date</th>
                                    <th>Total</th>
                                    <th>Balance</th>
                                    <th>Status</th>
                                    <th class="text-end">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($rows as $p)
                                    @php
                                        $balance = (float) $p->remaining_amount;
                                        $late = $p->due_date && $p->due_date->lt($today);
                                        $days = $late ? (int) $p->due_date->diffInDays($today) : 0;
                                        $phone = preg_replace('/\D+/', '', (string) $p->to_phone);
                                        $phone = strlen($phone) >= 10 ? substr($phone, -10) : null;
                                        $text = 'Dear ' . ($p->to_name ?: 'student') . ', this is a friendly reminder from Law Students that ' . $inr($balance)
                                            . ' is pending for invoice ' . $p->invoice_number . ($p->due_date ? ' (due ' . $p->due_date->format('j M Y') . ')' : '') . '. Please let us know once it is paid. Thank you.';
                                    @endphp
                                    <tr class="single-item">
                                        <td>{{ $rows->firstItem() + $loop->index }}</td>
                                        <td class="fw-bold text-dark">
                                            {{ $p->to_name }}
                                            <small class="d-block fw-normal text-muted">{{ $p->to_email }}</small>
                                        </td>
                                        <td>{{ $p->invoice_number }}</td>
                                        <td data-sort="{{ optional($p->due_date)->format('Y-m-d') }}">
                                            @if ($p->due_date)
                                                {{ $p->due_date->format('Y-m-d') }}
                                                @if ($late)<small class="d-block text-danger fw-semibold">{{ $days }} day{{ $days == 1 ? '' : 's' }} late</small>@endif
                                            @else
                                                <span class="text-muted">Not set</span>
                                            @endif
                                        </td>
                                        <td>
                                            {{ $inr($p->grand_total) }}
                                            @if ((float) ($p->paid_amount ?? 0) > 0)<small class="d-block text-muted">{{ $inr($p->paid_amount) }} paid</small>@endif
                                        </td>
                                        <td class="fw-bold {{ $late ? 'text-danger' : 'text-dark' }}">{{ $inr($balance) }}</td>
                                        <td>
                                            @if ($p->payment_status === 'partial')
                                                <div class="badge bg-soft-warning text-warning">Part paid</div>
                                            @else
                                                <div class="badge bg-soft-danger text-danger">Unpaid</div>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="hstack gap-2 justify-content-end">
                                                <a href="{{ route('admin.editpayment', $p->id) }}" class="avatar-text avatar-md" title="Edit payment" aria-label="Edit payment">
                                                    <i class="feather feather-edit"></i>
                                                </a>
                                                @if ($phone)
                                                    <a href="https://wa.me/91{{ $phone }}?text={{ rawurlencode($text) }}" target="_blank" rel="noopener" class="avatar-text avatar-md" title="WhatsApp reminder" aria-label="WhatsApp reminder" data-rt-label="Remind">
                                                        <i class="feather feather-message-circle"></i>
                                                    </a>
                                                @endif
                                                @if ($p->to_email)
                                                    <a href="mailto:{{ $p->to_email }}?subject={{ rawurlencode('Fee reminder - ' . $p->invoice_number) }}&body={{ rawurlencode($text) }}" class="avatar-text avatar-md" title="Email reminder" aria-label="Email reminder" data-rt-label="Email">
                                                        <i class="feather feather-mail"></i>
                                                    </a>
                                                @endif
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="8" class="text-center text-muted">No unpaid fees match. Nothing to chase here.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    @include('admin.partials.pagination', ['paginator' => $rows])
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
