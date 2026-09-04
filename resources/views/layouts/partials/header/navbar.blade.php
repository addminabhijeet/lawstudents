<!--===== RESPONSIVE HEADER STYLES (IMPROVED) =======-->
<style>
    /* ===== IMPROVED LOGO SIZING (Single Responsive Scale) ===== */
    .site-logo {
        width: 150px !important;
        height: 55px !important;
        flex-shrink: 0;
    }

    @media (max-width: 1399px) {
        .site-logo {
            width: 140px !important;
        }
    }

    @media (max-width: 1199px) {
        .site-logo {
            width: 130px !important;
        }
    }

    @media (max-width: 1024px) {
        .site-logo {
            width: 120px !important;
        }
    }

    @media (max-width: 768px) {
        .site-logo {
            width: 110px !important;
            height: 45px !important;
        }
    }

    @media (max-width: 480px) {
        .site-logo {
            width: 90px !important;
            height: 40px !important;
        }
    }

    @media (min-width: 1600px) {
        .site-logo {
            width: 160px !important;
            height: 60px !important;
        }
    }

    /* ===== IMPROVED HEADER ELEMENTS SPACING ===== */
    .header-elements {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: nowrap;
        justify-content: flex-start;
        width: 100%;
        min-height: 65px;
        padding: 10px 10px !important;
        transition: all 0.3s ease;
    }

    @media (min-width: 576px) {
        .header-elements {
            gap: 8px;
            min-height: 68px;
            padding: 10px 15px !important;
        }
    }

    @media (min-width: 768px) {
        .header-elements {
            gap: 10px;
            min-height: 70px;
            padding: 10px 20px !important;
        }
    }

    @media (min-width: 992px) {
        .header-elements {
            gap: 12px;
            min-height: 72px;
            padding: 10px 30px !important;
        }
    }

    @media (min-width: 1200px) {
        .header-elements {
            gap: 12px;
            min-height: 72px;
            padding: 10px 35px !important;
        }
    }

    /* ===== IMPROVED HEADER TOP AREA SPACING ===== */
    .header-top-border {
        padding: 14px 15px !important;
        margin: 0 !important;
        width: 100% !important;
        box-sizing: border-box !important;
        background-color: #ff5722 !important;
        background-image: none !important;
    }

    @media (min-width: 576px) {
        .header-top-border {
            padding: 14px 20px !important;
        }
    }

    @media (min-width: 768px) {
        .header-top-border {
            padding: 14px 30px !important;
        }
    }

    @media (min-width: 992px) {
        .header-top-border {
            padding: 14px 40px !important;
        }
    }

    @media (min-width: 1200px) {
        .header-top-border {
            padding: 14px 50px !important;
        }
    }

    /* ===== IMPROVED MAIN MENU STYLING (Clean Gaps) ===== */
    .main-menu-ex.homepage6 {
        flex: 1;
        min-width: 0;
        overflow: visible !important;
        order: 2 !important;
        margin-left: auto !important;
        flex-basis: auto !important;
        max-width: fit-content !important;
    }

    .main-menu-ex.homepage6 ul {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        gap: 4px;
        margin: 0;
        padding: 0;
        list-style: none;
        justify-content: flex-start;
    }

    /* Responsive gaps for menu items */
    @media (max-width: 1399px) {
        .main-menu-ex.homepage6 ul {
            gap: 4px;
        }
    }

    @media (max-width: 1199px) {
        .main-menu-ex.homepage6 ul {
            gap: 3px;
        }
    }

    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul {
            gap: 3px;
        }
    }

    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul {
            gap: 2px;
        }
    }

    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul {
            gap: 1px;
        }
    }

    /* ===== IMPROVED MENU ITEMS TYPOGRAPHY ===== */
    .main-menu-ex.homepage6 ul li a {
        font-size: 11px;
        display: inline-block;
        padding: 3px 4px;
        white-space: nowrap;
        transition: all 0.3s ease;
        letter-spacing: 0px;
        line-height: 1.2;
        color: #333 !important;
        font-weight: 500;
    }

    /* Large desktop (1600px+) */
    @media (min-width: 1600px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 12px;
            padding: 3px 5px;
            letter-spacing: 0px;
        }
    }

    /* Desktop (1200px - 1599px) */
    @media (min-width: 1200px) and (max-width: 1599px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 11px;
            padding: 3px 4px;
            letter-spacing: 0px;
        }
    }

    /* Tablet Large (1024px - 1199px) */
    @media (max-width: 1199px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 10px;
            padding: 3px 4px;
            letter-spacing: 0px;
        }
    }

    /* Tablet Small (768px - 1023px) */
    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 10px;
            padding: 2px 3px;
            letter-spacing: 0px;
        }
    }

    /* Mobile Large (480px - 767px) */
    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 9px;
            padding: 2px 3px;
            letter-spacing: 0px;
        }
    }

    /* Mobile Small (< 480px) */
    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 8px;
            padding: 2px 2px;
            letter-spacing: 0px;
        }
    }

    /* ===== IMPROVED HEADER TOP TEXT SCALING ===== */
    .top-content-area .content p {
        color: white !important;
        font-weight: 500 !important;
        font-size: 13px;
        line-height: 1.5;
        margin: 0;
        word-break: break-word;
        overflow-wrap: break-word;
    }

    @media (max-width: 1199px) {
        .top-content-area .content p {
            font-size: 12px;
        }
    }

    @media (max-width: 1024px) {
        .top-content-area .content p {
            font-size: 11px;
        }
    }

    @media (max-width: 768px) {
        .top-content-area .content p {
            font-size: 10px;
        }
    }

    /* ===== IMPROVED SOCIAL AREA (Email & Phone) ===== */
    .social-area {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
        white-space: normal;
    }

    .social-area ul {
        display: flex;
        align-items: center;
        margin: 0;
        padding: 0;
        white-space: nowrap;
        list-style: none;
    }

    .social-area a {
        color: white !important;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 12px;
        text-decoration: none;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .social-area a:hover {
        opacity: 0.85;
    }

    .social-area a span {
        color: white !important;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    @media (max-width: 1199px) {
        .social-area {
            order: 3;
            width: 100%;
            flex-direction: column;
            align-items: flex-start;
            gap: 10px;
        }

        .social-area ul {
            width: 100%;
        }

        .social-area a {
            font-size: 11px;
        }
    }

    @media (max-width: 1024px) {
        .social-area a {
            font-size: 10px;
        }

        .social-area a span {
            max-width: 150px;
            display: inline-block;
        }
    }

    @media (max-width: 768px) {
        .social-area a {
            font-size: 9px;
        }

        .social-area a span {
            max-width: 120px;
        }
    }

    /* ===== IMPROVED LOGIN/REGISTER BUTTON ===== */
    .main-menu-ex.homepage6 ul li .btn {
        background-color: #e64a19 !important;
        color: white !important;
        border-color: #e64a19 !important;
        padding: 4px 8px !important;
        font-size: 10px !important;
        font-weight: 600 !important;
        border-radius: 4px !important;
        transition: all 0.3s ease !important;
        white-space: nowrap !important;
        cursor: pointer !important;
        line-height: 1.2 !important;
        letter-spacing: 0px !important;
    }

    .main-menu-ex.homepage6 ul li .btn:hover {
        background-color: #d43b0a !important;
        border-color: #d43b0a !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
    }

    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 3px 7px !important;
            font-size: 9px !important;
        }
    }

    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 3px 6px !important;
            font-size: 8px !important;
        }
    }

    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 2px 5px !important;
            font-size: 7px !important;
        }
    }

    /* ===== CONTACT AREA STYLING ===== */
    .contact-3 {
        flex-shrink: 0;
        order: 3 !important;
    }

    .col-lg-4 {
        display: flex;
        align-items: center;
        flex: 1 1 auto;
        min-width: auto;
    }

    .header-top-area .row {
        row-gap: 10px;
    }

    /* ===== PREVENT TEXT OVERFLOW ===== */
    .top-content-area .content p,
    .social-area a {
        white-space: normal;
        overflow-wrap: break-word;
        word-break: break-word;
    }

    /* ===== RESPONSIVE MENU LAYOUT ===== */
    @media (max-width: 768px) {
        .header-top-area .row {
            row-gap: 12px;
        }
    }

    /* ===== MENU ITEMS OPTIMIZATION ===== */
    .main-menu-ex.homepage6 ul li {
        flex-shrink: 0;
        list-style: none;
    }

    /* ===== LOGO STYLING ===== */
    .site-logo img {
        max-width: 100%;
        max-height: 100%;
        display: block;
        object-fit: contain;
    }

    /* ===== HAMBURGER MENU STYLING ===== */
    .header__bar-icon {
        min-width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
        cursor: pointer;
    }

    /* ===== CONTACT INFO STYLING ===== */
    .col-lg-4 {
        display: flex;
        align-items: center;
    }

    @media (max-width: 1199px) {
        .col-lg-4 {
            margin-top: 0;
            width: 100%;
        }
    }

    /* ===== HEADER CONTAINER STYLING ===== */
    .container-fluid.px-0 {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    .header-top-area {
        overflow: hidden;
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-bottom: 0;
    }

    /* ===== SCROLLBAR HIDING ===== */
    .main-menu-ex.homepage6::-webkit-scrollbar {
        display: none;
    }

    .main-menu-ex.homepage6 {
        -ms-overflow-style: none;
        scrollbar-width: none;
    }

    .main-menu-ex.homepage6::-webkit-scrollbar-track {
        background: transparent;
    }

    .main-menu-ex.homepage6::-webkit-scrollbar-thumb {
        background: transparent;
    }

    /* ===== DROPDOWN MENU STYLING FOR ACTS & RULES ===== */
    .dropdown-menu-item {
        position: relative !important;
        display: inline-flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
        height: auto !important;
        z-index: 1000 !important;
    }

    .dropdown-menu-item > a {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        white-space: nowrap !important;
        cursor: pointer !important;
    }

    .dropdown-menu-item > a::after {
        content: '▼';
        font-size: 8px;
        display: inline-block;
        transition: transform 0.3s ease;
    }

    .dropdown-menu-item:hover > a::after {
        transform: rotate(180deg);
    }

    /* Dropdown submenu styling */
    .dropdown-submenu {
        position: absolute !important;
        top: calc(100% + 8px) !important;
        left: 0 !important;
        background-color: #fff !important;
        min-width: 160px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        border-radius: 4px !important;
        overflow: hidden !important;
        opacity: 0 !important;
        visibility: hidden !important;
        pointer-events: none !important;
        transition: all 0.3s ease !important;
        z-index: 9999 !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: block !important;
    }

    .dropdown-menu-item:hover .dropdown-submenu {
        opacity: 1 !important;
        visibility: visible !important;
        pointer-events: auto !important;
    }

    .dropdown-submenu li {
        list-style: none !important;
        margin: 0 !important;
        padding: 0 !important;
        display: block !important;
        width: 100% !important;
    }

    .dropdown-submenu li a {
        display: block !important;
        padding: 12px 20px !important;
        color: #333 !important;
        text-decoration: none !important;
        font-size: 13px !important;
        white-space: nowrap !important;
        transition: all 0.3s ease !important;
        width: 100% !important;
        box-sizing: border-box !important;
        line-height: 1.4 !important;
    }

    .dropdown-submenu li a:hover {
        background-color: #f5f5f5 !important;
        color: #ff5722 !important;
        padding-left: 24px !important;
    }

    .dropdown-submenu li:first-child a {
        border-top: none;
    }

    @media (min-width: 768px) {
        .dropdown-submenu li a {
            font-size: 14px !important;
        }
    }

    @media (min-width: 1200px) {
        .dropdown-submenu li a {
            font-size: 15px !important;
        }
    }

    /* Fix overflow clipping of dropdown menu */
    body {
        overflow-x: visible !important;
    }

    .header-area {
        overflow: visible !important;
        position: relative !important;
        z-index: 999 !important;
    }

    .header {
        overflow: visible !important;
    }

    .header-elements {
        overflow: visible !important;
    }

    .container-fluid.px-0 {
        overflow: visible !important;
    }

    .main-menu-ex.homepage6 {
        overflow: visible !important;
    }
</style>

<script>
(function() {
    // Simple font size management
    function getFontSize() {
        const windowWidth = window.innerWidth;
        if (windowWidth >= 1200) {
            return { menu: '16px', tagline: '17px' };
        } else if (windowWidth >= 992) {
            return { menu: '15px', tagline: '16px' };
        } else if (windowWidth >= 768) {
            return { menu: '14px', tagline: '15px' };
        } else if (windowWidth >= 576) {
            return { menu: '13px', tagline: '14px' };
        }
        return { menu: '13px', tagline: '14px' };
    }

    function applyFontSizes() {
        const sizes = getFontSize();
        const style = document.createElement('style');
        style.innerHTML = `
            .main-menu-ex.homepage6 ul li a { font-size: ${sizes.menu} !important; line-height: 1.4 !important; }
            .top-content-area .content p { font-size: ${sizes.tagline} !important; }
        `;
        document.head.appendChild(style);
    }

    // Ensure dropdown containers have overflow visible
    function ensureDropdownVisibility() {
        const menuContainer = document.querySelector('.main-menu-ex.homepage6');
        if (menuContainer) {
            menuContainer.style.overflow = 'visible';
            menuContainer.style.zIndex = '999';
        }

        const headerArea = document.querySelector('.header-area');
        if (headerArea) {
            headerArea.style.overflow = 'visible';
        }

        const header = document.querySelector('.header');
        if (header) {
            header.style.overflow = 'visible';
        }
    }

    // Initialize on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            applyFontSizes();
            ensureDropdownVisibility();
        });
    } else {
        applyFontSizes();
        ensureDropdownVisibility();
    }

    // Reapply on load
    window.addEventListener('load', function() {
        applyFontSizes();
        ensureDropdownVisibility();
    });

    // Reapply on resize
    window.addEventListener('resize', function() {
        applyFontSizes();
    });
})();
</script>

