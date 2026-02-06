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
        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img1.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner1.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">DUI/DWI Defense</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img2.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner2.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Military Justice</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img3.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner3.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Juvenile Defense</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img4.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner4.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Sexual Crime</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img5.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner5.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Assault and Battery</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img6.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner6.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">College Disciplinary</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img7.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner7.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Immigration Crime</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img8.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner8.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Assault and Battery</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
            </div>
          </div>
        </div>

        <div class="col-lg-4">
          <div class="service4-boxarea">
            <div class="service4-imges">
              <img src="/img/images/service-inner-img2.png" alt="">
            </div>
            <div class="service4-content-area">
              <div class="service4-author-area">
                <div class="service4-icons">
                  <img src="/img/icons/service-inner9.svg" alt="">
                </div>
                <div class="service4-main-heading">
                  <a href="{{ route('second', ['service', 'single']) }}">Probation Violations</a>
                </div>
              </div>
              <div class="service4-content2-area">
                <p>For allegations involving fraud, best law & lawyer embezzlement, or other white-collar offense, our team offers a service.</p>
                <p>Protecting clients' in cases lawyer involving government attempts to seize.</p>
                <a href="{{ route('second', ['service', 'single']) }}">Read More <i class="fa-light fa-arrow-right"></i></a>
              </div>
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