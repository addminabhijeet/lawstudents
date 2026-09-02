<!--===== RESPONSIVE HEADER STYLES =======-->
<style>
    /* Responsive logo sizing */
    .site-logo {
        width: 140px !important;
        flex-shrink: 0;
        height: 55px !important;
    }

    /* Tablets and smaller desktops */
    @media (max-width: 1399px) {
        .site-logo {
            width: 130px !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 0px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 11px;
            padding: 3px 4px;
            letter-spacing: -0.4px;
        }
    }

    /* Medium screens */
    @media (max-width: 1199px) {
        .site-logo {
            width: 120px !important;
        }

        .header-top-area {
            margin-bottom: 8px;
        }

        .social-area {
            gap: 8px !important;
            flex-wrap: wrap !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 0px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 11px;
            padding: 3px 3px;
            letter-spacing: -0.4px;
        }
    }

    /* Smaller medium screens */
    @media (max-width: 1024px) {
        .site-logo {
            width: 110px !important;
        }

        .header-elements {
            gap: 2px;
        }

        .main-menu-ex.homepage6 ul {
            gap: 0px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 10px;
            padding: 2px 3px;
            letter-spacing: -0.4px;
        }

        .contact-3 {
            order: -1;
        }
    }

    /* Adjust header top spacing */
    .header-top-border {
        padding: 12px 0 !important;
        margin: 0 !important;
        width: 100% !important;
        box-sizing: border-box !important;
    }

    @media (max-width: 1199px) {
        .header-top-border {
            padding: 8px 0 !important;
            margin: 0 !important;
        }
    }

    /* Ensure menu doesn't overlap with logo */
    .header-elements {
        display: flex;
        align-items: center;
        gap: 3px;
        flex-wrap: nowrap;
        justify-content: flex-start;
        width: 100%;
        min-height: 60px;
        padding: 0 !important;
    }

    @media (max-width: 1199px) {
        .header-elements {
            gap: 3px;
            flex-wrap: nowrap;
            justify-content: flex-start;
        }
    }

    @media (max-width: 1024px) {
        .header-elements {
            gap: 2px;
            justify-content: flex-start;
        }
    }

    /* Main menu responsive */
    .main-menu-ex.homepage6 {
        flex: 1;
        min-width: 0;
        overflow: visible !important;
    }

    .main-menu-ex.homepage6 ul {
        display: flex;
        flex-wrap: nowrap;
        align-items: center;
        gap: 0px;
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
        font-size: 12px;
        display: inline-block;
        padding: 3px 4px;
        white-space: nowrap;
        transition: all 0.3s ease;
        letter-spacing: -0.4px;
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
        padding: 5px 15px !important;
    }

    /* Responsive padding for header elements */
    @media (min-width: 576px) {
        .header-elements {
            padding: 5px 20px !important;
        }
    }

    @media (min-width: 768px) {
        .header-elements {
            padding: 5px 30px !important;
        }
    }

    @media (min-width: 992px) {
        .header-elements {
            padding: 5px 40px !important;
        }
    }

    @media (min-width: 1200px) {
        .header-elements {
            padding: 5px 50px !important;
        }
    }

    /* Move menu to right side - reorder flexbox items */
    .site-logo {
        order: 1 !important;
    }

    .main-menu-ex.homepage6 {
        order: 2 !important;
        margin-left: auto !important;
    }

    .contact-3 {
        order: 3 !important;
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
        min-width: 30px;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
        font-size: 18px;
    }

    /* Large desktop screens */
    @media (min-width: 1600px) {
        .site-logo {
            width: 160px !important;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 13px;
            padding: 3px 5px;
            letter-spacing: -0.4px;
        }

        .main-menu-ex.homepage6 ul {
            gap: 1px;
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

    /* Ultra-small screens - ensure single line */
    @media (max-width: 768px) {
        .site-logo {
            width: 100px !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 0px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 9px !important;
            padding: 2px 3px !important;
            letter-spacing: -0.4px;
        }

        .main-menu-ex.homepage6 ul li:last-child a {
            padding: 2px 3px !important;
        }
    }

    /* Extra small screens */
    @media (max-width: 480px) {
        .site-logo {
            width: 90px !important;
        }

        .main-menu-ex.homepage6 ul {
            gap: 0px;
        }

        .main-menu-ex.homepage6 ul li a {
            font-size: 8px !important;
            padding: 1px 2px !important;
            letter-spacing: -0.5px;
        }

        .main-menu-ex.homepage6 ul li:last-child a {
            padding: 1px 2px !important;
        }
    }

    /* Remove scrollbar indicator styling */
    .main-menu-ex.homepage6::-webkit-scrollbar-track {
        background: transparent;
    }

    .main-menu-ex.homepage6::-webkit-scrollbar-thumb {
        background: transparent;
    }

    /* Fill header container with orange color */
    .header-top-border {
        background-color: #ff5722 !important;
        background-image: none !important;
        width: 100% !important;
    }

    /* Text color adjustments for better contrast */
    .top-content-area .content p {
        color: white !important;
        font-weight: 500 !important;
    }

    .social-area a {
        color: white !important;
    }

    .social-area a span {
        color: white !important;
    }

    /* Full width container with orange fill */
    .container-fluid.px-0 {
        padding-left: 0 !important;
        padding-right: 0 !important;
        margin-left: 0 !important;
        margin-right: 0 !important;
        width: 100% !important;
        max-width: 100% !important;
    }

    /* Orange background fills 100% with NO padding on sides */
    .header-top-area {
        padding-left: 0 !important;
        padding-right: 0 !important;
    }

    /* Content spacing inside the full-width orange area */
    .header-top-border {
        padding-left: 15px !important;
        padding-right: 15px !important;
    }

    /* Responsive content padding */
    @media (min-width: 576px) {
        .header-top-border {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }
    }

    @media (min-width: 768px) {
        .header-top-border {
            padding-left: 30px !important;
            padding-right: 30px !important;
        }
    }

    @media (min-width: 992px) {
        .header-top-border {
            padding-left: 40px !important;
            padding-right: 40px !important;
        }
    }

    @media (min-width: 1200px) {
        .header-top-border {
            padding-left: 50px !important;
            padding-right: 50px !important;
        }
    }

    /* Move menu to right side - flexbox reordering */
    .site-logo {
        order: 1 !important;
    }

    .header-elements .main-menu-ex.homepage6 {
        order: 2 !important;
        margin-left: auto !important;
        flex: 0 0 auto !important;
        width: auto !important;
        max-width: fit-content !important;
    }

    .contact-3 {
        order: 3 !important;
    }

    /* Responsive font sizing for navbar menu items */
    .main-menu-ex.homepage6 ul li a {
        font-size: 13px !important;
        line-height: 1.4 !important;
    }

    .top-content-area .content p {
        font-size: 14px !important;
    }

    @media (min-width: 576px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 13px !important;
        }

        .top-content-area .content p {
            font-size: 14px !important;
        }
    }

    @media (min-width: 768px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 14px !important;
        }

        .top-content-area .content p {
            font-size: 15px !important;
        }
    }

    @media (min-width: 992px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 15px !important;
        }

        .top-content-area .content p {
            font-size: 16px !important;
        }
    }

    @media (min-width: 1200px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 16px !important;
        }

        .top-content-area .content p {
            font-size: 17px !important;
        }
    }

    /* ===== DROPDOWN MENU STYLING FOR ACTS & RULES ===== */
    .dropdown-menu-item {
        position: relative !important;
        display: inline-flex !important;
        align-items: center !important;
        flex-shrink: 0 !important;
        height: auto !important;
        z-index: 9999 !important;
    }

    .dropdown-menu-item > a {
        display: flex !important;
        align-items: center !important;
        gap: 6px !important;
        white-space: nowrap !important;
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
        top: 155px !important;
        left: 0 !important;
        background-color: #fff !important;
        min-width: 150px !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15) !important;
        border-radius: 4px !important;
        overflow: hidden !important;
        opacity: 0 !important;
        visibility: hidden !important;
        transform: translateY(0) !important;
        transition: all 0.3s ease !important;
        z-index: 99999 !important;
        list-style: none !important;
        padding: 0 !important;
        margin: 0 !important;
        display: flex !important;
        flex-direction: column !important;
    }

    .dropdown-menu-item:hover .dropdown-submenu {
        opacity: 1 !important;
        visibility: visible !important;
        transform: translateY(0) !important;
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
    }

    .dropdown-submenu li a:hover {
        background-color: #f5f5f5;
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
    let styleBlock = null;

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

    function createOrUpdateStyles() {
        // Remove old style if exists
        if (styleBlock && styleBlock.parentNode) {
            styleBlock.parentNode.removeChild(styleBlock);
        }

        const sizes = getFontSize();

        // Create style block that loads in <head> at end
        styleBlock = document.createElement('style');
        styleBlock.id = 'navbar-font-override-' + Date.now();
        styleBlock.innerHTML = `
            .main-menu-ex.homepage6 ul li a { font-size: ${sizes.menu} !important; line-height: 1.4 !important; }
            .top-content-area .content p { font-size: ${sizes.tagline} !important; }
            .dropdown-submenu { z-index: 99999 !important; }
        `;

        document.head.appendChild(styleBlock);

        // Also add to end of body as fallback
        const bodyStyle = document.createElement('style');
        bodyStyle.innerHTML = `
            .main-menu-ex.homepage6 ul li a { font-size: ${sizes.menu} !important; line-height: 1.4 !important; }
            .top-content-area .content p { font-size: ${sizes.tagline} !important; }
            .dropdown-submenu { z-index: 99999 !important; top: calc(100% + 30px) !important; }
        `;
        document.body.appendChild(bodyStyle);
    }

    // Apply on DOMContentLoaded
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(createOrUpdateStyles, 100);
        });
    } else {
        setTimeout(createOrUpdateStyles, 100);
    }

    // Reapply on any stylesheet load
    window.addEventListener('load', createOrUpdateStyles);

    // Apply on resize
    window.addEventListener('resize', createOrUpdateStyles);

    // Fix dropdown positioning to prevent banner overlap - FORCEFUL VERSION
    function fixDropdownPosition() {
        const dropdown = document.querySelector('.dropdown-submenu');
        const dropdownParent = document.querySelector('.dropdown-menu-item');

        if (dropdown && dropdownParent) {
            // Calculate absolute position
            // Dropdown should be positioned at least 155px from top to avoid banner overlap
            const header = document.querySelector('.header');
            const headerBottom = header?.getBoundingClientRect().bottom || 134;

            // Position dropdown 25px below banner start (banner starts at headerBottom)
            const targetTop = headerBottom + 25;

            // Use transform to move dropdown down by the offset
            const offset = Math.max(0, targetTop - 50);
            dropdown.style.setProperty('transform', `translateY(${offset}px)`, 'important');
        }
    }

    // Apply on multiple events to ensure it works
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            setTimeout(fixDropdownPosition, 100);
        });
    } else {
        setTimeout(fixDropdownPosition, 100);
    }
    window.addEventListener('load', fixDropdownPosition);

    // Also fix on hover
    const dropdownItem = document.querySelector('.dropdown-menu-item');
    if (dropdownItem) {
        dropdownItem.addEventListener('mouseenter', fixDropdownPosition);
        dropdownItem.addEventListener('mouseleave', fixDropdownPosition);
    }
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
                            <div class="main-menu-ex homepage6" style="flex: 0 0 auto; min-width: 0; overflow: hidden; margin-left: auto !important;">
                                <ul style="display: flex; flex-wrap: nowrap; align-items: center; gap: 0px; margin: 0; padding: 0; list-style: none;">
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.home') }}" class=" mainhome" style="white-space: nowrap;">Home</a></li>
                                    <li style="list-style: none; flex-shrink: 0;"><a href="{{ route('frontend.about') }}" style="white-space: nowrap;">About Us</a></li>
                                    <li style="list-style: none; flex-shrink: 0;" class="dropdown-menu-item">
                                        <a href="#" style="white-space: nowrap;">Acts & Rules</a>
                                        <ul class="dropdown-submenu">
                                            <li><a href="{{ route('frontend.acts') }}">Acts</a></li>
                                            <li><a href="{{ route('frontend.rules') }}">Rules</a></li>
                                        </ul>
                                    </li>
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

