@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<!-- ===== COURSES & TEAM SECTION RESPONSIVE STYLES ======= -->
<style>
    /* ===== COURSES SECTION ===== */
    /* Courses section - ensure 3 column layout on all screens */
    .service7-section-area .col-lg-4 {
        width: 33.333333% !important;
        flex: 0 0 33.333333% !important;
        max-width: 33.333333% !important;
    }

    /* Course box - flex column layout (image on top, text below) */
    .service7-box-area {
        display: flex;
        flex-direction: column;
        height: 100%;
    }

    .service7-boxarea {
        display: flex;
        flex-direction: column;
        width: 100%;
        height: auto;
        margin-bottom: 0;
    }

    /* Course image at top */
    .service-images {
        width: 100%;
        height: auto;
        overflow: hidden;
        margin-bottom: 12px;
    }

    .service-images img {
        width: 100%;
        height: auto;
        display: block;
    }

    /* Course author area below image */
    .service7-author-area {
        display: flex;
        flex-direction: column;
        align-items: center;
        text-align: center;
        margin-bottom: 12px;
    }

    .service-icons {
        margin-bottom: 10px;
        flex-shrink: 0;
    }

    .service-icons img {
        width: 45px;
        height: 45px;
    }

    .service-7-content a {
        font-size: 16px;
        font-weight: 600;
        display: block;
        margin-bottom: 8px;
    }

    /* Course description content */
    .service7-content {
        text-align: center;
    }

    .service7-content p {
        font-size: 13px;
        line-height: 1.5;
        margin: 0 0 10px 0;
    }

    .service7-content a {
        font-size: 12px;
        color: #ff5722;
        text-decoration: none;
    }

    /* Course header section */
    .service7-header-area {
        text-align: center;
        margin-bottom: 40px;
    }

    .service7-header-area span {
        font-size: 14px;
        display: block;
        margin-bottom: 15px;
    }

    .service7-header-area h2 {
        font-size: 32px;
        line-height: 1.3;
        margin: 0;
    }

    .service7-header-area .defence {
        color: #ff5722;
    }

    /* Tablet screens */
    @media (max-width: 1024px) {
        .service7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .service-images {
            margin-bottom: 10px;
        }

        .service-icons img {
            width: 40px;
            height: 40px;
        }

        .service-7-content a {
            font-size: 15px;
            margin-bottom: 6px;
        }

        .service7-content p {
            font-size: 12px;
        }

        .service7-header-area h2 {
            font-size: 28px;
        }
    }

    /* Medium screens */
    @media (max-width: 768px) {
        .service7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .service7-box-area {
            padding: 8px;
        }

        .service-images {
            margin-bottom: 8px;
        }

        .service7-author-area {
            margin-bottom: 8px;
        }

        .service-icons img {
            width: 36px;
            height: 36px;
        }

        .service-7-content a {
            font-size: 14px;
            margin-bottom: 5px;
        }

        .service7-content p {
            font-size: 11px;
        }

        .service7-header-area span {
            font-size: 12px;
        }

        .service7-header-area h2 {
            font-size: 24px;
        }
    }

    /* Small screens */
    @media (max-width: 576px) {
        .service7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .service7-box-area {
            padding: 6px;
        }

        .service-images {
            margin-bottom: 6px;
        }

        .service7-author-area {
            margin-bottom: 6px;
        }

        .service-icons img {
            width: 32px;
            height: 32px;
        }

        .service-7-content a {
            font-size: 12px;
            margin-bottom: 4px;
        }

        .service7-content p {
            font-size: 10px;
            line-height: 1.3;
        }

        .service7-content a {
            font-size: 10px;
        }

        .service7-header-area span {
            font-size: 11px;
        }

        .service7-header-area h2 {
            font-size: 20px;
        }
    }

    /* Extra small screens */
    @media (max-width: 480px) {
        .service7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .service7-box-area {
            padding: 4px;
        }

        .service-images {
            margin-bottom: 4px;
        }

        .service7-author-area {
            margin-bottom: 4px;
        }

        .service-icons img {
            width: 28px;
            height: 28px;
        }

        .service-7-content a {
            font-size: 11px;
            margin-bottom: 3px;
        }

        .service7-content p {
            font-size: 9px;
            line-height: 1.2;
            margin: 0 0 6px 0;
        }

        .service7-content a {
            font-size: 9px;
        }

        .service7-header-area span {
            font-size: 10px;
            margin-bottom: 10px;
        }

        .service7-header-area h2 {
            font-size: 18px;
            line-height: 1.2;
        }
    }

    /* ===== TEAM SECTION ===== */
    /* Team section - ensure 3 column layout on all screens */
    .team7-section-area .col-lg-4 {
        width: 33.333333% !important;
        flex: 0 0 33.333333% !important;
        max-width: 33.333333% !important;
    }

    /* Team main box - flex column layout (image on top, text below) */
    .team6-main-boxarea {
        display: flex;
        flex-direction: column;
    }

    .team6-boxarea {
        width: 100%;
        height: auto;
        margin-bottom: 12px;
    }

    .team6-img {
        width: 100%;
        height: auto;
        overflow: hidden;
    }

    .team6-img img {
        width: 100%;
        height: auto;
        display: block;
    }

    .team6-images {
        display: none;
    }

    /* Team content text below image */
    .team-content {
        text-align: center;
        padding: 10px 0;
    }

    .team-content a {
        font-size: 16px;
        font-weight: 600;
        display: block;
        margin-bottom: 4px;
    }

    .team-content p {
        font-size: 13px;
        margin: 0;
    }

    /* Tablet screens */
    @media (max-width: 1024px) {
        .team7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .team-content a {
            font-size: 15px;
        }

        .team-content p {
            font-size: 12px;
        }
    }

    /* Medium screens */
    @media (max-width: 768px) {
        .team7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .team6-boxarea {
            margin-bottom: 10px;
        }

        .team-content {
            padding: 8px 0;
        }

        .team-content a {
            font-size: 14px;
            margin-bottom: 3px;
        }

        .team-content p {
            font-size: 11px;
        }
    }

    /* Small screens */
    @media (max-width: 576px) {
        .team7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .team6-boxarea {
            margin-bottom: 8px;
        }

        .team-content {
            padding: 6px 0;
        }

        .team-content a {
            font-size: 12px;
            margin-bottom: 2px;
        }

        .team-content p {
            font-size: 10px;
        }
    }

    /* Extra small screens */
    @media (max-width: 480px) {
        .team7-section-area .col-lg-4 {
            width: 33.333333% !important;
            flex: 0 0 33.333333% !important;
            max-width: 33.333333% !important;
        }

        .team6-boxarea {
            margin-bottom: 6px;
        }

        .team-content {
            padding: 4px 0;
        }

        .team-content a {
            font-size: 11px;
            margin-bottom: 2px;
        }

        .team-content p {
            font-size: 9px;
        }
    }

    /* Team header section */
    .team6-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .team6-header span {
        font-size: 14px;
    }

    .team6-header h2 {
        font-size: 28px;
        line-height: 1.3;
    }

    @media (max-width: 768px) {
        .team6-header span {
            font-size: 12px;
        }

        .team6-header h2 {
            font-size: 22px;
        }
    }

    @media (max-width: 480px) {
        .team6-header span {
            font-size: 11px;
        }

        .team6-header h2 {
            font-size: 18px;
        }
    }
