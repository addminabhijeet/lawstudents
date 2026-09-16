@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<!-- ===== BLACK & GOLD MOBILE REDESIGN ===== -->
<style>
    :root {
        --black: #0f0f0f;
        --dark: #1a1a1a;
        --gold: #d4af37;
        --gold-light: #e6c547;
        --gray: #b0b0b0;
    }

    * {
        margin: 0; padding: 0; box-sizing: border-box;
    }

    body {
        font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
        background: #0f0f0f;
        color: var(--gray);
    }

    a { color: var(--gold); text-decoration: none; }
    a:hover { color: var(--gold-light); }

    .header {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-bottom: 2px solid var(--gold);
        padding: 16px 20px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .logo-section { display: flex; align-items: center; gap: 12px; }
    .logo-section img { height: 40px; }
    .logo-text { font-size: 16px; font-weight: 700; color: var(--gold); letter-spacing: 1px; }
    
    .nav-menu { display: flex; gap: 30px; list-style: none; }
    .nav-menu a { font-size: 13px; font-weight: 600; color: var(--gray); }
    .nav-menu a:hover { color: var(--gold); }
    
    .nav-toggle { display: none; background: none; border: none; color: var(--gold); font-size: 24px; cursor: pointer; }

    @media (max-width: 768px) {
        .nav-menu { display: none; }
        .nav-toggle { display: block; }
    }

    .hero-section {
        background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%);
        padding: 80px 20px;
        text-align: center;
        display: flex;
        align-items: center;
        justify-content: center;
        border-bottom: 1px solid var(--gold);
    }

    .hero-branding { display: flex; align-items: center; justify-content: center; gap: 15px; margin-bottom: 30px; }
    .hero-branding img { height: 60px; }
    .hero-branding h1 {
        font-size: 48px;
        font-weight: 800;
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 50%, var(--gold) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .hero-tagline { font-size: 24px; font-weight: 600; color: var(--gold); margin: 20px 0; }
    .hero-supporting-text { font-size: 15px; color: var(--gray); line-height: 1.8; margin: 0 0 40px 0; }

    .hero-buttons { display: flex; gap: 15px; justify-content: center; flex-wrap: wrap; }
    .btn { padding: 12px 28px; font-size: 13px; font-weight: 700; border: none; border-radius: 4px; cursor: pointer; text-transform: uppercase; letter-spacing: 1px; }
    .btn-primary { background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%); color: #000; }
    .btn-primary:hover { transform: translateY(-3px); box-shadow: 0 6px 25px rgba(212, 175, 55, 0.5); }

    @media (max-width: 768px) {
        .hero-section { padding: 60px 20px; }
        .hero-branding h1 { font-size: 36px; }
        .hero-buttons { flex-direction: column; }
        .btn { width: 100%; }
    }

    .quick-access-section { padding: 50px 20px; background: #0f0f0f; border-bottom: 1px solid var(--gold); }
    .quick-access-container { max-width: 1200px; margin: 0 auto; }
    
    .section-title {
        text-align: center;
        margin-bottom: 40px;
        font-size: 28px;
        font-weight: 700;
        color: var(--gold);
        text-transform: uppercase;
        letter-spacing: 2px;
    }

    .quick-grid { display: grid; grid-template-columns: repeat(auto-fit, minmax(150px, 1fr)); gap: 20px; }
    .quick-item {
        background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        padding: 25px;
        text-align: center;
        border: 2px solid var(--gold);
        border-radius: 8px;
        transition: all 0.3s ease;
        cursor: pointer;
    }
    .quick-item:hover {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
        transform: translateY(-8px);
        box-shadow: 0 8px 24px rgba(212, 175, 55, 0.3);
    }
    .quick-item h3 { font-size: 32px; font-weight: 800; color: var(--gold); }
    .quick-item:hover h3 { color: #000; }
    .quick-item p { font-size: 12px; color: var(--gray); margin-top: 8px; }
    .quick-item:hover p { color: #000; }

    .about-section { background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%); padding: 60px 20px; border-bottom: 1px solid var(--gold); }
    .about-container { max-width: 900px; margin: 0 auto; text-align: center; }
    .about-label { display: inline-block; background: rgba(212, 175, 55, 0.1); color: var(--gold); padding: 8px 16px; border-radius: 4px; font-size: 12px; font-weight: 700; text-transform: uppercase; margin-bottom: 20px; border: 1px solid var(--gold); }
    .about-heading { font-size: 36px; font-weight: 800; color: var(--gold); margin-bottom: 20px; text-transform: uppercase; letter-spacing: 2px; }
    .about-text { font-size: 14px; color: var(--gray); line-height: 1.8; margin-bottom: 30px; }
    .about-text strong { color: var(--gold); }
    
    .features-grid { display: grid; grid-template-columns: repeat(2, 1fr); gap: 15px; margin-top: 30px; }
    .feature-box { padding: 15px; background: rgba(212, 175, 55, 0.1); border-radius: 6px; border-left: 3px solid var(--gold); }
    .feature-box p { color: var(--gold); font-weight: 700; font-size: 12px; text-transform: uppercase; }

    .courses-section { padding: 60px 20px; background: #0f0f0f; border-bottom: 1px solid var(--gold); }
    .courses-container { max-width: 1200px; margin: 0 auto; }
    .section-header { text-align: center; margin-bottom: 50px; }
    .section-eyebrow { color: var(--gold); font-size: 14px; font-weight: 600; text-transform: uppercase; display: inline-block; padding: 6px 12px; background: rgba(212, 175, 55, 0.1); border-radius: 4px; margin-bottom: 15px; }
    .section-header h2 { font-size: 40px; font-weight: 700; color: var(--gold); margin: 0; text-transform: uppercase; letter-spacing: 1px; }
    .section-header p { font-size: 15px; color: var(--gray); }

    .cards-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 25px; }
    .card {
        background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%);
        border: 2px solid var(--gold);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
        height: 100%;
    }
    .card:hover { transform: translateY(-8px); box-shadow: 0 12px 35px rgba(212, 175, 55, 0.25); }
    
    .card-image { width: 100%; height: 180px; background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%); display: flex; align-items: center; justify-content: center; font-size: 48px; color: #000; }
    .card-image img { width: 100%; height: 100%; object-fit: cover; }
    
    .card-body { padding: 20px; flex-grow: 1; }
    .card-title { font-size: 20px; font-weight: 700; color: var(--gold); margin-bottom: 10px; }
    .card-desc { font-size: 13px; color: var(--gray); line-height: 1.6; margin-bottom: 15px; }
    .card-link { color: var(--gold); font-weight: 700; font-size: 12px; text-transform: uppercase; letter-spacing: 1px; }
    .card-link:hover { color: var(--gold-light); }

    .view-all-btn {
        background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
        color: #000;
        padding: 12px 28px;
        border-radius: 4px;
        font-weight: 700;
        font-size: 13px;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 30px;
        display: inline-block;
        cursor: pointer;
    }
    .view-all-btn:hover { transform: translateY(-2px); }

    .section-actions { text-align: center; }

    .footer {
        background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%);
        border-top: 2px solid var(--gold);
        padding: 40px 20px 20px;
        text-align: center;
    }
    .footer-content { max-width: 1200px; margin: 0 auto 30px; display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 30px; }
    .footer-col h4 { font-size: 13px; font-weight: 700; color: var(--gold); text-transform: uppercase; margin-bottom: 15px; }
    .footer-col ul { list-style: none; }
    .footer-col a { font-size: 12px; color: var(--gray); }
    .footer-col a:hover { color: var(--gold); }
    .footer-bottom { border-top: 1px solid var(--gold); padding-top: 20px; font-size: 12px; color: var(--gray); }

    @media (max-width: 768px) {
        .quick-grid { grid-template-columns: repeat(3, 1fr); }
        .cards-grid { grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); }
        .section-header h2 { font-size: 28px; }
        .footer-content { grid-template-columns: 1fr; }
    }
