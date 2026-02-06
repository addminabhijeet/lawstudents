@extends('layouts.base', ['title' => 'Lawsy || Tax Law || 02', 'logo4' => true])

@section('content')
  @include('layouts.partials.loader', ['loader' => 'preloader4'])

  @include('layouts.partials.header.navbar3')

  <!-- ===== WELCOME STARTS ======= -->
  <div class="welcome2-section-area">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-6">
      <div class="welcome-header2-text">
        <span data-aos="fade-up" data-aos-duration="600">We provide the experience you need</span>
        <h1 data-aos="fade-up" data-aos-duration="800">Trusted Tax <span>Attorneys <img src="/img/elements/quito2.png" alt="" /></span> Solve Your Tax Issues</h1>
        <p data-aos="fade-up" data-aos-duration="900">
        With a track record of successfully resolving a tax-related issues, we're <br /> committed to protecting your financial interests and helping achieve
        </p>
        <div data-aos="fade-up" data-aos-duration="1200">
        <a href="{{ route('second', ['contact', 'v1']) }}" class="welconme-btn2">Download Tax Guides <span><i class="fa-regular fa-angle-right"></i></span></a>
        </div>
      </div>
      </div>
      <div class="col-lg-6">
      <div class="welcome-header2-images">
        <div class="row">
        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-duration="500" data-aos-easing="linear">
          <div class="space70"></div>
          <div class="header-img3">
          <img src="/img/images/header-img4.png" alt="" />
          <div class="elementors15">
            <img src="/img/elements/elementor15.png" alt="" class="aniamtion-key-1" />
          </div>
          <div class="elementors16">
            <img src="/img/elements/elementor16.png" alt="" class="aniamtion-key-1" />
          </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-duration="600" data-aos-easing="linear">
          <div class="header-img4">
          <img src="/img/images/header-img3.png" alt="" />
          </div>
        </div>
        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-duration="700" data-aos-easing="linear">
          <div class="header-img5">
          <img src="/img/images/header-img5.png" alt="" />
          <div class="elementors17">
            <img src="/img/elements/elementor17.png" alt="" class="aniamtion-key-1" />
          </div>
          <div class="elementors18">
            <img src="/img/images/tax-text2.png" alt="" class="aniamtion-key-1" />
          </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6" data-aos="zoom-out" data-aos-duration="800" data-aos-easing="linear">
          <div class="header-img6">
          <img src="/img/images/header-img6.png" alt="" />
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== WELCOME ENDS ======= -->

  <!-- ===== ABOUT STARTS ======= -->
  <div class="about-section-area sp1">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-5" data-aos="flip-left" data-aos-duration="500" data-aos-easing="linear">
      <div class="about2-images">
        <img src="/img/images/about-img2.png" alt="" />
      </div>
      </div>
      <div class="col-lg-2">
      <div class="" data-aos="zoom-in" data-aos-duration="800">
        <div class="about-side-boxarea text-center">
        <div class="side-icon">
          <img src="/img/icons/calculator1.svg" alt="" />
        </div>
        <div class="about-side-text">
          <h3><span class="counter">98</span>%</h3>
          <p>Successful Client</p>
        </div>
        </div>
      </div>
      <div class="space20"></div>
      <div class="" data-aos="zoom-in" data-aos-duration="1000">
        <div class="about-side-boxarea text-center">
        <div class="side-icon">
          <img src="/img/icons/tax-img2.svg" alt="" />
        </div>
        <div class="about-side-text">
          <h3><span class="counter">1</span>M+</h3>
          <p>Tax Return Filled</p>
        </div>
        </div>
      </div>
      <div class="space20"></div>

      <div class="" data-aos="zoom-in" data-aos-duration="1200">
        <div class="about-side-boxarea text-center">
        <div class="side-icon">
          <img src="/img/icons/money-img1.svg" alt="" />
        </div>
        <div class="about-side-text">
          <h3>$<span class="counter">50</span>M</h3>
          <p>Trade Value Filled</p>
        </div>
        </div>
      </div>
      </div>
      <div class="col-lg-5">
      <div class="about2-textarea">
        <span data-aos="fade-left" data-aos-duration="600">About Us</span>
        <h2 class="text-capitalize" data-aos="fade-left" data-aos-duration="800">Protect Your and <img src="/img/elements/quito2.png" alt="" /> Minimize Tax Liability</h2>
        <p data-aos="fade-left" data-aos-duration="900">Whether you're facing a tax audit, need assistance with tax compliance, or are looking for ways to maximize tax benefits.</p>
        <p data-aos="fade-left" data-aos-duration="1000">Explore our website to learn more about our services and get to know our team of tax attorneys. When you're ready Lawyer.</p>
        <div class="about-list" data-aos="fade-left" data-aos-duration="1100">
        <ul>
          <li>
          <img src="/img/icons/check-img1.svg" alt="" />Range Of Services
          </li>
          <li>
          <img src="/img/icons/check-img1.svg" alt="" />Online Recourses
          </li>
        </ul>
        <ul>
          <li>
          <img src="/img/icons/check-img1.svg" alt="" />Professional Expertise
          </li>
          <li>
          <img src="/img/icons/check-img1.svg" alt="" />Client Success Stories
          </li>
        </ul>
        </div>
        <div class="div" data-aos="fade-left" data-aos-duration="1200">
        <a href="{{ route('second', ['pages', 'about']) }}" class="welconme-btn2">About Us <span><i class="fa-regular fa-angle-right"></i></span></a>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== ABOUT ENDS ======= -->

  <!-- ===== SERVICES STARTS ======= -->
  <div class="service2-section-area sp3">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4">
      <div class="service2-header-text">
        <span data-aos="fade-up" data-aos-duration="600">Our Services</span>
        <h2 data-aos="fade-up" data-aos-duration="800">Tax Resolution <img src="/img/elements/quito2.png" alt="" /> <br /> Starts Here</h2>
        <p data-aos="fade-up" data-aos-duration="1000">Explore our website to learn more about our services and get to know our team of tax attorneys. When you're ready Lawyer.</p>
        <div class="div" data-aos="fade-up" data-aos-duration="1200">
        <a href="{{ route('second', ['service', 'service1']) }}" class="welconme-btn2">View Our Services <span><i class="fa-regular fa-angle-right"></i></span></a>
        </div>
      </div>
      </div>
      <div class="col-lg-8">
      <div class="service2-boxarea">
        <div class="row">
        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="500" data-aos-easing="linear">
          <div class="service2-author-box">
          <div class="tax-icon-img">
            <img src="/img/icons/tax-img3.svg" alt="" />
          </div>
          <div class="tax-content">
            <a href="{{ route('second', ['service', 'single']) }}">Estate Planning & Taxation</a>
            <p>
            From understanding the latest tax code <br /> change to exploring tax planning strategies.
            </p>
          </div>
          <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Learn More<i class="fa-regular fa-arrow-right"></i></a>
          <div class="arrow-service">
            <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt="" /></a></span>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="600" data-aos-easing="linear">
          <div class="service2-author-box">
          <div class="tax-icon-img">
            <img src="/img/icons/tax-img4.svg" alt="" />
          </div>
          <div class="tax-content">
            <a href="{{ route('second', ['service', 'single']) }}">Estate Planning & Taxation</a>
            <p>
            From understanding the latest tax code <br /> change to exploring tax planning strategies.
            </p>
          </div>
          <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Learn More<i class="fa-regular fa-arrow-right"></i></a>
          <div class="arrow-service">
            <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt="" /></a></span>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="800" data-aos-easing="linear">
          <div class="service2-author-box">
          <div class="tax-icon-img">
            <img src="/img/icons/tax-img5.svg" alt="" />
          </div>
          <div class="tax-content">
            <a href="{{ route('second', ['service', 'single']) }}">Estate Planning & Taxation</a>
            <p>
            From understanding the latest tax code <br /> change to exploring tax planning strategies.
            </p>
          </div>
          <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Learn More<i class="fa-regular fa-arrow-right"></i></a>
          <div class="arrow-service">
            <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt="" /></a></span>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6" data-aos="fade-up" data-aos-duration="900" data-aos-easing="linear">
          <div class="service2-author-box">
          <div class="tax-icon-img">
            <img src="/img/icons/tax-img6.svg" alt="" />
          </div>
          <div class="tax-content">
            <a href="{{ route('second', ['service', 'single']) }}">Estate Planning & Taxation</a>
            <p>
            From understanding the latest tax code <br /> change to exploring tax planning strategies.
            </p>
          </div>
          <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Learn More<i class="fa-regular fa-arrow-right"></i></a>
          <div class="arrow-service">
            <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt="" /></a></span>
          </div>
          </div>
        </div>

        <div></div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== SERVICES ENDS ======= -->

  <!-- ===== WORKS STARTS ======= -->
  <div class="work2-section-area sp1">
    <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">
      <div class="work2-header-text text-center">
        <span data-aos="fade-down" data-aos-duration="600">How It Works</span>
        <h2 class="text-capitalize" data-aos="fade-down" data-aos-duration="800">Legal Tax Assistance <img src="/img/elements/quito2.png" alt="" /> <br /> Tailored to Your Needs</h2>
      </div>
      </div>
    </div>
    <div class="row align-items-center">
      <div class="col-lg-5">
      <div class="collapse-navtabs">
        <div class="d-flex align-items-start">
        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">
          <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true" data-aos="fade-left" data-aos-duration="800">
          <span>Initial Consultation</span>
          <span class="button-pera">We aim to simplify the intricacies of tax law, making it accessible and relevant to Tax.</span>
          <img src="/img/elements/polygon3.png" alt="" class="polygon1" />
          <img src="/img/elements/polygon2.png" alt="" class="polygon2" />
          </button>
          <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false" data-aos="fade-left" data-aos-duration="1000">
          <span>Information & Recources</span>
          <span class="button-pera">We aim to simplify the intricacies of tax law, making it accessible and relevant to Tax.</span>
          <img src="/img/elements/polygon3.png" alt="" class="polygon1" />
          <img src="/img/elements/polygon2.png" alt="" class="polygon2" />
          </button>
          <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false" data-aos="fade-left" data-aos-duration="1200">
          <span>Best Ongoing Support</span>
          <span class="button-pera">We aim to simplify the intricacies of tax law, making it accessible and relevant to Tax.</span>
          <img src="/img/elements/polygon3.png" alt="" class="polygon1" />
          <img src="/img/elements/polygon2.png" alt="" class="polygon2" />
          </button>
        </div>
        </div>
      </div>
      </div>
      <div class="col-lg-7 align-items-center">
      <div class="tabs-author-area" data-aos="fade-up" data-aos-duration="1000">
        <div class="tab-content" id="v-pills-tabContent">
        <div class="tab-pane fade show active" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">
          <div class="tabs-author-images1">
          <img src="/img/images/tabs-img6.png" alt="" class="tabs-img1" />
          </div>

          <div class="tabs-author-images1">
          <div class="space30"></div>
          <img src="/img/images/tabs-img7.png" alt="" class="tabs-img1" />
          </div>
          <div class="tabs-author-images2 space2">
          <img src="/img/images/tabs-img8.png" alt="" class="tabs-img1" />
          </div>
        </div>

        <div class="tab-pane fade" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
          <div class="tabs-author-images1">
          <img src="/img/images/tabs-img7.png" alt="" class="tabs-img1" />
          </div>

          <div class="tabs-author-images1">
          <div class="space30"></div>
          <img src="/img/images/tabs-img9.png" alt="" class="tabs-img1" />
          </div>

          <div class="tabs-author-images2 space2">
          <img src="/img/images/tabs-img6.png" alt="" class="tabs-img1" />
          </div>
        </div>

        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
          <div class="tabs-author-images1">
          <img src="/img/images/tabs-img9.png" alt="" class="tabs-img1" />
          </div>

          <div class="tabs-author-images1">
          <div class="space30"></div>
          <img src="/img/images/tabs-img6.png" alt="" class="tabs-img1" />
          </div>

          <div class="tabs-author-images2 space2">
          <img src="/img/images/tabs-img7.png" alt="" class="tabs-img1" />
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== WORKS ENDS ======= -->

  <!-- ===== TEAM STARTS ======= -->
  <div class="team2-section-area sp3">
    <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">
      <div class="team1-header text-center">
        <span data-aos="fade-up" data-aos-duration="600">Our Team</span>
        <h2 data-aos="fade-up" data-aos-duration="800">Our Expert Tax law Team <img src="/img/elements/quito2.png" alt="" /></h2>
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-3 col-md-6" data-aos="fade-right" data-aos-duration="1400">
      <div class="team2-parent-boxarea">
        <div class="team2-boxarea">
        <div class="team2images">
          <img src="/img/images/team-img5.png" alt="" />
        </div>
        <div class="team2-social-links">
          <ul>
          <li>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
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
        <div class="team2-textarea">
        <div class="teamsname">
          <a href="{{ route('second', ['pages', 'team1']) }}">Alex Fargusion</a>
          <p>Senior Attorneys</p>
        </div>
        <div class="shareicon">
          <a href="#"><i class="fa-light fa-share-nodes"></i></a>
        </div>
        </div>
      </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-right" data-aos-duration="1200">
      <div class="team2-parent-boxarea">
        <div class="team2-boxarea">
        <div class="team2images">
          <img src="/img/images/team-img6.png" alt="" />
        </div>
        <div class="team2-social-links">
          <ul>
          <li>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
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
        <div class="team2-textarea">
        <div class="teamsname">
          <a href="{{ route('second', ['pages', 'team1']) }}">Richad Stones</a>
          <p>Senior Attorneys</p>
        </div>
        <div class="shareicon">
          <a href="#"><i class="fa-light fa-share-nodes"></i></a>
        </div>
        </div>
      </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-right" data-aos-duration="1000">
      <div class="team2-parent-boxarea">
        <div class="team2-boxarea">
        <div class="team2images">
          <img src="/img/images/team-img7.png" alt="" />
        </div>
        <div class="team2-social-links">
          <ul>
          <li>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
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
        <div class="team2-textarea">
        <div class="teamsname">
          <a href="{{ route('second', ['pages', 'team1']) }}">Pep Gurdiola</a>
          <p>Tax Analysis</p>
        </div>
        <div class="shareicon">
          <a href="#"><i class="fa-light fa-share-nodes"></i></a>
        </div>
        </div>
      </div>
      </div>

      <div class="col-lg-3 col-md-6" data-aos="fade-right" data-aos-duration="800">
      <div class="team2-parent-boxarea">
        <div class="team2-boxarea">
        <div class="team2images">
          <img src="/img/images/team-img8.png" alt="" />
        </div>
        <div class="team2-social-links">
          <ul>
          <li>
            <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
          </li>
          <li>
            <a href="#"><i class="fa-brands fa-linkedin"></i></a>
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
        <div class="team2-textarea">
        <div class="teamsname">
          <a href="{{ route('second', ['pages', 'team1']) }}">Richad Stones</a>
          <p>Senior Attorneys</p>
        </div>
        <div class="shareicon">
          <a href="#"><i class="fa-light fa-share-nodes"></i></a>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== TEAM ENDS ======= -->

  <!-- ===== TESTIMONIAL STARTS ======= -->
  <div class="testimonial2-section-area sp1">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-4">
      <div class="testimonial2-header">
        <span data-aos="fade-up" data-aos-duration="600">Testimonials</span>
        <h2 data-aos="fade-up" data-aos-duration="800">Some love words <img src="/img/elements/quito2.png" alt="" /> <br /> from clients</h2>
        <p data-aos="fade-up" data-aos-duration="1000">"I had a complex international tax issue that required immediate attention.</p>
        <div class="div" data-aos="fade-up" data-aos-duration="1200">
        <a href="{{ route('second', ['pages', 'testimonial1']) }}" class="welconme-btn2">Read More Reviews <span><i class="fa-regular fa-angle-right"></i></span></a>
        </div>
      </div>
      </div>
      <div class="col-lg-8" data-aos="zoom-out" data-aos-duration="1000">
      <div class="testimonial-owlcarousel-area owl-carousel tes5">
        <div class="testimonial-carousel-box">
        <div class="testimonial-author-area">
          <ul class="star-list">
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          </ul>
          <p>"I was stressed about my complex tax situation, but your tax attorneys provided clarity and professionalism. They resolved my issues efficiently, and I couldn't be happier with the results."</p>
          <div class="testimonial-mans-infoarea">
          <div class="testimonial-man-info">
            <div class="man-img">
            <img src="/img/images/product-img2.png" alt="" />
            </div>
            <div class="img-text">
            <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stoks</a>
            <p>Owner Taxfirm</p>
            </div>
          </div>
          <div class="testimonial-quito">
            <img src="/img/icons/quito1.svg" alt="" />
          </div>
          </div>
        </div>
        </div>

        <div class="testimonial-carousel-box">
        <div class="testimonial-author-area">
          <ul class="star-list">
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          </ul>
          <p>"I was stressed about my complex tax situation, but your tax attorneys provided clarity and professionalism. They resolved my issues efficiently, and I couldn't be happier with the results."</p>
          <div class="testimonial-mans-infoarea">
          <div class="testimonial-man-info">
            <div class="man-img">
            <img src="/img/images/product-img3.png" alt="" />
            </div>
            <div class="img-text">
            <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stoks</a>
            <p>Owner Taxfirm</p>
            </div>
          </div>
          <div class="testimonial-quito">
            <img src="/img/icons/quito1.svg" alt="" />
          </div>
          </div>
        </div>
        </div>

        <div class="testimonial-carousel-box">
        <div class="testimonial-author-area">
          <ul class="star-list">
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          </ul>
          <p>"I was stressed about my complex tax situation, but your tax attorneys provided clarity and professionalism. They resolved my issues efficiently, and I couldn't be happier with the results."</p>
          <div class="testimonial-mans-infoarea">
          <div class="testimonial-man-info">
            <div class="man-img">
            <img src="/img/images/product-img2.png" alt="" />
            </div>
            <div class="img-text">
            <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stoks</a>
            <p>Owner Taxfirm</p>
            </div>
          </div>
          <div class="testimonial-quito">
            <img src="/img/icons/quito1.svg" alt="" />
          </div>
          </div>
        </div>
        </div>

        <div class="testimonial-carousel-box">
        <div class="testimonial-author-area">
          <ul class="star-list">
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          </ul>
          <p>"I was stressed about my complex tax situation, but your tax attorneys provided clarity and professionalism. They resolved my issues efficiently, and I couldn't be happier with the results."</p>
          <div class="testimonial-mans-infoarea">
          <div class="testimonial-man-info">
            <div class="man-img">
            <img src="/img/images/product-img4.png" alt="" />
            </div>
            <div class="img-text">
            <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stoks</a>
            <p>Owner Taxfirm</p>
            </div>
          </div>
          <div class="testimonial-quito">
            <img src="/img/icons/quito1.svg" alt="" />
          </div>
          </div>
        </div>
        </div>

        <div class="testimonial-carousel-box">
        <div class="testimonial-author-area">
          <ul class="star-list">
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          <li>
            <i class="fa-duotone fa-star"></i>
          </li>
          </ul>
          <p>"I was stressed about my complex tax situation, but your tax attorneys provided clarity and professionalism. They resolved my issues efficiently, and I couldn't be happier with the results."</p>
          <div class="testimonial-mans-infoarea">
          <div class="testimonial-man-info">
            <div class="man-img">
            <img src="/img/images/product-img1.png" alt="" />
            </div>
            <div class="img-text">
            <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stoks</a>
            <p>Owner Taxfirm</p>
            </div>
          </div>
          <div class="testimonial-quito">
            <img src="/img/icons/quito1.svg" alt="" />
          </div>
          </div>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== TESTIMONIAL ENDS ======= -->

  <!-- ===== BLOG STARTS ======= -->
  <div class="blog1-section-area blog2-section sp1">
    <div class="container">
    <div class="row">
      <div class="col-lg-6 m-auto">
      <div class="blog-header text-center">
        <span data-aos="fade-up" data-aos-duration="600">Our Blogs</span>
        <h2 data-aos-duration="800" data-aos="fade-up">Our Latest Blog Posts <img src="/img/elements/quito.png" alt="" /></h2>
      </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
      <div class="blog-boxarea">
        <div class="blog-images">
        <img src="/img/images/blog-img1.png" alt="" />
        <div class="date-img">
          <img src="/img/images/date2.png" alt="" />
        </div>
        </div>
        <div class="blog-all-textarea">
        <div class="blog-text-area">
          <div class="blog-name-area">
          <img src="/img/icons/contact-img1.svg" alt="" />
          <a href="#">
            <p>Henry Nicolls</p>
          </a>
          </div>
          <div class="blog-name-area">
          <img src="/img/icons/tax-img1.svg" alt="" />
          <a href="#">
            <p>Tax Lawyer</p>
          </a>
          </div>
        </div>
        <a href="{{ route('second', ['blog', 'single']) }}">Experience Matters: Your Tax Your & Resolution Starts Here</a>
        <p>As a small business owner, you're well aware of the numerous financial responsibilities.</p>
        <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
        </div>
      </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000">
      <div class="blog-boxarea">
        <div class="blog-images">
        <img src="/img/images/blog-img2.png" alt="" />
        <div class="date-img">
          <img src="/img/images/date5.png" alt="" />
        </div>
        </div>
        <div class="blog-all-textarea">
        <div class="blog-text-area">
          <div class="blog-name-area">
          <img src="/img/icons/contact-img1.svg" alt="" />
          <a href="#">
            <p>Henry Nicolls</p>
          </a>
          </div>
          <div class="blog-name-area">
          <img src="/img/icons/tax-img1.svg" alt="" />
          <a href="#">
            <p>Tax Lawyer</p>
          </a>
          </div>
        </div>
        <a href="{{ route('second', ['blog', 'single']) }}">Experience Matters: Your Tax Your & Resolution Starts Here</a>

        <p>As a small business owner, you're well aware of the numerous financial responsibilities.</p>
        <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
        </div>
      </div>
      </div>

      <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
      <div class="blog-boxarea">
        <div class="blog-images">
        <img src="/img/images/blog-img3.png" alt="" />
        <div class="date-img">
          <img src="/img/images/date6.png" alt="" />
        </div>
        </div>
        <div class="blog-all-textarea">
        <div class="blog-text-area">
          <div class="blog-name-area">
          <img src="/img/icons/contact-img1.svg" alt="" />
          <a href="#">
            <p>Henry Nicolls</p>
          </a>
          </div>
          <div class="blog-name-area">
          <img src="/img/icons/tax-img1.svg" alt="" />
          <a href="#">
            <p>Tax Lawyer</p>
          </a>
          </div>
        </div>
        <a href="{{ route('second', ['blog', 'single']) }}">Experience Matters: Your Tax Your & Resolution Starts Here</a>
        <p>As a small business owner, you're well aware of the numerous financial responsibilities.</p>
        <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
        </div>
      </div>
      </div>
    </div>
    <div class="col-lg-12" data-aos="fade-up" data-aos-duration="1400">
      <div class="div text-center">
      <a href="{{ route('second', ['blog', 'blog1']) }}" class="welconme-btn2">Read More & Articles <span><i class="fa-regular fa-angle-right"></i></span></a>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== BLOG ENDS ======= -->

  <!-- ===== CTA STARTS ======= -->
  <div class="cta2-section-area">
    <div class="container">
    <div class="row align-items-center">
      <div class="col-lg-12">
      <div class="cta2-section-hedaer sp5" data-aos="zoom-out" data-aos-duration="1000">
        <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="cta2-header">
          <h2 data-aos="fade-up" data-aos-duration="600">Schedule A Free Consultation</h2>
          <p data-aos="fade-up" data-aos-duration="800">
            At your firm name, Our experienced tax attorneys are here to help you <br /> navigate the complexities of tax law, save you money, & ensure.
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
              <input type="email" placeholder="Email Address" />
            </div>
            </div>
            <div class="col-lg-6">
            <div class="space20"></div>
            <div class="cta-input">
              <div class="first-name-input">
              <select name="country" id="country" class="country-area">
                <option value="1" data-display="Service Type">Service Type</option>
                <option value="">Belgium</option>
                <option value="">Brezil</option>
                <option value="">Argentina</option>
                <option value="">Bangladesh</option>
                <option value="">Germany</option>
              </select>
              </div>
            </div>
            </div>
            <div class="col-lg-6">
            <div class="space20"></div>
            <div class="cta-input">
              <button type="submit" class="cta-btn2">Schedule A Consultation <span><i class="fa-regular fa-angle-right"></i></span></button>
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
  <!-- ===== CTA HEADER ======= -->

  <!-- ===== FOOTER STARTS ======= -->
  <div class="footer2-section-area">
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
      <div class="footer-all-section-area sp5">
        <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="footer-last-section">
          <div class="footer-imgage">
            <img src="/img/logo/logo3.png" alt="" />
          </div>
          <div class="footer-text-area">
            <p>Include any additional information that may be relevant or helpful for visitors, such as FAQs, pricing options.</p>
            <div class="social-list-area">
            <ul>
              <li>
              <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
              </li>
              <li>
              <a href="#"><i class="fa-brands fa-x-twitter"></i></a>
              </li>
              <li>
              <a href="#"><i class="fa-brands fa-linkedin"></i></a>
              </li>
              <li>
              <a href="#"><i class="fa-brands fa-instagram"></i></a>
              </li>
            </ul>
            </div>
          </div>
          </div>
        </div>
        <div class="col-lg-2 col-md-6">
          <div class="about-links-area">
          <h3>About Link</h3>
          <ul>
            <li>
            <a href="{{ route('second', ['blog', 'blog1']) }}">Our Blog</a>
            </li>
            <li>
            <a href="{{ route('second', ['pages', 'about']) }}">About Us</a>
            </li>
            <li>
            <a href="{{ route('second', ['service', 'service1']) }}">Practice Areas</a>
            </li>
            <li>
            <a href="{{ route('second', ['pages', 'testimonial1']) }}">Testimonials</a>
            </li>
            <li>
            <a href="{{ route('second', ['contact', 'v1']) }}">Contact Us</a>
            </li>
          </ul>
          </div>
        </div>

        <div class="col-lg-3 col-md-6">
          <div class="get-links-area">
          <h3>Get In Touch</h3>
          <ul>
            <li>
            <img src="/img/icons/footer-email2.svg" alt="" /><a href="maito:demolawsy@gmail.com">demolawsy@gmail.com</a>
            </li>
            <li>
            <img src="/img/icons/footer-location1.svg" alt="" /><a href="#">8708 Technology Forest <br /> Pl Suite 125 -G, The <br /> Woodlands, TX 77381</a>
            </li>
            <li>
            <img src="/img/icons/footer-phn.svg" alt="" /><a href="tel:123-456-7890">123-456-7890</a>
            </li>
          </ul>
          </div>
        </div>
        <div class="col-lg-4 col-md-6">
          <div class="footer-contact-area">
          <h3>Subscribe Our Newsletter</h3>
          <div class="footer-form-area">
            <form>
            <input type="email" placeholder="Ener Your Email" />
            <div class="footer-btn">
              <button type="submit">Subscribe <span><i class="fa-regular fa-angle-right"></i></span></button>
            </div>
            </form>
          </div>
          </div>
        </div>
        </div>
      </div>
      <div class="copyright-pera">
        <p>© Copyright 2024 Lawsy Lawyer</p>
        <a href="#">Privacy Policy</a>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!-- ===== FOOTER ENDS ======= -->
@endsection