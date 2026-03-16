@extends('layouts.landing', ['title' => 'Law Students || Criminal Law || Our Team'])

@section('content')
    <!-- ===== WELCOME STARTS ======= -->
    @php
        $banner = $banner instanceof \Illuminate\Support\Collection ? $banner->first() : $banner;
    @endphp

    <div class="slider-carousel-area owl-carousel car">

        @if ($banner && $banner->image_1)
            <div class="welcome7-section-area"
                style="background-image: url('{{ asset('storage/app/public/' . $banner->image_1) }}');
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            min-height:600px;">
            </div>
        @endif

        @if ($banner && $banner->image_2)
            <div class="welcome7-section-area"
                style="background-image: url('{{ asset('storage/app/public/' . $banner->image_2) }}');
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            min-height:600px;">
            </div>
        @endif

        @if ($banner && $banner->image_3)
            <div class="welcome7-section-area"
                style="background-image: url('{{ asset('storage/app/public/' . $banner->image_3) }}');
            background-position:center;
            background-repeat:no-repeat;
            background-size:cover;
            min-height:600px;">
            </div>
        @endif

    </div>

    <script>
        $('.car').owlCarousel({
            loop: true,
            margin: 0,
            nav: false,
            autoplay: true,
            autoplayTimeout: 4000,
            items: 1
        });
    </script>
    <!-- ===== WELCOME ENDS ======= -->

    <!-- ===== ABOUT STARTS ======= -->
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
    <!-- ===== ABOUT ENDS ======= -->

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
