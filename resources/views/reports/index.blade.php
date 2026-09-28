@include('layouts.partials.admin.dashboard')
@php
    $cards = [
        ['students', 'Students', 'users', 'Every registered student: username, name, email and registration date.', route('admin.liststudent'), 'Open students', false],
        ['admissions', 'Admissions', 'file-text', 'Admission number, contact details, course(s), session, status and fee balance. Aadhaar and PAN numbers are left out.', route('admin.listadmission'), 'Open admissions', 'status:admissions'],
        ['payments', 'Payments', 'credit-card', 'Every invoice with total, paid, remaining and status.', route('admin.listpayment'), 'Open payments', 'status:payments'],
        ['dues', 'Fees due', 'alert-circle', 'One line per student whose newest invoice is unpaid or part paid, with days overdue.', route('admin.reports.dues'), 'Open fees due', false],
        ['messages', 'Contact messages', 'inbox', 'Messages sent through the website contact form.', route('admin.listcontactform'), 'Open messages', 'dates'],
    ];
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Reports &amp; Exports</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Reports &amp; Exports</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <p class="ls-lead">Download complete lists as spreadsheet (CSV) files that open in Excel or Google Sheets. Unlike the Export button on a list page, these include every record, not just the page on screen.</p>

            <div class="ls-reports">
                @foreach ($cards as [$type, $title, $ico, $text, $openUrl, $openLabel, $extra])
                    <section class="card ls-report" aria-labelledby="rep-{{ $type }}">
                        <div class="card-body">
                            <div class="ls-report__head">
                                <span class="ls-report__icon"><i class="feather-{{ $ico }}" aria-hidden="true"></i></span>
                                <div>
                                    <h2 class="ls-report__title" id="rep-{{ $type }}">{{ $title }}</h2>
                                    <p class="ls-report__count"><strong>{{ number_format($counts[$type]) }}</strong> record{{ $counts[$type] == 1 ? '' : 's' }}</p>
                                </div>
                            </div>
                            <p class="ls-report__text">{{ $text }}</p>

                            <form method="GET" action="{{ route('admin.reports.export', $type) }}" class="ls-report__form">
                                @if ($extra)
                                    <div class="ls-report__filters">
                                        @if ($extra === 'status:admissions')
                                            <label>Status
                                                <select name="status" class="form-select form-select-sm">
                                                    <option value="">Any</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="approved">Approved</option>
                                                    <option value="rejected">Rejected</option>
                                                </select>
                                            </label>
                                        @elseif ($extra === 'status:payments')
                                            <label>Status
                                                <select name="status" class="form-select form-select-sm">
                                                    <option value="">Any</option>
                                                    <option value="pending">Pending</option>
                                                    <option value="partial">Part paid</option>
                                                    <option value="paid">Paid</option>
                                                    <option value="failed">Failed</option>
                                                </select>
                                            </label>
                                        @endif
                                        <label>From <input type="date" name="from" class="form-control form-control-sm"></label>
                                        <label>To <input type="date" name="to" class="form-control form-control-sm"></label>
                                    </div>
                                @endif
                                <div class="ls-report__buttons">
                                    <button type="submit" class="btn btn-primary"><i class="feather-download me-2"></i>Download CSV</button>
                                    <a href="{{ $openUrl }}" class="btn btn-light-brand">{{ $openLabel }}</a>
                                </div>
                            </form>
                        </div>
                    </section>
                @endforeach
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
