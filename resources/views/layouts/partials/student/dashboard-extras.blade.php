{{-- Student panel layer (student-panel.css / .js, panel-suite.css / .js): the menu keeps its labels on laptop
     screens, tab titles name the page, the template's Theme Settings drawer is hidden.
     On the dashboard ($studentDashboard, from StudentDashboardServiceProvider) it adds
     the overview above the cards: a welcome, the one next step, and shortcuts. --}}
@php $studentPanelAsset = fn($path) => asset($path) . '?v=' . @filemtime(public_path($path)); @endphp
<link rel="stylesheet" href="{{ $studentPanelAsset('assets/css/student-panel.css') }}">

@isset($studentDashboard)
    @php
        $sd = $studentDashboard;
        $sdNext = $sd['next'];
        $sdShortcuts = [
            ['My Courses', route('student.listcourse'), 'feather-book-open',
                $sd['openCourses'] ? $sd['openCourses'] . ' open this month' : 'Locked until ' . $sd['month'] . ' is paid'],
            ['Favourite Notes', route('student.listnotes'), 'feather-bookmark', 'Notes you saved'],
            ['ID Card', route('student.viewidcard'), 'feather-credit-card', $sd['idCardReady'] ? 'Ready to print' : 'Not ready yet'],
            ['Payment Slips', route('student.viewpayment'), 'feather-file-text',
                $sd['invoiceCount'] . ' ' . ($sd['invoiceCount'] === 1 ? 'slip' : 'slips') . ' and bank details'],
        ];

        /* the journey: registered, admission, this month's fee, courses, ID card */
        $sdCards = $sd['cards'];
        $sdJourney = [
            ['Registered', $sdCards['registration'][1], $sd['registrationNo'] ?: 'Done', 'feather-user'],
            ['Admission', $sdCards['admission'][1], $sdCards['admission'][0], 'feather-file-text'],
            [$sd['month'] . ' fee', $sdCards['payment'][1], $sdCards['payment'][0], 'feather-credit-card'],
            ['Courses', $sd['openCourses'] ? 'done' : 'wait', $sd['openCourses'] ? $sd['openCourses'] . ' open' : 'Locked', 'feather-book-open'],
            ['ID card', $sdCards['idcard'][1], $sdCards['idcard'][0], 'feather-user-check'],
        ];
        $sdLearn = $studentLearning ?? null;
    @endphp
    <template id="sd-overview">
        <section class="sd-overview" aria-labelledby="sd-hello">
            <div class="card sd-hero">
                <div class="card-body">
                    <p class="sd-date">{{ $sd['today'] }}</p>
                    <h2 id="sd-hello" class="sd-hello">Welcome back, {{ $sd['firstName'] }}</h2>
                    <p class="sd-ids">
                        @if ($sd['registrationNo'])<span>Registration <b>{{ $sd['registrationNo'] }}</b></span>@endif
                        @if ($sd['admissionNo'])<span>Admission <b>{{ $sd['admissionNo'] }}</b></span>@endif
                    </p>

                    <div class="sd-next sd-state-{{ $sdNext['state'] }}">
                        <span class="sd-next-icon" aria-hidden="true"><i class="{{ $sdNext['icon'] }}"></i></span>
                        <div class="sd-next-body">
                            <p class="sd-next-label">Next step</p>
                            <h3 class="sd-next-title">{{ $sdNext['title'] }}</h3>
                            <p class="sd-next-text">{{ $sdNext['text'] }}</p>
                        </div>
                        <div class="sd-next-actions">
                            @foreach ($sdNext['actions'] as [$label, $url, $primary])
                                <a href="{{ $url }}" class="btn {{ $primary ? 'btn-primary' : 'btn-light-brand sd-btn-quiet' }}">{{ $label }}</a>
                            @endforeach
                        </div>
                    </div>

                    <ol class="sd-journey" aria-label="Your journey">
                        @foreach ($sdJourney as [$jLabel, $jState, $jText, $jIcon])
                            <li class="sd-jstep sd-state-{{ $jState }}">
                                <span class="sd-jdot" aria-hidden="true"><i class="{{ $jState === 'done' ? 'feather-check' : $jIcon }}"></i></span>
                                <span class="sd-jtext"><b>{{ $jLabel }}</b><small>{{ $jText }}</small></span>
                            </li>
                        @endforeach
                    </ol>
                </div>
            </div>

            <nav class="sd-shortcuts" aria-label="Shortcuts">
                @foreach ($sdShortcuts as [$label, $url, $icon, $hint])
                    <a class="sd-shortcut card" href="{{ $url }}">
                        <span class="sd-shortcut-icon" aria-hidden="true"><i class="{{ $icon }}"></i></span>
                        <span class="sd-shortcut-text"><b>{{ $label }}</b><small>{{ $hint }}</small></span>
                        <i class="feather-chevron-right sd-shortcut-go" aria-hidden="true"></i>
                    </a>
                @endforeach
            </nav>

            @if ($sdLearn)
                <section class="card sd-learn" aria-labelledby="sd-learn-title">
                    <div class="card-body">
                        <div class="sd-learn__head">
                            <h2 class="sd-section-title mb-0" id="sd-learn-title">Your learning</h2>
                            <div class="sd-learn__stats">
                                <span><b>{{ $sdLearn['started'] }}</b> note{{ $sdLearn['started'] === 1 ? '' : 's' }} started</span>
                                <span><b>{{ $sdLearn['average'] }}%</b> average read</span>
                                <span><b>{{ $sdLearn['favourites'] }}</b> favourite{{ $sdLearn['favourites'] === 1 ? '' : 's' }}</span>
                            </div>
                        </div>
                        @forelse ($sdLearn['recent'] as $item)
                            <div class="sd-learn__row">
                                <div class="sd-learn__main">
                                    <b>{{ $item['title'] }}</b>
                                    @if ($item['course'])<small>{{ $item['course'] }}</small>@endif
                                    <div class="sd-bar" role="img" aria-label="{{ $item['percent'] }} percent read"><span style="width: {{ $item['percent'] }}%"></span></div>
                                </div>
                                <span class="sd-learn__pct">{{ $item['percent'] }}%</span>
                                @if ($item['url'])
                                    <a class="btn btn-sm btn-primary" href="{{ $item['url'] }}">Continue</a>
                                @else
                                    <span class="sd-learn__locked"><i class="feather-lock" aria-hidden="true"></i> Locked</span>
                                @endif
                            </div>
                        @empty
                            <p class="sd-learn__empty">You have not opened any notes yet.
                                @if ($sd['openCourses'])<a href="{{ route('student.listcourse') }}">Open My Courses</a> to begin.
                                @else Your courses open once this month's fee is paid.@endif
                            </p>
                        @endforelse
                    </div>
                </section>
            @endif

            <h2 class="sd-section-title">Your progress</h2>
        </section>
    </template>
    {{-- the five cards: state (colour) and a line of detail each --}}
    <script type="application/json" id="sd-cards">@json(collect($sd['cards'])->map(fn($c) => ['state' => $c[1], 'detail' => $c[2]]))</script>
