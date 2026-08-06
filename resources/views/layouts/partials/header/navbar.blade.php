<!--===== RESPONSIVE HEADER STYLES =======-->
<style>
    /* Responsive logo sizing */
    .site-logo {
        width: 350px !important;
    }

    /* Tablets and smaller desktops */
    @media (max-width: 1399px) {
        .site-logo {
            width: 300px !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 6px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 13px;
            padding: 8px 10px;
        }
    }

    /* Medium screens */
    @media (max-width: 1199px) {
        .site-logo {
            width: 260px !important;
        }

        .header-top-area {
            margin-bottom: 8px;
        }

        .social-area {
            gap: 8px !important;
            flex-wrap: wrap !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 4px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 12px;
            padding: 6px 8px;
        }
    }

    /* Smaller medium screens */
    @media (max-width: 1024px) {
        .site-logo {
            width: 240px !important;
        }

        .header-elements {
            gap: 8px;
        }

        .main-menu-ex.homepage6 ul {
            gap: 3px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 11px;
            padding: 5px 6px;
        }

        .contact-3 {
            order: -1;
        }
    }

    /* Adjust header top spacing */
    .header-top-border {
        padding: 12px 0 !important;
    }

    @media (max-width: 1199px) {
        .header-top-border {
            padding: 8px 0 !important;
        }
    }

    /* Ensure menu doesn't overlap with logo */
    .header-elements {
        display: flex;
        align-items: center;
        gap: 12px;
        flex-wrap: nowrap;
        justify-content: space-between;
        width: 100%;
    }

    @media (max-width: 1199px) {
        .header-elements {
            gap: 10px;
            flex-wrap: nowrap;
            justify-content: space-between;
        }
    }

    @media (max-width: 1024px) {
        .header-elements {
            gap: 8px;
            justify-content: space-between;
        }
    }

    /* Main menu responsive */
    .main-menu-ex.homepage6 {
        flex: 1;
        min-width: 0;
        overflow: hidden;
    }

    .main-menu-ex.homepage6 ul {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        gap: 10px;
        margin: 0;
        padding: 0;
        list-style: none;
        justify-content: flex-start;
    }

    /* Email and phone responsive wrapping */
    .social-area ul {
        flex-wrap: wrap;
    }

    @media (max-width: 1199px) {
        .social-area {
            order: 3;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
        }

        .social-area ul {
            width: 100%;
        }
    }

    /* Contact area responsive */
    .col-lg-4 {
        display: flex;
        align-items: center;
    }

    @media (max-width: 1199px) {
        .col-lg-4 {
            margin-top: 10px;
            width: 100%;
        }
    }

    /* Prevent text overflow */
    .top-content-area .content p,
    .social-area a {
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    /* Header row responsive gaps */
    .header-top-area .row {
        row-gap: 8px;
    }

    @media (max-width: 1199px) {
        .header-top-area .row {
            row-gap: 12px;
        }
    }

    /* Email text truncation on smaller screens */
    @media (max-width: 1024px) {
        .social-area a {
            font-size: 12px;
        }

        .social-area a span {
            max-width: 150px;
            display: inline-block;
            overflow: hidden;
            text-overflow: ellipsis;
        }
    }

    /* Ensure contact area doesn't cause horizontal scroll */
    .header-top-area {
        overflow: hidden;
    }

    /* Menu items font size adjustment */
    .main-menu-ex.homepage6 ul li a {
        font-size: 14px;
        display: inline-block;
        padding: 8px 10px;
        white-space: nowrap;
        transition: all 0.3s ease;
    }

    /* Prevent horizontal overflow on smaller screens */
    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul li a {
            padding: 5px 6px !important;
            font-size: 11px !important;
            letter-spacing: -0.3px;
        }

        .main-menu-ex.homepage6 ul li:last-child a {
            padding: 5px 8px !important;
        }
    }

    /* Hide scrollbar if it appears */
    .main-menu-ex.homepage6::-webkit-scrollbar {
        display: none;
    }

    .main-menu-ex.homepage6 {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    /* Spacing between header sections */
    .header-elements {
        min-height: 85px;
        padding: 5px 0;
    }

    /* Prevent logo distortion */
    .site-logo img {
        max-width: 100%;
        max-height: 100%;
        display: block;
    }

    /* Optimize menu layout */
    .main-menu-ex.homepage6 ul li {
        flex-shrink: 0;
    }

    /* Hamburger menu position */
    .header__bar-icon {
        min-width: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    /* Large desktop screens */
    @media (min-width: 1600px) {
        .site-logo {
            width: 380px !important;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 15px;
            padding: 10px 12px;
        }

        .main-menu-ex.homepage6 ul {
            gap: 8px;
        }
    }

    /* Tablet layouts - better spacing */
    @media (min-width: 1200px) and (max-width: 1399px) {
        .header-elements {
            gap: 10px;
        }
    }

    /* Additional small screen adjustments */
    @media (max-width: 991px) {
        .site-logo {
            width: 240px !important;
        }

        .main-menu-ex.homepage6 {
            display: none;
        }

        .header {
            display: none !important;
        }
    }

    /* Remove scrollbar indicator styling */
    .main-menu-ex.homepage6::-webkit-scrollbar-track {
        background: transparent;
    }

    .main-menu-ex.homepage6::-webkit-scrollbar-thumb {
        background: transparent;
    }
</style>

<!--===== HEADER STARTS =======-->
<header class="header d-none d-lg-block" style="position:relative; z-index:999;">
    <div class="header-area header homepage7 header-sticky" id="header" style="position:relative; top:auto;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-top-area">
                        <div class="header-top-border"
                            style="background-image: url(/img/bacground/header7-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
                            <div class="row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px;">
                                <div class="col-lg-6" style="flex: 0 1 auto; min-width: 0;">
                                    <div class="top-content-area">
                                        <div class="content">
                                            <p style="margin: 0; word-break: break-word; overflow-wrap: break-word;">Start your journey into the world of law today.<a
                                                    href="{{ route('frontend.contact') }}">Contact Us</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2" style="display: none;"></div>
                                <div class="col-lg-4" style="flex: 1 1 auto; min-width: auto; display: flex; align-items: center; justify-content: flex-end;">
                                    @php
                                        $user = \App\Models\User::first();
                                        $email = !empty($user->webemail) ? $user->webemail : 'email@gmail.com';
                                        $mobile = !empty($user->mobile) ? $user->mobile : '9876543210';
                                        $twitter = !empty($user->twitter) ? $user->twitter : '9876543210';
                                        $pinterest = !empty($user->pinterest) ? $user->pinterest : '9876543210';
                                        $instagram = !empty($user->instagram) ? $user->instagram : '9876543210';
                                        $facebook = !empty($user->facebook) ? $user->facebook : '9876543210';
                                        $linkedin = !empty($user->linkedin) ? $user->linkedin : '9876543210';
                                        $description = !empty($user->description)
                                            ? $user->description
                                            : 'Revolutionize Your Future: Harness the Power of Technology for Unparalleled
                                            Growth and Success!';
                                    @endphp

                                    <div class="social-area"
                                        style="display:flex; align-items:center; gap:20px; flex-wrap:wrap; white-space:normal;">

                                        <ul style="display:flex; align-items:center; margin:0; padding:0; white-space: nowrap;">
                                            <li style="list-style:none;">
                                                <a href="mailto:{{ $email }}"
                                                    style="display:flex; align-items:center; gap:8px; font-size: 13px; white-space: nowrap;">
                                                    <img src="/img/icons/email3.svg" alt="" style="min-width: 16px;">
                                                    <span style="overflow: hidden; text-overflow: ellipsis;">{{ $email }}</span>
                                                </a>
                                            </li>
                                        </ul>

                                        <ul class="list"
                                            style="display:flex; align-items:center; margin:0; padding:0; white-space: nowrap;">
                                            <li style="list-style:none;">
                                                <a href="tel:{{ $mobile }}"
                                                    style="display:flex; align-items:center; gap:8px; font-size: 13px; white-space: nowrap;">
                                                    <img src="/img/icons/phone3.svg" alt="" style="min-width: 16px;">
                                                    {{ $mobile }}
                                                </a>
                                            </li>
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-elements" style="display: flex; align-items: center; justify-content: space-between; width: 100%; gap: 15px; flex-wrap: nowrap;">
                            <div class="site-logo"
                                style="width:350px; height:90px; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink: 0;">
                                <a href="" style="display:block; width:100%; height:100%;">
                                    <img src="assets/images/logo-full.png" alt=""
                                        style="width:100%; height:100%; object-fit:contain;">
                                </a>
                            </div>
                            <div class="main-menu-ex homepage6" style="flex: 1; min-width: 0; overflow: hidden;">
                                <ul style="display: flex; flex-wrap: wrap; align-items: center; gap: 10px; margin: 0; padding: 0; list-style: none;">
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.home') }}" class=" mainhome" style="white-space: nowrap;">Home</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.about') }}" style="white-space: nowrap;">About Us</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.acts') }}" style="white-space: nowrap;">Acts</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.rules') }}" style="white-space: nowrap;">Rules</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.copys') }}" style="white-space: nowrap;">Free Notes</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.clientele') }}" style="white-space: nowrap;">Client</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.course') }}" style="white-space: nowrap;">Course</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.gallery') }}" style="white-space: nowrap;">Gallery</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.contact') }}" style="white-space: nowrap;">Contact Us</a></li>
                                    <li style="list-style: none; flex-shrink: 0;">
                                        <a href="{{ route('login') }}" class="btn"
                                            style="background-color:#ff5722; color:#fff; border-color:#ff5722; white-space: nowrap;">
                                            Login
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-3 d-lg-block d-none" style="flex-shrink: 0;">
                                <div class="consulting2 consulting3">
                                    <div class="marginsp1"></div>
                                    <a class="header__bar hamburger_menu header__bar-icon header_bar5"
                                        href="javascript:void(0);">
                                        <i class="fa-solid fa-bars"></i>
                                    </a>
                                </div>
                            </div>
                            <!--===== SIDEBAR STARTS =======-->
                            <aside class="slide-bar slide-bar6">
                                <div class="close-mobile-menu">
                                    <a class="tx-close"></a>
                                </div>
                                <div class="sidebar-info sidebar-info6">
                                    <div class="sidebar-logo mb-30">
                                        <a href="">
                                            <img src="/img/logo/logo11.png" alt="logo">
                                        </a>
                                    </div>
                                    <div class="sidebar-content">
                                        <p>{{ $description }}</p>
                                    </div>

                                    <div class="sidebar-contact-header">
                                        <h3>Contact Info</h3>
                                        <div class="sidebar-footer-area">
                                            <div class="sidebar-author-area">
                                                <div class="phone-side">
                                                    <img src="/img/icons/phone1.svg" alt="">
                                                </div>
                                                <div class="phone-side">
                                                    <a href="tel:{{ $mobile }}">{{ $mobile }}</a>
                                                </div>
                                            </div>
                                            <div class="sidebar-author-area">
                                                <div class="phone-side">
                                                    <img src="/img/icons/email1.svg" alt="">
                                                </div>
                                                <div class="phone-side">
                                                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <h3 class="sidebar-heading">Social Links</h3>
                                    <ul class="social-links">
                                        <li><a href="{{ $linkedin }}"><i class="fa-brands fa-linkedin"></i></a>
                                        </li>
                                        <li><a href="{{ $facebook }}"><i class="fa-brands fa-facebook"></i></a>
                                        </li>
                                        <li><a href="{{ $twitter }}"><i class="fa-brands fa-x-twitter"></i></a>
                                        </li>
                                        <li><a href="{{ $instagram }}"><i class="fa-brands fa-instagram"></i></a>
                                        </li>
                                        <li><a href="{{ $pinterest }}"><i class="fa-brands fa-pinterest"></i></a>
                                        </li>
                                    </ul>
                                </div>
                                <nav class="side-mobile-menu">
                                    <div class="header-mobile-search">
                                        <form role="search" method="get" action="#">
                                            <input type="text" placeholder="Search Keywords">
                                            <button type="submit"><i class="ti-search"></i></button>
                                        </form>
                                    </div>
                                    <ul id="mobile-menu-active">
                                        <li class="dropdown"><a href="">Home</a>
                                            <ul class="sub-menu">
                                                <li><a href="">Home Chatbot</a></li>
                                                <li><a href="home-2">Home CRM</a></li>
                                                <li class="active"><a href="home-3">Home Copy Writing</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="scrollspy-btn" href="#whatwedo">What we do</a></li>
                                        <li><a class="scrollspy-btn" href="#process">Process</a></li>
                                        <li class="dropdown">
                                            <a href="#!">Blog</a>
                                            <ul class="sub-menu">
                                                <li><a href="blog">Blog</a></li>
                                                <li><a href="">Blog
                                                        Details</a></li>
                                            </ul>
                                        </li>
                                        <li><a class="scrollspy-btn" href="contact">Get in touch</a></li>
                                    </ul>
                                </nav>
                            </aside>
                            <div class="header-search-form-wrapper">
                                <div class="tx-search-close tx-close"><i class="fa-solid fa-xmark"></i></div>
                                <div class="header-search-container">
                                    <form role="search" class="search-form">
                                        <input type="search" class="search-field" placeholder="Search …"
                                            value="" name="s">
                                        <button type="submit" class="search-submit"><i
                                                class="fa-solid fa-magnifying-glass"></i></button>
                                    </form>
                                </div>
                            </div>
                            <div class="body-overlay"></div>
                            <!--===== SIDEBAR ENDS =======-->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!--===== HEADER ENDS =======-->

