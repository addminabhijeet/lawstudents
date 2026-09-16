@extends('layouts.landing' , ['title' => 'Law Students || Criminal Law || 01'])

@section('content')
  <!-- ===== WELCOME STARTS ======= -->
  <div class="welcome3-section-area" style="background-image: url(/img/bacground/header3-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover; z-index: 1;">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-2">
          <div class="welcome3-element" data-aos="fade-right" data-aos-duration="800">
            <img src="/img/elements/elementor18.png" alt="" class="keyframe5" />
            <div class="elementor19" data-aos="fade-right" data-aos-duration="1000">
              <img src="/img/elements/elementor19.png" alt="" class="aniamtion-key-1 d-lg-inline-block d-none" />
            </div>
          </div>
        </div>
        <div class="col-lg-8">
          <div class="welcome3-header-area text-center">
            <h1 data-aos="fade-up" data-aos-duration="800">Master Legal Knowledge, <img src="/img/elements/elementor20.png" alt="" class="aniamtion-key-1 d-lg-block d-md-none" />Build Your Career <a class="video-play-button1"><span class="video-play-button"><i class="fa-duotone fa-play"></i></span>Play Now</a>Path</h1>
            <p data-aos="fade-up" data-aos-duration="1000">
              Learn from industry experts with comprehensive legal education. Gain structured knowledge through our carefully designed curriculum <br /> and prepare for your successful legal career.
            </p>
            <div data-aos="fade-up" data-aos-duration="1200">
              <a href="{{ route('second', ['contact', 'v1']) }}" class="casebtn1">Explore Courses <span><i class="fa-regular fa-arrow-right"></i></span></a>
              <a href="{{ route('second', ['contact', 'v2']) }}" class="casebtn2">Start Learning <span><i class="fa-regular fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-2">
          <div class="welcome3-counter-area">
            <div class="welcome3-counter-box text-center" data-aos="fade-left" data-aos-duration="800">
              <h3><span class="counter">500</span>+</h3>
              <p>Students Enrolled</p>
            </div>

            <div class="welcome3-counter-box text-center" data-aos="fade-left" data-aos-duration="1000">
              <h3><span class="counter">100</span>+</h3>
              <p>Courses Available</p>
            </div>

            <div class="welcome3-counter-box text-center" data-aos="fade-left" data-aos-duration="=1200">
              <h3><span class="counter">50</span>+</h3>
              <p>Expert Instructors</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== WELCOME ENDS ======= -->

  <!-- ===== OTHERS STARTS ======= -->
  <div class="others-section-area">
    <div class="ontainer">
      <div class="row">
        <div class="col-lg-8 m-auto">
          <div class="others-content-area text-center">
            <div class="others-img1" data-aos="fade-up" data-aos-duration="600">
              <img src="/img/images/others-img1.png" alt="" />
              <div class="others-arrow">
                <a href="{{ route('second', ['service', 'single']) }}"><i class="fa-regular fa-angles-right"></i></a>
              </div>
            </div>
            <div class="others-img2" data-aos="fade-up" data-aos-duration="800">
              <img src="/img/images/others-img2.png" alt="" />
              <div class="others-arrow">
                <a href="{{ route('second', ['service', 'single']) }}"><i class="fa-regular fa-angles-right"></i></a>
              </div>
            </div>
            <div class="others-img3" data-aos="fade-up" data-aos-duration="1000">
              <img src="/img/images/others-img3.png" alt="" />
              <div class="others-arrow">
                <a href="{{ route('second', ['service', 'single']) }}"><i class="fa-regular fa-angles-right"></i></a>
              </div>
            </div>
            <div class="others-img4" data-aos="fade-up" data-aos-duration="1200">
              <img src="/img/images/others-img4.png" alt="" />
              <div class="others-arrow">
                <a href="{{ route('second', ['service', 'single']) }}"><i class="fa-regular fa-angles-right"></i></a>
              </div>
            </div>
            <div class="others-img5" data-aos="fade-up" data-aos-duration="1400">
              <img src="/img/images/others-img5.png" alt="" />
              <div class="others-arrow">
                <a href="{{ route('second', ['service', 'single']) }}"><i class="fa-regular fa-angles-right"></i></a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== OTHERS ENDS ======= -->

  <!-- ===== ABOUT STARTS ======= -->
  <div class="about3-section-area">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about3-textarea">
            <span data-aos="fade-right" data-aos-duration="600">About Our Institution</span>
            <h2 data-aos="fade-right" data-aos-duration="800">Building Tomorrow's Legal Professionals Today</h2>
            <p data-aos="fade-right" data-aos-duration="1000">We are dedicated to providing world-class legal education to aspiring lawyers. With industry experts as instructors and comprehensive curriculum, we prepare students for successful legal careers.</p>
            <div class="about3-textarea-list" data-aos="fade-right" data-aos-duration="1200">
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />World-Class Curriculum</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Expert Faculty Members</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Hands-On Training</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Career Support & Placement</a>
                </li>
              </ul>
            </div>
            <div class="about3-pera-text" data-aos="fade-right" data-aos-duration="700" data-aos-easing="linear">
              <p>We emphasize practical knowledge and industry exposure. Our graduates work at top law firms, corporate houses, and government institutions across the country, making meaningful impacts in their legal careers.</p>
            </div>
            <div class="div" data-aos="fade-right" data-aos-duration="800" data-aos-easing="linear">
              <a href="{{ route('second', ['pages', 'about']) }}" class="casebtn1">Discover Our Programs <span><i class="fa-regular fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about3-images-area" data-aos="zoom-out" data-aos-duration="1000">
            <img src="/img/images/about-img3.png" alt="" />
            <div class="elementors21">
              <img src="/img/elements/elementor21.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== ABOUT ENDS ======= -->

  <!-- ===== SERVICES STARTS ======= -->
  <div class="service3-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="service3-header-text text-center">
            <span data-aos="fade-up" data-aos-duration="600">Popular Courses</span>
            <h2 class="text-capitalize" data-aos="fade-up" data-aos-duration="800">Comprehensive Legal Education for Every Level</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12" data-aos="zoom-out" data-aos-duration="1000">
          <div class="service-navs-area">
            <div class="row align-items-center">
              <div class="col-lg-6">
                <div class="foter-carousel">
                  <div class="hero13-single-slider img5">
                    <img src="/img/images/service-img1-h3.png" alt="" />
                    <div class="elementors21">
                      <img src="/img/elements/elementor22.png" alt="" />
                    </div>
                  </div>

                  <div class="hero13-single-slider img5">
                    <img src="/img/images/service-img2-h3.png" alt="" />
                    <div class="elementors21">
                      <img src="/img/elements/elementor22.png" alt="" />
                    </div>
                  </div>

                  <div class="hero13-single-slider img5">
                    <img src="/img/images/service-img3-h3.png" alt="" />
                    <div class="elementors21">
                      <img src="/img/elements/elementor22.png" alt="" />
                    </div>
                  </div>

                  <div class="hero13-single-slider img5">
                    <img src="/img/images/service-img1-h3.png" alt="" />
                    <div class="elementors21">
                      <img src="/img/elements/elementor22.png" alt="" />
                    </div>
                  </div>

                  <div class="hero13-single-slider img5">
                    <img src="/img/images/service-img3-h3.png" alt="" />
                    <div class="elementors21">
                      <img src="/img/elements/elementor22.png" alt="" />
                    </div>
                  </div>
                </div>
              </div>
              <div class="col-lg-6">
                <div class="slider-nav1">
                  <div class="testimonial-listarea">
                    <h3>01 <img src="/img/elements/line-img1.png" alt="" />Program</h3>
                    <h4>LL.B. Entrance Preparation</h4>
                    <div class="service-pera1">
                      <p>
                        <span>IPC Basics:</span> Learn fundamental principles of the Indian Penal Code, essential concepts and legal framework required for law entrance examinations.
                      </p>
                      <p>
                        <span>Constitutional Law:</span> Understand core principles of constitutional law, fundamental rights, directive principles and constitutional amendments.
                      </p>
                      <p>
                        <span>Legal Writing:</span> Develop essential legal writing skills including drafting, case analysis, and effective communication required for legal practice.
                      </p>
                    </div>
                    <div class="div">
                      <a href="{{ route('second', ['service', 'single']) }}" class="casebtn1">View Details <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                  </div>

                  <div class="testimonial-listarea">
                    <h3>02 <img src="/img/elements/line-img1.png" alt="" />Program</h3>
                    <h4>LL.B. 3-Year Program</h4>
                    <div class="service-pera1">
                      <p>
                        <span>Criminal Law:</span> Comprehensive study of criminal law including procedural aspects, evidence, and criminal justice system implementation.
                      </p>
                      <p>
                        <span>Civil & Administrative Law:</span> Learn civil law procedures, contract law, administrative law, and regulatory frameworks governing civil practice.
                      </p>
                      <p>
                        <span>Constitutional Framework:</span> Deep dive into constitutional law, judicial interpretation, and constitutional rights protection and remedies.
                      </p>
                    </div>
                    <div class="div">
                      <a href="{{ route('second', ['service', 'single']) }}" class="casebtn1">View Details <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                  </div>

                  <div class="testimonial-listarea">
                    <h3>03 <img src="/img/elements/line-img1.png" alt="" />Program</h3>
                    <h4>LL.B. 5-Year Program</h4>
                    <div class="service-pera1">
                      <p>
                        <span>Complete Curriculum:</span> Comprehensive legal curriculum covering all major areas of law with specialized electives and practical training modules.
                      </p>
                      <p>
                        <span>Internships & Externships:</span> Mandatory internship programs with law firms, courts, and corporate offices to gain real-world legal experience.
                      </p>
                      <p>
                        <span>Moot Court & Competitions:</span> Active participation in moot courts, legal writing competitions, and inter-college legal contests for skill development.
                      </p>
                    </div>
                    <div class="div">
                      <a href="{{ route('second', ['service', 'single']) }}" class="casebtn1">View Details <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                  </div>

                  <div class="testimonial-listarea">
                    <h3>04 <img src="/img/elements/line-img1.png" alt="" />Program</h3>
                    <h4>LL.M. Specialization</h4>
                    <div class="service-pera1">
                      <p>
                        <span>Corporate Law:</span> Advanced study of corporate law, mergers and acquisitions, securities regulation, and corporate governance practices.
                      </p>
                      <p>
                        <span>International Law:</span> International legal frameworks, international trade, human rights law, and cross-border legal compliance requirements.
                      </p>
                      <p>
                        <span>Criminal Law Specialization:</span> Advanced criminal law topics including criminal procedure, evidence, international criminal law, and forensic law.
                      </p>
                    </div>
                    <div class="div">
                      <a href="{{ route('second', ['service', 'single']) }}" class="casebtn1">View Details <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                  </div>

                  <div class="testimonial-listarea">
                    <h3>05 <img src="/img/elements/line-img1.png" alt="" />Program</h3>
                    <h4>Judiciary & Competitive Exams</h4>
                    <div class="service-pera1">
                      <p>
                        <span>CLAT Preparation:</span> Comprehensive preparation for Common Law Admission Test including logical reasoning, legal reasoning, and current affairs.
                      </p>
                      <p>
                        <span>Judiciary Exam Coaching:</span> Specialized coaching for state and national level judiciary exams with expert instructors and practice materials.
                      </p>
                      <p>
                        <span>Civil Services Support:</span> Preparation and guidance for aspiring law graduates pursuing civil services examinations and government legal positions.
                      </p>
                    </div>
                    <div class="div">
                      <a href="{{ route('second', ['service', 'single']) }}" class="casebtn1">View Details <span><i class="fa-regular fa-arrow-right"></i></span></a>
                    </div>
                  </div>
                </div>
                <div class="testimonial-arrows">
                  <div class="testimonial-prev-arrow1">
                    <button><i class="fa-solid fa-arrow-left"></i></button>
                  </div>
                  <div class="testimonial-next-arrow1">
                    <button><i class="fa-solid fa-arrow-right"></i></button>
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
  <div class="work3-section-area sp3">
    <div class="container">
      <div class="row">
        <div class="col-lg-4 m-auto">
          <div class="work3-progress text-center">
            <span data-aos="fade-up" data-aos-duration="600">Learning Journey</span>
            <h2 data-aos="fade-up" data-aos-duration="800">How Students Succeed With Us</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="800">
          <div class="work3-boxarea text-center">
            <img src="/img/elements/dots-line.png" alt="" class="dots-line" />
            <div class="laws-icon1">
              <img src="/img/icons/law-img1.svg" alt="" />
            </div>
            <div class="circle-img">
              <img src="/img/elements/circle1.png" alt="" />
            </div>
            <h3>1</h3>
            <div class="work-progress-content">
              <img src="/img/elements/polygon4.png" alt="" />
              <a href="{{ route('second', ['service', 'single']) }}">Enroll & Learn</a>
              <p>Join our comprehensive legal education programs. Access structured courses taught by industry experts and learn at your own pace with flexible schedules.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1000">
          <div class="work3-boxarea text-center">
            <img src="/img/elements/dots-line.png" alt="" class="dots-line" />
            <div class="laws-icon1">
              <img src="/img/icons/law-img2.svg" alt="" />
            </div>
            <div class="circle-img">
              <img src="/img/elements/circle1.png" alt="" />
            </div>
            <h3>2</h3>
            <div class="work-progress-content">
              <img src="/img/elements/polygon4.png" alt="" />
              <a href="{{ route('second', ['service', 'single']) }}">Practice & Internship</a>
              <p>Gain hands-on experience through internships, moot courts, and live client counseling sessions. Build practical legal skills in real-world scenarios.</p>
            </div>
          </div>
        </div>

        <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-duration="1200">
          <div class="work3-boxarea text-center">
            <div class="laws-icon1">
              <img src="/img/icons/law-img3.svg" alt="" />
            </div>
            <div class="circle-img">
              <img src="/img/elements/circle1.png" alt="" />
            </div>
            <h3>3</h3>
            <div class="work-progress-content">
              <img src="/img/elements/polygon4.png" alt="" />
              <a href="{{ route('second', ['service', 'single']) }}">Career & Success</a>
              <p>Get placed at top law firms and corporations. Receive career guidance, networking opportunities, and launch your successful legal career.</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== WORKS ENDS ======= -->

  <!-- ===== CONTACT STARTS ======= -->
  <div class="contact3-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="contcat3-header text-center">
            <span data-aos="fade-up" data-aos-duration="600">Get Course Information</span>
            <h2 class="text-capitalize" data-aos="fade-up" data-aos-duration="800">Interested in Our Legal Education Programs?</h2>
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-6" data-aos="flip-left" data-aos-duration="1000">
          <div class="contact3-images">
            <img src="/img/images/contact-img1.png" alt="" />
          </div>
        </div>
        <div class="col-lg-6" data-aos="zoom-out" data-aos-duration="1200">
          <div class="contact3-boxarea">
            <div class="contact3-all-boxarea">
              <div class="message-img">
                <img src="/img/icons/messege1.svg" alt="" />
              </div>
              <h3 class="text-center">Request Course Information</h3>
              <div class="contact3-content-area">
                <div class="contcat3-input">
                  <input type="text" placeholder="Full Name*" />
                </div>
                <div class="contcat3-input">
                  <input type="email" placeholder="Email Address*" />
                </div>
                <div class="contcat3-input">
                  <input type="text" placeholder="Program of Interest*" />
                </div>
                <div class="contcat3-input">
                  <textarea cols="30" rows="10" placeholder="Tell us about your legal career goals*"></textarea>
                </div>
              </div>
              <div class="div" style="text-align: end;">
                <button type="submit" class="text-right contactbtn1">Send Inquiry <i class="fa-light fa-arrow-right"></i></button>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== CONTACT ENDS ======= -->

  <!-- ===== TESTIMONIAL STARTS ======= -->
  <div class="testimonial3-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="testimonial3-header text-center">
            <span data-aos="fade-up" data-aos-duration="600">Success Stories</span>
            <h2 data-aos="fade-up" data-aos-duration="800">Hear From Our Successful Alumni</h2>
          </div>
        </div>
      </div>
      <div class="row align-items-center">
        <div class="col-lg-2" data-aos="fade-up" data-aos-duration="1000">
          <div class="testimonial-img3 d-lg-block d-none">
            <img src="/img/icons/testimonial-img1.svg" alt="" />
          </div>
        </div>

        <div class="col-lg-10">
          <div class="testimonial-sliders">
            <div class="row">
              <div class="col-lg-2">
                <div class="slider-galeria-thumbs text-center d-lg-block d-none">
                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="600">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="700">
                    <img src="/img/images/testimonial3-img2.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="800">
                    <img src="/img/images/testimonial3-img3.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="900">
                    <img src="/img/images/testimonial3-img4.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="1000">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>

                  <div class="testimonial3-sliders-img" data-aos="fade-left" data-aos-duration="600">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img2.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img3.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img4.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>

                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img2.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img3.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img4.png" alt="" />
                  </div>
                  <div class="testimonial3-sliders-img">
                    <img src="/img/images/testimonial3-img1.png" alt="" />
                  </div>
                </div>
              </div>
              <div class="col-lg-10" data-aos="fade-up" data-aos-duration="1000">
                <div class="slider-galeria">
                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>
                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>"I cannot express how grateful I am for the legal has expertise and support provided by Your Law Firm to Name. Facing criminal charges was a nightmare, but their team was a beacon of hope my darkest”</p>
                    <div class="testimonial3-man-info-area">
                      <div class="mans-img">
                        <img src="/img/images/testimonial3-img2.png" alt="" />
                      </div>
                      <div class="man3-text">
                        <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stokes</a>
                        <p>Owner Taxfirm</p>
                      </div>
                    </div>
                  </div>
                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>"I cannot express how grateful I am for the legal has expertise and support provided by Your Law Firm to Name. Facing criminal charges was a nightmare, but their team was a beacon of hope my darkest”</p>
                    <div class="testimonial3-man-info-area">
                      <div class="mans-img">
                        <img src="/img/images/testimonial3-img3.png" alt="" />
                      </div>
                      <div class="man3-text">
                        <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stokes</a>
                        <p>Owner Taxfirm</p>
                      </div>
                    </div>
                  </div>
                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>"I cannot express how grateful I am for the legal has expertise and support provided by Your Law Firm to Name. Facing criminal charges was a nightmare, but their team was a beacon of hope my darkest”</p>
                    <div class="testimonial3-man-info-area">
                      <div class="mans-img">
                        <img src="/img/images/testimonial3-img4.png" alt="" />
                      </div>
                      <div class="man3-text">
                        <a href="{{ route('second', ['pages', 'team1']) }}">Ben Stokes</a>
                        <p>Owner Taxfirm</p>
                      </div>
                    </div>
                  </div>
                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>

                  <div class="testimonial3-slider-content-area">
                    <div class="testimonial3-author-area">
                      <ul>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                        <li>
                          <a href=""><i class="fa-solid fa-star"></i></a>
                        </li>
                      </ul>
                      <img src="/img/icons/quito3.svg" alt="" />
                    </div>
                    <p>”This program transformed my legal knowledge and career prospects. The faculty was exceptional and the practical training prepared me perfectly for my role at the law firm. I'm grateful for the strong foundation.”</p>
                    <div class=”testimonial3-man-info-area”>
                      <div class=”mans-img”>
                        <img src=”/img/images/testimonial3-img1.png” alt=”” />
                      </div>
                      <div class=”man3-text”>
                        <a href=”{{ route('second', ['pages', 'team1']) }}”>Priya Sharma</a>
                        <p>Associate, XYZ Law Firm</p>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="testimonial-arrows">
                  <div class="testimonial-prev-arrow">
                    <button><i class="fa-solid fa-arrow-left"></i></button>
                  </div>
                  <div class="testimonial-next-arrow">
                    <button><i class="fa-solid fa-arrow-right"></i></button>
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
  <div class="blog3-section-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="blog3-header text-center">
            <span data-aos="fade-up" data-aos-duration="600">Learning Resources</span>
            <h2 data-aos="fade-up" data-aos-duration="800">Latest Articles, Case Studies & Legal Insights</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6" data-aos="fade-right" data-aos-duration="1000">
          <div class="blog3-boxarea">
            <div class="blog3-img1">
              <img src="/img/images/blog3-img1.png" alt="" />
            </div>
            <div class="blog3-content-area">
              <div class="calender-content">
                <img src="/img/icons/calender1.svg" alt="" />
                <div class="blog3-pera">
                  <a href="#">10 October 2024</a>
                </div>
              </div>
              <a href="{{ route('second', ['blog', 'single']) }}">Understanding Constitutional Law: A Comprehensive Guide</a>
              <p>Learn about key constitutional principles that shape Indian law. This guide covers fundamental rights, directive principles of state policy, and amendment procedures.</p>
              <a href="{{ route('second', ['blog', 'single']) }}" class="learnmore">Learn More <i class="fa-regular fa-arrow-right"></i></a>
            </div>
          </div>
        </div>

        <div class="col-lg-6 col-md-6" data-aos="fade-left" data-aos-duration="1200">
          <div class="blog3-boxarea">
            <div class="blog3-img1">
              <img src="/img/images/blog3-img2.png" alt="" />
            </div>
            <div class="blog3-content-area">
              <div class="calender-content">
                <img src="/img/icons/calender1.svg" alt="" />
                <div class="blog3-pera">
                  <a href="#">10 October 2024</a>
                </div>
              </div>
              <a href="{{ route('second', ['blog', 'single']) }}">Understanding Constitutional Law: A Comprehensive Guide</a>
              <p>Learn about key constitutional principles that shape Indian law. This guide covers fundamental rights, directive principles of state policy, and amendment procedures.</p>
              <a href="{{ route('second', ['blog', 'single']) }}" class="learnmore">Learn More <i class="fa-regular fa-arrow-right"></i></a>
            </div>
          </div>
        </div>
        <div class="col-lg-12" data-aos="fade-up" data-aos-duration="1200">
          <div class="div text-center">
            <a href="{{ route('second', ['blog', 'single']) }}" class="casebtn1">Explore More Resources <span><i class="fa-regular fa-arrow-right"></i></span></a>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== BLOG ENDS ======= -->
@endsection
