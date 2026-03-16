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
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                width: 100%;
                min-height: 600px;">
            </div>
        @endif

        @if ($banner && $banner->image_2)
            <div class="welcome7-section-area"
                style="background-image: url('{{ asset('storage/app/public/' . $banner->image_2) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                width: 100%;
                min-height: 600px;">
            </div>
        @endif

        @if ($banner && $banner->image_3)
            <div class="welcome7-section-area"
                style="background-image: url('{{ asset('storage/app/public/' . $banner->image_3) }}');
                background-position: center;
                background-repeat: no-repeat;
                background-size: contain;
                width: 100%;
                min-height: 600px;">
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
                            Trusted Criminal Defense <span class="defence">Lawyers</span>
                            Ready to Fight
                        </h2>
                        <p data-aos="fade-left" data-aos-duration="900">
                            Our experienced divorce lawyers are not just legal professionals; <br /> they are your
                            advocates, your confidants, and your partners Law
                        </p>
                        <h3 data-aos="fade-left" data-aos-duration="1000">Our Best Service Benefits :</h3>
                        <div class="list-about" data-aos="fade-left" data-aos-duration="1100">
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Legal
                                        Expertise</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Reduced
                                        Stress</a>
                                </li>
                            </ul>

                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Paperwork &
                                        Documentation</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img7.svg" alt="" />Child Custody
                                        And Support</a>
                                </li>
                            </ul>
                        </div>
                        <div class="div" data-aos="fade-left" data-aos-duration="1200">
                            <a href="" class="welcome6-btn">Legal Support Needed<i
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
                        <span data-aos="fade-up" data-aos-duration="800">Practice Areas</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Every Case: Our Law Firm Delivers
                            <span class="defence">Results</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img1.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img1.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Auto Accidents</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img2.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img2.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Workplace Injuries</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img3.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img3.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Medical Malpractice</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1400">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img4.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img4.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Slip and Fall Accidents</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1600">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img5.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img5.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Product Liability</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
                                        <a href="">Read More <i class="fa-regular fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1800">
                    <div class="service7-box-area">
                        <div class="service7-boxarea">
                            <div class="service-images">
                                <img src="/img/images/service7-img6.png" alt="" />
                            </div>
                            <div class="service7-author-area">
                                <div class="service-icons">
                                    <img src="/img/icons/service7-img6.svg" alt="" />
                                </div>
                                <div class="service-7-content">
                                    <a href="">Wrongful Death</a>
                                    <div class="service7-content">
                                        <p>Focused Legal Expertise: Our team lawyer specializes in criminal defense best
                                            team.</p>
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
                            Experience Criminal Defense Attorneys Ready to
                            <span class="defence">Fight</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="space50"></div>
                            <div class="work-author-box" data-aos="fade-right" data-aos-duration="1000">
                                <div class="work-content">
                                    <a href="">Consultation & Assessment</a>
                                    <p>Schedule a consultation where we are law discuss your case detail.</p>
                                </div>
                                <div class="works-icon">
                                    <img src="/img/icons/works-img1.svg" alt="" />
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
                                    <a href="">Tailored Legal Strategies</a>
                                    <p>Our firm provides aggressive is representation in court coupled</p>
                                </div>
                                <div class="works-icon icon2">
                                    <img src="/img/icons/work-img2.svg" alt="" />
                                </div>
                                <div class="point">
                                    <h2>02</h2>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="works-modify-area">
                        <div class="work-img">
                            <img src="/img/images/works-img1.png" alt="" class="works-img1" data-aos="zoom-out"
                                data-aos-duration="1000" />
                            <img src="/img/elements/elementor35.png" alt=""
                                class="elementor35 aniamtion-key-5" />
                        </div>
                        <img src="/img/elements/elementor36.png" alt="" class="elementor36 d-none d-lg-block" />
                        <img src="/img/elements/elementor37.png" alt="" class="elementor37 d-none d-lg-block" />
                        <img src="/img/elements/elementor38.png" alt="" class="elementor38 d-none d-lg-block" />
                        <img src="/img/elements/elementor39.png" alt="" class="elementor39 d-none d-lg-block" />
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="space50"></div>
                            <div class="work-author-box box2" data-aos="fade-left" data-aos-duration="1000">
                                <div class="work-content">
                                    <a href="">Implementation Execution</a>
                                    <p>Expect clear and open lawyer communication at every step.</p>
                                </div>
                                <div class="works-icon icon3">
                                    <img src="/img/icons/works-img3.svg" alt="" />
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
                                    <a href="">Our Legal Support</a>
                                    <p>Your satisfaction and peace of a lawyer mind matter most to us.</p>
                                </div>
                                <div class="works-icon icon4">
                                    <img src="/img/icons/works-img4.svg" alt="" />
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
                        <span data-aos="fade-up" data-aos-duration="800">Our Case Studies</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Defense: Seasoned Lawyers Fighting for Your
                            <span class="defence">Freedom</span>
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
                                    <img src="/img/images/casestudy-carousel-img1.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Precision Legal Counsel</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img2.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Vanguard Legal Advocates</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img3.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Paramount Legal Services</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img1.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Elite Counsel Solutions</a>
                                </div>
                            </div>
                        </div>
                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img1.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Precision Legal Counsel</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img2.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Vanguard Legal Advocates</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img3.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Paramount Legal Services</a>
                                </div>
                            </div>
                        </div>

                        <div class="case7-study-area">
                            <div class="case-study7-boxarea">
                                <div class="case-study-casousel-img">
                                    <img src="/img/images/casestudy-carousel-img1.png" alt="" />
                                </div>
                                <div class="polygon-author"
                                    style="background-image: url(/img/elements/elementor33.svg); background-position: center; background-repeat: no-repeat; background-size: cover; display: inline-block;">
                                    <div class="polygon-arrow">
                                        <span><a href=""><i class="fa-regular fa-arrow-right"></i></a></span>
                                        <a href="">Read More</a>
                                    </div>
                                </div>
                                <div class="case-study-carousel-content text-center">
                                    <a href="">Elite Counsel Solutions</a>
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
                        <span data-aos="fade-up" data-aos-duration="800">Our Experienced Team</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Defend Your Rights Our Dedicated Legal
                            <span class="defence">Team</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="800">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img1.png" alt="" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>
                            <div class="social-links">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <a href="">Jofra Archer</a>
                            <p>Founder Partner</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img2.png" alt="" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>
                            <div class="social-links">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <a href="">Mitchel Starc</a>
                            <p>Senior Attorneys</p>
                        </div>
                    </div>
                </div>

                <div class="col-lg-4 col-md-6" data-aos="zoom-in" data-aos-duration="1200">
                    <div class="team6-main-boxarea">
                        <div class="team6-boxarea">
                            <div class="team6-img">
                                <img src="/img/images/team6-img1.png" alt="" />
                            </div>
                            <div class="team6-images">
                                <img src="/img/bacground/polygon3.png" alt="" class="polygon3" />
                                <img src="/img/bacground/polygon4.png" alt="" class="polygon4" />
                            </div>
                            <div class="social-links">
                                <ul>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-linkedin-in"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-instagram"></i></a>
                                    </li>
                                    <li>
                                        <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="team-content text-center">
                            <a href="">MD. Saifuddin</a>
                            <p>Personal Injury Law</p>
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
                        <span data-aos="fade-up" data-aos-duration="800">Our Testimonials</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            From Client to Advocates, Dedicated Legal
                            <span class="defence">Trust</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12" data-aos="fade-down" data-aos-duration="1000">
                    <div class="testimonial7-main-area owl-carousel">
                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img1.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Shakib Al Hasan</a>
                                    <p>@personal injury law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img2.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Tanzid Tamim</a>
                                    <p>@business law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img3.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Taskin Ahmed</a>
                                    <p>@workplace injury</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img1.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Shakib Al Hasan</a>
                                    <p>@personal injury law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img2.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Tanzid Tamim</a>
                                    <p>@business law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img3.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Taskin Ahmed</a>
                                    <p>@workplace injury</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img1.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Shakib Al Hasan</a>
                                    <p>@personal injury law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img2.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Tanzid Tamim</a>
                                    <p>@business law</p>
                                </div>
                            </div>
                        </div>

                        <div class="testimonial7-area">
                            <div class="quito7-img">
                                <img src="/img/icons/quito10.svg" alt="" />
                            </div>
                            <ul>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><i class="fa-solid fa-star"></i></a>
                                </li>
                                <li>
                                    <a href="#"><span>(5) Rating</span></a>
                                </li>
                            </ul>
                            <p>"I was lost in a legal maze until I found Law Firm Name. Their dedication and expertise guide
                                me through a hard case challenging case, their team's support.</p>
                            <div class="mans-img-area">
                                <div class="img">
                                    <img src="/img/images/testimonial7-img3.png" alt="" />
                                </div>
                                <div class="img-content">
                                    <a href="#">Taskin Ahmed</a>
                                    <p>@workplace injury</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== TESTIMONIAL ENDS ======= -->

    <!-- ===== CONTACT STARTS ======= -->
    <div class="contact7-section-area sp1"
        style="background-image: url(/img/images/contact-bg1.png); background-position: center; background-repeat: no-repeat; background-size: cover; position: relative;">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto">
                    <div class="contact7-header text-center">
                        <span data-aos="fade-up" data-aos-duration="800">Contact Us</span>
                        <h2 data-aos="fade-up" data-aos-duration="1000">
                            Connect Our Legal
                            <span class="defence">Experts</span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="contact-submit-area">
                        <h3 data-aos="fade-up" data-aos-duration="800">Send us a Message</h3>
                        <p data-aos="fade-up" data-aos-duration="1000">As a fellow small business owner, we know the
                            fulfillment that an a best to comes from running & own business contact our service to Finance.
                        </p>
                        <div class="row" data-aos="fade-up" data-aos-duration="1000">
                            <div class="col-lg-6">
                                <div class="contact-info">
                                    <input type="text" placeholder="Full Name*" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-info">
                                    <input type="text" placeholder="Email*" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-info">
                                    <input type="text" placeholder="Phone*" />
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-info">
                                    <textarea placeholder="Message*" cols="30" rows="10"></textarea>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="contact-info subject">
                                    <input type="text" placeholder="Subject*" />
                                </div>
                            </div>
                            <div class="col-lg-12" data-aos="fade-up" data-aos-duration="1200">
                                <div class="contact-info">
                                    <button type="submit">Free Case Evolution <i
                                            class="fa-regular fa-arrow-right"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-main-boxarea">
                        <div class="div" data-aos="fade-up" data-aos-duration="800">
                            <div class="contact-box-area">
                                <div class="contact-icon">
                                    <img src="/img/icons/clock1.svg" alt="" />
                                </div>
                                <div class="contact-content">
                                    <h4>Contact us</h4>
                                    <a href="#">8708 Technology Forest Pl Suite 125 -G, The <br /> Woodlands, TX
                                        77381</a>
                                </div>
                            </div>
                        </div>
                        <div class="space20"></div>
                        <div class="div" data-aos="fade-up" data-aos-duration="1000">
                            <div class="contact-box-area">
                                <div class="contact-icon">
                                    <img src="/img/icons/phone2.svg" alt="" />
                                </div>
                                <div class="contact-content">
                                    <h4>Call or text</h4>
                                    <a href="tel:123-456-7890">123-456-7890</a>
                                </div>
                            </div>
                        </div>
                        <div class="space20"></div>
                        <div class="div" data-aos="fade-up" data-aos-duration="1200">
                            <div class="contact-box-area">
                                <div class="contact-icon">
                                    <img src="/img/icons/email2.svg" alt="" />
                                </div>
                                <div class="contact-content">
                                    <h4>Email us today</h4>
                                    <a href="mailto:info@taxvice.com">info@taxvice.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== CONTACT ENDS ======= -->

    <!-- ===== CTA STARTS ======= -->
    <div class="cta7-section-area">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="cta2-section-hedaer sp5" data-aos="zoom-out" data-aos-duration="1000">
                        <div class="row align-items-center">
                            <div class="col-lg-6">
                                <div class="cta2-header">
                                    <h2 data-aos="fade-up" data-aos-duration="600">Schedule A Free <span
                                            class="defence">Consultation</span></h2>
                                    <p data-aos="fade-up" data-aos-duration="800">
                                        At your firm name, Our experienced tax attorneys are here to help you <br />
                                        navigate the complexities of tax law, save you money, & ensure.
                                    </p>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="cta-contact-area">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <div class="cta-input">
                                                <input type="text" placeholder="First Name" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="cta-input">
                                                <input type="email" placeholder="Email Adderss" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="cta-input">
                                                <input type="text" placeholder="Service Type" />
                                            </div>
                                        </div>
                                        <div class="col-lg-6">
                                            <div class="cta-input">
                                                <button type="submit" class="cta-btn2">Schedule A Consultation<i
                                                        class="fa-regular fa-arrow-right"></i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ===== CTA ENDS ======= -->
@endsection
