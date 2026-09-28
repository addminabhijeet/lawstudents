{{-- Student panel layer (student-panel.css / .js): the menu keeps its labels on laptop
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

            <h2 class="sd-section-title">Your progress</h2>
        </section>
    </template>
    {{-- the five cards: state (colour) and a line of detail each --}}
    <script type="application/json" id="sd-cards">@json(collect($sd['cards'])->map(fn($c) => ['state' => $c[1], 'detail' => $c[2]]))</script>
@endisset

<script src="{{ $studentPanelAsset('assets/js/student-panel.js') }}"></script>
