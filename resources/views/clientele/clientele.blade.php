@extends('layouts.landing', ['title' => 'Client — Law Students'])

@section('meta_description', 'Our esteemed clients and learners at Law Students.')

@section('content')
@php
    $clientProgramOptions = ['LL.B. Entrance Examination', 'LL.B. - 3 Years', 'LL.B. - 5 Years', 'LL.M.', 'Judiciary Examination', 'CSEET', 'CA', 'CS', 'CMA', 'English Grammar', 'Spoken English', 'Bare Acts / Rules', 'Legal Knowledge', 'Other'];
@endphp

<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Client</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Client</span>
        </nav>
    </div>
</section>

<section class="section contact-section" id="client">
    <div class="wrap">
        <div class="contact-layout">
            <div class="contact-intro reveal">
                <h2>Our Esteemed Clients &amp; Learners</h2>
                <p>At Law Students, we take pride in serving a diverse clientele including aspiring lawyers, law
                    students, working professionals, and legal enthusiasts. Our courses are trusted by individuals who
                    aim to build a strong foundation in legal studies and advance their careers in law.</p>
                <p>Our clientele includes students preparing for judiciary exams, professionals enhancing their legal
                    expertise, and individuals seeking practical knowledge in criminal, corporate, and traffic law. We
                    are committed to delivering high-quality education and real-world insights to every learner.</p>

                <div class="testi-list">
                    @foreach ($clienteles as $clientele)
                        @php
                            // Clientele has no `pdfs` array cast on the model (unlike Act/Rule) and the
                            // column holds a single plain path, not JSON. Normalised here so the model
                            // stays untouched, while still accepting a JSON array if one is ever stored.
                            $raw = $clientele->pdfs;
                            if (is_array($raw)) {
                                $clientelePdfs = $raw;
                            } else {
                                $decoded = json_decode((string) $raw, true);
                                $clientelePdfs = is_array($decoded) ? $decoded : (filled($raw) ? [$raw] : []);
                            }
                        @endphp
                        @foreach ($clientelePdfs as $pdf)
                            <a class="list-card" href="{{ asset('storage/app/public/' . $pdf) }}" target="_blank"
                                rel="noopener">
                                <div class="list-icon" aria-hidden="true"><span class="site-icon icon-file-text" aria-hidden="true"></span></div>
                                <div class="list-body">
                                    <h4>{{ $clientele->description }}</h4>
                                    <div class="list-meta"><span class="go">View PDF <span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></div>
                                </div>
                            </a>
                        @endforeach
                    @endforeach
                </div>
            </div>

            <form class="form-card reveal" data-d="1" action="{{ route('frontend.contactstore') }}" method="post">
                @csrf
                <h3 class="form-title">Join Our Client Network</h3>
                <p class="form-lead">We respond within 30 minutes during business hours to guide you better</p>
                @if (session('success'))
                    <p class="form-status" role="status">{{ session('success') }}</p>
                @elseif ($errors->any())
                    <p class="form-status" role="alert">{{ $errors->first() }}</p>
                @endif
                <div class="form-row">
                    <div class="field"><label for="cl-first">First Name <span class="req"
                                aria-hidden="true">*</span></label><input type="text" id="cl-first" name="first_name"
                            value="{{ old('first_name') }}" placeholder="First Name" autocomplete="given-name" required></div>
                    <div class="field"><label for="cl-last">Last Name <span class="req"
                                aria-hidden="true">*</span></label><input type="text" id="cl-last" name="last_name"
                            value="{{ old('last_name') }}" placeholder="Last Name" autocomplete="family-name" required></div>
                    <div class="field"><label for="cl-phone">Phone Number <span class="req"
                                aria-hidden="true">*</span></label><input type="tel" id="cl-phone" name="phone"
                            value="{{ old('phone') }}" placeholder="Phone Number" autocomplete="tel" inputmode="numeric"
                            pattern="[0-9]{10}" maxlength="10" title="Enter a 10-digit mobile number" required></div>
                    <div class="field"><label for="cl-email">Email Address <span class="req"
                                aria-hidden="true">*</span></label><input type="email" id="cl-email" name="email"
                            value="{{ old('email') }}" placeholder="Email Address" autocomplete="email" required></div>
                    <div class="field full"><label for="cl-service">Interested Course / Service Type <span class="req"
                                aria-hidden="true">*</span></label><select id="cl-service" name="service_type" required>
                            <option value="">Select Course / Service Type</option>
                            @foreach ($clientProgramOptions as $clientProgram)
                                <option value="{{ $clientProgram }}" @selected(old('service_type') === $clientProgram)>{{ $clientProgram }}</option>
                            @endforeach
                        </select></div>
                    <div class="field full"><label for="cl-msg">Message <span class="req"
                                aria-hidden="true">*</span></label><textarea id="cl-msg" name="message"
                            placeholder="Tell us about your learning goals or queries" minlength="10" required>{{ old('message') }}</textarea></div>
                </div>
                <div class="form-actions"><button type="submit" class="btn btn-gold" data-loading-text="Sending...">Join Our Client Network <span class="site-icon icon-arrow-right" aria-hidden="true"></span></button></div>
            </form>
        </div>
    </div>
</section>
@endsection
