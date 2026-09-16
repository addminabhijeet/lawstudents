<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>

    @include('layouts.partials.error-suppression')

    @include('layouts.partials.title-meta')

    <!--===== CSS LINK =======-->
    @vite(['resources/scss/master.scss' , 'resources/scss/typography.css'])

    <!-- ===== GLOBAL DESIGN SYSTEM STYLE ===== -->
    <style>
        /* ===== DESIGN VARIABLES ===== */
        :root {
            --black: #0f0f0f;
            --dark: #1a1a1a;
            --dark-light: #2a2a2a;
            --dark-accent: #2d2d2d;
            --gold: #d4af37;
            --gold-light: #e6c547;
            --gold-dark: #b8860b;
            --gray: #b0b0b0;
            --gray-light: #888888;
            --gray-lighter: #e0e0e0;
            --white: #ffffff;
        }

        /* ===== GLOBAL STYLES ===== */
        * { margin: 0; padding: 0; box-sizing: border-box; }

        html, body {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            background: var(--black);
            color: var(--white);
            scroll-behavior: smooth;
        }

        /* ===== TYPOGRAPHY ===== */
        h1, h2, h3, h4, h5, h6 {
            font-family: 'Playfair Display', serif;
            font-weight: 700;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        h1 { font-size: 36px; font-weight: 700; line-height: 1.2; }
        h2 { font-size: 28px; font-weight: 700; line-height: 1.3; }
        h3 { font-size: 22px; font-weight: 700; line-height: 1.4; }
        h4 { font-size: 18px; font-weight: 700; line-height: 1.4; }
        h5 { font-size: 16px; font-weight: 700; line-height: 1.5; }
        h6 { font-size: 14px; font-weight: 700; line-height: 1.5; }

        p {
            font-size: 13px;
            color: var(--gray);
            line-height: 1.6;
            font-weight: 400;
        }

        p.body-large {
            font-size: 15px;
            line-height: 1.6;
        }

        p.body-small {
            font-size: 12px;
            line-height: 1.5;
        }

        small, .text-small { font-size: 12px; }
        a { color: var(--gold); text-decoration: none; transition: all 0.3s ease; }
        a:hover { color: var(--gold-light); }

        /* ===== COMPREHENSIVE TEXT OVERRIDES ===== */
        /* Force Poppins font on all body text and elements */
        body, body *, .inner-pages, .inner-pages * {
            font-family: 'Poppins', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif !important;
        }

        /* Force Playfair Display on all headings */
        h1, h2, h3, h4, h5, h6,
        .h1, .h2, .h3, .h4, .h5, .h6,
        [class*="title"], [class*="heading"],
        .section-title, .page-title {
            font-family: 'Playfair Display', serif !important;
            font-weight: 700 !important;
            color: var(--gold) !important;
            text-transform: uppercase !important;
            letter-spacing: 2px !important;
        }

        /* Ensure all text elements use correct sizing */
        span, em, strong, b, i, label, .label, .text {
            font-family: 'Poppins', sans-serif !important;
            font-size: inherit !important;
            color: inherit !important;
        }

        /* Button and link text */
        button, .btn, a, [role="button"] {
            font-family: 'Poppins', sans-serif !important;
            font-weight: 600 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Form labels */
        label, .form-label {
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
            color: var(--gold) !important;
        }

        /* List items and navigation */
        li, nav, .nav, .menu, .navbar-nav {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            font-weight: 500 !important;
        }

        nav a, .nav a, .navbar-nav a, .menu a {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--gray) !important;
        }

        nav a:hover, .nav a:hover, .navbar-nav a:hover, .menu a:hover {
            color: var(--gold) !important;
        }

        /* Card titles and content */
        .card-title, .card-text, .card-body {
            font-family: 'Poppins', sans-serif !important;
        }

        .card-title {
            font-size: 18px !important;
            font-weight: 700 !important;
            color: var(--gold) !important;
        }

        .card-text, .card-body {
            font-size: 13px !important;
            color: var(--gray) !important;
            line-height: 1.6 !important;
        }

        /* Table and data text */
        table, td, th, .table {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            color: var(--gray) !important;
            line-height: 1.6 !important;
        }

        th {
            font-weight: 700 !important;
            color: var(--gold) !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Footer text */
        footer, footer * {
            font-family: 'Poppins', sans-serif !important;
        }

        footer a {
            color: var(--gray) !important;
            font-size: 13px !important;
        }

        footer a:hover {
            color: var(--gold) !important;
        }

        /* Ensure no text-decoration unless needed */
        a {
            text-decoration: none !important;
        }

        a:hover {
            text-decoration: none !important;
        }

        /* ===== BOOTSTRAP & UTILITY CLASS OVERRIDES ===== */
        .display-1, .display-2, .display-3, .display-4, .display-5, .display-6 {
            font-family: 'Playfair Display', serif !important;
            font-weight: 700 !important;
            color: var(--gold) !important;
            letter-spacing: 2px !important;
        }

        .lead {
            font-family: 'Poppins', sans-serif !important;
            font-size: 15px !important;
            font-weight: 400 !important;
            color: var(--gray) !important;
            line-height: 1.6 !important;
        }

        .text-muted {
            color: var(--gray) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .text-secondary {
            color: var(--gray) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .text-primary {
            color: var(--gold) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .text-white {
            color: var(--white) !important;
            font-family: 'Poppins', sans-serif !important;
        }

        .badge, .label, .tag {
            font-family: 'Poppins', sans-serif !important;
            font-size: 11px !important;
            font-weight: 700 !important;
            text-transform: uppercase !important;
            letter-spacing: 0.5px !important;
        }

        /* Breadcrumb text */
        .breadcrumb, .breadcrumb * {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            color: var(--gray) !important;
        }

        .breadcrumb-item.active {
            color: var(--gold) !important;
            font-weight: 600 !important;
        }

        /* Alert and notification text */
        .alert, .alert-* {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            line-height: 1.6 !important;
        }

        .alert-heading {
            font-family: 'Playfair Display', serif !important;
            font-weight: 700 !important;
            color: var(--gold) !important;
        }

        /* Modal and dialog text */
        .modal-title {
            font-family: 'Playfair Display', serif !important;
            font-size: 22px !important;
            font-weight: 700 !important;
            color: var(--gold) !important;
            letter-spacing: 2px !important;
        }

        .modal-body, .modal-body * {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            color: var(--gray) !important;
            line-height: 1.6 !important;
        }

        /* Dropdown and select text */
        .dropdown-menu, .dropdown-item {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            color: var(--gray) !important;
        }

        .dropdown-item:hover, .dropdown-item.active {
            color: var(--gold) !important;
            background-color: rgba(212, 175, 55, 0.1) !important;
        }

        /* Pagination text */
        .pagination, .page-link {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            font-weight: 600 !important;
        }

        .page-link {
            color: var(--gold) !important;
        }

        .page-link:hover {
            color: var(--gold-light) !important;
            background-color: rgba(212, 175, 55, 0.1) !important;
        }

        /* Tooltip and popover text */
        .tooltip, .popover {
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            color: var(--gray) !important;
        }

        /* Accordion text */
        .accordion-header, .accordion-button {
            font-family: 'Poppins', sans-serif !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            color: var(--gold) !important;
        }

        .accordion-body {
            font-family: 'Poppins', sans-serif !important;
            font-size: 13px !important;
            color: var(--gray) !important;
            line-height: 1.6 !important;
        }

        /* Progress bar text */
        .progress-bar {
            font-family: 'Poppins', sans-serif !important;
            font-size: 12px !important;
            font-weight: 600 !important;
        }

        /* Blockquote text */
        blockquote, .blockquote {
            font-family: 'Poppins', sans-serif !important;
            font-size: 15px !important;
            color: var(--gray) !important;
            line-height: 1.8 !important;
            font-style: italic !important;
        }

        .blockquote-footer {
            font-size: 12px !important;
            color: var(--gray) !important;
        }

        /* Code and pre text */
        code, pre, .code, .pre {
            font-family: 'Courier New', monospace !important;
            font-size: 12px !important;
            color: var(--gold) !important;
            background-color: rgba(212, 175, 55, 0.05) !important;
        }

        /* Ensure all inline elements inherit font properly */
        strong, b {
            font-weight: 700 !important;
        }

        em, i {
            font-style: italic !important;
        }

        /* Ensure hrefs and links have correct styling */
        a[href] {
            color: var(--gold) !important;
        }

        a[href]:visited {
            color: var(--gold) !important;
        }

        a[href]:hover {
            color: var(--gold-light) !important;
        }

        /* Override any element with inline style font-family */
        [style*="font-family"] {
            font-family: 'Poppins', sans-serif !important;
        }

        h1[style*="font-family"], h2[style*="font-family"], h3[style*="font-family"],
        h4[style*="font-family"], h5[style*="font-family"], h6[style*="font-family"],
        [class*="title"][style*="font-family"], [class*="heading"][style*="font-family"] {
            font-family: 'Playfair Display', serif !important;
        }

        /* ===== SECTION STYLES ===== */
        section, .inner-pages, .inner-pages .welcome-inner-section-area,
        .inner-pages .inner-section-area, .blog1-section-area, .about-inner,
        [class*="section-area"], [class*="inner"] {
            background: var(--black) !important;
            padding: 50px 20px;
            border-bottom: 1px solid rgba(212, 175, 55, 0.2);
        }

        /* Override all light/white backgrounds to black */
        body, html, .container, .container-fluid, .content-area, .main-content {
            background: var(--black) !important;
        }

        .welcome-inner-section-area, .inner-pages .welcome-inner-section-area {
            background: var(--black) !important;
            background-image: url(/img/bacground/inner-bg.png) !important;
            background-position: center !important;
            background-repeat: no-repeat !important;
            background-size: cover !important;
        }

        .section-title {
            text-align: center;
            margin-bottom: 40px;
            font-size: 28px;
            font-weight: 700;
            color: var(--gold);
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        .section-title::after {
            content: '';
            display: block;
            width: 80px;
            height: 3px;
            background: linear-gradient(90deg, var(--gold) 0%, var(--gold-light) 100%);
            margin: 15px auto 0;
            border-radius: 2px;
        }

        /* ===== BUTTON STYLES ===== */
        .btn, button, input[type="submit"], a[class*="btn"] {
            padding: 12px 28px;
            border-radius: 4px;
            font-size: 13px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            border: none;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-block;
            min-height: 44px;
            text-align: center;
            line-height: 1;
        }

        .btn-primary, .btn.btn-primary, .casebtn1, a.casebtn1 {
            background: linear-gradient(135deg, var(--gold) 0%, var(--gold-light) 100%);
            color: var(--black) !important;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.3);
            border: none;
        }

        .btn-primary:hover, .btn.btn-primary:hover, .casebtn1:hover, a.casebtn1:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 25px rgba(212, 175, 55, 0.5);
            color: var(--black) !important;
        }

        .btn-secondary, .btn.btn-secondary {
            background: transparent;
            color: var(--gold);
            border: 2px solid var(--gold);
        }

        .btn-secondary:hover, .btn.btn-secondary:hover {
            background: var(--gold);
            color: var(--black);
        }

        /* ===== CARD STYLES ===== */
        .card, [class*="card"], [class*="box"], .accordion-item, [class*="item"] {
            background: linear-gradient(135deg, var(--dark) 0%, var(--dark-light) 100%) !important;
            border: 2px solid var(--gold) !important;
            border-radius: 8px !important;
            box-shadow: 0 4px 15px rgba(212, 175, 55, 0.15) !important;
            transition: all 0.3s ease !important;
            overflow: hidden !important;
        }

        .card:hover, [class*="card"]:hover, [class*="box"]:hover, .accordion-item:hover, [class*="item"]:hover {
            box-shadow: 0 12px 35px rgba(212, 175, 55, 0.25) !important;
            transform: translateY(-8px) !important;
            border-color: var(--gold-light) !important;
        }

        /* ===== FORM STYLES ===== */
        input, textarea, select, .form-control, .form-input {
            background: var(--dark) !important;
            border: 1px solid var(--gold) !important;
            color: var(--gray) !important;
            border-radius: 4px !important;
            padding: 12px 14px !important;
            font-size: 14px !important;
            font-family: 'Poppins', sans-serif !important;
            transition: all 0.3s ease !important;
            min-height: 44px !important;
        }

        input::placeholder, textarea::placeholder, select::placeholder {
            color: var(--gray-light) !important;
        }

        input:focus, textarea:focus, select:focus, .form-control:focus, .form-input:focus {
            border-color: var(--gold-light) !important;
            box-shadow: 0 0 0 3px rgba(212, 175, 55, 0.1) !important;
            outline: none !important;
            background: var(--dark) !important;
            color: var(--gray) !important;
        }

        /* ===== CONTAINER STYLES ===== */
        .container, .container-fluid {
            max-width: 1200px;
            padding: 20px;
        }

        /* ===== RESPONSIVE ===== */
        @media (max-width: 1024px) {
            h1 { font-size: 32px; }
            h2 { font-size: 26px; }
            h3 { font-size: 20px; }
            h4 { font-size: 17px; }
            p { font-size: 13px; }
        }

        @media (max-width: 768px) {
            h1 { font-size: 28px; }
            h2 { font-size: 24px; }
            h3 { font-size: 18px; }
            h4 { font-size: 16px; }
            p, body { font-size: 13px; }
            .section-title { font-size: 20px; }
            section { padding: 40px 15px; }
            .btn, button { padding: 12px 16px; width: 100%; }
            .container, .container-fluid { padding: 15px; }
        }

        @media (max-width: 480px) {
            h1 { font-size: 24px; }
            h2 { font-size: 20px; }
            h3 { font-size: 16px; }
            h4 { font-size: 14px; }
            .section-title { font-size: 16px; margin-bottom: 20px; }
            section { padding: 30px 12px; }
            .btn, button { font-size: 12px; padding: 10px 14px; min-height: 42px; }
            p { font-size: 12px; }
        }

        /* ===== TEXT COLOR OVERRIDES ===== */
        .inner-pages .welcome-inner-header h1,
        .inner-pages .welcome-inner-header a {
            color: var(--white) !important;
        }

        /* ===== UTILITY CLASSES ===== */
        .text-gold { color: var(--gold); }
        .text-gray { color: var(--gray); }
        .text-white { color: var(--white); }
        .text-center { text-align: center; }
        .text-uppercase { text-transform: uppercase; }
        .mt-0 { margin-top: 0; }
        .mb-0 { margin-bottom: 0; }
        .m-auto { margin: auto; }
        .p-20 { padding: 20px; }
        .border-gold { border: 2px solid var(--gold); }

        /* ===== FIX ALL LIGHT BACKGROUNDS ===== */
        .sp1, .sp2, .sp3, .sp4, .sp5 {
            background: var(--black) !important;
        }

        /* ===== FORCE BLACK ON ALL CONTAINERS ===== */
        .nxl-container, .nxl-content, .main-content, .content-area,
        .apps-container, .apps-notes, .blog1-section-area {
            background: var(--black) !important;
        }

        /* ===== FIX SPECIFIC SECTION BACKGROUNDS ===== */
        /* Home page sections */
        .home-hero-section, .hero-section, .hero, .banner {
            background: var(--black) !important;
        }

        /* Inner page sections */
        .welcome-inner-section-area {
            background: linear-gradient(135deg, rgba(0,0,0,0.9) 0%, rgba(0,0,0,0.9) 100%),
                        url(/img/bacground/inner-bg.png) center / cover no-repeat !important;
            background-color: var(--black) !important;
        }

        /* Course/content list pages */
        .nxl-container .nxl-content {
            background: var(--black) !important;
        }

        /* Cards grid sections */
        .cards-grid, .course-grid, [class*="grid"] {
            background: var(--black) !important;
        }

        /* Override specific light backgrounds */
        div[style*="f8f9fa"], div[style*="f0f3f7"],
        div[style*="white"], div[style*="#fff"],
        div[style*="#f9f"] {
            background: var(--black) !important;
        }

        /* ===== TEXT COLOR FIXES ===== */
        .inner-pages {
            color: var(--white) !important;
        }

        .inner-pages p, .inner-pages span, .inner-pages a {
            color: inherit !important;
        }

        .inner-pages h1, .inner-pages h2, .inner-pages h3,
        .inner-pages h4, .inner-pages h5, .inner-pages h6 {
            color: var(--gold) !important;
        }

        /* ===== HEADER NAVIGATION STYLING ===== */
        .navbar, [class*="nav"], header {
            background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%) !important;
            border-bottom: 2px solid #d4af37 !important;
            box-shadow: 0 2px 12px rgba(212, 175, 55, 0.1) !important;
        }

        .navbar-brand, .logo {
            color: #d4af37 !important;
            font-weight: 700 !important;
            letter-spacing: 1px !important;
        }

        .nav-link, .navbar-nav a {
            color: #b0b0b0 !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            position: relative !important;
        }

        .nav-link:hover, .navbar-nav a:hover {
            color: #d4af37 !important;
        }

        /* ===== HERO SECTION STYLING ===== */
        .hero, [class*="banner"], [class*="welcome"] {
            background: linear-gradient(135deg, #1a1a1a 0%, #2d2d2d 50%, #1a1a1a 100%) !important;
            border-bottom: 1px solid #d4af37 !important;
        }

        .hero h1, [class*="welcome"] h1 {
            background: linear-gradient(135deg, #d4af37 0%, #e6c547 50%, #d4af37 100%) !important;
            -webkit-background-clip: text !important;
            -webkit-text-fill-color: transparent !important;
            background-clip: text !important;
        }

        /* ===== ALL SECTION BACKGROUNDS ===== */
        section, [class*="section"], [class*="area"], .container-fluid {
            background: #0f0f0f !important;
            border-bottom: 1px solid #d4af37 !important;
        }

        /* ===== FOOTER STYLING ===== */
        footer, [class*="footer"] {
            background: linear-gradient(135deg, #1a1a1a 0%, #0f0f0f 100%) !important;
            border-top: 2px solid #d4af37 !important;
        }

        footer h4, footer h5, footer h6, [class*="footer"] h4 {
            color: #d4af37 !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
        }

        footer a, [class*="footer"] a {
            color: #b0b0b0 !important;
            transition: all 0.3s ease !important;
        }

        footer a:hover, [class*="footer"] a:hover {
            color: #d4af37 !important;
            margin-left: 5px !important;
        }
    </style>

    @yield('css')

</head>

<body class="inner-pages @yield('body_attribute')">

    @include('layouts.partials.fix-asset-paths')

    @include('layouts.partials.loader')

    @include('layouts.partials.header.navbar')

    @include('layouts.partials.whatsapp')

    @yield('content')


    @include('layouts.partials.footer')

    @yield('scripts')

    @vite(['resources/js/main.js'])

</body>

</html>
