@extends('layouts.landing', ['title' => 'Contact Us — Law Students'])

@section('meta_description', 'Connect with our expert instructors and mentors at Law Students.')

@section('content')
@php
    $contactUser = \App\Models\User::first();
    $contactEmail = !empty($contactUser->webemail) ? $contactUser->webemail : 'lawstudents.edu@gmail.com';
    $contactMobile = !empty($contactUser->mobile) ? $contactUser->mobile : '+916624536320';
    $contactAddress = !empty($contactUser->webaddress) ? $contactUser->webaddress : '224 Legal District, Delhi High Court Marg, New Delhi 110001';
    $contactWhatsapp = preg_replace('/[^0-9]/', '', $contactMobile);
    $contactRequestedCourse = trim((string) request('course'));
    $contactProgramOptions = \App\Models\Course::query()
        ->orderBy('title')
        ->pluck('title')
        ->merge(['LL.B. Entrance Examination', 'LL.B. - 3 Years', 'LL.B. - 5 Years', 'LL.M.', 'Judiciary Examination', 'CSEET', 'CA', 'CS', 'CMA', 'English Grammar', 'Spoken English', 'Bare Acts / Rules', 'Legal Knowledge', 'Other'])
        ->filter()
        ->unique()
        ->values();
    $contactSelectedProgram = old('service_type', $contactRequestedCourse);
@endphp

<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Contact Us</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Contact Us</span>
        </nav>
    </div>
</section>

<section class="section contact-section" id="contact">
    <div class="wrap">
        <div class="contact-layout">
            <div class="contact-intro reveal">
                <h2>Connect with Our Expert Instructors and Mentors Today</h2>
                <p>At Law Students, we understand the importance of personalized guidance in your legal education. Our
                    team of experienced instructors and mentors is here to provide you with support and practical
                    insights. Whether you're exploring Criminal Law, Corporate Law, Constitutional Law, or Traffic Law
                    courses, our commitment is to help you succeed in your legal career.</p>
                <p>When learning law, having a dedicated and knowledgeable team by your side can make all the
                    difference. At Law Students, we prioritize your growth and provide exceptional mentorship
                    tailored to your goals.</p>
                <a class="btn btn-gold" href="{{ route('frontend.about') }}#team">Meet Our Mentors</a>
                <div class="contact-items">
                    <div class="contact-item">
                        <div class="contact-ico" aria-hidden="true"><span class="site-icon icon-map-pin" aria-hidden="true"></span></div>
                        <div>
                            <h5>Address</h5>
                            <p>{{ $contactAddress }}</p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-ico" aria-hidden="true"><span class="site-icon icon-phone" aria-hidden="true"></span></div>
                        <div>
                            <h5>Call or text</h5>
                            <p><a href="tel:{{ $contactMobile }}">{{ $contactMobile }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-ico" aria-hidden="true"><span class="site-icon icon-mail" aria-hidden="true"></span></div>
                        <div>
                            <h5>Email us today</h5>
                            <p><a href="mailto:{{ $contactEmail }}">{{ $contactEmail }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-ico" aria-hidden="true"><span class="site-icon icon-brand-whatsapp" aria-hidden="true"></span></div>
                        <div>
                            <h5>WhatsApp Us</h5>
                            <p><a href="https://wa.me/{{ $contactWhatsapp }}" target="_blank"
                                    rel="noopener">{{ $contactMobile }}</a></p>
                        </div>
                    </div>
                    <div class="contact-item">
                        <div class="contact-ico" aria-hidden="true"><span class="site-icon icon-world" aria-hidden="true"></span></div>
                        <div>
                            <h5>Website</h5>
                            <p><a href="{{ url('/') }}">{{ parse_url(url('/'), PHP_URL_HOST) }}</a></p>
                        </div>
                    </div>
                </div>
            </div>

            <form class="form-card reveal" data-d="1" id="contact-form" action="{{ route('frontend.contactstore') }}" method="post">
                @csrf
                <h3 class="form-title">Send Us Your Inquiry</h3>
                <p class="form-lead">Our response time is within 30 minutes during business hours</p>

                @if (session('success'))
                    <p class="form-status" role="status">{{ session('success') }}</p>
                @elseif ($errors->any())
                    <p class="form-status" role="alert">{{ $errors->first() }}</p>
                @endif

                <div class="form-row">
                    <div class="field"><label for="ct-first">First Name <span class="req"
                                aria-hidden="true">*</span></label><input type="text" id="ct-first" name="first_name"
                            value="{{ old('first_name') }}" placeholder="First Name" autocomplete="given-name"
                            required></div>
                    <div class="field"><label for="ct-last">Last Name <span class="req"
                                aria-hidden="true">*</span></label><input type="text" id="ct-last" name="last_name"
                            value="{{ old('last_name') }}" placeholder="Last Name" autocomplete="family-name" required>
                    </div>
                    <div class="field"><label for="ct-phone">Phone Number <span class="req"
                                aria-hidden="true">*</span></label><input type="tel" id="ct-phone" name="phone"
                            value="{{ old('phone') }}" placeholder="Phone Number" autocomplete="tel" inputmode="numeric"
                            pattern="[0-9]{10}" maxlength="10" title="Enter a 10-digit mobile number" required></div>
                    <div class="field"><label for="ct-email">Email Address <span class="req"
                                aria-hidden="true">*</span></label><input type="email" id="ct-email" name="email"
                            value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" required></div>
                    <div class="field full"><label for="ct-service">Program of Interest <span class="req"
                                aria-hidden="true">*</span></label><select id="ct-service" name="service_type" required>
                            <option value="">Select Program of Interest</option>
                            @foreach ($contactProgramOptions as $contactProgram)
                                <option value="{{ $contactProgram }}" @selected($contactSelectedProgram === $contactProgram)>{{ $contactProgram }}</option>
                            @endforeach
                        </select></div>
                    <div class="field full"><label for="ct-msg">Message <span class="req"
                                aria-hidden="true">*</span></label><textarea id="ct-msg" name="message"
                            placeholder="Message" minlength="10" required>{{ old('message') }}</textarea></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-gold" data-loading-text="Sending...">Send Inquiry <span class="site-icon icon-arrow-right" aria-hidden="true"></span></button></div>
            </form>
        </div>

        <div class="map-frame reveal">
            <iframe title="Law Students location map"
                src="https://maps.google.com/maps?q={{ urlencode($contactAddress) }}&amp;z=13&amp;output=embed"
                loading="lazy" referrerpolicy="no-referrer-when-downgrade" allowfullscreen></iframe>
        </div>
    </div>
</section>
@endsection
