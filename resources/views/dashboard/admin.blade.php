@include('layouts.partials.admin.dashboard')
@php
    /* Indian digit grouping: 12,66,395 */
    $inr = function ($n, $dec = 0) {
        $n = round((float) $n, $dec);
        $neg = $n < 0;
        [$int, $frac] = array_pad(explode('.', number_format(abs($n), $dec, '.', '')), 2, null);
        $tail = substr($int, -3);
        $head = substr($int, 0, -3);
        $head = $head === '' ? '' : preg_replace('/\B(?=(\d{2})+(?!\d))/', ',', $head) . ',';
        return ($neg ? '-' : '') . '₹' . $head . $tail . ($frac !== null ? '.' . $frac : '');
    };
    $today = $dash['today'];
    $hour = (int) $today->format('G');
    $greeting = $hour < 12 ? 'Good morning' : ($hour < 17 ? 'Good afternoon' : 'Good evening');
    $adminName = auth('admin')->user()?->name;
    $money = $dash['money'];
    $adm = $dash['admission_status'];
    $pay = $dash['payment_status'];
    $due = $pay['partial'] + $pay['pending'];
    $admTotal = max(1, array_sum($adm));
    $series = $dash['series'];
    $maxStudents = max(1, ...($series['students'] ?: [1]));
    $maxMoney = max(1, ...(array_merge($series['billed'] ?: [1], $series['collected'] ?: [1])));
    $enq = $dash['enquiries'];
    $overdue = $dash['overdue'];
    $attentionTotal = $overdue['count'] + $adm['pending'] + $enq['messages'] + $enq['leads'];

    // calendar for the current month (Monday first)
    $first = $today->copy()->startOfMonth();
    $lead = ($first->dayOfWeekIso + 6) % 7;
    $days = $today->daysInMonth;
