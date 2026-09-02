@extends('layouts.landing', ['title' => 'Legal Knowledge - Law Students'])

@section('content')
    <!-- ===== WELCOME STARTS======= -->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none" />
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Legal Knowledge</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Legal Knowledge</a>
                        <img src="/img/elements/elementor20.png" alt="" />
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
            background: linear-gradient(90deg, #ff5722 0%, #ff7a50 100%);
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
            color: #ff5722;
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
            border-color: #ff5722;
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
            background-color: #ff5722;
            color: white;
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
            background-color: #e64a19;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3);
        }

        .disclaimer-section {
            background-color: #f5f5f5;
            border-left: 4px solid #ff5722;
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
                        <label for="document">Upload Document <span style="color: #999;">(Optional)</span></label>
                        <input type="file" id="document" name="document" accept=".pdf,.doc,.docx,.txt">
                    </div>

                    <button type="submit" class="submit-btn">Submit Inquiry</button>
                </form>

                <div class="disclaimer-section">
                    <div class="disclaimer-title">⚠️ Important Disclaimer</div>
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
