@include('layouts.partials.student.dashboard')
@php
    $faq = [
        ['Why are my courses locked?', 'Courses open month by month. As soon as the office marks your fee for the month as paid, your courses appear under <b>Courses</b>. You can see what is due on the <a href="' . route('student.fees') . '">Fee Summary</a>.'],
        ['How do I pay my fee?', 'The bank details are on your <a href="' . route('student.viewpayment') . '">payment slip</a>. After you pay, send your payment proof to the office (WhatsApp or email) so they can mark it as paid.'],
        ['When will my admission be approved?', 'The office checks every admission by hand. Your status is shown on the <a href="' . route('student.viewadmission') . '">Admission</a> page and on the dashboard. If it takes longer than you expect, contact the office.'],
        ['Where is my ID card?', 'Your <a href="' . route('student.viewidcard') . '">ID card</a> appears once your fee is confirmed. Open it and press <b>Print / Save as PDF</b>.'],
        ['How do I keep a note for later?', 'Open a course, then press the heart beside a note. It is then listed under <a href="' . route('student.listnotes') . '">Favourite Notes</a>.'],
        ['I need to change my details', 'Your registration and admission details are kept by the office. Contact them and they will update your record.'],
        ['I forgot my password', 'Log out, then press <b>Forgot password?</b> on the sign-in page. A code is sent to your email.'],
    ];
@endphp
<main class="nxl-container">
    <div class="nxl-content">
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Help &amp; Support</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('student.dashboard') }}">Dashboard</a></li>
                    <li class="breadcrumb-item">Help &amp; Support</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <section class="sh-contact" aria-labelledby="shContactTitle">
                <h2 class="sh-title" id="shContactTitle">Contact the office</h2>
                <div class="sh-contact__grid">
                    <a class="sh-card" href="tel:{{ preg_replace('/[^+\d]/', '', $office['phone']) }}">
                        <span class="sh-card__icon"><i class="feather-phone" aria-hidden="true"></i></span>
                        <span class="sh-card__text"><b>Call</b><small>{{ $office['phone'] }}</small></span>
                    </a>
                    @if ($office['whatsapp'])
                        <a class="sh-card" href="https://wa.me/{{ $office['whatsapp'] }}?text={{ rawurlencode('Hello, I am ' . (auth('student')->user()?->name ?? 'a student') . ' (' . (auth('student')->user()?->username ?? '') . ').') }}" target="_blank" rel="noopener">
                            <span class="sh-card__icon"><i class="feather-message-circle" aria-hidden="true"></i></span>
                            <span class="sh-card__text"><b>WhatsApp</b><small>Message the office</small></span>
                        </a>
                    @endif
                    <a class="sh-card" href="mailto:{{ $office['email'] }}?subject={{ rawurlencode('Student query: ' . (auth('student')->user()?->username ?? '')) }}">
                        <span class="sh-card__icon"><i class="feather-mail" aria-hidden="true"></i></span>
                        <span class="sh-card__text"><b>Email</b><small>{{ $office['email'] }}</small></span>
                    </a>
                    <a class="sh-card" href="{{ route('frontend.contact') }}" target="_blank" rel="noopener">
                        <span class="sh-card__icon"><i class="feather-map-pin" aria-hidden="true"></i></span>
                        <span class="sh-card__text"><b>Visit or write</b><small>Contact page on the website</small></span>
                    </a>
                </div>
                @if (!empty($office['centres']))
                    <ul class="sh-centres">
                        @foreach ($office['centres'] as $centre)<li><i class="feather-map-pin" aria-hidden="true"></i>{{ $centre }}</li>@endforeach
                    </ul>
                @endif
                <p class="sh-note">When you write, quote your registration number <b>{{ auth('student')->user()?->username }}</b> so the office can find you quickly.</p>
            </section>

            <section class="card sh-faq" aria-labelledby="shFaqTitle">
                <div class="card-header"><h2 class="sh-title mb-0" id="shFaqTitle">Common questions</h2></div>
                <div class="card-body p-0">
                    @foreach ($faq as [$q, $a])
                        <details class="sh-q">
                            <summary>{{ $q }}</summary>
                            <p>{!! $a !!}</p>
                        </details>
                    @endforeach
                </div>
            </section>
        </div>
    </div>
</main>
@include('layouts.partials.student.theme')