@endphp
<main class="nxl-container ls-dashboard">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Dashboard</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Count View</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">

            <!-- Welcome -->
            <section class="ls-hero" aria-label="Welcome">
                <div class="ls-hero__text">
                    <p class="ls-hero__eyebrow">{{ $today->format('l, j F Y') }}</p>
                    <h1 class="ls-hero__title">{{ $greeting }}@if ($adminName), {{ $adminName }}@endif</h1>
                    <p class="ls-hero__lead">
                        @if ($attentionTotal > 0)
                            {{ $attentionTotal }} item{{ $attentionTotal == 1 ? '' : 's' }} need{{ $attentionTotal == 1 ? 's' : '' }} your attention today. Everything you need next is one tap away.
                        @else
                            Everything is up to date. Pick a task below to carry on.
                        @endif
                    </p>
                </div>
                <div class="ls-hero__actions">
                    <a class="btn btn-primary" href="{{ route('admin.addstudent') }}"><i class="feather-user-plus me-2"></i>Add student</a>
                    <a class="btn btn-light-brand" href="{{ route('admin.listpayment') }}"><i class="feather-credit-card me-2"></i>Payments</a>
                    <button type="button" class="btn btn-light-brand" data-ls-open="palette"><i class="feather-search me-2"></i>Search</button>
                </div>
            </section>

            <!-- The six counts (each opens its list) -->
            <section class="ls-stats" aria-label="Key numbers">
                <a class="ls-stat" href="{{ route('admin.liststudent') }}" aria-label="Open students list">
                    <span class="ls-stat__icon"><i class="feather-users"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $studentsCount }}</span></span>
                        <span class="ls-stat__label">Total Students</span>
                        <span class="ls-stat__sub">
                            @if ($dash['students']['this_month'] > 0)
                                +{{ $dash['students']['this_month'] }} this month
                                @if ($dash['students']['delta'] !== null)
                                    <span class="ls-trend {{ $dash['students']['delta'] >= 0 ? 'is-up' : 'is-down' }}">{{ $dash['students']['delta'] >= 0 ? '▲' : '▼' }} {{ abs($dash['students']['delta']) }}%</span>
                                @endif
                            @else
                                None new this month
                            @endif
                        </span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
                <a class="ls-stat" href="{{ route('admin.listadmission') }}" aria-label="Open admissions list">
                    <span class="ls-stat__icon"><i class="feather-file-text"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $admissionsCount }}</span></span>
                        <span class="ls-stat__label">Total Admissions</span>
                        <span class="ls-stat__sub">{{ $adm['approved'] }} approved · {{ $adm['pending'] }} waiting</span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
                <a class="ls-stat" href="{{ route('admin.listpayment') }}" aria-label="Open payments list">
                    <span class="ls-stat__icon"><i class="feather-dollar-sign"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $paymentsCount }}</span></span>
                        <span class="ls-stat__label">Total Payments</span>
                        <span class="ls-stat__sub">{{ $pay['paid'] }} paid · {{ $due }} still due</span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
                <a class="ls-stat" href="{{ route('admin.listidcard') }}" aria-label="Open ID cards list">
                    <span class="ls-stat__icon"><i class="feather-credit-card"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $idCardsCount }}</span></span>
                        <span class="ls-stat__label">Total ID Cards</span>
                        <span class="ls-stat__sub">Admission numbers issued</span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
                <a class="ls-stat" href="{{ route('admin.listcourse') }}" aria-label="Open courses list">
                    <span class="ls-stat__icon"><i class="feather-book"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $coursesCount }}</span></span>
                        <span class="ls-stat__label">Total Courses</span>
                        <span class="ls-stat__sub">Manage courses</span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
                <a class="ls-stat" href="{{ route('admin.listnotes') }}" aria-label="Open notes list">
                    <span class="ls-stat__icon"><i class="feather-file"></i></span>
                    <span class="ls-stat__body">
                        <span class="ls-stat__num"><span class="counter">{{ $notesCount }}</span></span>
                        <span class="ls-stat__label">Total Notes</span>
                        <span class="ls-stat__sub">Study material</span>
                    </span>
                    <i class="feather-arrow-up-right ls-stat__go" aria-hidden="true"></i>
                </a>
            </section>

            <div class="row g-4 ls-dash-row">

                <!-- Fees -->
                <div class="col-xl-8">
                    <section class="card ls-card" aria-labelledby="lsFeesTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsFeesTitle">Fees</h2>
                                <p class="ls-card__sub">Across every invoice on record</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.reports.dues') }}">Fees due</a>
                        </div>
                        <div class="card-body">
                            <div class="ls-money">
                                <div class="ls-money__item">
                                    <span class="ls-money__label">Billed</span>
                                    <strong class="ls-money__num">{{ $inr($money['billed']) }}</strong>
                                </div>
                                <div class="ls-money__item">
                                    <span class="ls-money__label">Collected</span>
                                    <strong class="ls-money__num is-good">{{ $inr($money['collected']) }}</strong>
                                </div>
                                <div class="ls-money__item">
                                    <span class="ls-money__label">Outstanding</span>
                                    <strong class="ls-money__num is-warn">{{ $inr($money['outstanding']) }}</strong>
                                </div>
                            </div>
                            <div class="ls-meter" role="img" aria-label="{{ $money['rate'] }} percent of billed fees collected">
                                <div class="ls-meter__bar"><span style="width: {{ min(100, $money['rate']) }}%"></span></div>
                                <span class="ls-meter__text">{{ $money['rate'] }}% collected</span>
                            </div>

                            <div class="ls-chart" role="img" aria-label="Fees billed and collected in each of the last six months">
                                <div class="ls-chart__legend">
                                    <span><i class="ls-dot ls-dot--soft"></i>Billed</span>
                                    <span><i class="ls-dot ls-dot--gold"></i>Collected</span>
                                </div>
                                <div class="ls-chart__cols">
                                    @foreach ($series['labels'] as $i => $label)
                                        <div class="ls-chart__col">
                                            <div class="ls-chart__bars" title="{{ $label }}: billed {{ $inr($series['billed'][$i]) }}, collected {{ $inr($series['collected'][$i]) }}">
                                                <span class="ls-bar ls-bar--soft" style="height: {{ round($series['billed'][$i] / $maxMoney * 100) }}%"></span>
                                                <span class="ls-bar ls-bar--gold" style="height: {{ round($series['collected'][$i] / $maxMoney * 100) }}%"></span>
                                            </div>
                                            <span class="ls-chart__x">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                </div>
                                <p class="ls-chart__note">By the month each invoice was raised.</p>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Needs attention -->
                <div class="col-xl-4">
                    <section class="card ls-card" aria-labelledby="lsAttTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsAttTitle">Needs attention</h2>
                                <p class="ls-card__sub">What to do next</p>
                            </div>
                        </div>
                        <div class="card-body ls-todo">
                            <a class="ls-todo__item {{ $overdue['count'] ? 'is-alert' : '' }}" href="{{ route('admin.reports.dues', ['filter' => 'overdue']) }}">
                                <span class="ls-todo__icon"><i class="feather-alert-circle"></i></span>
                                <span class="ls-todo__text"><strong>{{ $overdue['count'] }}</strong> overdue payment{{ $overdue['count'] == 1 ? '' : 's' }}
                                    @if ($overdue['count'])<small>{{ $inr($overdue['amount']) }} to collect</small>@endif</span>
                                <i class="feather-chevron-right" aria-hidden="true"></i>
                            </a>
                            <a class="ls-todo__item" href="{{ route('admin.listadmission') }}">
                                <span class="ls-todo__icon"><i class="feather-file-text"></i></span>
                                <span class="ls-todo__text"><strong>{{ $adm['pending'] }}</strong> admission{{ $adm['pending'] == 1 ? '' : 's' }} to approve</span>
                                <i class="feather-chevron-right" aria-hidden="true"></i>
                            </a>
                            <a class="ls-todo__item" href="{{ route('admin.listcontactform') }}">
                                <span class="ls-todo__icon"><i class="feather-inbox"></i></span>
                                <span class="ls-todo__text"><strong>{{ $enq['messages'] }}</strong> new contact message{{ $enq['messages'] == 1 ? '' : 's' }}<small>last 7 days</small></span>
                                <i class="feather-chevron-right" aria-hidden="true"></i>
                            </a>
                            <a class="ls-todo__item" href="{{ route('admin.activity.leads') }}">
                                <span class="ls-todo__icon"><i class="feather-phone-call"></i></span>
                                <span class="ls-todo__text"><strong>{{ $enq['leads'] }}</strong> new admission enquir{{ $enq['leads'] == 1 ? 'y' : 'ies' }}</span>
                                <i class="feather-chevron-right" aria-hidden="true"></i>
                            </a>

                            @if (count($overdue['rows']))
                                <h3 class="ls-todo__head">Most overdue</h3>
                                @foreach ($overdue['rows'] as $row)
                                    <a class="ls-todo__row" href="{{ route('admin.editpayment', $row->id) }}">
                                        <span class="ls-todo__name">{{ $row->to_name ?: $row->invoice_number }}</span>
                                        <span class="ls-todo__meta">due {{ optional($row->due_date)->format('j M') }} · {{ $inr($row->remaining_amount ?: $row->grand_total) }}</span>
                                    </a>
                                @endforeach
                            @endif
                        </div>
                    </section>
                </div>

                <!-- New students per month -->
                <div class="col-xl-4 col-md-6">
                    <section class="card ls-card" aria-labelledby="lsNewTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsNewTitle">New students</h2>
                                <p class="ls-card__sub">Last six months</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="ls-chart ls-chart--single" role="img" aria-label="Students registered in each of the last six months">
                                <div class="ls-chart__cols">
                                    @foreach ($series['labels'] as $i => $label)
                                        <div class="ls-chart__col">
                                            <span class="ls-chart__val">{{ $series['students'][$i] }}</span>
                                            <div class="ls-chart__bars" title="{{ $label }}: {{ $series['students'][$i] }} new">
                                                <span class="ls-bar ls-bar--gold" style="height: {{ round($series['students'][$i] / $maxStudents * 100) }}%"></span>
                                            </div>
                                            <span class="ls-chart__x">{{ $label }}</span>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Admission status -->
                <div class="col-xl-4 col-md-6">
                    <section class="card ls-card" aria-labelledby="lsAdmTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsAdmTitle">Admission status</h2>
                                <p class="ls-card__sub">{{ array_sum($adm) }} admissions</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.listadmission') }}">Review</a>
                        </div>
                        <div class="card-body">
                            @php
                                $pA = round($adm['approved'] / $admTotal * 100);
                                $pP = round($adm['pending'] / $admTotal * 100);
                            @endphp
                            <div class="ls-donut-wrap">
                                <div class="ls-donut" role="img" aria-label="{{ $adm['approved'] }} approved, {{ $adm['pending'] }} waiting, {{ $adm['rejected'] }} rejected"
                                     style="--a: {{ $pA }}%; --p: {{ $pA + $pP }}%">
                                    <div class="ls-donut__hole"><strong>{{ $pA }}%</strong><span>approved</span></div>
                                </div>
                                <ul class="ls-legend">
                                    <li><i class="ls-dot ls-dot--gold"></i>Approved <strong>{{ $adm['approved'] }}</strong></li>
                                    <li><i class="ls-dot ls-dot--ink"></i>Waiting <strong>{{ $adm['pending'] }}</strong></li>
                                    <li><i class="ls-dot ls-dot--soft"></i>Rejected <strong>{{ $adm['rejected'] }}</strong></li>
                                </ul>
                            </div>
                        </div>
                    </section>
                </div>

                <!-- Calendar -->
                <div class="col-xl-4 col-md-12">
                    <section class="card ls-card" aria-labelledby="lsCalTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsCalTitle">{{ $today->format('F Y') }}</h2>
                                <p class="ls-card__sub">Today is {{ $today->format('j F') }}</p>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="ls-cal ls-no-tools" aria-label="Calendar for {{ $today->format('F Y') }}">
                                <thead><tr>@foreach (['Mo', 'Tu', 'We', 'Th', 'Fr', 'Sa', 'Su'] as $d)<th scope="col">{{ $d }}</th>@endforeach</tr></thead>
                                <tbody>
                                    @php $cell = 0; @endphp
                                    <tr>
                                        @for ($i = 0; $i < $lead; $i++)<td></td>@php $cell++; @endphp @endfor
                                        @for ($d = 1; $d <= $days; $d++)
                                            @if ($cell % 7 === 0 && $cell > 0)</tr><tr>@endif
                                            <td class="{{ $d === (int) $today->format('j') ? 'is-today' : '' }} {{ in_array($cell % 7, [5, 6], true) ? 'is-weekend' : '' }}">{{ $d }}</td>
                                            @php $cell++; @endphp
                                        @endfor
                                        @while ($cell % 7 !== 0)<td></td>@php $cell++; @endphp @endwhile
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </section>
                </div>

                <!-- Recent students -->
                <div class="col-xl-6">
                    <section class="card ls-card" aria-labelledby="lsRsTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsRsTitle">Recent students</h2>
                                <p class="ls-card__sub">Latest registrations</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.liststudent') }}">All students</a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="ls-list">
                                @forelse ($dash['recent_students'] as $s)
                                    <li>
                                        <a class="ls-list__row" href="{{ route('admin.viewstudent', $s->id) }}">
                                            <span class="ls-avatar" aria-hidden="true">{{ strtoupper(mb_substr($s->name ?: '?', 0, 1)) }}</span>
                                            <span class="ls-list__main">
                                                <strong>{{ $s->name }}</strong>
                                                <small>{{ $s->username }} · {{ $s->email }}</small>
                                            </span>
                                            <time class="ls-list__time" datetime="{{ $s->created_at }}">{{ $s->created_at?->diffForHumans(null, true, true) }}</time>
                                        </a>
                                    </li>
                                @empty
                                    <li class="ls-list__empty">No students yet. <a href="{{ route('admin.addstudent') }}">Add the first student</a>.</li>
                                @endforelse
                            </ul>
                        </div>
                    </section>
                </div>

                <!-- Recent payments -->
                <div class="col-xl-6">
                    <section class="card ls-card" aria-labelledby="lsRpTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsRpTitle">Recent payments</h2>
                                <p class="ls-card__sub">Latest invoices</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.listpayment') }}">All payments</a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="ls-list">
                                @forelse ($dash['recent_payments'] as $p)
                                    <li>
                                        <a class="ls-list__row" href="{{ route('admin.editpayment', $p->id) }}">
                                            <span class="ls-avatar ls-avatar--ink" aria-hidden="true"><i class="feather-credit-card"></i></span>
                                            <span class="ls-list__main">
                                                <strong>{{ $p->to_name ?: $p->invoice_number }}</strong>
                                                <small>{{ $p->invoice_number }}</small>
                                            </span>
                                            <span class="ls-list__end">
                                                <b>{{ $inr($p->grand_total) }}</b>
                                                <span class="ls-pill ls-pill--{{ $p->payment_status === 'paid' ? 'good' : ($p->payment_status === 'failed' || $p->payment_status === 'cancelled' ? 'bad' : 'warn') }}">{{ ucfirst($p->payment_status) }}</span>
                                            </span>
                                        </a>
                                    </li>
                                @empty
                                    <li class="ls-list__empty">No payments yet.</li>
                                @endforelse
                            </ul>
                        </div>
                    </section>
                </div>

                <!-- Awaiting approval -->
                <div class="col-xl-6">
                    <section class="card ls-card" aria-labelledby="lsApTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsApTitle">Waiting for approval</h2>
                                <p class="ls-card__sub">Open one to review and decide</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.listadmission') }}">All admissions</a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="ls-list">
                                @forelse ($dash['awaiting_approval'] as $a)
                                    <li>
                                        <a class="ls-list__row" href="{{ route('admin.showadmission', $a->id) }}">
                                            <span class="ls-avatar" aria-hidden="true">{{ strtoupper(mb_substr($a->full_name ?: '?', 0, 1)) }}</span>
                                            <span class="ls-list__main">
                                                <strong>{{ $a->full_name ?: 'Unnamed applicant' }}</strong>
                                                <small>{{ $a->admno ?: 'No admission number yet' }}</small>
                                            </span>
                                            <time class="ls-list__time" datetime="{{ $a->created_at }}">{{ $a->created_at?->diffForHumans(null, true, true) }}</time>
                                        </a>
                                    </li>
                                @empty
                                    <li class="ls-list__empty">Nothing is waiting. Well done.</li>
                                @endforelse
                            </ul>
                        </div>
                    </section>
                </div>

                <!-- Recent messages -->
                <div class="col-xl-6">
                    <section class="card ls-card" aria-labelledby="lsMsTitle">
                        <div class="card-header ls-card__head">
                            <div>
                                <h2 class="ls-card__title" id="lsMsTitle">Latest messages</h2>
                                <p class="ls-card__sub">From the website contact form</p>
                            </div>
                            <a class="btn btn-sm btn-light-brand" href="{{ route('admin.listcontactform') }}">All messages</a>
                        </div>
                        <div class="card-body p-0">
                            <ul class="ls-list">
                                @forelse ($dash['recent_messages'] as $m)
                                    <li>
                                        <a class="ls-list__row" href="{{ route('admin.viewcontactform', $m->id) }}">
                                            <span class="ls-avatar ls-avatar--ink" aria-hidden="true"><i class="feather-inbox"></i></span>
                                            <span class="ls-list__main">
                                                <strong>{{ trim($m->first_name . ' ' . $m->last_name) }}</strong>
                                                <small>{{ \Illuminate\Support\Str::limit(($m->service_type ? $m->service_type . ' — ' : '') . $m->message, 70) }}</small>
                                            </span>
                                            <time class="ls-list__time" datetime="{{ $m->created_at }}">{{ $m->created_at?->diffForHumans(null, true, true) }}</time>
                                        </a>
                                    </li>
                                @empty
                                    <li class="ls-list__empty">No messages yet.</li>
                                @endforelse
                            </ul>
                        </div>
                    </section>
                </div>
            </div>

            <!-- Shortcuts -->
            <section class="ls-launch" aria-labelledby="lsLaunchTitle">
                <h2 class="ls-launch__title" id="lsLaunchTitle">Jump to</h2>
                <div class="ls-launch__grid">
                    <a href="{{ route('admin.addstudent') }}"><i class="feather-user-plus"></i><span>Add student</span></a>
                    <a href="{{ route('admin.listadmission') }}"><i class="feather-file-text"></i><span>Admissions</span></a>
                    <a href="{{ route('admin.listidcard') }}"><i class="feather-user-check"></i><span>ID cards</span></a>
                    <a href="{{ route('admin.listcourse') }}"><i class="feather-book-open"></i><span>Courses</span></a>
                    <a href="{{ route('admin.listnotes') }}"><i class="feather-file"></i><span>Course notes</span></a>
                    <a href="{{ route('admin.listacts') }}"><i class="feather-book"></i><span>Acts</span></a>
                    <a href="{{ route('admin.listrules') }}"><i class="feather-shield"></i><span>Rules</span></a>
                    <a href="{{ route('admin.listgovtexams') }}"><i class="feather-award"></i><span>Govt. exams</span></a>
                    <a href="{{ route('admin.listlegalknowledgelibrary') }}"><i class="feather-layers"></i><span>Legal knowledge</span></a>
                    <a href="{{ route('admin.listcopys') }}"><i class="feather-edit"></i><span>Free notes</span></a>
                    <a href="{{ route('admin.listgallery') }}"><i class="feather-image"></i><span>Gallery</span></a>
                    <a href="{{ route('admin.activity.index') }}"><i class="feather-bar-chart-2"></i><span>Analytics</span></a>
                </div>
            </section>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>
@include('layouts.partials.admin.theme')
