@extends('layouts.landing' , ['title' => 'Lawsy || Criminal Law || Practice Areas'])

@section('content')
  <!--===== WELCOME STARTS =======-->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 m-auto">
          <div class="welcome-inner-header text-center">
            <h1>Practice Areas</h1>
            <a href="{{ route('any', 'index') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Practice Areas</a>
            <img src="/img/elements/elementor20.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== WELCOME ENDS =======-->

  <!--===== SERVICES STARTS =======-->
  <div class="service-inner-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner1.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">DUI/DWI Defense</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner2.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Assault and Battery</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner3.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">White-Collar Crimes</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner4.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Theft and Property Crimes</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner5.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Domestic Violence</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner6.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Juvenile Defense</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner7.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Federal Crimes</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner8.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Divorce Law</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6">
          <div class="service2-author-box">
            <div class="tax-icon-img">
              <img src="/img/icons/service-inner9.svg" alt="">
            </div>
            <div class="tax-content">
              <a href="{{ route('second', ['service', 'single']) }}">Drug Offenses</a>
              <p>Law strategy, or a legal professional in to the search of the latest updates and insights.</p>
            </div>
            <a href="{{ route('second', ['service', 'single']) }}" class="learn-more">Read More<i class="fa-regular fa-arrow-right"></i></a>
            <div class="arrow-service">
              <span><a href="{{ route('second', ['service', 'single']) }}"><img src="/img/icons/arrow_right.svg" alt=""></a></span>
            </div>
          </div>
        </div>
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
  <!--===== SERVICES ENDS =======-->
@endsection