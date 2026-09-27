@extends('layouts.landing', ['title' => 'About Us — Law Students'])
@section('meta_description', 'About Law Students: a legal education platform with Bare Acts, Rules, free study notes, Centre & State Govt. exam material, legal knowledge guides and law courses.')
{{-- About page layer, loaded after every other sheet. --}}
@section('css')
    <link rel="stylesheet" href="{{ asset('assets/theme/css/about.css') }}?v={{ filemtime(public_path('assets/theme/css/about.css')) }}">
@endsection

@section('content')
<section class="page-hero"><div class="hero-frame" aria-hidden="true"></div><div class="wrap"><h1>About Us</h1><nav class="crumbs" aria-label="Breadcrumb"><a href="{{ route('frontend.home') }}">Home</a><span aria-hidden="true"><span class="site-icon icon-chevron-right" aria-hidden="true"></span></span><span aria-current="page">About Us</span></nav></div></section>
<section class="section about-section" id="about"><div class="wrap"><div class="split">
  <div class="copy reveal">
    <span class="eyebrow">About Us</span>
    <h2 class="section-title">Law Students was created to empower aspiring legal professionals</h2>
    <p>Our platform helps students gain practical legal knowledge, build expertise in various law domains, and prepare for successful careers.</p>
    <ul class="check-list"><li>Expert Instructors &amp; Knowledge</li><li>Comprehensive Curriculum</li><li>Hands-on Learning</li><li>Career Advancement</li></ul>
    <p>We provide interactive courses, case studies, and mentorship programs so that students can apply legal knowledge practically and confidently in real-world scenarios.</p>
    <a class="btn btn-gold" href="{{ route('frontend.course') }}">Enroll Now</a>
  </div>
  <div class="media-frame reveal" data-d="1"><picture><source type="image/webp" srcset="{{ asset('assets/theme/images/about/about-img3.webp') }}"><img src="{{ asset('assets/theme/images/about/about-img3.png') }}" alt="" width="551" height="570" loading="eager" decoding="async"></picture></div>
</div></div></section>

{{-- What the platform actually offers (the copy above never named it). --}}
<section class="section" id="offer"><div class="wrap">
  <div class="section-head reveal"><span class="eyebrow">What You'll Find</span><h2 class="section-title">Everything You Need, <span class="accent">in One Place</span></h2><div class="title-rule"></div></div>
  <div class="offer-grid">
    <a class="offer-card reveal" href="{{ route('frontend.acts') }}"><span class="offer-ico"><span class="site-icon icon-script" aria-hidden="true"></span></span><div><h3>Bare Acts</h3><p>Bare Acts, arranged by category.</p></div></a>
    <a class="offer-card reveal" data-d="1" href="{{ route('frontend.rules') }}"><span class="offer-ico"><span class="site-icon icon-scale" aria-hidden="true"></span></span><div><h3>Rules</h3><p>Rules and regulations, arranged by category.</p></div></a>
    <a class="offer-card reveal" data-d="2" href="{{ route('frontend.copys') }}"><span class="offer-ico"><span class="site-icon icon-books" aria-hidden="true"></span></span><div><h3>Free Notes</h3><p>Free study notes for law students.</p></div></a>
    <a class="offer-card reveal" href="{{ route('frontend.govtexams') }}"><span class="offer-ico"><span class="site-icon icon-clipboard" aria-hidden="true"></span></span><div><h3>Govt. Exams</h3><p>Material for Centre and State government examinations.</p></div></a>
    <a class="offer-card reveal" data-d="1" href="{{ route('frontend.legalknowledgelibrary') }}"><span class="offer-ico"><span class="site-icon icon-file-text" aria-hidden="true"></span></span><div><h3>Legal Knowledge</h3><p>Guides and PDFs on everyday legal topics, from consumer rights to cyber law.</p></div></a>
    <a class="offer-card reveal" data-d="2" href="{{ route('frontend.course') }}"><span class="offer-ico"><span class="site-icon icon-school" aria-hidden="true"></span></span><div><h3>Courses</h3><p>Courses for LL.B., LL.M., Judiciary, CSEET, CA, CS and CMA.</p></div></a>
  </div>
</div></section>

<section class="section notes-section"><div class="wrap"><div class="split">
  <div class="media-stack reveal">
    <div class="media-frame m1"><img src="{{ asset('assets/theme/images/about/about-inner-img1.png') }}" alt="Law Course Students" width="460" height="470" loading="lazy" decoding="async"></div>
    <div class="media-frame m2"><img src="{{ asset('assets/theme/images/about/about-inner-img2.png') }}" alt="Interactive Learning" width="210" height="210" loading="lazy" decoding="async"></div>
    <div class="exp-badge"><b>10+</b><span>Years of Legal Education Experience</span></div>
  </div>
  <div class="copy reveal" data-d="1">
    <span class="eyebrow">How We Teach</span>
    <h2 class="section-title">Learn From Expert Legal Educators & Advance Your Career</h2>
    <p>Welcome to Law Students, where aspiring lawyers gain practical knowledge, career-ready skills, and in-depth understanding of diverse legal domains. Our platform is designed to empower students to excel in law exams, internships, and professional practice.</p>
    <p>Our courses combine theoretical insights with practical case studies, mentorship programs, and interactive sessions, ensuring you’re confident and well-prepared for the real-world legal environment.</p>
    <ul class="check-list"><li>Practical Case Studies</li><li>Mentorship Programs</li><li>Interactive Sessions</li><li>Exam &amp; Internship Preparation</li></ul>
    <a class="btn btn-gold" href="{{ route('frontend.course') }}">Enroll in Courses</a>
  </div>
</div></div></section>

<section class="section" id="team"><div class="wrap">
  <div class="section-head reveal"><span class="eyebrow">Our Instructors</span><h2 class="section-title">Meet Our Expert <span class="accent">Law Course Team</span></h2><div class="title-rule"></div></div>
  <div class="team-grid"><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner2.png') }}" alt="Alex Ferguson - Criminal Law" width="270" height="270" loading="lazy" decoding="async"><h3>Alex Ferguson</h3><p>Criminal Law Expert</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner3.png') }}" alt="Richard Stones - Corporate Law" width="270" height="270" loading="lazy" decoding="async"><h3>Richard Stones</h3><p>Corporate Law Instructor</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner4.png') }}" alt="Pep Guardiola - Tax &amp; Compliance" width="270" height="270" loading="lazy" decoding="async"><h3>Pep Guardiola</h3><p>Tax &amp; Compliance Specialist</p></article><article class="team-card reveal"><img src="{{ asset('assets/theme/images/about/team-inner1.png') }}" alt="Samantha Lee - Civil Law" width="270" height="270" loading="lazy" decoding="async"><h3>Samantha Lee</h3><p>Civil Law Instructor</p></article></div>
</div></section>

{{-- A next step at the end of the page. --}}
<section class="section about-cta"><div class="wrap reveal">
  <h2 class="section-title">Not sure where to start?</h2>
  <p>Have a question about a course, a Bare Act or a legal topic? Send us a message.</p>
  <div class="cta-actions"><a class="btn btn-gold" href="{{ route('frontend.contact') }}">Contact Us</a><a class="btn btn-ghost" href="{{ route('frontend.course') }}">Explore Our Courses</a></div>
</div></section>
<script src="{{ asset('assets/theme/js/about.js') }}?v={{ filemtime(public_path('assets/theme/js/about.js')) }}"></script>
@endsection
