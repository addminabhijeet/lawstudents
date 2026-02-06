@extends('layouts.landing', ['title' => 'Lawsy || Criminal Law || Contact Us'])

@section('content')
  <!--===== WELCOME STARTS =======-->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
    <div class="row">
      <div class="col-lg-3 m-auto">
      <div class="welcome-inner-header text-center">
        <h1>Contact Us</h1>
        <a href="{{ route('any', 'index') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Contact Us</a>
        <img src="/img/elements/elementor20.png" alt="">
      </div>
      </div>
    </div>
    </div>
  </div>
  <!--===== WELCOME ENDS =======-->

  <!--===== CONTACT STARTS =======-->
  <div class="contact1-section-area sp1">
    <div class="container">
    <div class="row">
      <div class="col-lg-12">
      <div class="contact-auhtor-area">
        <div class="row">
        <div class="col-lg-7">
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
              <button type="submit">Free Case Evulation <i class="fa-light fa-arrow-right"></i></button>
            </div>
            </div>
          </div>
          </div>
        </div>
        <div class="col-lg-5">
          <div class="contact-widget-area">
          <div class="clock-img">
            <img src="/img/icons/clock1.svg" alt="">
          </div>
          <div class="content">
            <h4>Contact Us</h4>
            <a href="#">8708 Technology Forest Pl Suite 125 -G, The Woodlands, TX 77381</a>
          </div>
          </div>
          <div class="space20"></div>
          <div class="contact-widget-area">
          <div class="clock-img">
            <img src="/img/icons/phone2.svg" alt="">
          </div>
          <div class="content">
            <h4>Call or text</h4>
            <a href="123-456-7890">123-456-7890</a>
          </div>
          </div>
          <div class="space20"></div>
          <div class="contact-widget-area">
          <div class="clock-img">
            <img src="/img/icons/email2.svg" alt="">
          </div>
          <div class="content">
            <h4>Email us today</h4>
            <a href="info@taxvice.com">info@taxvice.com</a>
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
          <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d4506257.120552435!2d88.67021924228865!3d21.954385721237916!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2sbd!4v1704088968016!5m2!1sen!2sbd" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
        </div>
      </div>
      </div>
    </div>
    </div>
  </div>
  <!--===== CONTACT STARTS =======-->
@endsection