</style>
<!-- ===== HERO/LANDING SECTION STARTS ======= -->
<style>
    .hero-section {
        background: linear-gradient(135deg, #f5f7fa 0%, #e8ecf1 100%);
        padding: 80px 20px;
        text-align: center;
        min-height: 600px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .hero-content {
        max-width: 900px;
    }

    .hero-branding {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 15px;
        margin-bottom: 30px;
    }

    .hero-branding img {
        height: 60px;
        width: auto;
    }

    .hero-branding h1 {
        font-size: 48px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        font-family: 'Poppins', sans-serif;
    }

    .hero-tagline {
        font-size: 28px;
        font-weight: 600;
        color: #2c3e50;
        margin: 25px 0 20px 0;
        line-height: 1.4;
        font-family: 'Poppins', sans-serif;
    }

    .hero-supporting-text {
        font-size: 16px;
        color: #555;
        line-height: 1.8;
        margin: 0 0 50px 0;
        max-width: 750px;
        margin-left: auto;
        margin-right: auto;
    }

    .hero-buttons {
        display: flex;
        gap: 20px;
        justify-content: center;
        flex-wrap: wrap;
        margin-top: 40px;
    }

    .hero-btn {
        padding: 14px 36px;
        font-size: 15px;
        font-weight: 600;
        border: 2px solid;
        text-decoration: none;
        border-radius: 5px;
        transition: all 0.3s ease;
        display: inline-block;
        cursor: pointer;
        min-width: 200px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .hero-btn-primary {
        background-color: #ff5722;
        color: white;
        border-color: #ff5722;
    }

    .hero-btn-primary:hover {
        background-color: #e64a19;
        border-color: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    .hero-btn-secondary {
        background-color: transparent;
        color: #2c3e50;
        border-color: #2c3e50;
    }

    .hero-btn-secondary:hover {
        background-color: #2c3e50;
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(44, 62, 80, 0.3);
    }

    @media (max-width: 768px) {
        .hero-section {
            padding: 60px 20px;
            min-height: auto;
        }

        .hero-branding {
            flex-direction: column;
            gap: 10px;
        }

        .hero-branding h1 {
            font-size: 36px;
        }

        .hero-tagline {
            font-size: 22px;
            margin: 20px 0 15px 0;
        }

        .hero-supporting-text {
            font-size: 14px;
            margin: 0 0 35px 0;
        }

        .hero-buttons {
            flex-direction: column;
            gap: 15px;
        }

        .hero-btn {
            width: 100%;
            min-width: auto;
        }
    }
</style>

<div class="hero-section">
    <div class="hero-content">
        <div class="hero-branding">
            <img src="/img/logo/logo11.png" alt="LawStudents Logo" style="height: 50px;">
            <h1>LawStudents</h1>
        </div>

        <div class="hero-tagline">
            Learn Law. Understand Law. Build Your Future.
        </div>

        <div class="hero-supporting-text">
            A comprehensive platform for Legal Education, Examination Preparation, Legal Knowledge,
            Bare Acts, Rules, Notifications and Study Materials.
        </div>

        <div class="hero-buttons">
            <a href="{{ route('frontend.course') }}" class="hero-btn hero-btn-primary">
                Explore Courses
            </a>
            <a href="{{ route('frontend.copys') }}" class="hero-btn hero-btn-secondary">
                Free Notes
            </a>
            <a href="{{ route('frontend.home') }}" class="hero-btn hero-btn-secondary">
                Legal Knowledge
            </a>
        </div>
    </div>
</div>

<!-- ===== HERO/LANDING SECTION ENDS ======= -->

<!-- ===== QUICK ACCESS SECTION STARTS ======= -->
<style>
    .quick-access-section {
        padding: 40px 20px;
        background-color: #f5f5f5;
    }

    .quick-access-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .quick-access-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .quick-access-item {
        background: white;
        padding: 25px;
        border-radius: 8px;
        text-align: center;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        text-decoration: none;
        color: inherit;
        display: block;
    }

    .quick-access-item:hover {
        box-shadow: 0 4px 16px rgba(255, 87, 34, 0.15);
        transform: translateY(-5px);
    }

    .quick-access-icon {
        font-size: 40px;
        margin-bottom: 12px;
    }

    .quick-access-item h3 {
        font-size: 16px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
    }

    @media (max-width: 768px) {
        .quick-access-grid {
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .quick-access-item {
            padding: 20px;
        }

        .quick-access-icon {
            font-size: 32px;
        }

        .quick-access-item h3 {
            font-size: 14px;
        }
    }
</style>


<!-- ===== ABOUT LAWSTUDENT SECTION STARTS ======= -->
<style>
    .about-lawstudent-section {
        padding: 80px 0;
    }

    .about-lawstudent-container {
        max-width: 900px;
        margin: 0 auto;
        padding: 0 20px;
    }

    .about-lawstudent-content {
        text-align: center;
    }

    .about-lawstudent-eyebrow {
        color: #ff5722;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 16px;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        background: #ff57221a;
        margin-bottom: 20px;
    }

    .about-lawstudent-heading {
        color: #0a141c;
        font-family: 'Outfit', sans-serif;
        font-size: 44px;
        font-weight: 600;
        margin-bottom: 20px;
        line-height: 54px;
        text-align: center;
    }

    .about-lawstudent-intro {
        color: var(--Paragraph-Color, #515456);
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 400;
        line-height: 26px;
        text-align: center;
        margin: 0 auto;
    }

    .about-lawstudent-intro strong {
        color: #ff5722;
        font-weight: 600;
    }

    @media (max-width: 768px) {
        .about-lawstudent-section {
            padding: 60px 0;
        }

        .about-lawstudent-heading {
            font-size: 32px;
            line-height: 42px;
        }

        .about-lawstudent-intro {
            font-size: 14px;
        }
    }
</style>

<div class="about-lawstudent-section">
    <div class="about-lawstudent-container">
        <div class="about-lawstudent-content">
            <span class="about-lawstudent-eyebrow">About Platform</span>
            <h2 class="about-lawstudent-heading">Welcome to LawStudent</h2>

            <p class="about-lawstudent-intro">
                <strong>LawStudent</strong> is an educational and knowledge platform dedicated to students, aspirants and
                professionals pursuing legal and professional education. The platform provides structured courses,
                study materials, Bare Acts, Rules, Notifications, legal knowledge resources and examination-
                oriented preparation.
            </p>
        </div>
    </div>
</div>
<!-- ===== ABOUT LAWSTUDENT SECTION ENDS ======= -->

<style>
    .courses-notes-section {
        padding: 60px 20px;
        background-color: #fff;
    }

    .courses-notes-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .courses-notes-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .courses-notes-header h2 {
        font-size: 44px;
        font-weight: 600;
        color: #0a141c;
        margin: 0 0 15px 0;
        line-height: 54px;
        font-family: 'Outfit', sans-serif;
    }

    .courses-notes-header p {
        font-size: 16px;
        color: var(--Paragraph-Color, #515456);
        font-family: 'Outfit', sans-serif;
        margin: 0;
    }

    .courses-notes-eyebrow {
        color: #ff5722;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 16px;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        background: #ff57221a;
        margin-bottom: 20px;
    }

    .courses-notes-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
        gap: 30px;
    }

    .course-note-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
    }

    .course-note-card:hover {
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.15);
        transform: translateY(-8px);
    }

    .course-note-card-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
        font-weight: bold;
        overflow: hidden;
    }

    .course-note-card-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .course-note-card-price {
        font-size: 13px;
        color: #666;
        margin: 0 0 15px 0;
    }

    .course-note-card-price strong {
        color: #1a1a1a;
        font-weight: 700;
    }

    .course-note-card-body {
        padding: 25px;
    }

    .course-note-card-body h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .course-note-card-body p {
        font-size: 14px;
        color: #666;
        margin: 0 0 15px 0;
        line-height: 1.6;
        min-height: 40px;
    }

    .course-note-card-footer {
        padding: 0 25px 25px 25px;
    }

    .course-note-link {
        color: #ff5722;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .course-note-link:hover {
        color: #e64a19;
        gap: 12px;
    }

    .courses-notes-view-all {
        text-align: center;
        margin-top: 50px;
    }

    .courses-notes-view-all-btn {
        background-color: #ff5722;
        color: white;
        padding: 14px 36px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
        border: 2px solid #ff5722;
    }

    .courses-notes-view-all-btn:hover {
        background-color: #e64a19;
        border-color: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    .no-content-message {
        text-align: center;
        padding: 40px;
        color: #999;
        font-size: 16px;
    }

    /* Free Notes preview: plain bordered list style (same as the real Free Notes page,
       which has no thumbnails/cards, just flat bordered boxes) */
    .note-plain-card {
        background: #fff;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: none;
        overflow: visible;
        padding: 15px;
    }

    .note-plain-card:hover {
        box-shadow: none;
        transform: none;
    }

    .note-plain-card .course-note-card-body {
        padding: 0 0 10px 0;
    }

    .note-plain-card .course-note-card-body h3 {
        font-size: 15px;
        font-weight: 600;
    }

    .note-plain-card .course-note-card-body p {
        min-height: 0;
        margin: 8px 0 0 0;
    }

    .note-plain-card .course-note-card-footer {
        padding: 0;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .courses-notes-section {
            padding: 40px 15px;
        }

        .courses-notes-header h2 {
            font-size: 24px;
        }

        .courses-notes-header p {
            font-size: 14px;
        }

        .courses-notes-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 20px;
        }

        .course-note-card-image {
            height: 180px;
            font-size: 40px;
        }

        .course-note-card-body {
            padding: 20px;
        }

        .course-note-card-footer {
            padding: 0 20px 20px 20px;
        }
    }

    @media (max-width: 480px) {
        .courses-notes-section {
            padding: 30px 10px;
        }

        .courses-notes-header h2 {
            font-size: 20px;
        }

        .courses-notes-header p {
            font-size: 13px;
        }

        .courses-notes-grid {
            grid-template-columns: 1fr;
            gap: 15px;
        }

        .course-note-card-image {
            height: 160px;
            font-size: 36px;
        }

        .course-note-card-body {
            padding: 15px;
        }

        .course-note-card-body h3 {
            font-size: 16px;
        }

        .course-note-card-body p {
            font-size: 13px;
        }

        .course-note-card-footer {
            padding: 0 15px 15px 15px;
        }

        .courses-notes-view-all-btn {
            width: 100%;
        }
    }
</style>

<div class="courses-notes-section">
    <div class="courses-notes-container">
        <!-- COURSES SECTION -->
        <div style="margin-bottom: 80px;">
            <div class="courses-notes-header">
                <span class="courses-notes-eyebrow">Courses</span>
                <h2>📚 Explore Our Courses</h2>
                <p>Comprehensive learning programs designed by legal experts</p>
            </div>

            <div class="courses-notes-grid" data-aos="fade-up">
                @php
                $courses = \App\Models\Course::limit(9)->get();
                @endphp
                @forelse($courses as $course)
                <div class="course-note-card">
                    <div class="course-note-card-image">
                        @if($course->thumbnail)
                        <img src="{{ asset('storage/app/public/' . $course->thumbnail) }}" alt="{{ $course->title }}">
                        @else
                        <i class="fa-solid fa-book"></i>
                        @endif
                    </div>
                    <div class="course-note-card-body">
                        <h3>{{ $course->title ?? 'Course Title' }}</h3>
                        <p>{{ Str::limit($course->description ?? 'Learn comprehensive legal knowledge', 80) }}</p>
                        <div class="course-note-card-price">
                            Price: <strong>₹{{ number_format($course->price ?? 0, 2) }}</strong>
                        </div>
                    </div>
                    <div class="course-note-card-footer">
                        <a href="{{ route('frontend.course') }}" class="course-note-link">
                            Explore Course <span>→</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="no-content-message" style="grid-column: 1 / -1;">
                    Courses will be displayed here
                </div>
                @endforelse
            </div>

            <div class="courses-notes-view-all">
                <a href="{{ route('frontend.course') }}" class="courses-notes-view-all-btn">View All Courses</a>
            </div>
        </div>

        <!-- FREE NOTES SECTION -->
        <div>
            <div class="courses-notes-header">
                <span class="courses-notes-eyebrow">Free Notes</span>
                <h2>📝 Free Study Notes</h2>
                <p>Access valuable study materials and notes for your legal education</p>
            </div>

            <div class="courses-notes-grid" data-aos="fade-up">
                @php
                $notes = \App\Models\Copy::limit(9)->get();
                @endphp
                @forelse($notes as $note)
                <div class="course-note-card note-plain-card">
                    <div class="course-note-card-body">
                        <h3>{{ Str::limit($note->description ?? 'Study Note', 60) }}</h3>
                        <p>
                            <i class="fa-solid fa-file-pdf" style="color:#ff5722; margin-right:6px;"></i>
                            {{ count($note->pdfs ?? []) }} PDF{{ count($note->pdfs ?? []) === 1 ? '' : 's' }} available
                        </p>
                    </div>
                    <div class="course-note-card-footer">
                        <a href="{{ route('frontend.copys') }}" class="course-note-link">
                            View Notes <span>→</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="no-content-message" style="grid-column: 1 / -1;">
                    Study notes will be displayed here
                </div>
                @endforelse
            </div>

            <div class="courses-notes-view-all">
                <a href="{{ route('frontend.copys') }}" class="courses-notes-view-all-btn">View All Notes</a>
            </div>
        </div>
    </div>
</div>
<!-- ===== COURSES & FREE NOTES SECTION ENDS ======= -->

<!-- ===== BARE ACTS & RULES SECTION STARTS ======= -->
<style>
    .acts-rules-section {
        padding: 60px 20px;
        background-color: #f9f9f9;
    }

    .acts-rules-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .acts-rules-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .acts-rules-eyebrow {
        color: #ff5722;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 16px;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        background: #ff57221a;
        margin-bottom: 20px;
    }

    .acts-rules-header h2 {
        font-size: 44px;
        font-weight: 600;
        color: #0a141c;
        margin: 0 0 15px 0;
        line-height: 54px;
        font-family: 'Outfit', sans-serif;
    }

    .acts-rules-header p {
        font-size: 16px;
        color: var(--Paragraph-Color, #515456);
        font-family: 'Outfit', sans-serif;
        margin: 0;
    }

    .acts-rules-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
    }

    .acts-rules-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }

    .acts-rules-card:hover {
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.2);
        transform: translateY(-5px);
    }

    .acts-rules-card-header {
        background: #fff;
        padding: 25px 30px 0 30px;
        text-align: center;
        border-bottom: 1px solid #f0f0f0;
        padding-bottom: 20px;
    }

    .acts-rules-card-header h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0;
        font-family: 'Outfit', sans-serif;
    }

    .acts-rules-card-body {
        padding: 30px;
        max-height: 400px;
        overflow-y: auto;
    }

    .acts-rules-item {
        display: flex;
        align-items: flex-start;
        margin-bottom: 10px;
        padding: 10px;
        border: 1px solid #eee;
        border-radius: 6px;
    }

    .acts-rules-item:last-child {
        margin-bottom: 0;
    }

    .acts-rules-item-icon {
        width: 24px;
        height: 24px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #ff5722;
        flex-shrink: 0;
        margin-right: 15px;
        font-size: 16px;
    }

    .acts-rules-item-content {
        flex: 1;
    }

    .acts-rules-item-content a {
        color: #1a1a1a;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: block;
        margin-bottom: 5px;
        transition: color 0.3s ease;
    }

    .acts-rules-item-content a:hover {
        color: #ff5722;
    }

    .acts-rules-item-content p {
        color: #888;
        font-size: 12px;
        margin: 0;
        line-height: 1.4;
    }

    .acts-rules-card-footer {
        padding: 20px 30px;
        background-color: #f5f5f5;
        text-align: center;
        border-top: 1px solid #eee;
    }

    .acts-rules-view-all {
        color: #ff5722;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        transition: all 0.3s ease;
        display: inline-block;
    }

    .acts-rules-view-all:hover {
        color: #e64a19;
        transform: translateX(5px);
    }

    /* Responsive */
    @media (max-width: 768px) {
        .acts-rules-wrapper {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .acts-rules-header h2 {
            font-size: 24px;
        }

        .acts-rules-card-header {
            padding: 20px;
        }

        .acts-rules-card-header h3 {
            font-size: 20px;
        }

        .acts-rules-card-body {
            padding: 20px;
            max-height: 300px;
        }

        .acts-rules-card-footer {
            padding: 15px 20px;
        }
    }

    @media (max-width: 480px) {
        .acts-rules-section {
            padding: 40px 15px;
        }

        .acts-rules-header h2 {
            font-size: 20px;
        }

        .acts-rules-header p {
            font-size: 14px;
        }

        .acts-rules-card-header {
            padding: 15px;
        }

        .acts-rules-card-header h3 {
            font-size: 18px;
        }

        .acts-rules-card-body {
            padding: 15px;
            max-height: 250px;
        }

        .acts-rules-item {
            margin-bottom: 12px;
            padding-bottom: 12px;
        }

        .acts-rules-item-icon {
            width: 20px;
            height: 20px;
            font-size: 12px;
            margin-right: 10px;
        }

        .acts-rules-item-content a {
            font-size: 13px;
        }

        .acts-rules-item-content p {
            font-size: 11px;
        }
    }
</style>

<div class="acts-rules-section">
    <div class="acts-rules-container">
        <div class="acts-rules-header">
            <span class="acts-rules-eyebrow">Legal Resources</span>
            <h2>Bare Acts & Rules</h2>
            <p>Access comprehensive legal documents and regulatory frameworks</p>
        </div>

        <!-- Acts -->
        <div style="margin-bottom: 60px;">
            <div class="acts-rules-card-header" style="text-align:left; border-bottom:none; padding:0 0 20px 0;">
                <h3>📜 Acts</h3>
            </div>
            <div class="courses-notes-grid" data-aos="fade-up">
                @php
                $acts = \App\Models\Act::limit(9)->get();
                @endphp
                @forelse($acts as $act)
                <div class="course-note-card note-plain-card">
                    <div class="course-note-card-body">
                        <h3>{{ Str::limit($act->description ?? 'Legal Act', 60) }}</h3>
                        <p>
                            <i class="fa-solid fa-file-pdf" style="color:#ff5722; margin-right:6px;"></i>
                            {{ count($act->pdfs ?? []) }} PDF{{ count($act->pdfs ?? []) === 1 ? '' : 's' }} available
                        </p>
                    </div>
                    <div class="course-note-card-footer">
                        <a href="{{ route('frontend.acts') }}" class="course-note-link">
                            View Act <span>→</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="no-content-message" style="grid-column: 1 / -1;">
                    Acts will be displayed here
                </div>
                @endforelse
            </div>
            <div class="courses-notes-view-all">
                <a href="{{ route('frontend.acts') }}" class="courses-notes-view-all-btn">View All Acts</a>
            </div>
        </div>

        <!-- Rules -->
        <div>
            <div class="acts-rules-card-header" style="text-align:left; border-bottom:none; padding:0 0 20px 0;">
                <h3>⚖️ Rules</h3>
            </div>
            <div class="courses-notes-grid" data-aos="fade-up">
                @php
                $rules = \App\Models\Rule::limit(9)->get();
                @endphp
                @forelse($rules as $rule)
                <div class="course-note-card note-plain-card">
                    <div class="course-note-card-body">
                        <h3>{{ Str::limit($rule->description ?? 'Legal Rule', 60) }}</h3>
                        <p>
                            <i class="fa-solid fa-file-pdf" style="color:#ff5722; margin-right:6px;"></i>
                            {{ count($rule->pdfs ?? []) }} PDF{{ count($rule->pdfs ?? []) === 1 ? '' : 's' }} available
                        </p>
                    </div>
                    <div class="course-note-card-footer">
                        <a href="{{ route('frontend.rules') }}" class="course-note-link">
                            View Rule <span>→</span>
                        </a>
                    </div>
                </div>
                @empty
                <div class="no-content-message" style="grid-column: 1 / -1;">
                    Rules will be displayed here
                </div>
                @endforelse
            </div>
            <div class="courses-notes-view-all">
                <a href="{{ route('frontend.rules') }}" class="courses-notes-view-all-btn">View All Rules</a>
            </div>
        </div>
    </div>
</div>
<!-- ===== BARE ACTS & RULES SECTION ENDS ======= -->


<!-- ===== LEGAL KNOWLEDGE INQUIRY FORM SECTION STARTS ======= -->
<style>
    .legal-knowledge-inquiry-section {
        padding: 60px 20px;
        background-color: #1a1a1a;
        color: white;
    }

    .legal-knowledge-inquiry-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .legal-knowledge-inquiry-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .legal-knowledge-inquiry-text h2 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 20px 0;
        line-height: 1.3;
        font-family: 'Poppins', sans-serif;
    }

    .legal-knowledge-inquiry-text p {
        font-size: 16px;
        margin: 0 0 30px 0;
        line-height: 1.6;
        opacity: 0.95;
    }

    .legal-knowledge-inquiry-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .legal-knowledge-inquiry-form input,
    .legal-knowledge-inquiry-form textarea,
    .legal-knowledge-inquiry-form select {
        padding: 12px 15px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
        background-color: white;
        color: #1a1a1a;
    }

    .legal-knowledge-inquiry-form input:focus,
    .legal-knowledge-inquiry-form textarea:focus,
    .legal-knowledge-inquiry-form select:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.3);
    }

    .legal-knowledge-inquiry-form textarea {
        resize: vertical;
        min-height: 100px;
    }

    .legal-knowledge-inquiry-btn {
        background-color: #ff5722;
        color: white;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        font-family: inherit;
    }

    .legal-knowledge-inquiry-btn:hover {
        background-color: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    @media (max-width: 768px) {
        .legal-knowledge-inquiry-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .legal-knowledge-inquiry-text h2 {
            font-size: 24px;
        }

        .legal-knowledge-inquiry-text p {
            font-size: 14px;
        }
    }

    @media (max-width: 480px) {
        .legal-knowledge-inquiry-section {
            padding: 40px 15px;
        }

        .legal-knowledge-inquiry-text h2 {
            font-size: 20px;
        }

        .legal-knowledge-inquiry-text p {
            font-size: 13px;
            margin: 0 0 20px 0;
        }

        .legal-knowledge-inquiry-form {
            gap: 12px;
        }
    }
</style>

<div class="legal-knowledge-inquiry-section">
    <div class="legal-knowledge-inquiry-container">
        <div class="legal-knowledge-inquiry-content">
            <div class="legal-knowledge-inquiry-text">
                <h2>Interested in Specific Legal Knowledge?</h2>
                <p>Submit your inquiry about any legal topic you'd like to explore deeper. Our legal experts will provide guidance and resources tailored to your learning needs.</p>
            </div>

            <form class="legal-knowledge-inquiry-form" method="POST" action="#" data-aos="fade-left">
                <input type="text" placeholder="Your Full Name" required>
                <input type="email" placeholder="Your Email Address" required>
                <input type="tel" placeholder="Your Phone Number" required>
                <select required>
                    <option value="">Select Legal Knowledge Category</option>
                    <option value="constitutional">Constitutional Law</option>
                    <option value="criminal">Criminal Law</option>
                    <option value="family">Family Law</option>
                    <option value="corporate">Corporate Law</option>
                    <option value="labor">Labor Law</option>
                    <option value="tax">Tax Law</option>
                    <option value="environmental">Environmental Law</option>
                    <option value="ip">Intellectual Property</option>
                    <option value="admin">Administrative Law</option>
                    <option value="international">International Law</option>
                </select>
                <textarea placeholder="Describe your inquiry or learning interests"></textarea>
                <button type="submit" class="legal-knowledge-inquiry-btn">Send Inquiry</button>
            </form>
        </div>
    </div>
</div>
<!-- ===== LEGAL KNOWLEDGE INQUIRY FORM SECTION ENDS ======= -->

<!-- ===== CENTRE & STATE GOVT EXAMS SECTION STARTS ======= -->
<style>
    .exams-section {
        padding: 60px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    }

    .exams-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .exams-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .exams-header h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 15px 0;
        font-family: 'Poppins', sans-serif;
    }

    .exams-header p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .exams-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .exam-card {
        background: white;
        padding: 30px;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        text-align: center;
        transition: all 0.3s ease;
    }

    .exam-card:hover {
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.15);
        transform: translateY(-8px);
    }

    .exam-icon {
        font-size: 48px;
        margin-bottom: 15px;
    }

    .exam-card h3 {
        font-size: 20px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 10px 0;
    }

    .exam-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .exams-header h2 {
            font-size: 24px;
        }

        .exam-card h3 {
            font-size: 18px;
        }
    }