<!--===== MOBILE HEADER STARTS =======-->
<div class="mobile-header mobile-homepage6 d-block d-lg-none">
    <div class="container-fluid">
        <div class="col-12">
            <div class="mobile-header-elements">
                <div class="mobile-logo">
                    <a href=""><img src="/img/logo/logo11.png" alt=""></a>
                </div>
                <div class="mobile-nav-icon dots-menu">
                    <i class="fa-solid fa-bars"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-sidebar sidebar6">
    <div class="logosicon-area">
        <div class="logos">
            <img src="/img/logo/logo11.png" alt="">
        </div>
        <div class="menu-close">
            <i class="fa-solid fa-xmark"></i>
        </div>
    </div>
    <div class="mobile-nav">

        <ul class="mobile-nav-list">
            <li><a href="#">Home </a>
                <ul class="sub-menu">
                    <li><a href="">Home One</a></li>
                </ul>
            </li>
            <li><a href="#">Pages</a>
                <ul class="sub-menu">
                    <li><a href="">Our Team 01</a></li>
                </ul>
            </li>
            <li><a href="#">Practice Areas</a>
                <ul class="sub-menu">
                    <li><a href="">Service One</a></li>

                </ul>
            </li>

            <li><a href="#">Blogs </a>
                <ul class="sub-menu">
                    <li><a href="">Blog One</a></li>
                </ul>
            </li>
            <li><a href="">Contact</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('frontend.contact') }}">Contact</a></li>
                </ul>
            </li>
        </ul>

        <div class="allmobilesection">
            <a href="" class="welcome5-btn">Get Started</a>
            <div class="single-footer">
                <h3>Contact Info</h3>
                <div class="footer4-contact-info">
                    <div class="contact-info-single">
                        <div class="contact-info-icon">
                            <img src="/img/icons/footer-phn.svg" alt="">
                        </div>
                        <div class="contact-info-text">
                            <a href="tel:+3(924)4596512">+3(924)4596512</a>
                        </div>
                    </div>

                    <div class="contact-info-single">
                        <div class="contact-info-icon">
                            <img src="/img/icons/footer-email2.svg" alt="">
                        </div>
                        <div class="contact-info-text">
                            <a href="mailto:info@example.com">info@example.com</a>
                        </div>
                    </div>

                    <div class="single-footer single-footer-menu single-footer4">
                        <h3>Our Location</h3>

                        <div class="contact-info-single">
                            <div class="contact-info-icon">
                                <img src="/img/icons/footer-location1.svg" alt="">
                            </div>
                            <div class="contact-info-text">
                                <a href="mailto:info@example.com">55 East Birchwood Ave.Brooklyn, <br> New York
                                    11201,United States</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== MOBILE HEADER ENDS =======-->
