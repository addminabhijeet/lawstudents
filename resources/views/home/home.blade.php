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

    <div class="quick-access-section">
        <div class="quick-access-container">
            <div class="quick-access-grid">
                <a href="{{ route('frontend.acts') }}" class="quick-access-item">
                    <div class="quick-access-icon">📜</div>
                    <h3>Acts</h3>
                </a>
                <a href="{{ route('frontend.copys') }}" class="quick-access-item">
                    <div class="quick-access-icon">📝</div>
                    <h3>Free Notes</h3>
                </a>
                <a href="{{ route('frontend.course') }}" class="quick-access-item">
                    <div class="quick-access-icon">📚</div>
                    <h3>Courses</h3>
                </a>
                <a href="{{ route('frontend.home') }}" class="quick-access-item">
                    <div class="quick-access-icon">🎓</div>
                    <h3>Exams</h3>
                </a>
            </div>
        </div>
    </div>
    <!-- ===== QUICK ACCESS SECTION ENDS ======= -->

    <!-- ===== ABOUT SECTION STARTS ======= -->
    <div class="about7-section-area sp1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="about5-images-area">
                        <div class="row">
                            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="800">
                                <div class="about5-img1">
                                    <img src="/img/images/about5-img1.png" alt="" />
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1000">
                                <div class="about5-img1">
                                    <div class="space50"></div>
                                    <img src="/img/images/about7-img2.png" alt="" />
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1200">
                                <div class="about5-img1 about5-textarea">
                                    <h1><span class="counter">25</span>+</h1>
                                    <p>Years Of Experiance</p>
                                    <img src="/img/images/about7-img1.png" alt="" />
                                    <p>Divorce Satisfied Clients</p>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-up" data-aos-duration="1400">
                                <div class="space30"></div>
                                <div class="about5-img1">
                                    <img src="/img/images/about7-img3.png" alt="" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="about7-header-area">
                        <span data-aos="fade-left" data-aos-duration="600">About Us</span>
                        <h2 data-aos="fade-left" data-aos-duration="800">
                            Trusted Law Experts <span class="defence"> Guiding</span>
                            Your Learning Journey
                        </h2>
                        <p data-aos="fade-left" data-aos-duration="900">
                            Our courses are designed by experienced legal professionals who are not just instructors;
                            <br /> they are your mentors, your guides, and your partners in mastering the law.
                        </p>
                        <h3 data-aos="fade-left" data-aos-duration="1000">Why Choose Our Courses?</h3>
                        <div class="list-about" data-aos="fade-left" data-aos-duration="1100">
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Comprehensive
                                        Legal Knowledge</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Simplified
                                        Learning</a>
                                </li>
                            </ul>

                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Step-by-Step
                                        Guidance</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Specialized
                                        Modules</a>
                                </li>
                            </ul>
                        </div>
                        <div class="div" data-aos="fade-left" data-aos-duration="1200">
                            <a href="" class="welcome6-btn">Ongoing Support<i
                                    class="fa-regular fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== ABOUT SECTION ENDS ======= -->

    <!-- ===== COURSES & FREE NOTES SECTION STARTS ======= -->
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
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 15px 0;
            font-family: 'Poppins', sans-serif;
        }

        .courses-notes-header p {
            font-size: 16px;
            color: #666;
            margin: 0;
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
                    <h2>📚 Explore Our Courses</h2>
                    <p>Comprehensive learning programs designed by legal experts</p>
                </div>

                <div class="courses-notes-grid" data-aos="fade-up">
                    @php
                        $courses = \App\Models\Course::limit(9)->get();
                    @endphp
                    @forelse($courses as $course)
                        <div class="course-note-card">
                            <div class="course-note-card-image">📖</div>
                            <div class="course-note-card-body">
                                <h3>{{ $course->title ?? 'Course Title' }}</h3>
                                <p>{{ Str::limit($course->description ?? 'Learn comprehensive legal knowledge', 80) }}</p>
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
                    <h2>📝 Free Study Notes</h2>
                    <p>Access valuable study materials and notes for your legal education</p>
                </div>

                <div class="courses-notes-grid" data-aos="fade-up">
                    @php
                        $notes = \App\Models\Copy::limit(9)->get();
                    @endphp
                    @forelse($notes as $note)
                        <div class="course-note-card">
                            <div class="course-note-card-image">📄</div>
                            <div class="course-note-card-body">
                                <h3>{{ $note->title ?? 'Study Note' }}</h3>
                                <p>{{ Str::limit($note->description ?? 'Important study material for legal learning', 80) }}</p>
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

        .acts-rules-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 15px 0;
            font-family: 'Poppins', sans-serif;
        }

        .acts-rules-header p {
            font-size: 16px;
            color: #666;
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
            background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
            padding: 30px;
            text-align: center;
            color: white;
        }

        .acts-rules-card-header h3 {
            font-size: 24px;
            font-weight: 700;
            margin: 0;
            font-family: 'Poppins', sans-serif;
        }

        .acts-rules-card-body {
            padding: 30px;
            max-height: 400px;
            overflow-y: auto;
        }

        .acts-rules-item {
            display: flex;
            align-items: flex-start;
            margin-bottom: 15px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }

        .acts-rules-item:last-child {
            border-bottom: none;
            margin-bottom: 0;
            padding-bottom: 0;
        }

        .acts-rules-item-icon {
            width: 24px;
            height: 24px;
            background-color: #ff5722;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            flex-shrink: 0;
            margin-right: 15px;
            font-size: 14px;
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
                <h2>Bare Acts & Rules</h2>
                <p>Access comprehensive legal documents and regulatory frameworks</p>
            </div>

            <div class="acts-rules-wrapper">
                <!-- Acts Card -->
                <div class="acts-rules-card" data-aos="fade-right" data-aos-duration="800">
                    <div class="acts-rules-card-header">
                        <h3>📜 Acts</h3>
                    </div>
                    <div class="acts-rules-card-body">
                        @php
                            $acts = \App\Models\Act::limit(6)->get();
                            $counter = 1;
                        @endphp
                        @forelse($acts as $act)
                            <div class="acts-rules-item">
                                <div class="acts-rules-item-icon">{{ $counter }}</div>
                                <div class="acts-rules-item-content">
                                    <a href="{{ route('frontend.acts') }}">{{ $act->title ?? 'Legal Act' }}</a>
                                    <p>{{ Str::limit($act->description ?? 'Important legal framework', 60) }}</p>
                                </div>
                            </div>
                            @php $counter++; @endphp
                        @empty
                            <div class="acts-rules-item">
                                <div class="acts-rules-item-content">
                                    <p style="color: #999; text-align: center;">Acts will be displayed here</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="acts-rules-card-footer">
                        <a href="{{ route('frontend.acts') }}" class="acts-rules-view-all">View All Acts →</a>
                    </div>
                </div>

                <!-- Rules Card -->
                <div class="acts-rules-card" data-aos="fade-left" data-aos-duration="800">
                    <div class="acts-rules-card-header">
                        <h3>⚖️ Rules</h3>
                    </div>
                    <div class="acts-rules-card-body">
                        @php
                            $rules = \App\Models\Rule::limit(6)->get();
                            $counter = 1;
                        @endphp
                        @forelse($rules as $rule)
                            <div class="acts-rules-item">
                                <div class="acts-rules-item-icon">{{ $counter }}</div>
                                <div class="acts-rules-item-content">
                                    <a href="{{ route('frontend.rules') }}">{{ $rule->title ?? 'Legal Rule' }}</a>
                                    <p>{{ Str::limit($rule->description ?? 'Important legal rule', 60) }}</p>
                                </div>
                            </div>
                            @php $counter++; @endphp
                        @empty
                            <div class="acts-rules-item">
                                <div class="acts-rules-item-content">
                                    <p style="color: #999; text-align: center;">Rules will be displayed here</p>
                                </div>
                            </div>
                        @endforelse
                    </div>
                    <div class="acts-rules-card-footer">
                        <a href="{{ route('frontend.rules') }}" class="acts-rules-view-all">View All Rules →</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== BARE ACTS & RULES SECTION ENDS ======= -->

    <!-- ===== LEGAL KNOWLEDGE (10 CATEGORIES) SECTION STARTS ======= -->
    <style>
        .legal-knowledge-categories-section {
            padding: 60px 20px;
            background: linear-gradient(135deg, #f8f9fa 0%, #fff 100%);
        }

        .legal-knowledge-categories-container {
            max-width: 1200px;
            margin: 0 auto;
        }

        .legal-knowledge-categories-header {
            text-align: center;
            margin-bottom: 50px;
        }

        .legal-knowledge-categories-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 15px 0;
            font-family: 'Poppins', sans-serif;
        }

        .legal-knowledge-categories-header p {
            font-size: 16px;
            color: #666;
            margin: 0;
        }

        .legal-knowledge-categories-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 30px;
        }

        .legal-knowledge-category-card {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            transition: all 0.3s ease;
            border-top: 4px solid #ff5722;
        }

        .legal-knowledge-category-card:hover {
            box-shadow: 0 4px 20px rgba(255, 87, 34, 0.15);
            transform: translateY(-8px);
        }

        .legal-knowledge-category-icon {
            width: 100%;
            height: 150px;
            background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 48px;
        }

        .legal-knowledge-category-body {
            padding: 25px;
        }

        .legal-knowledge-category-body h3 {
            font-size: 18px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 10px 0;
            line-height: 1.4;
        }

        .legal-knowledge-category-body p {
            font-size: 14px;
            color: #666;
            margin: 0 0 15px 0;
            line-height: 1.6;
            min-height: 40px;
        }

        .legal-knowledge-category-footer {
            padding: 0 25px 25px 25px;
        }

        .legal-knowledge-category-link {
            color: #ff5722;
            text-decoration: none;
            font-weight: 600;
            font-size: 14px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .legal-knowledge-category-link:hover {
            color: #e64a19;
            gap: 12px;
        }

        @media (max-width: 768px) {
            .legal-knowledge-categories-section {
                padding: 40px 15px;
            }

            .legal-knowledge-categories-header h2 {
                font-size: 24px;
            }

            .legal-knowledge-categories-header p {
                font-size: 14px;
            }

            .legal-knowledge-categories-grid {
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
                gap: 20px;
            }

            .legal-knowledge-category-icon {
                height: 130px;
                font-size: 40px;
            }

            .legal-knowledge-category-body {
                padding: 20px;
            }

            .legal-knowledge-category-footer {
                padding: 0 20px 20px 20px;
            }
        }

        @media (max-width: 480px) {
            .legal-knowledge-categories-section {
                padding: 30px 10px;
            }

            .legal-knowledge-categories-header h2 {
                font-size: 20px;
            }

            .legal-knowledge-categories-grid {
                grid-template-columns: 1fr;
                gap: 15px;
            }

            .legal-knowledge-category-icon {
                height: 120px;
                font-size: 36px;
            }

            .legal-knowledge-category-body {
                padding: 15px;
            }

            .legal-knowledge-category-body h3 {
                font-size: 16px;
            }

            .legal-knowledge-category-body p {
                font-size: 13px;
            }

            .legal-knowledge-category-footer {
                padding: 0 15px 15px 15px;
            }
        }
    </style>

    <div class="legal-knowledge-categories-section">
        <div class="legal-knowledge-categories-container">
            <div class="legal-knowledge-categories-header">
                <h2>📚 Legal Knowledge (10 Categories)</h2>
                <p>Explore essential areas of law and deepen your legal expertise</p>
            </div>

            <div class="legal-knowledge-categories-grid" data-aos="fade-up">
                <!-- Constitutional Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="600">
                    <div class="legal-knowledge-category-icon">⚖️</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Constitutional Law</h3>
                        <p>Understand the fundamental principles and structure of constitutional governance and rights.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Criminal Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="700">
                    <div class="legal-knowledge-category-icon">🚨</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Criminal Law</h3>
                        <p>Master criminal statutes, procedures, and principles governing criminal justice system.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Family Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="800">
                    <div class="legal-knowledge-category-icon">👨‍👩‍👧‍👦</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Family Law</h3>
                        <p>Explore matrimonial rights, child custody, inheritance, and family relations.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Corporate Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="900">
                    <div class="legal-knowledge-category-icon">🏢</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Corporate Law</h3>
                        <p>Learn company formation, governance, compliance, and corporate transactions.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Labor Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1000">
                    <div class="legal-knowledge-category-icon">👷</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Labor Law</h3>
                        <p>Understand employment rights, workplace safety, and labor regulations.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Tax Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1100">
                    <div class="legal-knowledge-category-icon">💰</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Tax Law</h3>
                        <p>Gain expertise in income tax, GST, and taxation principles and planning.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Environmental Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1200">
                    <div class="legal-knowledge-category-icon">🌿</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Environmental Law</h3>
                        <p>Explore environmental protection, pollution control, and conservation regulations.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Intellectual Property -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1300">
                    <div class="legal-knowledge-category-icon">💡</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Intellectual Property</h3>
                        <p>Master patents, copyrights, trademarks, and intellectual property protection.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- Administrative Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1400">
                    <div class="legal-knowledge-category-icon">🏛️</div>
                    <div class="legal-knowledge-category-body">
                        <h3>Administrative Law</h3>
                        <p>Understand government agencies, administrative procedures, and judicial review.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>

                <!-- International Law -->
                <div class="legal-knowledge-category-card" data-aos="fade-up" data-aos-duration="1500">
                    <div class="legal-knowledge-category-icon">🌍</div>
                    <div class="legal-knowledge-category-body">
                        <h3>International Law</h3>
                        <p>Learn treaties, international relations, and cross-border legal principles.</p>
                    </div>
                    <div class="legal-knowledge-category-footer">
                        <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-category-link">Learn More <span>→</span></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== LEGAL KNOWLEDGE (10 CATEGORIES) SECTION ENDS ======= -->

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

            <div class="exams-grid">
                <div class="exam-card" data-aos="fade-up">
                    <div class="exam-icon">📋</div>
                    <h3>UGC NET</h3>
                    <p>National Eligibility Test preparation for law teaching positions</p>
                </div>

                <div class="exam-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="exam-icon">⚖️</div>
                    <h3>Judicial Exam</h3>
                    <p>State and Central judicial service examination preparation</p>
                </div>

                <div class="exam-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="exam-icon">📚</div>
                    <h3>Bar Council Exam</h3>
                    <p>All India Bar Examination (AIBE) comprehensive guidance</p>
                </div>

                <div class="exam-card" data-aos="fade-up" data-aos-delay="300">
                    <div class="exam-icon">🏆</div>
                    <h3>CLAT Preparation</h3>
                    <p>Common Law Admission Test coaching and study material</p>
                </div>

                <div class="exam-card" data-aos="fade-up" data-aos-delay="400">
                    <div class="exam-icon">📖</div>
                    <h3>Law Entrance</h3>
                    <p>Various state and national law entrance exam preparation</p>
                </div>

                <div class="exam-card" data-aos="fade-up" data-aos-delay="500">
                    <div class="exam-icon">✍️</div>
                    <h3>Practice Tests</h3>
                    <p>Mock tests and sample papers for all legal examinations</p>
                </div>
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
    <!-- ===== WHY LAWSTUDENT SECTION ENDS ======= -->

    <!-- ===== WORKS STARTS ======= -->
    <div class="works7-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="work7-header text-center">
                        <span data-aos="fade-up" data-aos-duration="800">How It Works</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Learn Law Effectively with Our Expert
                            <span class="defence">Guidance</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Step 1 & 2 -->
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="space50"></div>
                            <div class="work-author-box" data-aos="fade-right" data-aos-duration="1000">
                                <div class="work-content">
                                    <a href="">Enroll & Get Orientation</a>
                                    <p>Sign up for your course and get an introduction to the curriculum and learning
                                        platform.</p>
                                </div>
                                <div class="works-icon">
                                    <img src="/img/icons/works-img1.svg" alt="Orientation Icon" />
                                </div>
                                <div class="point">
                                    <h2>01</h2>
                                </div>
                            </div>
                        </div>
                        <div class="space60"></div>
                        <div class="col-lg-12">
                            <div class="work-author-box" data-aos="fade-right" data-aos-duration="1200">
                                <div class="work-content">
                                    <a href="">Structured Learning Modules</a>
                                    <p>Follow step-by-step lessons covering all key areas of law with practical examples.
                                    </p>
                                </div>
                                <div class="works-icon icon2">
                                    <img src="/img/icons/work-img2.svg" alt="Modules Icon" />
                                </div>
                                <div class="point">
                                    <h2>02</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Center Image -->
                <div class="col-lg-6">
                    <div class="works-modify-area">
                        <div class="work-img">
                            <img src="/img/images/works-img1.png" alt="Learning Illustration" class="works-img1"
                                data-aos="zoom-out" data-aos-duration="1000" />
                            <img src="/img/elements/elementor35.png" alt=""
                                class="elementor35 aniamtion-key-5" />
                        </div>
                        <img src="/img/elements/elementor36.png" alt="" class="elementor36 d-none d-lg-block" />
                        <img src="/img/elements/elementor37.png" alt="" class="elementor37 d-none d-lg-block" />
                        <img src="/img/elements/elementor38.png" alt="" class="elementor38 d-none d-lg-block" />
                        <img src="/img/elements/elementor39.png" alt="" class="elementor39 d-none d-lg-block" />
                    </div>
                </div>

                <!-- Step 3 & 4 -->
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="space50"></div>
                            <div class="work-author-box box2" data-aos="fade-left" data-aos-duration="1000">
                                <div class="work-content">
                                    <a href="">Practice & Assess</a>
                                    <p>Apply your learning through quizzes, case studies, and exercises to reinforce
                                        understanding.</p>
                                </div>
                                <div class="works-icon icon3">
                                    <img src="/img/icons/works-img3.svg" alt="Practice Icon" />
                                </div>
                                <div class="point">
                                    <h2>03</h2>
                                </div>
                            </div>
                        </div>
                        <div class="space60"></div>
                        <div class="col-lg-12">
                            <div class="work-author-box box2" data-aos="fade-left" data-aos-duration="1200">
                                <div class="work-content">
                                    <a href="">Mentorship & Support</a>
                                    <p>Get expert guidance, feedback, and support to master legal concepts and boost your
                                        confidence.</p>
                                </div>
                                <div class="works-icon icon4">
                                    <img src="/img/icons/works-img4.svg" alt="Support Icon" />
                                </div>
                                <div class="point">
                                    <h2>04</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== WORKS ENDS ======= -->

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

            <div class="legal-articles">
                <div class="article-card" data-aos="fade-up">
                    <div class="article-image">⚖️</div>
                    <div class="article-body">
                        <div class="article-date">Latest Update</div>
                        <h3>Understanding Criminal Procedure Code</h3>
                        <p>A comprehensive guide to the Criminal Procedure Code and its provisions for criminal justice.</p>
                        <a href="{{ route('frontend.legal-knowledge') }}" class="article-link">Read More →</a>
                    </div>
                </div>

                <div class="article-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="article-image">📜</div>
                    <div class="article-body">
                        <div class="article-date">Recent News</div>
                        <h3>Corporate Law Updates</h3>
                        <p>Latest updates in corporate law including company regulations and compliance requirements.</p>
                        <a href="{{ route('frontend.legal-knowledge') }}" class="article-link">Read More →</a>
                    </div>
                </div>

                <div class="article-card" data-aos="fade-up" data-aos-delay="200">
                    <div class="article-image">👨‍⚖️</div>
                    <div class="article-body">
                        <div class="article-date">Expert Opinion</div>
                        <h3>Family Law Amendments</h3>
                        <p>Recent amendments in family law and their implications for matrimonial disputes and succession.</p>
                        <a href="{{ route('frontend.legal-knowledge') }}" class="article-link">Read More →</a>
                    </div>
                </div>
            </div>

            <div class="legal-knowledge-view-all">
                <a href="{{ route('frontend.legal-knowledge') }}" class="legal-knowledge-btn">View All Legal Knowledge</a>
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

        .gallery-header h2 {
            font-size: 32px;
            font-weight: 700;
            color: #1a1a1a;
            margin: 0 0 15px 0;
            font-family: 'Poppins', sans-serif;
        }

        .gallery-header p {
            font-size: 16px;
            color: #666;
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
    </style>

    <div class="gallery-section">
        <div class="gallery-container">
            <div class="gallery-header">
                <h2>🖼️ Gallery Preview</h2>
                <p>Glimpses of our campus, events, and learning environment</p>
            </div>

            <div class="gallery-grid">
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
            </div>

            <div class="gallery-view-all">
                <a href="{{ route('frontend.gallery') }}" class="gallery-btn">View Full Gallery</a>
            </div>
        </div>
    </div>
    <!-- ===== GALLERY PREVIEW SECTION ENDS ======= -->

    <!-- ===== SERVICES STARTS ======= -->
    <div class="service7-section-area sp3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 m-auto">
                    <div class="service7-header-area text-center">
                        <span data-aos="fade-up" data-aos-duration="800">Our Courses</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Learn Law With Confidence
                            <span class="defence">Expert Guidance</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <!-- Course 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img1.png" alt="Criminal Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img1.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Criminal Law</a>
                                    <div class="service7-content">
                                        <p>Master the fundamentals of criminal law with real-world case examples and
                                            practical guidance.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img2.png" alt="Family Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img2.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Family Law</a>
                                    <div class="service7-content">
                                        <p>Learn child custody, divorce, and support laws with step-by-step guidance from
                                            experts.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img3.png" alt="Civil Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img3.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Civil Law</a>
                                    <div class="service7-content">
                                        <p>Understand contracts, property law, and civil rights through engaging lessons and
                                            case studies.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1400">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img4.png" alt="Corporate Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img4.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Corporate Law</a>
                                    <div class="service7-content">
                                        <p>Gain expertise in company law, compliance, and business regulations through
                                            practical examples.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1600">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img5.png" alt="Environmental Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img5.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Environmental Law</a>
                                    <div class="service7-content">
                                        <p>Explore laws protecting the environment and sustainable practices with real-world
                                            case studies.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Course 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1800">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img6.png" alt="Intellectual Property Law Course" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img6.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Intellectual Property Law</a>
                                    <div class="service7-content">
                                        <p>Learn patents, copyrights, and trademarks from industry experts with hands-on
                                            exercises.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== SERVICES ENDS ======= -->

    <!-- ===== CASE STUDY STARTS ======= -->
    <div class="case-study7-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="case-study-header">
                        <span data-aos="fade-up" data-aos-duration="800">Student Success Stories</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Law Learning: Expert Courses Helping You
                            <span class="defence">Excel</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="casestudy-carousel-area owl-carousel">

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img1.png"
                                        alt="Criminal Law Course Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Criminal Law Mastery</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img2.png" alt="Family Law Course Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Family Law Excellence</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img3.png"
                                        alt="Corporate Law Course Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Corporate Law Achievers</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img1.png"
                                        alt="Intellectual Property Law Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Intellectual Property Mastery</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img2.png"
                                        alt="Environmental Law Course Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Environmental Law Achievements</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img3.png" alt="Civil Law Course Success" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Civil Law Success Stories</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== CASE STUDY ENDS ======= -->

    <!-- ===== TEAM STARTS ======= -->
    <div class="team7-section-area sp3">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="team6-header text-center">
                        <span data-aos="fade-up" data-aos-duration="800">Meet Our Expert Instructors</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Learn From the Best in
                            <span class="defence">Legal Education</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="800">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img1.png" alt="Instructor 1" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>

                        </div>
                        <div class="team-content text-center">
                            <a href="">Prof. Jofra Archer</a>
                            <p>Criminal Law Specialist</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img2.png" alt="Instructor 2" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>

                        </div>
                        <div class="team-content text-center">
                            <a href="">Dr. Mitchel Starc</a>
                            <p>Corporate & Business Law</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img1.png" alt="Instructor 3" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>

                        </div>
                        <div class="team-content text-center">
                            <a href="">MD. Saifuddin</a>
                            <p>Personal Injury Law Expert</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== TEAM ENDS ======= -->

    <!-- ===== TESTIMONIAL STARTS ======= -->
    <div class="testimonial7-section-area sp1">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="testimonial7-haeder text-center">
                        <span data-aos="fade-up" data-aos-duration="800">What Our Students Say</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            From Learners to Legal Experts, Trusted
                            <span class="defence">Feedback</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" data-aos="fade-down" data-aos-duration="1000">
                    <div class="testimonial7-main-area owl-carousel">
                        <!-- Testimonial 1 -->
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><span>(5) Rating</span></a></li>
                            </ul>
                            <p>"This law course transformed my understanding of criminal law. The instructors are clear,
                                practical, and engaging."</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img1.png" alt="Student 1" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Shakib Al Hasan</a>
                                    <p>@Criminal Law Student</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 2 -->
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><span>(5) Rating</span></a></li>
                            </ul>
                            <p>"I gained hands-on knowledge in corporate law that helped me start my own legal consultancy."
                            </p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img2.png" alt="Student 2" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Tanzid Tamim</a>
                                    <p>@Corporate Law Student</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 3 -->
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><span>(5) Rating</span></a></li>
                            </ul>
                            <p>"The personal injury law modules helped me land my first internship in a top law firm."</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img3.png" alt="Student 3" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Taskin Ahmed</a>
                                    <p>@Personal Injury Law Student</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 4 -->
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><span>(5) Rating</span></a></li>
                            </ul>
                            <p>"I highly recommend this course for anyone looking to strengthen their knowledge of workplace
                                law."</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img1.png" alt="Student 4" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Shakib Al Hasan</a>
                                    <p>@Workplace Law Student</p>
                                </div>
                            </div>
                        </div>

                        <!-- Testimonial 5 -->
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><i class="fa-solid fa-star"></i></a></li>
                                <li><a href="#"><span>(5) Rating</span></a></li>
                            </ul>
                            <p>"The instructors' real-life examples made learning law easy and applicable."</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img2.png" alt="Student 5" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Tanzid Tamim</a>
                                    <p>@General Law Student</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== TESTIMONIAL ENDS ======= -->
@endsection
