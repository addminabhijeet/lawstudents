@extends('layouts.landing' , ['title' => 'Lawsy || Criminal Law || About'])

@section('content')
  <!-- ===== WELCOME STARTS======= -->
  <div class="welcome-inner-section-area" style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none" />
    <div class="container">
      <div class="row">
        <div class="col-lg-3 m-auto">
          <div class="welcome-inner-header text-center">
            <h1>About Us</h1>
            <a href="{{ route('any', 'index') }}">Home <span><i class="fa-light fa-angle-right"></i></span> About Us</a>
            <img src="/img/elements/elementor20.png" alt="" />
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== WELCOME ENDS======= -->

  <!-- ===== ABOUT STARTS======= -->
  <div class="about3-section-area about-inner">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6">
          <div class="about3-textarea">
            <span>About Us</span>
            <h2>Navigating & Legal Maze with a Criminal Defense Expert</h2>
            <p>Service providers can differentiate themselves by offering high-quality and reliable services. Airlines, for instance, promote their safety records and.</p>
            <div class="about3-textarea-list">
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Expertise & Knowledge</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Quality & Reliability</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Improved Efficiency</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Environment Benefits</a>
                </li>
              </ul>
            </div>
            <div class="about3-pera-text">
              <p>Some services emphasize environmental sustainability as a benefit, Car-sharing services like Zipcar promote reduced emissions and the use of fewer vehicles, contributing to a greener environment.</p>
            </div>
            <div class="div">
              <a href="{{ route('second', ['pages', 'about']) }}" class="casebtn1">Request Case Evolution <span><i class="fa-regular fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
        <div class="col-lg-6">
          <div class="about3-images-area">
            <img src="/img/images/about-img3.png" alt="" />
            <div class="elementors21">
              <img src="/img/elements/elementor21.png" alt="" />
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== ABOUT ENDS======= -->

  <!-- ===== SERVICE STARTS======= -->
  <div class="about-servce-section-area sp1">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-5">
          <div class="about-service-area">
            <div class="about-img1">
              <img src="/img/images/about-inner-img1.png" alt="" />
            </div>
            <div class="about-img2 aniamtion-key-1">
              <img src="/img/images/about-inner-img2.png" alt="" />
            </div>
            <div class="eleemntors30 d-lg-inline-block d-none">
              <img src="/img/elements/elementor30.png" alt="" />
            </div>
            <div class="experiance-area">
              <h4><span class="counter">25</span>+</h4>
              <p>Years Of Experience</p>
            </div>
          </div>
        </div>
        <div class="col-lg-1"></div>
        <div class="col-lg-6">
          <div class="about-service-content">
            <h2>Expert Criminal Best Defense Lawyers Protecting Future</h2>
            <p>Welcome to Law Firm Name, where your rights, freedom, and future matter most. Our team comprises seasoned criminal defense attorneys dedicated to providing unwavering protection and strategic advocacy for every client.</p>
            <p>Our commitment extends beyond the courtroom - we prioritize best lawyer communication, transparency, and personalized attention, ensuring you're informed & empowered every step of the way. Rest assured, with our Law.</p>
            <div class="about3-textarea-list">
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Expertise & Knowledge</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Quality & Reliability</a>
                </li>
              </ul>
              <ul>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Improved Efficiency</a>
                </li>
                <li>
                  <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Environment Benefits</a>
                </li>
              </ul>
            </div>
            <div class="div">
              <a href="{{ route('second', ['service', 'service1']) }}" class="casebtn1">Secure Your Defense <span><i class="fa-regular fa-arrow-right"></i></span></a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- ===== SERVICE ENDS======= -->

  <!-- ===== ABOUT HISTORY STARTS======= -->
  <div class="about-history-sction-area sp1">
    <div class="container">
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="history-header text-center">
            <span>Company History</span>
            <h2>Our Lawsy History</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-12 m-auto">
          <div class="about-history-tabs">
            <div class="row">
              <div class="col-lg-10 m-auto">
                <nav class="tabs-nav">
                  <a href="javascript:void(0);" data-tab="one" class="active">2017</a>
                  <a href="javascript:void(0);" data-tab="two">2018</a>
                  <a href="javascript:void(0);" data-tab="three">2019</a>
                  <a href="javascript:void(0);" data-tab="four">2020</a>
                  <a href="javascript:void(0);" data-tab="five">2021</a>
                  <a href="javascript:void(0);" data-tab="six">2022</a>
                  <a href="javascript:void(0);" data-tab="seven">2023</a>
                </nav>
              </div>
            </div>

            <div class="tabContainer">
              <div id="one" class="Tabcondent active">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img1.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2017 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="two" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img2.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2018 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="three" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img3.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2019 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="four" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img1.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2020 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="five" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img2.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2021 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="six" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img3.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2022 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
                    </div>
                  </div>
                </div>
              </div>
              <div id="seven" class="Tabcondent">
                <div class="row align-items-center">
                  <div class="col-lg-6">
                    <div class="tabs-images">
                      <img src="/img/images/history-img1.png" alt="" />
                    </div>
                  </div>
                  <div class="col-lg-6">
                    <div class="tabs-history-content">
                      <h2>2023 - Founded In Los Angeles</h2>
                      <p>
                        <span>Drug Trafficking:</span>The distribution, manufacturing, or trafficking of the controlled substances, such as narcotics, cocaine, heroin, or lawsy law methamphetamine, in to be continue violation of the Controlled.
                      </p>
                      <p>
                        <span>White-Collar Crimes:</span> These involve financial or economic crimes, such as fraud, embezzlement, insider trading, tax evasion, and money.
                      </p>
                      <p>
                        <span>Federal Conspiracy:</span> Engaging in a criminal conspiracy that spans multiple states or involves federal agencies can result in federal.
                      </p>
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
  <!-- ===== ABOUT HISTORY ENDS======= -->

  <!-- ===== TEAM STARTS======= -->
  <div class="team2-section-area sp3">
    <div class="container">
      <div class="row">
        <div class="col-lg-6 m-auto">
          <div class="team1-header text-center">
            <span>Our Team</span>
            <h2>Our Expert Law Firm Team</h2>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-lg-3 col-md-6">
          <div class="team2-parent-boxarea">
            <div class="team2-boxarea">
              <div class="team2images">
                <img src="/img/images/team-inner2.png" alt="" />
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

        <div class="col-lg-3 col-md-6">
          <div class="team2-parent-boxarea">
            <div class="team2-boxarea">
              <div class="team2images">
                <img src="/img/images/team-inner3.png" alt="" />
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

        <div class="col-lg-3 col-md-6">
          <div class="team2-parent-boxarea">
            <div class="team2-boxarea">
              <div class="team2images">
                <img src="/img/images/team-inner4.png" alt="" />
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

        <div class="col-lg-3 col-md-6">
          <div class="team2-parent-boxarea">
            <div class="team2-boxarea">
              <div class="team2images">
                <img src="/img/images/team-inner1.png" alt="" />
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
  <!-- ===== TEAM ENDS======= -->
@endsection