</style>

<header class="header">
    <div class="logo-section">
        <img src="/img/logo/logo11.png" alt="Law Students Logo">
        <span class="logo-text">LAW STUDENTS</span>
    </div>
    <nav><ul class="nav-menu">
        <li><a href="#home">Home</a></li>
        <li><a href="{{ route('frontend.course') }}">Courses</a></li>
        <li><a href="{{ route('frontend.copys') }}">Notes</a></li>
        <li><a href="{{ route('frontend.acts') }}">Acts</a></li>
    </ul></nav>
    <button class="nav-toggle">☰</button>
</header>

<section class="hero-section">
    <div style="max-width: 900px;">
        <div class="hero-branding">
            <img src="/img/logo/logo11.png" alt="Law Students">
            <h1>Law Students</h1>
        </div>
        <p class="hero-tagline">Learn • Understand • Achieve</p>
        <p class="hero-supporting-text">A comprehensive platform for Legal Education, Examination Preparation, Legal Knowledge, Bare Acts, Rules, and Study Materials.</p>
        <div class="hero-buttons">
            <a href="{{ route('frontend.course') }}" class="btn btn-primary">Explore Courses</a>
            <a href="{{ route('frontend.copys') }}" class="btn btn-primary">Free Notes</a>
            <a href="{{ route('frontend.legalknowledgelibrary') }}" class="btn btn-primary">Legal Knowledge</a>
        </div>
    </div>
