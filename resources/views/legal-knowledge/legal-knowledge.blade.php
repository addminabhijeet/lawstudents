@extends('layouts.landing', ['title' => 'Legal Knowledge — Law Students'])

@section('meta_description', 'Submit a legal knowledge inquiry to the Law Students team.')

@section('content')
<section class="page-hero">
    <div class="hero-frame" aria-hidden="true"></div>
    <div class="wrap">
        <h1>Legal Knowledge</h1>
        <nav class="crumbs" aria-label="Breadcrumb">
            <a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span
                aria-current="page">Legal Knowledge</span>
        </nav>
    </div>
</section>

<section class="section form-section" id="inquiry">
    <div class="wrap">
        <div class="section-head reveal">
            <span class="eyebrow">Knowledge Inquiry</span>
            <h2 class="section-title">Legal Knowledge <span class="accent">Inquiry</span></h2>
            <div class="title-rule"></div>
        </div>

        {{-- Visitors who come here for the PDFs rather than to ask a question. --}}
        <a class="library-cta reveal" href="{{ route('frontend.legalknowledgelibrary') }}">
            <span class="library-cta-ico" aria-hidden="true"><span class="site-icon icon-books" aria-hidden="true"></span></span>
            <span class="library-cta-text"><strong>Looking for Legal Knowledge PDFs?</strong>
                <span>Open the Legal Knowledge Library to read or download notes by category.</span></span>
            <span class="library-cta-go">Open Library <span aria-hidden="true"><span class="site-icon icon-arrow-right" aria-hidden="true"></span></span></span>
        </a>

        <form class="form-card reveal" action="{{ route('frontend.legal-knowledge-store') }}" method="post"
            enctype="multipart/form-data">
            @csrf

            @if (session('success'))
                <p class="form-status" role="status">{{ session('success') }}</p>
            @elseif ($errors->any())
                <p class="form-status" role="alert">{{ $errors->first() }}</p>
            @endif

            <div class="form-row">
                <div class="field"><label for="lk-name">Name <span class="req"
                            aria-hidden="true">*</span></label><input type="text" id="lk-name" name="name"
                        value="{{ old('name') }}" placeholder="Your Full Name" autocomplete="name" required></div>
                <div class="field"><label for="lk-email">Email <span class="req"
                            aria-hidden="true">*</span></label><input type="email" id="lk-email" name="email"
                        value="{{ old('email') }}" placeholder="your.email@example.com" autocomplete="email" required>
                </div>
                <div class="field"><label for="lk-mobile">Mobile Number <span class="req"
                            aria-hidden="true">*</span></label><input type="tel" id="lk-mobile" name="mobile"
                        value="{{ old('mobile') }}" placeholder="Your Mobile Number" autocomplete="tel"
                        inputmode="numeric" pattern="[0-9]{10}" maxlength="10"
                        title="Enter a 10-digit mobile number" required></div>
                <div class="field">
                    <label for="lk-subject">Subject / Area of Law <span class="req" aria-hidden="true">*</span></label>
                    <select id="lk-subject" name="subject" required>
                        <option value="">Select Category</option>
                        @foreach (['Cheque Bounce', 'Civil Law', 'Criminal Law', 'Company Law', 'Hindu Law', 'Muslim Law', 'Labour Law', 'Cyber Crime', 'Cyber Security', 'Legal Compliance', 'Other Laws'] as $subject)
                            <option value="{{ $subject }}" @selected(old('subject') === $subject)>{{ $subject }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="field full"><label for="lk-question">Your Question <span class="req"
                            aria-hidden="true">*</span></label><textarea id="lk-question" name="question"
                        placeholder="Please describe your legal inquiry in detail..." minlength="10" required>{{ old('question') }}</textarea>
                </div>
                <div class="field full"><label for="lk-doc">Upload Document <span>(Optional)</span></label><input
                        type="file" id="lk-doc" name="document" accept=".pdf,.doc,.docx,.txt"></div>
            </div>
            <div class="form-actions"><button type="submit" class="btn btn-gold" data-loading-text="Submitting...">Submit Inquiry</button></div>
            <div class="form-note"><strong class="disc-title"><span aria-hidden="true"><span class="site-icon icon-alert-triangle" aria-hidden="true"></span></span> Important
                    Disclaimer</strong>This inquiry facility is intended for preliminary communication and
                legal/educational information. Submission of an inquiry does not by itself create an advocate-client
                relationship. Formal legal advice, representation or engagement shall be subject to separate
                communication and acceptance.</div>
        </form>
    </div>
</section>
@endsection
