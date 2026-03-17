@extends('layouts.landing', ['title' => 'Law Students || Criminal Law || Free Notes'])

@section('content')
    <!--===== WELCOME STARTS =======-->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Clientele</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Clientele</a>
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
                                    <h3>Send Us A Message</h3>
                                    <p>Our response time is within 30 minutes during business hours</p>
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" placeholder="Last Name">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="number" placeholder="Phone NUmber">
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="email" placeholder="Email Address">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <input type="text" placeholder="Service Type">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <textarea placeholder="Message" cols="30" rows="10"></textarea>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <button type="submit">Free Case Evulation <i
                                                        class="fa-light fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-content-area">
                                    <h2>Connect with Our Law Experts and Mentors Today</h2>
                                    <p>
                                        At Law School Name, we understand the importance of personalized guidance in your
                                        legal education. Our team of experienced instructors and mentors is here to provide
                                        you with support and practical insights. Whether you're exploring criminal law,
                                        corporate law, or traffic law courses, our commitment is to help you succeed in your
                                        legal career.
                                    </p>
                                    <p>
                                        When learning law, having a dedicated and knowledgeable team by your side can make
                                        all the difference. At Law School Name, we prioritize your growth and provide
                                        exceptional mentorship tailored to your goals.
                                    </p>

                                    <!-- Grid Wrapper -->
                                    <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">

                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>
                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>
                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>
                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>
                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>
                                        <a href="#" class="welcome-btn3">View Pdf<i
                                                class="fa-light fa-arrow-right"></i></a>

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