</style>

<div class="exams-section">
    <div class="exams-container">
        <div class="exams-header">
            <h2>🎓 Centre & State Govt. Examination</h2>
            <p>Comprehensive preparation for competitive legal examinations</p>
        </div>

        <div class="courses-notes-grid" data-aos="fade-up">
            @php
            $govtExams = \App\Models\GovtExam::where('delete', 1)->latest()->limit(9)->get();
            @endphp
            @forelse($govtExams as $govtExam)
            <div class="course-note-card note-plain-card">
                <div class="course-note-card-body">
                    <h3>{{ Str::limit($govtExam->description ?? 'Govt. Examination Notification', 60) }}</h3>
                    <p>
                        <i class="fa-solid fa-file-pdf" style="color:#ff5722; margin-right:6px;"></i>
                        {{ count($govtExam->pdfs ?? []) }} PDF{{ count($govtExam->pdfs ?? []) === 1 ? '' : 's' }} available
                    </p>
                </div>
                <div class="course-note-card-footer">
                    <a href="{{ route('frontend.govtexams') }}" class="course-note-link">
                        View Notification <span>→</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="no-content-message" style="grid-column: 1 / -1;">
                Govt. Examination notifications will be displayed here
            </div>
            @endforelse
        </div>
        <div class="courses-notes-view-all">
            <a href="{{ route('frontend.govtexams') }}" class="courses-notes-view-all-btn">View All Govt. Examinations</a>
        </div>
    </div>
