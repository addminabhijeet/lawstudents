@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<!-- ===== MODERN MOBILE REDESIGN FOR CONTACT US PAGE ======= -->
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
        font-family: 'Poppins', sans-serif !important;
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
        width: 100% !important;
        margin-bottom: 12px !important;
    }

    button:hover, .btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    /* ===== MODERN CARD DESIGN ===== */
    .card, [class*="contact"], .info-box {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
        overflow: hidden !important;
        padding: 24px !important;
        transition: all 0.3s ease !important;
    }

    .card:hover, [class*="contact"]:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
        transform: translateY(-4px) !important;
    }

    /* ===== MODERN SPACING ===== */
    .container {
        padding: 20px !important;
    }

    .row {
        margin: -15px !important;
    }

    .row > * {
        padding: 15px !important;
    }

    /* ===== MODERN CONTACT INFO STYLING ===== */
    .contact-info-item {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 16px;
    }

    .contact-info-icon {
        width: 48px;
        height: 48px;
        background: #ff5722;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        flex-shrink: 0;
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

        .row {
            margin: -10px !important;
        }

        .row > * {
            padding: 10px !important;
        }

        .card, [class*="contact"] {
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

        .row {
            margin: -8px !important;
        }

        .row > * {
            padding: 8px !important;
        }

        input, textarea, select {
            font-size: 16px !important;
        }

        .card, [class*="contact"] {
            padding: 14px !important;
        }
    }

    /* ===== HEADING STYLES FOR CONTACT US PAGE (MODERN) ===== */
    /* Heading styles to match about page EXACTLY */
    h1 {
        font-size: 60px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 60px !important;
    }

    h2 {
        font-size: 46px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 1.3 !important;
    }

    h3 {
        font-size: 40px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    h4 {
        font-size: 32px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    /* Increase contact form container */
    .contact-submit-area {
        padding: 40px !important;
    }

    .contact-submit-area h3 {
        margin-bottom: 20px !important;
    }

    .contact-submit-area p {
        font-size: 16px !important;
        margin-bottom: 25px !important;
    }

    /* Increase contact input fields */
    .contact-inner input,
    .contact-inner textarea {
        padding: 16px 18px !important;
        font-size: 15px !important;
        min-height: 50px !important;
    }

    .contact-inner textarea {
        min-height: 160px !important;
    }

    /* Increase contact box size */
    .contact-box-area {
        padding: 30px !important;
        min-height: 180px !important;
    }

    .contact-widget-area {
        text-align: center;
    }

    .clock-img {
        margin-bottom: 15px !important;
    }

    .clock-img img {
        width: 50px !important;
        height: 50px !important;
    }

    .contact-widget-area .content h4 {
        font-size: 24px !important;
        margin-bottom: 12px !important;
    }

    .contact-widget-area .content a {
        font-size: 14px !important;
    }

    /* Increase contact content area */
    .contact-content-area {
        padding: 40px 30px !important;
    }

    .contact-content-area h2 {
        margin-bottom: 20px !important;
    }

    .contact-content-area p {
        font-size: 16px !important;
        line-height: 1.8 !important;
        margin-bottom: 18px !important;
    }

    .welcome-btn3 {
        font-size: 15px !important;
        padding: 14px 30px !important;
        margin-top: 15px !important;
    }

    /* Increase contact section spacing */
    .contact1-section-area {
        padding: 60px 20px !important;
    }

    .contact-auhtor-area .row {
        gap: 40px !important;
    }

    /* Protect form labels and buttons */
    label {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    button, input, textarea, select {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 48px !important;
        }

        h2 {
            font-size: 36px !important;
        }

        h3 {
            font-size: 32px !important;
        }

        h4 {
            font-size: 24px !important;
        }

        .contact-submit-area {
            padding: 30px !important;
        }

        .contact-submit-area p {
            font-size: 14px !important;
        }

        .contact-inner input,
        .contact-inner textarea {
            padding: 14px 16px !important;
            font-size: 14px !important;
        }

        .contact-box-area {
            padding: 25px !important;
            min-height: 160px !important;
        }

        .clock-img img {
            width: 45px !important;
            height: 45px !important;
        }

        .contact-widget-area .content h4 {
            font-size: 20px !important;
        }

        .contact-content-area {
            padding: 30px 20px !important;
            margin-top: 30px !important;
        }

        .contact-content-area p {
            font-size: 14px !important;
        }

        .contact1-section-area {
            padding: 50px 15px !important;
        }

        .contact-auhtor-area .row {
            gap: 30px !important;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 36px !important;
        }

        h2 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 24px !important;
        }

        h4 {
            font-size: 20px !important;
        }

        .contact-submit-area {
            padding: 20px !important;
        }

        .contact-submit-area h3 {
            font-size: 28px !important;
            margin-bottom: 15px !important;
        }

        .contact-submit-area p {
            font-size: 13px !important;
            margin-bottom: 20px !important;
        }

        .contact-inner input,
        .contact-inner textarea {
            padding: 12px 14px !important;
            font-size: 13px !important;
            min-height: 45px !important;
        }

        .contact-inner textarea {
            min-height: 140px !important;
        }

        .contact-box-area {
            padding: 20px !important;
            min-height: 140px !important;
            margin-bottom: 20px !important;
        }

        .clock-img img {
            width: 40px !important;
            height: 40px !important;
        }

        .contact-widget-area .content h4 {
            font-size: 18px !important;
            margin-bottom: 10px !important;
        }

        .contact-widget-area .content a {
            font-size: 13px !important;
        }

        .contact-content-area {
            padding: 20px 15px !important;
            margin-top: 25px !important;
        }

        .contact-content-area h2 {
            font-size: 28px !important;
            margin-bottom: 15px !important;
        }

        .contact-content-area p {
            font-size: 13px !important;
            line-height: 1.6 !important;
            margin-bottom: 15px !important;
        }

        .welcome-btn3 {
            font-size: 13px !important;
            padding: 12px 24px !important;
        }

        .contact1-section-area {
            padding: 40px 10px !important;
        }

        .contact-auhtor-area .row {
            gap: 20px !important;
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
                    <h1>Contact Us</h1>
                    <a href="{{ route('frontend.home') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Contact Us</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== CONTACT STARTS =======-->

@php
$user = \App\Models\User::first();
$address = !empty($user->webaddress) ? $user->webaddress : 'email@gmail.com';
$email = !empty($user->webemail) ? $user->webemail : 'email@gmail.com';
$mobile = !empty($user->mobile) ? $user->mobile : '9876543210';
$twitter = !empty($user->twitter) ? $user->twitter : '9876543210';
$pinterest = !empty($user->pinterest) ? $user->pinterest : '9876543210';
$instagram = !empty($user->instagram) ? $user->instagram : '9876543210';
$facebook = !empty($user->facebook) ? $user->facebook : '9876543210';
$linkedin = !empty($user->linkedin) ? $user->linkedin : '9876543210';
$description = !empty($user->description)
? $user->description
: 'Learn Law.
Understand Law.
Build Your Future.';
@endphp

<div class="contact1-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-auhtor-area contact2">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif
                            <div class="contact-submit-area">
                                <h3>Send Us Your Inquiry</h3>
                                <p>Our response time is within 30 minutes during business hours</p>
                                <form action="{{ route('frontend.contactstore') }}" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="phone" id="phone" placeholder="Phone Number"
                                                    pattern="[0-9]{10}" maxlength="10" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="email" name="email" id="email" placeholder="Email Address" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <input type="text" name="service_type" id="service_type" placeholder="Program of Interest" required>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <textarea name="message" id="message" placeholder="Message" cols="30" rows="10" required></textarea>
                                            </div>
                                        </div>

                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <button type="submit">
                                                    Send Inquiry
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
                                <h2>Connect with Our Expert Instructors and Mentors Today</h2>
                                <p>
                                    At Law Students, we understand the importance of personalized guidance in your
                                    legal education. Our team of experienced instructors and mentors is here to provide
                                    you with support and practical insights. Whether you're exploring Criminal Law,
                                    Corporate Law, Constitutional Law, or Traffic Law courses, our commitment is to help you succeed in your
                                    legal career.
                                </p>
                                <p>
                                    When learning law, having a dedicated and knowledgeable team by your side can make
                                    all the difference. At Law School Name, we prioritize your growth and provide
                                    exceptional mentorship tailored to your goals.
                                </p>
                                <a href="#" class="welcome-btn3">Meet Our Mentors <i
                                        class="fa-light fa-arrow-right"></i></a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-box-area">
                                <div class="contact-widget-area">
                                    <div class="clock-img">
                                        <img src="/img/icons/clock1.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4>Contact Us</h4>
                                        <a>{{ $address }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-box-area">
                                <div class="contact-widget-area">
                                    <div class="clock-img">
                                        <img src="/img/icons/phone2.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4>Call or text</h4>
                                        <a href="{{ $mobile }}">{{ $mobile }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-box-area">
                                <div class="contact-widget-area">
                                    <div class="clock-img">
                                        <img src="/img/icons/email2.svg" alt="">
                                    </div>
                                    <div class="content">
                                        <h4>Email us today</h4>
                                        <a href="{{ $email }}">{{ $email }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row" style="margin-top: 30px;">
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-box-area">
                                <div class="contact-widget-area">
                                    <div class="clock-img">
                                        <i class="fa-brands fa-whatsapp" style="font-size: 24px; color: #ff5722;"></i>
                                    </div>
                                    <div class="content">
                                        <h4>WhatsApp Us</h4>
                                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/', '', $mobile) }}" target="_blank" rel="noopener">{{ $mobile }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="contact-box-area">
                                <div class="contact-widget-area">
                                    <div class="clock-img">
                                        <i class="fa-solid fa-globe" style="font-size: 24px; color: #ff5722;"></i>
                                    </div>
                                    <div class="content">
                                        <h4>Website</h4>
                                        <a href="{{ url('/') }}">{{ request()->getHost() }}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="space60"></div>
            <div class="col-lg-12">
                <div class="map-section-area">
                    <div class="mapouter">
                        <div class="gmap_canvas">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4506257.120552435!2d88.67021924228865!3d21.954385721237916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1704088968016!5m2!1sen!2sbd"
                                width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== CONTACT ENDS =======-->
@endsection