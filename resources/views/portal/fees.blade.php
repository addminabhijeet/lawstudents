@include('layouts.partials.student.dashboard')
@php
    $inr = fn ($n) => \App\Support\AdminPanel::inr((float) $n);
    [$monthWord, $monthState, $monthDetail] = $month;
    $today = now()->startOfDay();
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Fee Summary</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Fee Summary</li>
                </ul>
            </div>
        </div>

        <div class="main-content">

            <!-- this month -->
            <section class="card sf-now sd-state-{{ $monthState }}" aria-labelledby="sfNowTitle">
                <div class="card-body">
                    <div class="sf-now__main">
                        <p class="sf-now__label">{{ now()->format('F Y') }}</p>
                        <h2 class="sf-now__title" id="sfNowTitle">
                            <span class="sf-now__pill">{{ $monthWord }}</span>
                        </h2>
                        <p class="sf-now__text">{{ $monthDetail }}</p>
                    </div>
                    <div class="sf-now__pay">
                        <span class="sf-now__label">Amount to pay now</span>
                        @if ($owing)
                            <strong class="sf-now__amount">{{ $inr($due) }}</strong>
                            <small>
                                Invoice {{ $owing->invoice_number }}@if ($owing->due_date) · pay by {{ $owing->due_date->format('j M Y') }}@endif
                            </small>
                        @elseif ($monthState === 'alert')
                            <strong class="sf-now__amount">Not billed yet</strong>
                            <small>Your last invoice is paid. Ask the office for {{ now()->format('F') }}'s invoice.</small>
                        @else
                            <strong class="sf-now__amount">{{ $inr(0) }}</strong>
                            <small>Nothing is waiting to be paid.</small>
                        @endif
                    </div>
                    <div class="sf-now__actions">
                        <a href="{{ route('student.viewpayment') }}" class="btn btn-primary"><i class="feather-file me-2"></i>Open payment slip</a>
                        @if ($whatsapp)
                            <a href="{{ $whatsapp }}" target="_blank" rel="noopener" class="btn btn-light-brand"><i class="feather-message-circle me-2"></i>I have paid: tell the office</a>
                        @endif
                    </div>
                </div>
            </section>

            <!-- how to pay -->
            <section class="sf-steps" aria-label="How to pay">
                <div class="sf-step"><span class="sf-step__n">1</span><div><b>Pay</b><small>The bank details are on your payment slip.</small></div></div>
                <div class="sf-step"><span class="sf-step__n">2</span><div><b>Tell the office</b><small>Send them your payment proof on WhatsApp, or by email.</small></div></div>
                <div class="sf-step"><span class="sf-step__n">3</span><div><b>Courses open</b><small>Once the office marks it paid, this month's courses appear.</small></div></div>
            </section>

            <!-- invoices -->
            <section class="card stretch stretch-full" aria-labelledby="sfInvTitle">
                <div class="card-header sf-head">
                    <div>
                        <h2 class="sf-head__title" id="sfInvTitle">Your invoices</h2>
                        <p class="sf-head__sub">{{ $invoices->count() }} invoice{{ $invoices->count() === 1 ? '' : 's' }} · {{ $inr($paidTotal) }} paid so far</p>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover" id="invoiceList">
                            <thead>
                                <tr>
                                    <th>Invoice</th>
                                    <th>Issued</th>
                                    <th>Due date</th>
                                    <th>Total</th>
                                    <th>Paid</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($invoices as $inv)
                                    @php
                                        $late = $inv->due_date && $inv->due_date->lt($today) && in_array($inv->payment_status, ['pending', 'partial'], true);
                                        $word = match ($inv->payment_status) {
                                            'paid' => 'Paid', 'partial' => 'Part paid', 'failed' => 'Failed', 'cancelled' => 'Cancelled', default => 'Unpaid',
                                        };
                                    @endphp
                                    <tr>
                                        <td class="fw-bold text-dark">
                                            {{ $inv->invoice_number }}
                                            @if ($inv->invoice_label)<small class="d-block fw-normal text-muted">{{ $inv->invoice_label }}</small>@endif
                                        </td>
                                        <td>{{ optional($inv->issue_date)->format('j M Y') ?: '—' }}</td>
                                        <td>
                                            {{ optional($inv->due_date)->format('j M Y') ?: 'Not set' }}
                                            @if ($late)<small class="d-block text-danger fw-semibold">Overdue</small>@endif
                                        </td>
                                        <td>{{ $inr($inv->grand_total) }}</td>
                                        <td>{{ $inr($inv->paid_amount ?? 0) }}</td>
                                        <td><div class="badge ls-status">{{ $word }}</div></td>
                                    </tr>
                                @empty
                                    <tr><td colspan="6" class="text-center text-muted">No invoices yet. The office adds them once your admission is set up.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </section>

            <p class="sf-foot">Something looks wrong? <a href="{{ route('student.help') }}">Contact the office</a>. Only the office can change amounts or mark a fee as paid.</p>
        </div>
    </div>
</main>
@include('layouts.partials.student.theme')