<!-- ENSURE DROPDOWN Z-INDEX IS ULTRA-HIGH AND POSITION BELOW BANNER -->
<style>
.dropdown-submenu {
    z-index: 99999 !important;
    top: 155px !important;
    position: absolute !important;
}
</style>

<!-- MAXIMUM SPECIFICITY DROPDOWN FIX -->
<style>
.main-menu-ex.homepage6 ul li.dropdown-menu-item .dropdown-submenu {
    top: 160px !important !important;
    transform: none !important;
    position: fixed !important;
    left: auto !important;
}
</style>

<!-- Override the 12px font-size rule from sheet 6 that's overriding everything -->
<style>
.header .main-menu-ex.homepage6 ul li a {
    font-size: 13px !important;
    line-height: 1.4 !important;
}

@media (min-width: 576px) {
    .header .main-menu-ex.homepage6 ul li a {
        font-size: 13px !important;
    }
}

@media (min-width: 768px) {
    .header .main-menu-ex.homepage6 ul li a {
        font-size: 14px !important;
    }
}

@media (min-width: 992px) {
    .header .main-menu-ex.homepage6 ul li a {
        font-size: 15px !important;
    }
}

@media (min-width: 1200px) {
    .header .main-menu-ex.homepage6 ul li a {
        font-size: 16px !important;
    }
}

/* Tagline font sizes */
.header-top-border .top-content-area .content p {
    font-size: 14px !important;
}

@media (min-width: 576px) {
    .header-top-border .top-content-area .content p {
        font-size: 14px !important;
    }
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
    .header-top-border .top-content-area .content p {
        font-size: 17px !important;
    }
}
</style>