</section>

<section class="quick-access-section">
    <div class="quick-access-container">
        <h2 class="section-title">Quick Access</h2>
        <div class="quick-grid">
            <div class="quick-item"><h3>50+</h3><p>Courses</p></div>
            <div class="quick-item"><h3>500+</h3><p>Materials</p></div>
            <div class="quick-item"><h3>100+</h3><p>Bare Acts</p></div>
            <div class="quick-item"><h3>200+</h3><p>Rules</p></div>
            <div class="quick-item"><h3>1000+</h3><p>Topics</p></div>
            <div class="quick-item"><h3>30+</h3><p>Exams</p></div>
        </div>
    </div>
</section>

<section class="about-section">
    <div class="about-container">
        <span class="about-label">About Platform</span>
        <h2 class="about-heading">Welcome to Law Student</h2>
        <p class="about-text"><strong>Law Student</strong> is an educational and knowledge platform dedicated to students, aspirants and professionals pursuing legal and professional education.</p>
        <div class="features-grid">
            <div class="feature-box"><p>✓ Expert Instructors</p></div>
            <div class="feature-box"><p>✓ Comprehensive Curriculum</p></div>
            <div class="feature-box"><p>✓ Study Materials</p></div>
            <div class="feature-box"><p>✓ Career Advancement</p></div>
        </div>
    </div>
</section>

<section class="courses-section">
    <div class="courses-container">
        <div class="section-header">
            <span class="section-eyebrow">Courses</span>
            <h2>Explore Our Courses</h2>
            <p>Comprehensive learning programs designed by legal experts</p>
        </div>
        <div class="cards-grid">
            @php $courses = \App\Models\Course::limit(6)->get(); @endphp
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
                    <h3 class="card-title">{{ Str::limit($course->title, 30) }}</h3>
                    <p class="card-desc">{{ Str::limit($course->description ?? '', 60) }}</p>
                </div>
                <div style="padding: 0 20px 20px;"><a href="{{ route('frontend.course') }}" class="card-link">Learn More →</a></div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">Courses will be displayed here</div>
            @endforelse
        </div>
        <div class="section-actions"><a href="{{ route('frontend.course') }}" class="view-all-btn">View All Courses</a></div>
    </div>
</section>

<section class="courses-section" style="border-bottom: none;">
    <div class="courses-container">
        <div class="section-header">
            <span class="section-eyebrow">Free Notes</span>
            <h2>Study Materials</h2>
            <p>Access valuable study materials and resources</p>
        </div>
        <div class="cards-grid">
            @php $notes = \App\Models\Copy::limit(6)->get(); @endphp
            @forelse($notes as $note)
            <div class="card">
                <div class="card-image" style="font-size: 32px;"><i class="fa-solid fa-file-pdf"></i></div>
                <div class="card-body">
                    <h3 class="card-title">{{ Str::limit($note->description, 30) }}</h3>
                    <p class="card-desc">{{ count($note->pdfs ?? []) }} PDF available</p>
                </div>
                <div style="padding: 0 20px 20px;"><a href="{{ route('frontend.copys') }}" class="card-link">View Notes →</a></div>
            </div>
            @empty
            <div style="grid-column: 1 / -1; text-align: center; padding: 40px;">Study notes will be displayed here</div>
            @endforelse
        </div>
        <div class="section-actions"><a href="{{ route('frontend.copys') }}" class="view-all-btn">View All Notes</a></div>
    </div>
</section>

<footer class="footer">
    <div class="footer-content">
        <div class="footer-col"><h4>Quick Links</h4><ul><li><a href="{{ route('frontend.course') }}">Courses</a></li><li><a href="{{ route('frontend.copys') }}">Notes</a></li><li><a href="{{ route('frontend.acts') }}">Acts</a></li></ul></div>
        <div class="footer-col"><h4>Resources</h4><ul><li><a href="{{ route('frontend.govtexams') }}">Govt. Exams</a></li><li><a href="{{ route('frontend.legalknowledgelibrary') }}">Knowledge</a></li><li><a href="#">Contact</a></li></ul></div>
        <div class="footer-col"><h4>Company</h4><ul><li><a href="#">Terms</a></li><li><a href="#">Privacy</a></li><li><a href="#">Sitemap</a></li></ul></div>
    </div>
    <div class="footer-bottom"><p>&copy; 2024 Law Students. All rights reserved.</p></div>
</footer>

@endsection
