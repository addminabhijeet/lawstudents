@extends('layouts.landing', ['title' => 'Legal Knowledge - Law Students'])

@section('content')
    <!-- ===== MODERN MOBILE REDESIGN FOR LEGAL KNOWLEDGE PAGE ======= -->
    <style>
        /* ===== MODERN MOBILE-FIRST DESIGN ===== */
        * {
            box-sizing: border-box;
        }

        /* ===== SECTION TITLE DESIGN ===== */
        h1, h2, .page-title, [class*="title"] {
            color: #d4af37 !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
            font-weight: 700 !important;
        }

        /* ===== MODERN CARD DESIGN ===== */
        .card, [class*="box"], .knowledge-card {
            background: linear-gradient(135deg, #1a1a1a 0%, #2a2a2a 100%) !important;
            border: 2px solid #d4af37 !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15) !important;
            overflow: hidden !important;
            transition: all 0.3s ease !important;
        }

        .card:hover {
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.25) !important;
            transform: translateY(-8px) !important;
            border-color: #e6c547 !important;
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

        /* ===== MODERN FORM STYLES ===== */
        input, textarea, select {
            border-radius: 8px !important;
            border: 1px solid #e0e0e0 !important;
            padding: 12px 14px !important;
            font-size: 14px !important;
            transition: all 0.3s ease;
            width: 100% !important;
        }

        input:focus, textarea:focus, select:focus {
            border-color: #d4af37 !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1) !important;
            outline: none !important;
        }

        /* ===== RESPONSIVE CONTAINER ===== */
        .container {
            padding: 20px !important;
        }

        @media (max-width: 768px) {
            .col-lg-4, .col-lg-6 {
                flex: 0 0 50% !important;
                max-width: 50% !important;
            }

            .container {
                padding: 16px !important;
            }
        }

        @media (max-width: 576px) {
            .col-lg-4, .col-lg-6, .col-md-6 {
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

        /* ===== HEADING STYLES FOR LEGAL KNOWLEDGE PAGE (MODERN) ===== */
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

        /* Override legal-inquiry-heading class */
        .legal-inquiry-heading {
            font-size: 46px !important;
            font-family: 'Playfair Display', serif !important;
            font-weight: 500 !important;
            line-height: 1.3 !important;
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

            .legal-inquiry-heading {
                font-size: 36px !important;
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

            .legal-inquiry-heading {
                font-size: 28px !important;
            }
        }
    </style>
    <!-- ===== WELCOME STARTS======= -->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Legal Knowledge</h1>
                        <a href="{{ route('frontend.home') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Legal Knowledge</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== WELCOME ENDS======= -->

    <!-- ===== LEGAL KNOWLEDGE INQUIRY SECTION STARTS ======= -->
    <style>
        .legal-inquiry-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f3f7 100%);
            padding: 80px 20px;
        }

        .legal-inquiry-container {
            max-width: 900px;
            margin: 0 auto;
        }

        .legal-inquiry-content {
            background: white;
            padding: 50px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .legal-inquiry-heading {
            font-size: 36px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }

        .legal-inquiry-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #d4af37 0%, #e6c547 100%);
            border-radius: 2px;
        }

        .inquiry-form {
            margin-top: 40px;
        }

        .form-group {
            margin-bottom: 25px;
        }

        .form-group label {
            display: block;
            font-size: 15px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .form-group label .required {
            color: #d4af37;
            margin-left: 3px;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 12px 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 14px;
            font-family: inherit;
            color: #333;
            background-color: #fafbfc;
            transition: all 0.3s ease;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #d4af37;
            background-color: white;
            box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 150px;
        }

        .form-row {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .submit-btn {
            background-color: #d4af37;
            color: #0f0f0f;
            padding: 14px 36px;
            border: none;
            border-radius: 5px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            max-width: 250px;
            display: block;
            margin: 35px auto 0;
        }

        .submit-btn:hover {
            background-color: #e6c547;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(212, 175, 55, 0.3);
        }

        .disclaimer-section {
            background-color: #f5f5f5;
            border-left: 4px solid #d4af37;
            padding: 20px;
            border-radius: 4px;
            margin-top: 40px;
        }

        .disclaimer-title {
            font-size: 16px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 12px;
        }

        .disclaimer-text {
            font-size: 13px;
            line-height: 1.8;
            color: #666;
        }

        @media (max-width: 768px) {
            .legal-inquiry-section {
                padding: 60px 15px;
            }

            .legal-inquiry-content {
                padding: 35px 25px;
            }

            .legal-inquiry-heading {
                font-size: 28px;
                margin-bottom: 25px;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 20px;
            }

            .submit-btn {
                max-width: 100%;
            }
        }
    </style>

    <div class="legal-inquiry-section">
        <div class="legal-inquiry-container">
            <div class="legal-inquiry-content">
                <h2 class="legal-inquiry-heading">Legal Knowledge Inquiry</h2>

                <form class="inquiry-form" method="POST" enctype="multipart/form-data" action="{{ route('frontend.legal-knowledge-store') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group">
                            <label for="name">Name <span class="required">*</span></label>
                            <input type="text" id="name" name="name" required placeholder="Your Full Name">
                        </div>
                        <div class="form-group">
                            <label for="email">Email <span class="required">*</span></label>
                            <input type="email" id="email" name="email" required placeholder="your.email@example.com">
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="mobile">Mobile Number <span class="required">*</span></label>
                            <input type="tel" id="mobile" name="mobile" required placeholder="Your Mobile Number">
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject / Area of Law <span class="required">*</span></label>
                            <select id="subject" name="subject" required>
                                <option value="">Select Category</option>
                                <option value="Cheque Bounce">Cheque Bounce</option>
                                <option value="Civil Law">Civil Law</option>
                                <option value="Criminal Law">Criminal Law</option>
                                <option value="Company Law">Company Law</option>
                                <option value="Hindu Law">Hindu Law</option>
                                <option value="Muslim Law">Muslim Law</option>
                                <option value="Labour Law">Labour Law</option>
                                <option value="Cyber Crime">Cyber Crime</option>
                                <option value="Cyber Security">Cyber Security</option>
                                <option value="Legal Compliance">Legal Compliance</option>
                                <option value="Other Laws">Other Laws</option>
                            </select>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="question">Your Question <span class="required">*</span></label>
                        <textarea id="question" name="question" required placeholder="Please describe your legal inquiry in detail..."></textarea>
                    </div>

                    <div class="form-group">
                        <label for="document">Upload Document <span style="color: #767676;">(Optional)</span></label>
                        <input type="file" id="document" name="document" accept=".pdf,.doc,.docx,.txt">
                    </div>

                    <button type="submit" class="submit-btn">Submit Inquiry</button>
                </form>

                <div class="disclaimer-section">
                    <div class="disclaimer-title"><i class="fa-solid fa-triangle-exclamation"></i> Important Disclaimer</div>
                    <div class="disclaimer-text">
                        This inquiry facility is intended for preliminary communication and legal/educational
                        information. Submission of an inquiry does not by itself create an advocate-client relationship.
                        Formal legal advice, representation or engagement shall be subject to separate communication and
                        acceptance.
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== LEGAL KNOWLEDGE INQUIRY SECTION ENDS ======= -->

@endsection
