@extends('layouts.landing', ['title' => 'Lawsy || Criminal Law || Our Blog Sidebar'])

@section('content')
  <!--===== WELCOME STARTS=======-->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
    <div class="row">
      <div class="col-lg-5 m-auto">
      <div class="welcome-inner-header text-center">
        <h1>Our Blog Sidebar</h1>
        <a href="{{ route('any', 'index') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Our Blog Sidebar</a>
        <img src="/img/elements/elementor20.png" alt="">
      </div>
      </div>
    </div>
    </div>
  </div>
  <!--===== WELCOME ENDS =======-->

  <!--===== BLOG STARTS=======-->
  <div class="blog5-section-area sp3">
    <div class="container">
    <div class="row">
      <div class="col-lg-8">
      <div class="blog-left-area">
        <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog5-img1.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Legal Assessment</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">Navigating Co-Parenting Law Challenges After Divorce</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog5-img2.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Property Division</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">The Different Types of Divorce: Which One Is Right for You?"</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog5-img3.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Child Custody & Support</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">Divorce and Child Custody: The Putting Children First</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog3-inner-img1.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Legal Assessment</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">Expert Criminal Defense Law Attorneys by Your Side</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog3-inner-img2.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Legal Law</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">Trustworthy Criminal Lawyers Protecting Your Rights</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
          </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog5-boxarea">
          <div class="blog5-imgeas">
            <img src="/img/images/blog3-inner-img3.png" alt="">
          </div>
          <div class="blog5-content-area">
            <div class="tags-area">
            <a href="#">#Legal Advisory</a>
            </div>
            <a href="{{ route('second', ['blog', 'single']) }}">Criminal Defense Good Lawyers Ready to Fight for Your Rights</a>
            <p>Child custody is a central concern in many to divorces, We'll explore the different Lawyers.</p>
            <a href="{{ route('second', ['blog', 'single']) }}" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
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

      <div class="col-lg-4">
      <div class="blog-leftber-area right">
        <div class="search-area">
        <h3>Search</h3>
        <form action="#">
          <input type="text" placeholder="Search.....">
          <button type="submit"><i class="fa-regular fa-magnifying-glass"></i></button>
        </form>
        </div>

        <div class="blog-categories">
        <h3>Blog Category</h3>
        <ul>
          <li><a href=""> Homicide/Murder Defense <i class="fa-regular fa-angle-right"></i></a></li>
          <li><a href=""> Internet and Cyber Crimes <i class="fa-regular fa-angle-right"></i></a></li>
          <li><a href=""> Professional License Defense <i class="fa-regular fa-angle-right"></i></a></li>
          <li><a href=""> Immigration-Related Crimes <i class="fa-regular fa-angle-right"></i></a></li>
          <li><a href=""> Pre-Charge Representation <i class="fa-regular fa-angle-right"></i></a></li>
          <li><a href=""> Asset Forfeiture Defense <i class="fa-regular fa-angle-right"></i></a></li>
        </ul>
        </div>
        <div class="author-area">
        <h3>Our Author</h3>
        <ul>
          <li><img src="/img/images/auhtor-img1.png" alt=""></li>
          <li><img src="/img/images/author-img2.png" alt=""></li>
          <li><img src="/img/images/auhtor-img3.png" alt=""></li>
          <li><img src="/img/images/author-img4.png" alt=""></li>
          <li><img src="/img/images/auhtor-img5.png" alt=""></li>
        </ul>
        </div>
        <div class="popular-tags-area">
        <h3>Our Popular Tags</h3>
        <div class="first-tags">
          <a href="#">#Legal Warriors</a>
          <a href="#">#Legal Defense Expert</a>
        </div>
        <div class="second-tags">
          <a href="#">#Your Legal Guardians</a>
          <a href="#">#Legal Shield</a>
        </div>
        <div class="third-tags">
          <a href="#">#Strong Legal Defense</a>
          <a href="#">#Legal Lawyers</a>
        </div>
        </div>
        <div class="phone-area">
        <h3>If You Need Any Help <br> Contact With Us</h3>
        <a href="tel:+917052101786"> <img src="/img/icons/call-img4.svg" alt="">+91 705 2101 786</a>
        </div>
      </div>
      </div>


    </div>
    </div>
  </div>
  <!--===== BLOG ENDS=======-->
@endsection