</div>
<!-- ===== CENTRE & STATE GOVT EXAMS SECTION ENDS ======= -->

<!-- ===== COURSE ENQUIRY SECTION STARTS ======= -->
<style>
    .enquiry-section {
        padding: 60px 20px;
        background-color: #ff5722;
        color: white;
    }

    .enquiry-container {
        max-width: 1000px;
        margin: 0 auto;
    }

    .enquiry-content {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .enquiry-text h2 {
        font-size: 32px;
        font-weight: 700;
        margin: 0 0 20px 0;
        line-height: 1.3;
        font-family: 'Poppins', sans-serif;
    }

    .enquiry-text p {
        font-size: 16px;
        margin: 0 0 30px 0;
        line-height: 1.6;
        opacity: 0.95;
    }

    .enquiry-form {
        display: flex;
        flex-direction: column;
        gap: 15px;
    }

    .enquiry-form input,
    .enquiry-form textarea {
        padding: 12px 15px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        font-family: inherit;
    }

    .enquiry-form input:focus,
    .enquiry-form textarea:focus {
        outline: none;
        box-shadow: 0 0 0 3px rgba(255, 255, 255, 0.3);
    }

    .enquiry-form textarea {
        resize: vertical;
        min-height: 100px;
    }

    .enquiry-btn {
        background-color: #1a1a1a;
        color: #ff5722;
        padding: 12px 30px;
        border: none;
        border-radius: 5px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 14px;
        font-family: inherit;
    }

    .enquiry-btn:hover {
        background-color: #333;
        transform: translateY(-2px);
    }

    @media (max-width: 768px) {
        .enquiry-content {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .enquiry-text h2 {
            font-size: 24px;
        }

        .enquiry-text p {
            font-size: 14px;
        }
    }
</style>

<div class="enquiry-section">
    <div class="enquiry-container">
        <div class="enquiry-content">
            <div class="enquiry-text">
                <h2>Interested in Our Courses?</h2>
                <p>Get in touch with our counselors to learn more about our comprehensive law courses and personalized learning programs. We're here to help you achieve your legal education goals.</p>
            </div>

            <form class="enquiry-form" method="POST" action="#" data-aos="fade-left">
                <input type="text" placeholder="Your Full Name" required>
                <input type="email" placeholder="Your Email Address" required>
                <input type="tel" placeholder="Your Phone Number" required>
                <textarea placeholder="Your Message or Course Inquiry"></textarea>
                <button type="submit" class="enquiry-btn">Send Enquiry</button>
            </form>
        </div>
    </div>
</div>
<!-- ===== COURSE ENQUIRY SECTION ENDS ======= -->

<!-- ===== WHY LAWSTUDENT SECTION STARTS ======= -->
<style>
    .why-section {
        padding: 60px 20px;
        background-color: white;
    }

    .why-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .why-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .why-header h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 15px 0;
        font-family: 'Poppins', sans-serif;
    }

    .why-header p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .why-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 30px;
    }

    .why-card {
        padding: 30px;
        background: #f9f9f9;
        border-radius: 8px;
        border-left: 4px solid #ff5722;
        transition: all 0.3s ease;
    }

    .why-card:hover {
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        transform: translateY(-5px);
    }

    .why-card h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 10px 0;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .why-card h3::before {
        content: '✓';
        color: #ff5722;
        font-size: 20px;
        font-weight: bold;
    }

    .why-card p {
        font-size: 14px;
        color: #666;
        margin: 0;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .why-header h2 {
            font-size: 24px;
        }

        .why-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="why-section">
    <div class="why-container">
        <div class="why-header">
            <h2>Why LawStudents?</h2>
            <p>Discover what makes our platform the best choice for legal education</p>
        </div>

        <div class="why-grid">
            <div class="why-card" data-aos="fade-up">
                <h3>Expert Instructors</h3>
                <p>Learn from experienced legal professionals with decades of practice and teaching experience</p>
            </div>

            <div class="why-card" data-aos="fade-up" data-aos-delay="100">
                <h3>Comprehensive Content</h3>
                <p>Access complete study materials covering all major areas of law and legal practice</p>
            </div>

            <div class="why-card" data-aos="fade-up" data-aos-delay="200">
                <h3>Flexible Learning</h3>
                <p>Study at your own pace with lifetime access to course materials and updates</p>
            </div>

            <div class="why-card" data-aos="fade-up" data-aos-delay="300">
                <h3>Affordable Pricing</h3>
                <p>Quality legal education at competitive rates with various payment options available</p>
            </div>

            <div class="why-card" data-aos="fade-up" data-aos-delay="400">
                <h3>Exam Preparation</h3>
                <p>Dedicated exam coaching for CLAT, AIBE, UGC NET, and other legal entrance exams</p>
            </div>

            <div class="why-card" data-aos="fade-up" data-aos-delay="500">
                <h3>24/7 Support</h3>
                <p>Round-the-clock support from our dedicated counselors and academic team</p>
            </div>
        </div>
    </div>
</div>

<!-- ===== LATEST LEGAL KNOWLEDGE SECTION STARTS ======= -->
<style>
    .legal-knowledge-section {
        padding: 60px 20px;
        background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
    }

    .legal-knowledge-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .legal-knowledge-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .legal-knowledge-header h2 {
        font-size: 32px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 15px 0;
        font-family: 'Poppins', sans-serif;
    }

    .legal-knowledge-header p {
        font-size: 16px;
        color: #666;
        margin: 0;
    }

    .legal-articles {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
        gap: 30px;
    }

    .article-card {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
    }

    .article-card:hover {
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.15);
        transform: translateY(-8px);
    }

    .article-image {
        width: 100%;
        height: 200px;
        background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 48px;
    }

    .article-body {
        padding: 25px;
    }

    .article-date {
        font-size: 12px;
        color: #ff5722;
        font-weight: 600;
        margin-bottom: 10px;
    }

    .article-body h3 {
        font-size: 18px;
        font-weight: 700;
        color: #1a1a1a;
        margin: 0 0 10px 0;
        line-height: 1.4;
    }

    .article-body p {
        font-size: 14px;
        color: #666;
        margin: 0 0 15px 0;
        line-height: 1.6;
    }

    .article-link {
        color: #ff5722;
        text-decoration: none;
        font-weight: 600;
        font-size: 14px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: all 0.3s ease;
    }

    .article-link:hover {
        gap: 12px;
        color: #e64a19;
    }

    .legal-knowledge-view-all {
        text-align: center;
        margin-top: 50px;
    }

    .legal-knowledge-btn {
        background-color: #ff5722;
        color: white;
        padding: 14px 36px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .legal-knowledge-btn:hover {
        background-color: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    @media (max-width: 768px) {
        .legal-knowledge-header h2 {
            font-size: 24px;
        }

        .article-card {
            grid-column: span 1;
        }
    }
</style>

<div class="legal-knowledge-section">
    <div class="legal-knowledge-container">
        <div class="legal-knowledge-header">
            <h2>📰 Latest Legal Knowledge</h2>
            <p>Stay updated with the latest developments in law and legal practice</p>
        </div>

        <div class="courses-notes-grid" data-aos="fade-up">
            @php
            $legalKnowledgeNotes = \App\Models\LegalKnowledgeNote::where('delete', 1)->latest()->limit(9)->get();
            @endphp
            @forelse($legalKnowledgeNotes as $legalKnowledgeNote)
            <div class="course-note-card note-plain-card">
                <div class="course-note-card-body">
                    <h3>{{ Str::limit($legalKnowledgeNote->description ?? 'Legal Knowledge', 60) }}</h3>
                    <p>
                        <i class="fa-solid fa-file-pdf" style="color:#ff5722; margin-right:6px;"></i>
                        {{ count($legalKnowledgeNote->pdfs ?? []) }} PDF{{ count($legalKnowledgeNote->pdfs ?? []) === 1 ? '' : 's' }} available
                    </p>
                </div>
                <div class="course-note-card-footer">
                    <a href="{{ route('frontend.legalknowledgelibrary') }}" class="course-note-link">
                        View Legal Knowledge <span>→</span>
                    </a>
                </div>
            </div>
            @empty
            <div class="no-content-message" style="grid-column: 1 / -1;">
                Legal Knowledge notes will be displayed here
            </div>
            @endforelse
        </div>

        <div class="legal-knowledge-view-all">
            <a href="{{ route('frontend.legalknowledgelibrary') }}" class="legal-knowledge-btn">View All Legal Knowledge</a>
        </div>
    </div>
</div>
<!-- ===== LATEST LEGAL KNOWLEDGE SECTION ENDS ======= -->

<!-- ===== GALLERY PREVIEW SECTION STARTS ======= -->
<style>
    .gallery-section {
        padding: 60px 20px;
        background-color: white;
    }

    .gallery-container {
        max-width: 1200px;
        margin: 0 auto;
    }

    .gallery-header {
        text-align: center;
        margin-bottom: 50px;
    }

    .gallery-header .gallery-eyebrow {
        color: #ff5722;
        font-family: 'Outfit', sans-serif;
        font-size: 16px;
        font-weight: 500;
        line-height: 16px;
        display: inline-block;
        padding: 8px 12px;
        border-radius: 4px;
        background: #ff57221a;
        margin-bottom: 20px;
    }

    .gallery-header h2 {
        font-size: 44px;
        font-weight: 600;
        color: #0a141c;
        margin: 0 0 15px 0;
        line-height: 54px;
        font-family: 'Outfit', sans-serif;
    }

    .gallery-header p {
        font-size: 16px;
        color: var(--Paragraph-Color, #515456);
        font-family: 'Outfit', sans-serif;
        margin: 0;
    }

    .gallery-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 20px;
        margin-bottom: 40px;
    }

    .gallery-item {
        position: relative;
        overflow: hidden;
        border-radius: 8px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
        cursor: pointer;
        aspect-ratio: 1;
    }

    .gallery-item:hover {
        box-shadow: 0 4px 20px rgba(255, 87, 34, 0.2);
        transform: scale(1.05);
    }

    .gallery-image {
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 48px;
    }

    .gallery-image img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .gallery-overlay {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        display: flex;
        align-items: center;
        justify-content: center;
        opacity: 0;
        transition: opacity 0.3s ease;
    }

    .gallery-item:hover .gallery-overlay {
        opacity: 1;
    }

    .gallery-overlay-icon {
        font-size: 32px;
        color: white;
    }

    .gallery-view-all {
        text-align: center;
    }

    .gallery-btn {
        background-color: #ff5722;
        color: white;
        padding: 14px 36px;
        text-decoration: none;
        border-radius: 5px;
        font-weight: 600;
        display: inline-block;
        transition: all 0.3s ease;
    }

    .gallery-btn:hover {
        background-color: #e64a19;
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
    }

    @media (max-width: 768px) {
        .gallery-header h2 {
            font-size: 24px;
        }

        .gallery-grid {
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 15px;
        }
    }

    /* Stacked photo-group card design (same as the full Gallery page) */
    .gallery-section .gallery-item.group-card {
        aspect-ratio: auto;
        overflow: visible;
        box-shadow: none;
        border-radius: 0;
        display: block;
        text-decoration: none;
    }

    .gallery-section .gallery-item.group-card:hover {
        box-shadow: none;
        transform: none;
    }

    .gallery-section .group-card {
        cursor: pointer;
        position: relative;
    }

    .gallery-section .image-stack {
        position: relative;
        height: 220px;
    }

    .gallery-section .stack-img {
        position: absolute;
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
        transition: 0.4s;
    }

    .gallery-section .stack-0 {
        top: 0;
        left: 0;
        z-index: 3;
    }

    .gallery-section .stack-1 {
        top: 8px;
        left: 8px;
        z-index: 2;
    }

    .gallery-section .stack-2 {
        top: 16px;
        left: 16px;
        z-index: 1;
    }

    .gallery-section .group-card:hover .stack-img {
        transform: scale(1.05);
    }

    .gallery-section .group-title {
        margin-bottom: 8px;
    }

    .gallery-section .group-title strong {
        font-family: 'Outfit', sans-serif;
        color: #0a141c;
    }

    .gallery-section .group-overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        border-radius: 12px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        color: #fff;
    }

    .gallery-section .group-overlay span {
        font-size: 12px;
        opacity: 0.8;
    }
</style>

<div class="gallery-section">
    <div class="gallery-container">
        <div class="gallery-header">
            <span class="gallery-eyebrow">Gallery</span>
            <p>Glimpses of our campus, events, and learning environment</p>
        </div>

        @php
            $homeGalleryGrouped = \App\Models\Gallery::active()->get()
                ->groupBy(function ($item) {
                    return $item->group_name ?: 'Ungrouped';
                })
                ->take(6);
        @endphp

        <div class="gallery-grid">
            @forelse ($homeGalleryGrouped as $homeGroupName => $homeGroupItems)
            <a href="{{ route('frontend.gallery') }}" class="gallery-item group-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 100 }}">
                <div class="group-title text-center">
                    <strong>{{ $homeGroupName }}</strong>
                </div>
                <div class="image-stack">
                    @foreach ($homeGroupItems->take(3) as $stackIndex => $homeGroupItem)
                    <img src="{{ asset('storage/app/public/' . $homeGroupItem->image) }}" class="stack-img stack-{{ $stackIndex }}">
                    @endforeach
                    <div class="group-overlay">
                        <span>{{ $homeGroupItems->count() }} Photos</span>
                    </div>
                </div>
            </a>
            @empty
            <div class="gallery-item" data-aos="fade-up">
                <div class="gallery-image">📚</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="100">
                <div class="gallery-image">🏫</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="200">
                <div class="gallery-image">👥</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="300">
                <div class="gallery-image">🎓</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="400">
                <div class="gallery-image">🏆</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>

            <div class="gallery-item" data-aos="fade-up" data-aos-delay="500">
                <div class="gallery-image">⭐</div>
                <div class="gallery-overlay">
                    <div class="gallery-overlay-icon">🔍</div>
                </div>
            </div>
            @endforelse
        </div>

        <div class="gallery-view-all">
            <a href="{{ route('frontend.gallery') }}" class="gallery-btn">View Full Gallery</a>
        </div>
    </div>
</div>

@endsection