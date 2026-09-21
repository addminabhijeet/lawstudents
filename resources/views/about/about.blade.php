@extends('layouts.landing', ['title' => 'About Us — Law Students'])

@section('content')
<section class="page-hero"><div class="wrap"><h1>About Us</h1><nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true">›</span><span aria-current="page">About Us</span></nav></div></section>
<section class="section about-section" id="about"><div class="wrap"><div class="split">
  <div class="copy reveal">
    <span class="eyebrow">About Us</span>
    <h2 class="section-title">Law Students was created to empower aspiring legal professionals:</h2>
    <p>Our platform helps students gain practical legal knowledge, build expertise in various law domains, and prepare for successful careers.</p>
    <ul class="check-list"><li>Expert Instructors &amp; Knowledge</li><li>Comprehensive Curriculum</li><li>Hands-on Learning</li><li>Career Advancement</li></ul>
    <p>We provide interactive courses, case studies, and mentorship programs so that students can apply legal knowledge practically and confidently in real-world scenarios.</p>
    <a class="btn btn-gold" href="{{ route('frontend.course') }}">Enroll Now</a>
  </div>
  <div class="media-frame reveal" data-d="1"><img src="{{ asset('assets/theme/images/about/about-img3.png') }}" alt="" width="551" height="570" loading="eager" decoding="async"></div>
</div></div></section>

<section class="section notes-section"><div class="wrap"><div class="split">
  <div class="media-stack reveal">
    <div class="media-frame m1"><img src="{{ asset('assets/theme/images/about/about-inner-img1.png') }}" alt="Law Course Students" width="460" height="470" loading="lazy" decoding="async"></div>
    <div class="media-frame m2"><img src="{{ asset('assets/theme/images/about/about-inner-img2.png') }}" alt="Interactive Learning" width="210" height="210" loading="lazy" decoding="async"></div>
    <div class="exp-badge"><b>10+</b><span>Years of Legal Education Experience</span></div>
  </div>
  <div class="copy reveal" data-d="1">
    <h2 class="section-title">Learn From Expert Legal Educators & Advance Your Career</h2>
    <p>Welcome to Law Students, where aspiring lawyers gain practical knowledge, career-ready skills, and in-depth understanding of diverse legal domains. Our platform is designed to empower students to excel in law exams, internships, and professional practice.</p>
    <p>Our courses combine theoretical insights with practical case studies, mentorship programs, and interactive sessions, ensuring you’re confident and well-prepared for the real-world legal environment.</p>
    <ul class="check-list"><li>Expert Instructors &amp; Knowledge</li><li>Comprehensive Curriculum</li><li>Practical Learning</li><li>Career Advancement</li></ul>
    <a class="btn btn-gold" href="{{ route('frontend.course') }}">Enroll in Courses</a>
  </div>
</div></div></section>

<section class="section" id="team"><div class="wrap">
  <div class="section-head reveal"><span class="eyebrow">Our Instructors</span><h2 class="section-title">Meet Our Expert <span class="accent">Law Course Team</span></h2><div class="title-rule"></div></div>
  <div class="team-grid"><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner2.png') }}" alt="Alex Ferguson - Criminal Law" width="270" height="270" loading="lazy" decoding="async"><h3>Alex Ferguson</h3><p>Criminal Law Expert</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner3.png') }}" alt="Richard Stones - Corporate Law" width="270" height="270" loading="lazy" decoding="async"><h3>Richard Stones</h3><p>Corporate Law Instructor</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner4.png') }}" alt="Pep Guardiola - Tax &amp; Compliance" width="270" height="270" loading="lazy" decoding="async"><h3>Pep Guardiola</h3><p>Tax &amp; Compliance Specialist</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner1.png') }}" alt="Samantha Lee - Civil Law" width="270" height="270" loading="lazy" decoding="async"><h3>Samantha Lee</h3><p>Civil Law Instructor</p></article></div>
</div></section>
@endsection
