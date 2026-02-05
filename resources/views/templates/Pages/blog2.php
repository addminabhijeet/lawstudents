<!DOCTYPE html>
<html lang="en">

<head>
  <?= $this->element('title_meta' , ['title' => 'Lawsy || Criminal Law || Our Blog 02' ]) ?>

  <?= $this->element("head_css") ?>
</head>

<body class="inner-pages">

  <?= $this->element("loader") ?>

  <?= $this->element("header/navbar") ?>

  <!--===== WELCOME STARTS =======-->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
      <div class="row">
        <div class="col-lg-3 m-auto">
          <div class="welcome-inner-header text-center">
            <h1>Our Blog</h1>
            <a href="index">Home <span><i class="fa-light fa-angle-right"></i></span> Our BLog</a>
            <img src="/img/elements/elementor20.png" alt="">
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--===== WELCOME ENDS =======-->

  <!--===== BLOG STARTS =======-->
  <div class="blog4-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <div class="blog4-boxarea">
            <div class="blog4-images">
              <img src="/img/images/blog4-img1.png" alt="">
            </div>
            <div class="blog4-content-area">
              <div class="blog4-date-area">
                <div class="date4-img">
                  <img src="/img/icons/date-img1.svg" alt="">
                </div>
                <a href="#">10 October 2024</a>
              </div>
              <a href="blog-single">Your Shield in Legal Battles: Premier Criminal Law & Lawyer Defense Counsel at Service</a>
              <p>Our team of dedicated criminal defense attorneys is here to has provide unwavering support and expert legal guidance lawyer.</p>
              <a href="blog-single" class="readmore">Learn More <i class="fa-light fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog4-boxarea">
            <div class="blog4-images">
              <img src="/img/images/blog4-img2.png" alt="">
            </div>
            <div class="blog4-content-area">
              <div class="blog4-date-area">
                <div class="date4-img">
                  <img src="/img/icons/date-img1.svg" alt="">
                </div>
                <a href="#">8 October 2024</a>
              </div>
              <a href="blog-single">Empowering Your Defense: Trustworthy Law Criminal Lawyers Protecting Your Rights</a>
              <p>Our team of dedicated criminal defense attorneys is here to has provide unwavering support and expert legal guidance lawyer.</p>
              <a href="blog-single" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog4-boxarea">
            <div class="blog4-images">
              <img src="/img/images/blog2-inner-img1.png" alt="">
            </div>
            <div class="blog4-content-area">
              <div class="blog4-date-area">
                <div class="date4-img">
                  <img src="/img/icons/date-img1.svg" alt="">
                </div>
                <a href="#">10 October 2024</a>
              </div>
              <a href="blog-single">Defending Futures: Seasoned Criminal Lawyer Defense Lawyers Ready to Fight for You</a>
              <p>Our team of dedicated criminal defense attorneys is here to has provide unwavering support and expert legal guidance lawyer.</p>
              <a href="blog-single" class="readmore">Learn More <i class="fa-light fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6">
          <div class="blog4-boxarea">
            <div class="blog4-images">
              <img src="/img/images/blog2-inner-img2.png" alt="">
            </div>
            <div class="blog4-content-area">
              <div class="blog4-date-area">
                <div class="date4-img">
                  <img src="/img/icons/date-img1.svg" alt="">
                </div>
                <a href="#">8 October 2024</a>
              </div>
              <a href="blog-single">Navigating Legal Storms: Premier Criminal Defense Lawyers Ensuring Your Rights</a>
              <p>Our team of dedicated criminal defense attorneys is here to has provide unwavering support and expert legal guidance lawyer.</p>
              <a href="blog-single" class="readmore">Read More <i class="fa-light fa-arrow-right"></i></a>
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
  <!--===== BLOG ENDS =======-->

  <?= $this->element("cta") ?>

  <?= $this->element("footer") ?>

  <?= $this->element("footer_scripts") ?>

</body>

</html>