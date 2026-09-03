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
        gap: 20px;
        flex-wrap: nowrap;
        justify-content: flex-start;
        width: 100%;
        min-height: 70px;
        padding: 15px 15px !important;
        transition: all 0.3s ease;
    }

    @media (min-width: 576px) {
        .header-elements {
            gap: 25px;
            min-height: 75px;
            padding: 15px 20px !important;
        }
    }

    @media (min-width: 768px) {
        .header-elements {
            gap: 30px;
            min-height: 80px;
            padding: 15px 30px !important;
        }
    }

    @media (min-width: 992px) {
        .header-elements {
            gap: 35px;
            min-height: 85px;
            padding: 15px 40px !important;
        }
    }

    @media (min-width: 1200px) {
        .header-elements {
            gap: 40px;
            min-height: 85px;
            padding: 15px 50px !important;
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
        gap: 18px;
        margin: 0;
        padding: 0;
        list-style: none;
        justify-content: flex-start;
    }

    /* Responsive gaps for menu items */
    @media (max-width: 1399px) {
        .main-menu-ex.homepage6 ul {
            gap: 16px;
        }
    }

    @media (max-width: 1199px) {
        .main-menu-ex.homepage6 ul {
            gap: 14px;
        }
    }

    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul {
            gap: 12px;
        }
    }

    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul {
            gap: 10px;
        }
    }

    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul {
            gap: 8px;
        }
    }

    /* ===== IMPROVED MENU ITEMS TYPOGRAPHY ===== */
    .main-menu-ex.homepage6 ul li a {
        font-size: 17px;
        display: inline-block;
        padding: 8px 12px;
        white-space: nowrap;
        transition: all 0.3s ease;
        letter-spacing: 0.2px;
        line-height: 1.5;
        color: #333 !important;
        font-weight: 500;
    }

    /* Large desktop (1600px+) */
    @media (min-width: 1600px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 18px;
            padding: 8px 13px;
            letter-spacing: 0.3px;
        }
    }

    /* Desktop (1200px - 1599px) */
    @media (min-width: 1200px) and (max-width: 1599px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 17px;
            padding: 8px 12px;
            letter-spacing: 0.2px;
        }
    }

    /* Tablet Large (1024px - 1199px) */
    @media (max-width: 1199px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 15px;
            padding: 7px 10px;
            letter-spacing: 0.1px;
        }
    }

    /* Tablet Small (768px - 1023px) */
    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 14px;
            padding: 6px 9px;
            letter-spacing: 0px;
        }
    }

    /* Mobile Large (480px - 767px) */
    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 13px;
            padding: 5px 8px;
            letter-spacing: -0.1px;
        }
    }

    /* Mobile Small (< 480px) */
    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul li a {
            font-size: 11px;
            padding: 4px 6px;
            letter-spacing: -0.2px;
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
        padding: 9px 18px !important;
        font-size: 14px !important;
        font-weight: 600 !important;
        border-radius: 5px !important;
        transition: all 0.3s ease !important;
        white-space: nowrap !important;
        cursor: pointer !important;
        line-height: 1.5 !important;
        letter-spacing: 0.5px !important;
    }

    .main-menu-ex.homepage6 ul li .btn:hover {
        background-color: #d43b0a !important;
        border-color: #d43b0a !important;
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3) !important;
    }

    @media (max-width: 1024px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 8px 16px !important;
            font-size: 13px !important;
        }
    }

    @media (max-width: 768px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 7px 14px !important;
            font-size: 12px !important;
        }
    }

    @media (max-width: 480px) {
        .main-menu-ex.homepage6 ul li .btn {
            padding: 6px 12px !important;
            font-size: 11px !important;
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

    /* When dropdown is hovered, expand header to prevent banner overlap */
    .dropdown-menu-item:hover ~ .header-area,
    .dropdown-menu-item:hover {
        /* Signal that dropdown is active */
    }

    /* Dynamically expand header when dropdown shows */
    .header-area {
        transition: padding-bottom 0.3s ease !important;
    }

    .main-menu-ex.homepage6:has(.dropdown-menu-item:hover) {
        /* Parent flex container - maintain layout */
    }

    /* Expand header-top-area when dropdown is visible */
    .header:has(.dropdown-menu-item:hover) {
        padding-bottom: 120px !important;
    }

    /* Dropdown submenu styling */
    .dropdown-submenu {
        position: absolute !important;
        top: 100% !important;
        left: 0 !important;
        margin-top: 8px !important;
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
            .dropdown-submenu { z-index: 99999 !important; }
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

    // Fix dropdown positioning after all CSS loads
    setTimeout(function() {
        const dd = document.querySelector('.dropdown-submenu');
        if (dd) {
            dd.style.setProperty('position', 'absolute', 'important');
            dd.style.setProperty('top', '100%', 'important');
            dd.style.setProperty('left', '0', 'important');
            dd.style.setProperty('margin-top', '8px', 'important');
        }
    }, 500);

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

    // FINAL FIX: Remove bad position:fixed CSS and inject correct absolute positioning
    function fixDropdownPositioningFinal() {
        // Find and remove the problematic style block with position: fixed
        const styles = Array.from(document.querySelectorAll('style'));
        styles.forEach(style => {
            if (style.innerHTML && style.innerHTML.includes('position: fixed') && style.innerHTML.includes('dropdown-menu-item')) {
                style.remove();
            }
        });

        // Inject correct CSS rule
        const correctStyle = document.createElement('style');
        correctStyle.id = 'dropdown-position-fix';
        correctStyle.innerHTML = `.main-menu-ex.homepage6 ul li.dropdown-menu-item .dropdown-submenu {
            position: absolute !important;
            top: 100% !important;
            left: 0 !important;
            margin-top: 8px !important;
            transform: none !important;
        }`;
        document.head.appendChild(correctStyle);
    }

    // Apply the fix immediately and on delays to catch late-loading CSS
    fixDropdownPositioningFinal();
    setTimeout(fixDropdownPositioningFinal, 100);
    setTimeout(fixDropdownPositioningFinal, 500);
    setTimeout(fixDropdownPositioningFinal, 1000);

    // Also handle header expansion and dropdown visibility
    const dropdownItem = document.querySelector('.dropdown-menu-item');
    const header = document.querySelector('.header');
    const dropdown = document.querySelector('.dropdown-submenu');

    if (dropdownItem && header && dropdown) {
        // Ensure menu container doesn't clip dropdown
        const menuContainer = document.querySelector('.main-menu-ex.homepage6');
        if (menuContainer) {
            menuContainer.style.setProperty('overflow', 'visible', 'important');
        }

        // Ensure header area doesn't clip dropdown
        const headerArea = document.querySelector('.header-area');
        if (headerArea) {
            headerArea.style.setProperty('overflow', 'visible', 'important');
        }
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

<!-- CORRECT DROPDOWN POSITIONING - BELOW MENU ITEM -->
<style>
.dropdown-submenu {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    margin-top: 8px !important;
    z-index: 99999 !important;
}

.main-menu-ex.homepage6 ul li.dropdown-menu-item .dropdown-submenu {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    margin-top: 8px !important;
}

/* Force absolute positioning - override all compiled CSS */
html .main-menu-ex.homepage6 ul li.dropdown-menu-item .dropdown-submenu {
    position: absolute !important;
    top: 100% !important;
    left: 0 !important;
    margin-top: 8px !important;
    right: auto !important;
    bottom: auto !important;
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
