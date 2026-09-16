@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<style>
    :root {
        --black: #0f0f0f;
        --dark: #1a1a1a;
        --gold: #d4af37;
        --gold-light: #e6c547;
        --gray: #b0b0b0;
    }

    * { margin: 0; padding: 0; box-sizing: border-box; }

    body {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #0f0f0f;
        color: #b0b0b0;
    }

    a { color: #d4af37; text-decoration: none; transition: all 0.3s ease; }
    a:hover { color: #e6c547; }

    /* HEADER */
    .header {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom: 2px solid #d4af37;
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 12px rgba(212, 175, 55, 0.1);
    }

    .logo-section { display: flex; align-items: center; gap: 12px; }
    .logo-section img { height: 40px; width: auto; }
    .logo-text { font-size: 16px; font-weight: 700; color: #d4af37; letter-spacing: 1px; }
    
    .nav-menu { display: flex; gap: 30px; list-style: none; }
    .nav-menu a { font-size: 13px; font-weight: 600; color: #b0b0b0; position: relative; }
    .nav-menu a:hover { color: #d4af37; }
    .nav-menu a::after { content: ''; position: absolute; bottom: -4px; left: 0; width: 0; height: 2px; background: #d4af37; transition: width 0.3s; }
    .nav-menu a:hover::after { width: 100%; }
    
    .nav-toggle { display: none; background: none; border: none; color: #d4af37; font-size: 24px; cursor: pointer; }

    @media (max-width: 768px) {
        .nav-menu { display: none; }
        .nav-toggle { display: block; }
    }

    /* HERO */
    .hero {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        padding: 60px 20px;
        text-align: center;
        border-bottom: 1px solid #d4af37;
    }

    .hero-content { max-width: 900px; margin: 0 auto; }
    
    .hero h1 {
        font-size: 48px;
        font-weight: 800;
        background: linear-gradient(135deg, #d4af37 0%, #e6c547 50%, #d4af37 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        margin-bottom: 15px;
    }

    .hero-logo { height: 70px; width: auto; margin-bottom: 20px; display: inline-block; }
    .hero-tagline { font-size: 20px; color: #d4af37; margin-bottom: 15px; font-weight: 600; }
    .hero-desc { font-size: 14px; color: #b0b0b0; margin-bottom: 30px; line-height: 1.6; }

    .hero-buttons { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }

    .btn { padding: 12px 28px; border-radius: 4px; font-size: 13px; font-weight: 700; text-transform: uppercase; letter-spacing: 1px; border: none; cursor: pointer; transition: all 0.3s ease; display: inline-block; }
    .btn-primary { background: linear-gradient(135deg, #d4af37 0%, #e6c547 100%); color: #000; box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3); }
    .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 6px 25px rgba(212, 175, 55, 0.5); }

    @media (max-width: 768px) {
        .hero { padding: 40px 20px; }
        .hero h1 { font-size: 36px; }
        .hero-buttons { flex-direction: column; }
        .btn { width: 100%; }
    }

    /* QUICK ACCESS */
    .quick-access {
        background: #0f0f0f;
        padding: 40px 20px;
        border-bottom: 1px solid #d4af37;
    }

    .quick-access-container { max-width: 1200px; margin: 0 auto; }

    .section-title {
        text-align: center;
        margin-bottom: 40px;
        font-size: 28px;
        font-weight: 700;
        color: #d4af37;
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .quick-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(160px, 1fr)); gap: 20px; }

    .quick-item {
        background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        padding: 25px;
        text-align: center;
        border: 2px solid #d4af37;
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }

    .quick-item:hover {
        background: linear-gradient(135deg, #d4af37 0%, #e6c547 100%);
        color: #000;
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(212, 175, 55, 0.3);
    }

    .quick-item h3 { font-size: 32px; font-weight: 800; margin: 0; color: #d4af37; }
    .quick-item:hover h3 { color: #000; }
    .quick-item p { font-size: 12px; color: #b0b0b0; margin-top: 8px; }
    .quick-item:hover p { color: #000; }

    @media (max-width: 768px) {
        .quick-grid { grid-template-columns: repeat(3, 1fr); }
        .quick-item h3 { font-size: 24px; }
    }

    /* ABOUT */
    .about {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        padding: 50px 20px;
        border-bottom: 1px solid #d4af37;
    }

    .about-container { max-width: 900px; margin: 0 auto; text-align: center; }
    .about-label { display: inline-block; background: rgba(212, 175, 55, 0.1); color: #d4af37; padding: 8px 16px; border-radius: 4px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 20px; letter-spacing: 1px; border: 1px solid #d4af37; }
    .about h2 { font-size: 36px; font-weight: 800; color: #d4af37; margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; }
    .about p { font-size: 14px; color: #b0b0b0; line-height: 1.8; margin: 0; }
    .about p strong { color: #d4af37; }

    .about-features { margin-top: 30px; display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; text-align: left; }
    .feature-item { padding: 15px; background: rgba(212, 175, 55, 0.1); border-radius: 6px; border-left: 3px solid #d4af37; }
    .feature-item p { margin: 0; color: #d4af37; font-weight: 700; font-size: 13px; text-transform: uppercase; }

    /* COURSES SECTION */
    .content-section {
        background: #0f0f0f;
        padding: 50px 20px;
        border-bottom: 1px solid #d4af37;
    }

    .content-container { max-width: 1200px; margin: 0 auto; }

    .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }

    .card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        border: 2px solid #d4af37;
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .card:hover {
        transform: translateY(-8px);
        box-shadow: 0 12px 35px rgba(212, 175, 55, 0.25);
        border-color: #e6c547;
    }

    .card-image {
        width: 100%;
        height: 180px;
        background: linear-gradient(135deg, #d4af37 0%, #e6c547 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
        font-weight: 700;
        color: #000;
        overflow: hidden;
    }

    .card-image img { width: 100%; height: 100%; object-fit: cover; }

    .card-body { padding: 20px; flex-grow: 1; display: flex; flex-direction: column; }
    .card-title { font-size: 20px; font-weight: 700; color: #d4af37; margin-bottom: 10px; }
    .card-desc { font-size: 13px; color: #b0b0b0; line-height: 1.6; margin-bottom: 15px; flex-grow: 1; }
    .card-link { color: #d4af37; font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; transition: all 0.3s ease; align-self: flex-start; }
    .card-link:hover { color: #e6c547; margin-left: 8px; }

    /* FOOTER */
    .footer {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-top: 2px solid #d4af37;
        padding: 40px 20px 20px;
        text-align: center;
    }

    .footer-content { max-width: 1200px; margin: 0 auto 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
    .footer-col h4 { font-size: 14px; font-weight: 700; color: #d4af37; text-transform: uppercase; margin-bottom: 15px; letter-spacing: 1px; }
    .footer-col ul { list-style: none; }
    .footer-col li { margin-bottom: 10px; }
    .footer-col a { font-size: 13px; color: #b0b0b0; transition: all 0.3s ease; }
    .footer-col a:hover { color: #d4af37; margin-left: 5px; }
    .footer-bottom { border-top: 1px solid #d4af37; padding-top: 20px; font-size: 12px; color: #b0b0b0; }

    @media (max-width: 768px) {
        .footer-content { grid-template-columns: 1fr; gap: 20px; }
        .cards-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
    }

    @media (max-width: 480px) {
        .header { padding: 12px 15px; }
        .logo-text { font-size: 14px; }
        .hero { padding: 30px 15px; }
        .hero h1 { font-size: 28px; }
        .section-title { font-size: 22px; }
        .quick-grid { grid-template-columns: repeat(3, 1fr); gap: 12px; }
        .quick-item { padding: 15px; }
        .quick-item h3 { font-size: 20px; }
    }
</style>

<!-- HEADER -->
<header class="header">
    <div class="logo-section">
        <img src="/img/logo/logo11.png" alt="Law Students Logo" style="width: 40px; height: 40px; object-fit: contain;">
        <span class="logo-text">LAW STUDENTS</span>
    </div>
    <nav>
        <ul class="nav-menu">
            <li><a href="#home">Home</a></li>
            <li><a href="{{ route('frontend.course') }}">Courses</a></li>
            <li><a href="{{ route('frontend.copys') }}">Notes</a></li>
            <li><a href="{{ route('frontend.acts') }}">Acts</a></li>
            <li><a href="{{ route('frontend.legalknowledgelibrary') }}">Knowledge</a></li>
        </ul>
    </nav>
    <button class="nav-toggle" aria-label="Toggle navigation menu">☰</button>
</header>

<!-- HERO SECTION 1 -->
<div class="hero">
    <h1>Master Legal Education</h1>
    <p>Comprehensive courses, expert instructors, and proven success for aspiring legal professionals</p>
    <div class="hero-buttons">
        <a href="{{ route('frontend.course') }}" class="btn btn-primary">Explore Courses →</a>
        <a href="{{ route('frontend.copys') }}" class="btn" style="border: 2px solid #d4af37; color: #d4af37; background: transparent;">Get Started</a>
    </div>
</div>

<!-- HERO SECTION 2 -->
<div class="hero">
    <div class="hero-content">
        <img src="/img/logo/logo11.png" alt="Law Students" class="hero-logo">
        <h1>Law Students</h1>
        <p class="hero-tagline">Learn • Understand • Achieve</p>
        <p class="hero-desc">A comprehensive platform for Legal Education, Examination Preparation, Legal Knowledge, Bare Acts, Rules, and Study Materials.</p>
        <div class="hero-buttons">
            <a href="{{ route('frontend.course') }}" class="btn btn-primary">Explore Courses</a>
            <a href="{{ route('frontend.copys') }}" class="btn btn-primary">Free Notes</a>
            <a href="{{ route('frontend.legalknowledgelibrary') }}" class="btn btn-primary">Legal Knowledge</a>
        </div>
    </div>
</div>

<!-- QUICK ACCESS -->
<div class="quick-access">
    <div class="quick-access-container">
        <h2 class="section-title">Quick Access</h2>
        <div class="quick-grid">
            <div class="quick-item"><h3>50+</h3><p>Courses</p></div>
            <div class="quick-item"><h3>500+</h3><p>Study Materials</p></div>
            <div class="quick-item"><h3>100+</h3><p>Bare Acts</p></div>
            <div class="quick-item"><h3>200+</h3><p>Rules</p></div>
            <div class="quick-item"><h3>1000+</h3><p>Legal Topics</p></div>
            <div class="quick-item"><h3>30+</h3><p>Exams</p></div>
        </div>
    </div>
</div>

<!-- ABOUT -->
<div class="about">
    <div class="about-container">
        <span class="about-label">About Platform</span>
        <h2>Welcome to Law Student</h2>
        <p>Law Student is an educational and knowledge platform dedicated to students, aspirants and professionals pursuing legal and professional education. The platform provides structured courses, study materials, Bare Acts, Rules, Notifications, legal knowledge resources and examination-oriented preparation.</p>
        <div class="about-features">
            <div class="feature-item"><p>✓ Expert Instructors & Knowledge</p></div>
            <div class="feature-item"><p>✓ Comprehensive Curriculum</p></div>
            <div class="feature-item"><p>✓ Hands-on Learning</p></div>
            <div class="feature-item"><p>✓ Career Advancement</p></div>
        </div>
    </div>
</div>

<!-- COURSES -->
<div class="content-section">
    <div class="content-container">
        <h2 class="section-title">Featured Courses</h2>
        <div class="cards-grid">
            @php
            $courses = \App\Models\Course::limit(6)->get();
            @endphp
            @forelse($courses as $course)
            <div class="card">
                <div class="card-image">
                    @if($course->thumbnail)
                    <img src="{{ asset('storage/app/public/' . $course->thumbnail) }}" alt="{{ $course->title }}">
                    @else
                    <i class="fa-solid fa-book"></i>
                    @endif
                </div>
                <div class="card-body">
                    <h3 class="card-title">{{ Str::limit($course->title, 25) }}</h3>
                    <p class="card-desc">{{ Str::limit($course->description ?? '', 50) }}</p>
                </div>
                <div style="padding: 0 20px 20px;">
                    <a href="{{ route('frontend.course') }}" class="card-link">Learn More →</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">Courses will be displayed here</div>
            @endforelse
        </div>
    </div>
</div>

<!-- NOTES -->
<div class="content-section" style="border-bottom: none;">
    <div class="content-container">
        <h2 class="section-title">Free Study Notes</h2>
        <div class="cards-grid">
            @php
            $notes = \App\Models\Copy::limit(6)->get();
            @endphp
            @forelse($notes as $note)
            <div class="card">
                <div class="card-image" style="font-size: 32px;"><i class="fa-solid fa-file-pdf"></i></div>
                <div class="card-body">
                    <h3 class="card-title">{{ Str::limit($note->description, 25) }}</h3>
                    <p class="card-desc">{{ count($note->pdfs ?? []) }} PDF available</p>
                </div>
                <div style="padding: 0 20px 20px;">
                    <a href="{{ route('frontend.copys') }}" class="card-link">View Notes →</a>
                </div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">Study notes will be displayed here</div>
            @endforelse
        </div>
    </div>
</div>

<!-- FOOTER -->
<footer class="footer">
    <div class="footer-content">
        <div class="footer-col">
            <h4>Quick Links</h4>
            <ul>
                <li><a href="{{ route('frontend.course') }}">Courses</a></li>
                <li><a href="{{ route('frontend.copys') }}">Notes</a></li>
                <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                <li><a href="{{ route('frontend.rules') }}">Rules</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Resources</h4>
            <ul>
                <li><a href="{{ route('frontend.govtexams') }}">Govt. Exams</a></li>
                <li><a href="{{ route('frontend.legalknowledgelibrary') }}">Legal Knowledge</a></li>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">About Us</a></li>
            </ul>
        </div>
        <div class="footer-col">
            <h4>Company</h4>
            <ul>
                <li><a href="#">Terms & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Disclaimer</a></li>
                <li><a href="#">Sitemap</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>&copy; 2024 Law Students. All rights reserved. | Designed with <span style="color: #d4af37;">♥</span></p>
    </div>
</footer>

@endsection
