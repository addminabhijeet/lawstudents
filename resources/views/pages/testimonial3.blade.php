@extends('layouts.landing' , ['title' => 'Lawsy || Criminal Law || Testimonials'])

@section('content')
  <!--===== WELCOME STARTS =======-->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 m-auto">
          <div class="welcome-inner-header text-center">
            <h1>Testimonials</h1>
            <a href="{{ route('any', 'index') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Testimonials</a>
            <img src="/img/elements/elementor20.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== WELCOME ENDS =======-->

  <!--===== TESTIMONIAL STARTS =======-->
  <div class="testimonial-section-area sp1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="testimonial-img">
            <img src="/img/images/testimonial3-inner-img1.png" alt="">
          </div>
        </div>
        <div class="col-lg-8">
          <div class="blog-nav-area">
            <div class="qutio-img">
              <img src="/img/icons/quito7.svg" alt="">
            </div>
            <div class="quito-content">
              <p>"Navigating the complexities of divorce law requires a lawyer compassionate advocate who understands your unique law to situation. Our dedicated divorce lawyers are here to guide you through the process and help you achieve a fresh start.</p>
              <div class="nav-img-area">
                <div class="nav-img">
                  <img src="/img/images/testimonial3-inner-img1.png" alt="">
                </div>
                <div class="nav-content-area">
                  <a href="{{ route('second', ['pages', 'team1']) }}">Alexander Arnold</a>
                  <p>Owner Lawsy Lawyer</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space30"></div>

      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="testimonial-img">
            <img src="/img/images/testimonial3-inner-img2.png" alt="">
          </div>
        </div>
        <div class="col-lg-8">
          <div class="blog-nav-area">
            <div class="qutio-img">
              <img src="/img/icons/quito7.svg" alt="">
            </div>
            <div class="quito-content">
              <p>"I was facing serious charges, unsure of what my future held. [Law Firm Name] took charge, meticulously preparing my defense and guiding me through the legal complexities. Their dedication & professionalism made a significant difference.”</p>
              <div class="nav-img-area">
                <div class="nav-img">
                  <img src="/img/images/testimonial3-inner-img2.png" alt="">
                </div>
                <div class="nav-content-area">
                  <a href="{{ route('second', ['pages', 'team1']) }}">Mabel Smitham</a>
                  <p>Future Factors Director</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space30"></div>

      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="testimonial-img">
            <img src="/img/images/testimonial3-inner-img3.png" alt="">
          </div>
        </div>
        <div class="col-lg-8">
          <div class="blog-nav-area">
            <div class="qutio-img">
              <img src="/img/icons/quito7.svg" alt="">
            </div>
            <div class="quito-content">
              <p>"I never thought I'd need a criminal defense lawyer until I found myself in trouble. [Lawyer Name] at [Law Firm Name] was a beacon of hope during a dark time. Their knowledge of the law and commitment to my case were impressive.”</p>
              <div class="nav-img-area">
                <div class="nav-img">
                  <img src="/img/images/testimonial3-inner-img3.png" alt="">
                </div>
                <div class="nav-content-area">
                  <a href="{{ route('second', ['pages', 'team1']) }}">Mrs. Lynn Kirlin</a>
                  <p>Direct Data Analyst</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space30"></div>

      <div class="row align-items-center">
        <div class="col-lg-4">
          <div class="testimonial-img">
            <img src="/img/images/testimonial3-inner-img4.png" alt="">
          </div>
        </div>
        <div class="col-lg-8">
          <div class="blog-nav-area">
            <div class="qutio-img">
              <img src="/img/icons/quito7.svg" alt="">
            </div>
            <div class="quito-content">
              <p>"I cannot thank [Law Firm Name] enough for their exceptional work. They handled my case with care and precision, ensuring my rights were protected at every turn. Their attention to detail & willingness to go above and beyond are unmatched.”</p>
              <div class="nav-img-area">
                <div class="nav-img">
                  <img src="/img/images/testimonial3-inner-img4.png" alt="">
                </div>
                <div class="nav-content-area">
                  <a href="{{ route('second', ['pages', 'team1']) }}">Oscar Cummerata</a>
                  <p>Legacy Solutions Consultant</p>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="space30"></div>
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="pagination-area">
            <nav aria-label="Page navigation example">
              <ul class="pagination">
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true"><i class="fa-regular fa-angle-left"></i></span>
                  </a>
                </li>
                <li class="page-item"><a class="page-link active" href="#">1</a></li>
                <li class="page-item"><a class="page-link" href="#">2</a></li>
                <li class="page-item"><a class="page-link" href="#">3</a></li>
                <li class="page-item"><a class="page-link" href="#">...</a></li>
                <li class="page-item"><a class="page-link" href="#">12</a></li>
                <li class="page-item">
                  <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true"><i class="fa-regular fa-angle-right"></i></span>
                  </a>
                </li>
              </ul>
            </nav>
          </div>
        </div>
      </div>

    </div>
  </div>
  <!--===== TESTIMONIAL ENDS =======-->
@endsection