@endisset

{{-- Courses page while locked: what happens next, and the courses the student is enrolled in. --}}
@isset($lockedInfo)
    <template id="ls-locked">
        <section class="sl-locked" aria-labelledby="slTitle">
            <div class="card">
                <div class="card-body">
                    <h2 id="slTitle">Open your courses in three steps</h2>
                    <ol>
                        <li>Pay your {{ $lockedInfo['month'] }} fee. The bank details are on your payment slip.</li>
                        <li>Send your payment proof to the office (WhatsApp or email).</li>
                        <li>When the office marks it paid, your courses appear on this page.</li>
                    </ol>
                    @if (count($lockedInfo['titles']))
                        <h3>Your enrolled courses</h3>
                        <ul class="sl-courses">
                            @foreach ($lockedInfo['titles'] as $title)
                                <li><i class="feather-lock" aria-hidden="true"></i><span>{{ $title }}</span><small>Opens after payment</small></li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="sl-actions">
                        <a class="btn btn-primary" href="{{ route('student.fees') }}">See what is due</a>
                        <a class="btn btn-light-brand sd-btn-quiet" href="{{ route('student.help') }}">Contact the office</a>
                    </div>
                </div>
            </div>
        </section>
    </template>
    <script>
        (function () {
            var tpl = document.getElementById('ls-locked');
            var notice = document.querySelector('.content-area-body .alert');
            if (tpl && notice) { notice.insertAdjacentElement('afterend', tpl.content.firstElementChild.cloneNode(true)); }
        })();
    </script>
@endisset

<script src="{{ $studentPanelAsset('assets/js/student-panel.js') }}"></script>
