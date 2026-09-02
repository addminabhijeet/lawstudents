@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
    <!-- ===== WELCOME STARTS======= -->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none" />
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>About Us</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> About Us</a>
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
                        <h2>Law Students was created to empower aspiring legal professionals:</h2>
                        <p>Our platform helps students gain practical legal knowledge, build expertise in various law
                            domains, and prepare for successful careers.</p>
                        <div class="about3-textarea-list">
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Expert
                                        Instructors & Knowledge</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Comprehensive
                                        Curriculum</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Hands-on
                                        Learning</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Career
                                        Advancement</a>
                                </li>
                            </ul>
                        </div>
                        <div class="about3-pera-text">
                            <p>We provide interactive courses, case studies, and mentorship programs so that students can
                                apply legal knowledge practically and confidently in real-world scenarios.</p>
                        </div>
                        <div class="div">
                            <a href="" class="casebtn1">Enroll Now <span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
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

    <!-- ===== ABOUT LAWSTUDENT SECTION STARTS ======= -->
    <style>
        .about-lawstudent-section {
            background: linear-gradient(135deg, #f8f9fa 0%, #f0f3f7 100%);
            padding: 80px 20px;
        }

        .about-lawstudent-container {
            max-width: 1000px;
            margin: 0 auto;
        }

        .about-lawstudent-content {
            background: white;
            padding: 50px 40px;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        }

        .about-lawstudent-heading {
            font-size: 36px;
            font-weight: 700;
            color: #1a1a1a;
            margin-bottom: 30px;
            font-family: 'Poppins', sans-serif;
            text-align: center;
            position: relative;
            padding-bottom: 20px;
        }

        .about-lawstudent-heading::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, #ff5722 0%, #ff7a50 100%);
            border-radius: 2px;
        }

        .about-lawstudent-intro {
            font-size: 15px;
            line-height: 1.9;
            color: #555;
            text-align: center;
            margin: 0;
            max-width: 900px;
            margin: 0 auto;
        }

        .about-lawstudent-intro strong {
            color: #ff5722;
            font-weight: 600;
        }

        .about-lawstudent-features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 25px;
            margin-top: 50px;
            padding-top: 40px;
            border-top: 1px solid #e8e8e8;
        }

        .feature-item {
            text-align: center;
            padding: 0 15px;
        }

        .feature-icon {
            width: 50px;
            height: 50px;
            background: rgba(255, 87, 34, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 15px;
            font-size: 24px;
        }

        .feature-title {
            font-size: 16px;
            font-weight: 600;
            color: #2c3e50;
            margin-bottom: 8px;
        }

        .feature-text {
            font-size: 13px;
            color: #777;
            line-height: 1.6;
        }

        @media (max-width: 768px) {
            .about-lawstudent-section {
                padding: 60px 15px;
            }

            .about-lawstudent-content {
                padding: 35px 25px;
            }

            .about-lawstudent-heading {
                font-size: 28px;
                margin-bottom: 25px;
            }

            .about-lawstudent-intro {
                font-size: 14px;
            }

            .about-lawstudent-features {
                grid-template-columns: 1fr;
                gap: 20px;
                margin-top: 40px;
                padding-top: 30px;
            }
        }
    </style>

    <div class="about-lawstudent-section">
        <div class="about-lawstudent-container">
            <div class="about-lawstudent-content">
                <h2 class="about-lawstudent-heading">Welcome to LawStudent</h2>

                <p class="about-lawstudent-intro">
                    <strong>LawStudent</strong> is an educational and knowledge platform dedicated to students, aspirants and
                    professionals pursuing legal and professional education. The platform provides structured courses,
                    study materials, Bare Acts, Rules, Notifications, legal knowledge resources and examination-
                    oriented preparation.
                </p>

                <div class="about-lawstudent-features">
                    <div class="feature-item">
                        <div class="feature-icon">📚</div>
                        <div class="feature-title">Comprehensive Courses</div>
                        <div class="feature-text">Structured learning programs designed for all levels</div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">📖</div>
                        <div class="feature-title">Study Materials</div>
                        <div class="feature-text">Curated resources and study guides</div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">⚖️</div>
                        <div class="feature-title">Legal Knowledge</div>
                        <div class="feature-text">Bare Acts, Rules, and legal resources</div>
                    </div>

                    <div class="feature-item">
                        <div class="feature-icon">📢</div>
                        <div class="feature-title">Notifications</div>
                        <div class="feature-text">Latest updates and important notices</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- ===== ABOUT LAWSTUDENT SECTION ENDS ======= -->

    <!-- ===== SERVICE STARTS======= -->
    <div class="about-servce-section-area sp1">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="about-service-area">
                        <div class="about-img1">
                            <img src="/img/images/about-inner-img1.png" alt="Law Course Students" />
                        </div>
                        <div class="about-img2 aniamtion-key-1">
                            <img src="/img/images/about-inner-img2.png" alt="Interactive Learning" />
                        </div>
                        <div class="eleemntors30 d-lg-inline-block d-none">
                            <img src="/img/elements/elementor30.png" alt="Decorative Element" />
                        </div>
                        <div class="experiance-area">
                            <h4><span class="counter">10</span>+</h4>
                            <p>Years of Legal Education Experience</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-1"></div>
                <div class="col-lg-6">
                    <div class="about-service-content">
                        <h2>Learn From Expert Legal Educators & Advance Your Career</h2>
                        <p>Welcome to Law Students, where aspiring lawyers gain practical knowledge, career-ready skills,
                            and in-depth understanding of diverse legal domains. Our platform is designed to empower
                            students to excel in law exams, internships, and professional practice.</p>
                        <p>Our courses combine theoretical insights with practical case studies, mentorship programs, and
                            interactive sessions, ensuring you’re confident and well-prepared for the real-world legal
                            environment.</p>
                        <div class="about3-textarea-list">
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Expert
                                        Instructors & Knowledge</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Comprehensive
                                        Curriculum</a>
                                </li>
                            </ul>
                            <ul>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Practical
                                        Learning</a>
                                </li>
                                <li>
                                    <a href="#"><img src="/img/icons/check-img2.svg" alt="" />Career
                                        Advancement</a>
                                </li>
                            </ul>
                        </div>
                        <div class="div">
                            <a href="" class="casebtn1">Enroll in Courses <span><i
                                        class="fa-regular fa-arrow-right"></i></span></a>
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
                        <span>Our Journey</span>
                        <h2>Law Students Platform History</h2>
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
                                            <img src="/img/images/history-img1.png" alt="2017 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2017 - Platform Founded</h2>
                                            <p><span>Our Mission:</span> We launched Law Students to help aspiring lawyers
                                                gain practical knowledge and build a strong foundation in legal studies.</p>
                                            <p><span>First Courses:</span> Initial courses in criminal law, civil law, and
                                                constitutional law were introduced, helping students learn from expert
                                                instructors.</p>
                                            <p><span>Community:</span> We began building an online community for students to
                                                discuss cases, ask questions, and share resources.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="two" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img2.png" alt="2018 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2018 - Expanded Curriculum</h2>
                                            <p><span>New Courses:</span> Launched specialized courses in business law,
                                                intellectual property, and personal injury law.</p>
                                            <p><span>Interactive Learning:</span> Introduced case studies, quizzes, and
                                                assignments for practical learning.</p>
                                            <p><span>Mentorship:</span> Connected students with experienced mentors to guide
                                                their career paths.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="three" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img3.png" alt="2019 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2019 - Online Platform Launch</h2>
                                            <p><span>Platform Go-Live:</span> Launched the interactive online learning
                                                platform for students worldwide.</p>
                                            <p><span>Live Sessions:</span> Introduced live webinars and interactive Q&A
                                                sessions with expert lawyers.</p>
                                            <p><span>Student Growth:</span> Enrolled over 2,000 students in the first year
                                                of online courses.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="four" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img1.png" alt="2020 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2020 - Career Support Added</h2>
                                            <p><span>Internship Programs:</span> Partnered with law firms to provide
                                                students with internship opportunities.</p>
                                            <p><span>Career Guidance:</span> Introduced resume workshops and interview
                                                preparation for law students.</p>
                                            <p><span>Interactive Tools:</span> Launched legal research tools and case study
                                                libraries for advanced learning.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="five" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img2.png" alt="2021 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2021 - Global Expansion</h2>
                                            <p><span>International Students:</span> Opened courses for students across
                                                multiple countries.</p>
                                            <p><span>New Subjects:</span> Added courses in environmental law, labor law, and
                                                cyber law.</p>
                                            <p><span>Certification:</span> Introduced verified course certificates for
                                                career credibility.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="six" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img3.png" alt="2022 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2022 - Interactive & Personalized Learning</h2>
                                            <p><span>AI Assistance:</span> Introduced AI-powered quizzes and feedback for
                                                personalized learning.</p>
                                            <p><span>Live Workshops:</span> Hosted specialized workshops with legal experts
                                                and judges.</p>
                                            <p><span>Student Success:</span> Thousands of students completed courses and
                                                advanced into internships or law schools.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div id="seven" class="Tabcondent">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <div class="tabs-images">
                                            <img src="/img/images/history-img1.png" alt="2023 Milestone" />
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="tabs-history-content">
                                            <h2>2023 - Continuing Growth</h2>
                                            <p><span>New Features:</span> Launched mentorship programs, live case
                                                competitions, and career webinars.</p>
                                            <p><span>Global Recognition:</span> Law Students became a leading online
                                                platform for aspiring legal professionals.</p>
                                            <p><span>Future Plans:</span> Expanding course offerings, AI-driven learning,
                                                and international collaboration with law schools.</p>
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
                        <span>Our Instructors</span>
                        <h2>Meet Our Expert Law Course Team</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="team2-parent-boxarea">
                        <div class="team2-boxarea">
                            <div class="team2images">
                                <img src="/img/images/team-inner2.png" alt="Alex Ferguson - Criminal Law" />
                            </div>
                            <div class="team2-social-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team2-textarea">
                            <div class="teamsname">
                                <a href="">Alex Ferguson</a>
                                <p>Criminal Law Expert</p>
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
                                <img src="/img/images/team-inner3.png" alt="Richard Stones - Corporate Law" />
                            </div>
                            <div class="team2-social-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team2-textarea">
                            <div class="teamsname">
                                <a href="">Richard Stones</a>
                                <p>Corporate Law Instructor</p>
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
                                <img src="/img/images/team-inner4.png" alt="Pep Guardiola - Tax & Compliance" />
                            </div>
                            <div class="team2-social-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team2-textarea">
                            <div class="teamsname">
                                <a href="">Pep Guardiola</a>
                                <p>Tax & Compliance Specialist</p>
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
                                <img src="/img/images/team-inner1.png" alt="Samantha Lee - Civil Law" />
                            </div>
                            <div class="team2-social-links">
                                <ul>
                                    <li><a href="#"><i class="fa-brands fa-x-twitter"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-linkedin"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                                    <li><a href="#"><i class="fa-brands fa-facebook-f"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="team2-textarea">
                            <div class="teamsname">
                                <a href="">Samantha Lee</a>
                                <p>Civil Law Instructor</p>
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
