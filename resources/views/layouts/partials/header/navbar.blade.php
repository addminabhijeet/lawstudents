<!--===== HEADER STARTS =======-->
<header class="header d-none d-lg-block" style="position:relative; z-index:999;">
    <div class="header-area header homepage7 header-sticky" id="header" style="position:relative; top:auto;">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="header-top-area">
                        <div class="header-top-border"
                            style="background-image: url(/img/bacground/header7-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="top-content-area">
                                        <div class="content">
                                            <p>Start your journey into the world of law today.<a
                                                    href="{{ route('frontend.contact') }}">Contact Us</a></p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-2"></div>
                                <div class="col-lg-4">
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

                                    <div class="social-area">
                                        <ul>
                                            <li>
                                                <a href="mailto:{{ $email }}">
                                                    <img src="/img/icons/email3.svg" alt="">
                                                    {{ $email }}
                                                </a>
                                            </li>
                                        </ul>

                                        <ul class="list">
                                            <li>
                                                <a href="tel:{{ $mobile }}">
                                                    <img src="/img/icons/phone3.svg" alt="">
                                                    {{ $mobile }}
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="header-elements">
                            <div class="site-logo"
                                style="width:150px; height:60px; display:flex; align-items:center; justify-content:center; overflow:hidden;">
                                <a href="" style="display:block; width:100%; height:100%;">
                                    <img src="assets/images/logo-full.png" alt=""
                                        style="width:100%; height:100%; object-fit:contain;">
                                </a>
                            </div>
                            <div class="main-menu-ex homepage6">
                                <ul>
                                    <li><a href="{{ route('frontend.home') }}" class=" mainhome">Home</a></li>
                                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                    <li><a href="{{ route('frontend.notes') }}">Free Notes</a></li>
                                    <li><a href="{{ route('frontend.course') }}">Clientele</a></li>
                                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                                    <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                                    <li>
                                        <a href="{{ route('login') }}" class="btn"
                                            style="background-color:#ff5722; color:#fff; border-color:#ff5722;">
                                            Login
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-3 d-lg-block d-none">
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