<!--===== HEADER STARTS =======-->
<header class="header d-none d-lg-block" style="position:relative; z-index:999;">
    <div class="header-area header homepage7 header-sticky" id="header" style="position:relative; top:auto;">
        <div class="container-fluid px-0">
            <div class="row g-0">
                <div class="col-12">
                    <div class="header-top-area">
                        <div class="header-top-border"
                            style="background-image: url(/img/bacground/header7-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
                            <div class="row" style="display: flex; flex-wrap: wrap; align-items: center; gap: 8px;">
                                <div class="col-lg-6" style="flex: 0 1 auto; min-width: 0;">
                                    <div class="top-content-area">
                                        <div class="content">
                                            <p style="margin: 0; word-break: break-word; overflow-wrap: break-word;">• Legal Education • Legal Knowledge • Legal Resources</p>
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
                                            : 'Learn Law.
                                            Understand Law.
                                            Build Your Future.';
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
                        <div class="header-elements" style="display: flex; align-items: center; justify-content: flex-start; width: 100%; gap: 15px; flex-wrap: nowrap;">
                            <div class="site-logo"
                                style="width:350px; height:90px; display:flex; align-items:center; justify-content:center; overflow:hidden; flex-shrink: 0;">
                                <a href="" style="display:block; width:100%; height:100%;">
                                    <img src="assets/images/logo-full.png" alt=""
                                        style="width:100%; height:100%; object-fit:contain;">
                                </a>
                            </div>
                            <div class="main-menu-ex homepage6" style="flex: 0 0 auto; min-width: 0; overflow: visible !important; margin-left: auto !important;">
                                <ul style="display: flex; flex-wrap: nowrap; align-items: center; gap: 0px; margin: 0; padding: 0; list-style: none;">
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.home') }}" class=" mainhome" style="white-space: nowrap;">Home</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.about') }}" style="white-space: nowrap;">About Us</a></li>
                                    <li style="list-style: none; flex-shrink: 0;" class="dropdown-menu-item">
                                        <a href="#" style="white-space: nowrap;">Bare Acts & Rules</a>
                                        <ul class="dropdown-submenu">
                                            <li><a href="{{ route('frontend.acts') }}">Acts</a></li>
                                            <li><a href="{{ route('frontend.rules') }}">Rules</a></li>
                                        </ul>
                                    </li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.legal-knowledge') }}" style="white-space: nowrap;">Legal Knowledge</a></li>
                                    <li style="list-style: none; flex-shrink: 0;" class="dropdown-menu-item">
                                        <a href="#" style="white-space: nowrap;">Courses & Free Notes</a>
                                        <ul class="dropdown-submenu">
                                            <li><a href="{{ route('frontend.course') }}">Course</a></li>
                                            <li><a href="{{ route('frontend.copys') }}">Free Notes</a></li>
                                        </ul>
                                    </li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.clientele') }}" style="white-space: nowrap;">Client</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.home') }}" style="white-space: nowrap;">Centre & State Govt. Examination</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.gallery') }}" style="white-space: nowrap;">Gallery</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.contact') }}" style="white-space: nowrap;">Contact Us</a></li>
                                    <li style="list-style: none; flex-shrink: 0;">
                                        <a href="{{ route('login') }}" class="btn"
                                            style="background-color:#ff5722; color:#fff; border-color:#ff5722; white-space: nowrap;">
                                            Login / Register
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="contact-3 d-none" style="flex-shrink: 0;">
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
                                        <p>{!! nl2br($description) !!}</p>
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

<!-- DROPDOWN POSITIONING -->
<style>
/* Ensure dropdown appears below menu item with proper positioning */
.main-menu-ex.homepage6 .dropdown-menu-item {
    position: relative !important;
    overflow: visible !important;
}

.main-menu-ex.homepage6 ul li.dropdown-menu-item .dropdown-submenu {
    position: absolute !important;
    top: calc(100% + 8px) !important;
    left: 0 !important;
    z-index: 9999 !important;
    right: auto !important;
    bottom: auto !important;
}
</style>

<!-- Font size overrides -->
<style>
.header .main-menu-ex.homepage6 ul li a {
    font-size: 11px !important;
    line-height: 1.4 !important;
}

/* Tagline font sizes */
.header-top-border .top-content-area .content p {
    font-size: 14px !important;
}

@media (min-width: 768px) {
    .header-top-border .top-content-area .content p {
        font-size: 15px !important;
    }
}

@media (min-width: 992px) {
    .header-top-border .top-content-area .content p {
        font-size: 16px !important;
    }
}

@media (min-width: 1200px) {
    .header .main-menu-ex.homepage6 ul li a {
        font-size: 11px !important;
    }

    .header-top-border .top-content-area .content p {
        font-size: 17px !important;
    }
}
</style>
