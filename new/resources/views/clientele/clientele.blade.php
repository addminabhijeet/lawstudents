@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<!-- ===== MODERN MOBILE REDESIGN FOR CLIENTELE PAGE ======= -->
<style>
    /* ===== MODERN MOBILE-FIRST DESIGN ===== */
    * {
        box-sizing: border-box;
    }

    /* ===== MODERN FORM STYLES ===== */
    .form-control, input, textarea, select {
        border-radius: 8px !important;
        border: 1px solid #e0e0e0 !important;
        padding: 12px 14px !important;
        font-size: 14px !important;
        transition: all 0.3s ease !important;
        width: 100% !important;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #ff5722 !important;
        box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1) !important;
        outline: none !important;
    }

    /* ===== MODERN BUTTON STYLES ===== */
    button, .btn, a[class*="btn"] {
        border-radius: 8px !important;
        padding: 14px 28px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        min-height: 44px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }

    button:hover, .btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    /* ===== MODERN CARD DESIGN ===== */
    .card, [class*="contact"] {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
        overflow: hidden !important;
        transition: all 0.3s ease !important;
    }

    .card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
        transform: translateY(-4px) !important;
    }

    /* ===== MODERN SPACING ===== */
    .container {
        padding: 20px !important;
    }

    /* ===== RESPONSIVE GRID ===== */
    @media (max-width: 768px) {
        .col-lg-6 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .container {
            padding: 16px !important;
        }
    }

    @media (max-width: 576px) {
        .col-lg-6, .col-md-6 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .container {
            padding: 12px !important;
        }

        button, .btn {
            width: 100% !important;
            margin-bottom: 12px !important;
        }

        input, textarea, select {
            font-size: 16px !important;
        }
    }
</style>
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Client</h1>
                    <a href="{{ route('frontend.home') }}">Home <span><i class="fa-light fa-angle-right"></i></span>Client</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== BLOG STARTS =======-->
<div class="contact1-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-auhtor-area contact2">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="contact-submit-area">
                                <h3>Join Our Client Network</h3>
                                <p>We respond within 30 minutes during business hours to guide you better</p>
                                <form action="{{ route('frontend.contactstore') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="phone" id="phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="email" name="email" id="email" placeholder="Email Address" required>
                                            </div>
                                        </div>

                                        <!-- Interested Course / Service Type -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <input type="text" name="service_type" id="service_type" placeholder="Interested Course (Criminal / Corporate / Traffic Law)" required>
                                            </div>
                                        </div>

                                        <!-- Message / Queries -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <textarea name="message" id="message" placeholder="Tell us about your learning goals or queries" cols="30" rows="10" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <button type="submit">
                                                    Join Our Client
                                                    <i class="fa-light fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-content-area">
                                <h2>Our Esteemed Client & Learners</h2>
                                <p>
                                    At Law Students, we take pride in serving a diverse client including aspiring
                                    lawyers,
                                    law students, working professionals, and legal enthusiasts. Our courses are trusted
                                    by individuals
                                    who aim to build a strong foundation in legal studies and advance their careers in
                                    law.
                                </p>
                                <p>
                                    Our client includes students preparing for judiciary exams, professionals
                                    enhancing their legal
                                    expertise, and individuals seeking practical knowledge in criminal, corporate, and
                                    traffic law.
                                    We are committed to delivering high-quality education and real-world insights to
                                    every learner.
                                </p>

                                <!-- Grid Wrapper -->
                                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                                    @foreach ($clienteles as $clientele)
                                    @if (is_array(json_decode($clientele->pdfs)))
                                    @foreach (json_decode($clientele->pdfs) as $pdf)
                                    <a href="{{ asset('storage/app/public/' . $pdf) }}" class="welcome-btn3"
                                        target="_blank">
                                        {{ $clientele->description }}<i class="fa-light fa-arrow-right"></i>
                                    </a>
                                    @endforeach
                                    @else
                                    <a href="{{ asset('storage/app/public/' . $clientele->pdfs) }}"
                                        class="welcome-btn3" target="_blank">
                                        {{ $clientele->description }}<i class="fa-light fa-arrow-right"></i>
                                    </a>
                                    @endif
                                    @endforeach
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection