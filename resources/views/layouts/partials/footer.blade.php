<!--===== FOOTER STARTS =======-->

<style>
/* ===== FOOTER CORE STYLES ===== */
.footer3-section-area {
    background: linear-gradient(180deg, #fff9f5 0%, #ffffff 100%);
    border-top: 4px solid #ff5722;
    padding: 40px 20px 30px 0;
    margin-top: 40px;
}

.footer-container {
    max-width: 1200px;
    margin: 0 auto;
}

.footer-content {
    display: grid !important;
    grid-template-columns: repeat(3, 1fr) !important;
    gap: 30px !important;
    margin-bottom: 30px !important;
    width: 100% !important;
}

.footer-section {
    display: block !important;
    width: 100% !important;
}

.footer-section:first-child {
    text-align: center;
    padding-left: 0;
    margin-left: -60px;
}

/* ===== FOOTER HEADINGS ===== */
.footer-section h3 {
    font-family: 'Playfair Display', serif;
    font-size: 18px;
    font-weight: 700;
    color: #b8410f;
    margin-bottom: 14px;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    text-align: center;
}

/* ===== FOOTER LOGO ===== */
.footer-logo {
    margin-bottom: 24px;
    text-align: left;
}

.footer-logo img {
    max-width: 400px;
    height: auto;
    object-fit: contain;
}

/* ===== FOOTER TEXT & TAGLINE ===== */
.footer-tagline {
    font-family: 'Playfair Display', serif;
    font-size: 28px;
    font-weight: 800;
    color: #b8410f;
    text-transform: uppercase;
    letter-spacing: 0.8px;
    line-height: 1.6;
    margin-bottom: 0;
    text-align: center;
}

/* ===== FOOTER LINKS ===== */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
    text-align: center;
}

.footer-links li {
    margin-bottom: 8px;
}

.footer-links a {
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #555;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    display: inline-block;
}

.footer-links a:hover {
    color: #ff5722;
    padding-left: 5px;
}

/* ===== CONTACT INFO ===== */
.contact-item {
    display: block;
    margin-bottom: 12px;
    transition: all 0.3s ease;
    text-align: center;
}

.contact-info {
    display: flex;
    flex-direction: column;
    align-items: center;
}

.contact-label {
    font-size: 12px;
    font-weight: 800;
    color: #ff5722;
    text-transform: uppercase;
    letter-spacing: 1px;
    margin-bottom: 5px;
    font-family: 'Poppins', sans-serif;
    display: block;
}

.contact-detail a {
    font-family: 'Poppins', sans-serif;
    font-size: 14px;
    color: #333;
    text-decoration: none;
    font-weight: 700;
    transition: all 0.3s ease;
    display: inline-block;
    line-height: 1.5;
}

.contact-detail a:hover {
    color: #ff5722;
    padding-left: 4px;
}

/* ===== SOCIAL MEDIA ===== */
.social-links {
    list-style: none;
    padding: 0;
    margin: 0;
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    justify-content: center;
}

.social-links li a {
    width: 44px;
    height: 44px;
    border-radius: 50%;
    background: linear-gradient(135deg, #ff5722 0%, #e64a19 100%);
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 18px;
    transition: all 0.3s ease;
    text-decoration: none;
}

.social-links li a:hover {
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(255, 87, 34, 0.3);
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    border-top: 1px solid #e0e0e0;
    padding-top: 16px;
}

.footer-links-bottom {
    text-align: center;
    margin-bottom: 12px;
}

.footer-links-bottom a {
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #666;
    text-decoration: none;
    font-weight: 700;
    transition: color 0.3s ease;
    margin: 0 8px;
}

.footer-links-bottom a:hover {
    color: #ff5722;
}

.footer-links-bottom span {
    color: #ccc;
    margin: 0 4px;
}

.footer-copyright {
    text-align: center;
    font-family: 'Poppins', sans-serif;
    font-size: 13px;
    color: #999;
    font-weight: 700;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
    .footer-content {
        grid-template-columns: repeat(2, 1fr);
        gap: 30px;
    }
}

@media (max-width: 768px) {
    .footer3-section-area {
        padding: 30px 16px 20px 0;
    }

    .footer-section:first-child {
        margin-left: -40px;
    }

    .footer-content {
        grid-template-columns: 1fr;
        gap: 20px;
    }

    .footer-logo img {
        max-width: 320px;
    }

    .footer-section h3 {
        font-size: 16px;
        margin-bottom: 12px;
    }

    .footer-tagline {
        font-size: 22px;
    }

    .footer-links a {
        font-size: 12px;
    }

    .footer-links li {
        margin-bottom: 6px;
    }

    .footer-links-bottom {
        margin-bottom: 10px;
    }

    .footer-links-bottom a {
        display: block;
        margin: 6px 0;
    }

    .footer-links-bottom span {
        display: none;
    }

    .contact-icon {
        width: 46px;
        height: 46px;
        font-size: 22px;
    }

    .contact-label {
        font-size: 11px;
        letter-spacing: 0.8px;
    }

    .contact-detail a {
        font-size: 13px;
    }
}

@media (max-width: 480px) {
    .footer3-section-area {
        padding: 20px 12px 16px 0;
        margin-top: 30px;
    }

    .footer-section:first-child {
        margin-left: -30px;
    }

    .footer-content {
        gap: 16px;
    }

    .footer-logo {
        margin-bottom: 10px;
    }

    .footer-logo {
        margin-bottom: 18px;
    }

    .footer-logo img {
        max-width: 280px;
    }

    .footer-section h3 {
        font-size: 15px;
        margin-bottom: 10px;
        letter-spacing: 0.5px;
    }

    .footer-tagline {
        font-size: 20px;
    }

    .footer-links a {
        font-size: 12px;
    }

    .footer-links li {
        margin-bottom: 6px;
    }

    .contact-icon {
        width: 44px;
        height: 44px;
        font-size: 20px;
    }

    .contact-label {
        font-size: 11px;
    }

    .contact-detail a {
        font-size: 13px;
    }

    .social-links li a {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }

    .footer-copyright {
        font-size: 11px;
    }

    .footer-links-bottom a {
        font-size: 11px;
    }
}
</style>

<div class="footer3-section-area">
    <div class="footer-container">
        <div class="footer-content">
            <!-- Column 1: Logo & About Section -->
            <div class="footer-section">
                <div class="footer-logo">
                    <img src="{{ asset('assets/images/logo-full.png') }}" alt="Law Students Logo">
                </div>
                <p class="footer-tagline">Learn Law.<br> Understand Law.<br> Build Your Future.</p>
            </div>

            <!-- Column 2: Quick Links -->
            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.acts') }}">Acts & Rules</a></li>
                    <li><a href="{{ route('frontend.legal-knowledge') }}">Legal Knowledge</a></li>
                    <li><a href="{{ route('frontend.course') }}">All Courses</a></li>
                    <li><a href="{{ route('frontend.copys') }}">Study Materials</a></li>
                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                </ul>
            </div>

            <!-- Column 3: Programs -->
            <div class="footer-section">
                <h3>Programs</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.course') }}">LL.B. Entrance Prep</a></li>
                    <li><a href="{{ route('frontend.course') }}">LL.B. (3-Year)</a></li>
                    <li><a href="{{ route('frontend.course') }}">LL.B. (5-Year)</a></li>
                    <li><a href="{{ route('frontend.course') }}">LL.M. Specialization</a></li>
                    <li><a href="{{ route('frontend.course') }}">Judiciary Exams</a></li>
                    <li><a href="{{ route('frontend.course') }}">CSEET Preparation</a></li>
                    <li><a href="{{ route('frontend.course') }}">CA Studies</a></li>
                    <li><a href="{{ route('frontend.course') }}">CS Studies</a></li>
                    <li><a href="{{ route('frontend.course') }}">CMA Studies</a></li>
                </ul>
            </div>
        </div>

        <!-- Second Row: Contact, Resources, Social Media -->
        <div class="footer-content">
            <!-- Column 1: Contact -->
            <div class="footer-section">
                <h3>Contact</h3>
                <div class="contact-item">
                    <div class="contact-info">
                        <span class="contact-label">Email</span>
                        <div class="contact-detail">
                            <a href="mailto:lawstudents.edu@gmail.com">lawstudents.edu@gmail.com</a>
                        </div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-info">
                        <span class="contact-label">Address</span>
                        <div class="contact-detail">
                            <a href="#">224 Legal District, Delhi High Court Marg, New Delhi 110001</a>
                        </div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-info">
                        <span class="contact-label">Phone</span>
                        <div class="contact-detail">
                            <a href="tel:+916624536320">+916624536320</a>
                        </div>
                    </div>
                </div>

                <div class="contact-item">
                    <div class="contact-info">
                        <span class="contact-label">WhatsApp</span>
                        <div class="contact-detail">
                            <a href="https://wa.me/916624536320" target="_blank" rel="noopener">+916624536320</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Column 2: Resources -->
            <div class="footer-section">
                <h3>Resources</h3>
                <ul class="footer-links">
                    <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                    <li><a href="{{ route('frontend.rules') }}">Rules & Regulations</a></li>
                    <li><a href="#">Announcements</a></li>
                    <li><a href="{{ route('frontend.govtexams') }}">Competitive Exams</a></li>
                </ul>
            </div>

            <!-- Column 3: Social Media -->
            <div class="footer-section">
                <h3>Social Media</h3>
                <ul class="social-links">
                    <li><a href="https://www.linkedin.com/" target="_blank" rel="noopener" title="LinkedIn"><i class="fa-brands fa-linkedin-in"></i></a></li>
                    <li><a href="https://www.facebook.com/" target="_blank" rel="noopener" title="Facebook"><i class="fa-brands fa-facebook-f"></i></a></li>
                    <li><a href="https://x.com/" target="_blank" rel="noopener" title="Twitter"><i class="fa-brands fa-x-twitter"></i></a></li>
                    <li><a href="https://www.instagram.com/" target="_blank" rel="noopener" title="Instagram"><i class="fa-brands fa-instagram"></i></a></li>
                    <li><a href="https://in.pinterest.com/" target="_blank" rel="noopener" title="Pinterest"><i class="fa-brands fa-pinterest-p"></i></a></li>
                </ul>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="footer-bottom">
            <div class="footer-links-bottom">
                <a href="#">Privacy Policy</a>
                <span>|</span>
                <a href="#">Terms & Conditions</a>
                <span>|</span>
                <a href="#">Disclaimer</a>
                <span>|</span>
                <a href="#">Refund Policy</a>
                <span>|</span>
                <a href="#">Sitemap</a>
            </div>
            <div class="footer-copyright">
                © 2026 Law Student. All Rights Reserved.
            </div>
        </div>
    </div>
</div>

<!--===== FOOTER ENDS =======-->

<!-- ===== FOOTER: RESPONSIVE FIX (PURELY ADDITIVE) =====
     Appended after the markup above so it wins on document order alone.
     Nothing earlier in this file is edited, removed or reordered, and no
     colour, font, size or column design is changed — these rules only make
     the steps that were already written above actually take effect.

     The bug: `.footer-content` declares

         grid-template-columns: repeat(3, 1fr) !important;

     while the `max-width: 1024px` and `max-width: 768px` steps that follow
     re-declare it WITHOUT `!important`. An important declaration beats a
     normal one whatever the order, so neither step ever applied and the
     footer stayed on three columns all the way down — measured at
     250px / 78px / 135px on a 390px phone. With the columns stuck,
     `.footer-section:first-child`'s negative left margin and the section's
     `padding-right: 20px / padding-left: 0` (which balance each other only
     at desktop width) pushed the logo column off the left edge while
     Programs and Social Media ran off the right. Restated below with
     matching `!important` so the intended 3 / 2 / 1 layout happens. -->
<style>
    /* ---------------------------------------------------------------
       1. COLUMN COUNT — the 3 / 2 / 1 that was already intended above.
          `minmax(0, 1fr)` lets a track shrink below its longest word
          instead of forcing itself wider than the grid.
       --------------------------------------------------------------- */
    .footer-content {
        grid-template-columns: repeat(3, minmax(0, 1fr)) !important;
    }

    @media (max-width: 1024px) {
        .footer-content {
            grid-template-columns: repeat(2, minmax(0, 1fr)) !important;
            gap: 28px 24px !important;
        }
    }

    @media (max-width: 768px) {
        .footer-content {
            grid-template-columns: minmax(0, 1fr) !important;
            gap: 20px !important;
        }
    }

    /* ---------------------------------------------------------------
       2. GUTTERS — the negative left margin on the first column offsets
          the section's asymmetric padding, which only balances out while
          three columns are on screen. Once the grid collapses it leaves
          content sitting past the left edge, so it is zeroed from the
          same width the column count changes.
       --------------------------------------------------------------- */
    /* The pull-back only clears the screen while the 1200px-wide footer
       container is centred with at least 60px of slack beside it, which
       needs roughly a 1340px viewport. Below that the first column — logo,
       tagline and the Contact block under it — sits outside the left edge
       and is clipped. Zeroed, with the section's missing left padding
       restored, from that width down. */
    @media (max-width: 1339.98px) {
        .footer3-section-area {
            padding-left: 20px !important;
            padding-right: 20px !important;
        }

        .footer-section:first-child {
            margin-left: 0 !important;
            padding-left: 0 !important;
        }
    }

    @media (max-width: 1024px) {
        .footer3-section-area {
            padding: 36px 20px 26px 20px !important;
        }

        .footer-logo {
            text-align: center !important;
        }
    }

    @media (max-width: 768px) {
        .footer3-section-area {
            padding: 30px 16px 22px 16px !important;
        }

        .footer-section:first-child {
            margin-left: 0 !important;
        }
    }

    @media (max-width: 480px) {
        .footer3-section-area {
            padding: 24px 16px 20px 16px !important;
        }

        .footer-section:first-child {
            margin-left: 0 !important;
        }
    }

    /* ---------------------------------------------------------------
       3. CONTENT FIT — the address, email and WhatsApp number are long
          unbroken strings; they wrap rather than widening their column.
       --------------------------------------------------------------- */
    .footer-container {
        width: 100%;
    }

    .footer-section,
    .footer-links,
    .contact-item,
    .contact-info,
    .contact-detail {
        min-width: 0;
        max-width: 100%;
    }

    .footer-logo img {
        max-width: min(400px, 100%) !important;
        height: auto !important;
        margin: 0 auto;
    }

    .footer-tagline,
    .footer-section h3 {
        overflow-wrap: break-word;
    }

    .footer-links a,
    .contact-detail a,
    .footer-links-bottom a {
        overflow-wrap: anywhere;
        max-width: 100%;
    }

    /* Hovering nudges a link sideways; in a single narrow column that is
       enough to clip its last character. */
    @media (max-width: 768px) {
        .footer-links a:hover,
        .contact-detail a:hover {
            padding-left: 0 !important;
        }
    }

    /* ---------------------------------------------------------------
       4. TOUCH TARGETS — spacing only, the type stays as authored.
       --------------------------------------------------------------- */
    @media (max-width: 1024px) {
        .footer-links a {
            display: inline-block;
            padding: 6px 0;
        }

        .footer-links li {
            margin-bottom: 2px !important;
        }

        .contact-detail a {
            padding: 4px 0;
        }

        .footer-links-bottom a {
            padding: 6px 0;
        }
    }

    @media (max-width: 480px) {
        .footer3-section-area .social-links li a {
            width: 40px !important;
            height: 40px !important;
            font-size: 16px !important;
        }
    }

    /* The bottom policy row wraps as a centred line on tablet rather
       than jumping straight from one line to a full stack. */
    @media (min-width: 769px) and (max-width: 1024px) {
        .footer-links-bottom {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: center;
            gap: 2px 4px;
        }
    }
</style>

<!-- ===== FRONTEND-WIDE RESPONSIVE PASS (PURELY ADDITIVE) =====
     This footer partial is included by layouts/landing on every frontend
     page and is the last thing in <body>, which is the one place a rule can
     be added without editing any page file: each page keeps its own <style>
     blocks inside <body>, so a stylesheet in <head> would lose to them at
     equal specificity. Placing the site-wide steps here means Home, About,
     Acts, Rules, Legal Knowledge, Course, Free Notes, Client, Govt.
     Examination, Gallery, Contact and the Legal Knowledge Library all pick
     them up with no change to a single page file.

     Nothing here introduces a new design. Every rule re-declares a selector
     the theme already defines, at a width where the authored value does not
     work, and leaves the desktop appearance alone. Breakpoints match the
     ones already used across this project (480 / 576 / 768 / 992 / 1024 /
     1200 / 1400). -->
<style>
    /* ---------------------------------------------------------------
       A. NOTHING MAY PUSH THE PAGE WIDER THAN THE SCREEN
          `img` already gets max-width from the error-suppression partial;
          these are the element types it does not cover.
       --------------------------------------------------------------- */
    svg,
    video,
    canvas,
    iframe,
    embed,
    object {
        max-width: 100%;
    }

    /* Long unbroken strings — emails, URLs, act titles, file names — are
       the most common cause of an overflow at phone width. */
    p,
    li,
    a,
    span,
    td,
    th,
    label,
    figcaption,
    h1, h2, h3, h4, h5, h6 {
        overflow-wrap: break-word;
        word-wrap: break-word;
    }

    @media (max-width: 991.98px) {
        table {
            display: block;
            max-width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }
    }

    /* A readable side margin at phone width. */
    @media (max-width: 575.98px) {
        .container,
        .container-fluid {
            padding-left: 16px !important;
            padding-right: 16px !important;
        }
    }

    /* Contact page cards size themselves to their content rather than to
       their column, so on a 320px screen the card holding the longest
       address grows past the column and off the edge. Capped to the column
       they sit in; on wider screens the content already fits, so this
       changes nothing there. */
    .contact-box-area,
    .contact-widget-area {
        max-width: 100% !important;
    }

    /* ---------------------------------------------------------------
       B. SECTION RHYTHM
          `.sp1`-`.sp6` and `.space10`-`.space100` are flat pixel values
          with no small-screen step, so a phone inherits the full 100px
          desktop padding twice per section — on Acts that is 200px of
          empty band before the first card. Scaled below 992px only;
          desktop keeps its authored rhythm.
       --------------------------------------------------------------- */
    @media (max-width: 991.98px) {
        .sp1, .sp6 { padding: 70px 0 70px !important; }
        .sp2       { padding: 70px 0 !important; }
        .sp3       { padding: 70px 0 50px !important; }
        .sp4       { padding: 45px 0 45px !important; }
        .sp5       { padding: 55px 0 55px !important; }

        .space100 { height: 70px !important; }
        .space90  { height: 64px !important; }
        .space80  { height: 56px !important; }
        .space70  { height: 50px !important; }
        .space60  { height: 42px !important; }
        .space50  { height: 36px !important; }
        .space40  { height: 30px !important; }
    }

    @media (max-width: 767.98px) {
        .sp1, .sp6 { padding: 50px 0 50px !important; }
        .sp2       { padding: 50px 0 !important; }
        .sp3       { padding: 50px 0 36px !important; }
        .sp4       { padding: 35px 0 35px !important; }
        .sp5       { padding: 40px 0 40px !important; }

        .space100 { height: 52px !important; }
        .space90  { height: 48px !important; }
        .space80  { height: 42px !important; }
        .space70  { height: 36px !important; }
        .space60  { height: 32px !important; }
        .space50  { height: 28px !important; }
        .space40  { height: 24px !important; }
        .space30  { height: 20px !important; }
    }

    @media (max-width: 479.98px) {
        .sp1, .sp6 { padding: 40px 0 40px !important; }
        .sp2       { padding: 40px 0 !important; }
        .sp3       { padding: 40px 0 28px !important; }
        .sp4       { padding: 28px 0 28px !important; }
        .sp5       { padding: 32px 0 32px !important; }

        .space100 { height: 40px !important; }
        .space90  { height: 38px !important; }
        .space80  { height: 34px !important; }
        .space70  { height: 30px !important; }
        .space60  { height: 26px !important; }
        .space50  { height: 22px !important; }
        .space40  { height: 20px !important; }
        .space30  { height: 16px !important; }
    }

    /* ---------------------------------------------------------------
       C. INNER-PAGE HERO (About, Acts, Rules, Course, Free Notes,
          Client, Govt. Examination, Gallery, Contact, Legal Knowledge)
          `.welcome-inner-section-area` is a flat `160px 0 100px`, which
          on a phone is 260px of empty band above a two-word title. The
          padding exists to clear the desktop header, and below 1200px
          that header is not on screen. Desktop is untouched.
       --------------------------------------------------------------- */
    @media (max-width: 1199.98px) {
        .inner-pages .welcome-inner-section-area {
            padding: 110px 0 70px !important;
        }
    }

    @media (max-width: 991.98px) {
        .inner-pages .welcome-inner-section-area {
            padding: 80px 0 55px !important;
        }
    }

    @media (max-width: 767.98px) {
        .inner-pages .welcome-inner-section-area {
            padding: 56px 0 40px !important;
        }

        .inner-pages .welcome-inner-section-area .welcome-inner-header h1 {
            line-height: 1.25 !important;
            margin-bottom: 14px !important;
        }

        /* The absolutely placed decorations are the only things in this
           band that can reach past the screen edge on a phone. */
        .inner-pages .welcome-inner-section-area .elementor40,
        .inner-pages .welcome-inner-section-area .elementor32 {
            display: none !important;
        }
    }

    /* ---------------------------------------------------------------
       D. ABOUT PAGE — "Platform History" tabs
          `.tabContainer` is authored at a hard `width: 1300px` with fixed
          heights (400x870 under 768px, 700x860 for 768-991px). At 1085px
          it measures 1300px against a 1085px screen, so 290px of every
          panel is cut off and unreachable; the fixed heights clip the
          text below them. Made fluid up to 1400px, where the authored
          1300x475 box fits its container again and is left as-is.
       --------------------------------------------------------------- */
    @media (max-width: 1399.98px) {
        .about-history-tabs .tabContainer {
            width: 100% !important;
            max-width: 100% !important;
            height: auto !important;
            overflow: visible !important;
        }

        /* The panel switcher stacks every panel absolutely and fades in
           the active one. Promoting only the active panel to `relative`
           lets the container take its height, while the inactive panels
           stay absolutely positioned and invisible exactly as before, so
           the existing tab script keeps working unchanged. */
        .about-history-tabs .tabContainer .Tabcondent.active {
            position: relative !important;
            height: auto !important;
        }

        .about-history-tabs .tabContainer .Tabcondent:not(.active) {
            position: absolute !important;
        }
    }

    @media (max-width: 991.98px) {
        .about-history-tabs .tabContainer .tabs-history-content {
            width: auto !important;
            height: auto !important;
            margin-right: 0 !important;
            padding: 26px 22px !important;
        }

        .about-history-tabs .tabContainer .tabs-images .elementor-img {
            display: none !important;
        }

        .about-history-tabs .tabs-nav {
            display: flex !important;
            flex-wrap: wrap !important;
            justify-content: center !important;
            gap: 8px !important;
        }
    }

    /* ---------------------------------------------------------------
       E. CONTACT PAGE — the embedded map carries width="600"
          height="450" attributes, so it cannot shrink on its own.
       --------------------------------------------------------------- */
    .map-section-area,
    .map-section-area .mapouter,
    .map-section-area .gmap_canvas {
        max-width: 100% !important;
        overflow: hidden;
    }

    .map-section-area iframe,
    .mapouter iframe,
    .gmap_canvas iframe {
        width: 100% !important;
        max-width: 100% !important;
        display: block;
        border: 0;
    }

    @media (max-width: 991.98px) {
        .map-section-area iframe,
        .mapouter iframe,
        .gmap_canvas iframe {
            height: 360px !important;
        }
    }

    @media (max-width: 575.98px) {
        .map-section-area iframe,
        .mapouter iframe,
        .gmap_canvas iframe {
            height: 260px !important;
        }
    }

    /* ---------------------------------------------------------------
       F. SEARCH / FILTER CARD
          Acts, Rules, Free Notes, Courses, Govt. Examination and the
          Legal Knowledge Library all open with the same two-column row
          (a category dropdown beside a search box), written as an inline
          style so it never collapses. Two ~160px columns on a phone
          leaves neither control usable. Matched two ways so it also
          works where :has() is unsupported.
       --------------------------------------------------------------- */
    @media (max-width: 575.98px) {
        [style*="grid-template-columns:1fr 1fr"] {
            grid-template-columns: 1fr !important;
            gap: 14px !important;
        }
    }

    @supports selector(:has(*)) {
        @media (max-width: 575.98px) {
            div:has(> .category-filter-wrapper) {
                grid-template-columns: 1fr !important;
                gap: 14px !important;
            }
        }
    }

    .category-filter-wrapper,
    .category-filter-wrapper > div {
        max-width: 100%;
    }

    /* ---------------------------------------------------------------
       G. FORM CONTROLS (contact form, enquiry form, knowledge inquiry,
          every search box)
          A font-size under 16px makes iOS Safari zoom the whole page in
          on focus, which then leaves the layout scrolled sideways. Font
          size is raised on phones only; the desktop forms are untouched.
       --------------------------------------------------------------- */
    input,
    select,
    textarea,
    button {
        max-width: 100%;
    }

    @media (max-width: 767.98px) {
        input[type="text"],
        input[type="email"],
        input[type="tel"],
        input[type="search"],
        input[type="number"],
        input[type="password"],
        input[type="url"],
        input[type="date"],
        select,
        textarea {
            width: 100% !important;
            font-size: 16px !important;
            min-height: 46px !important;
        }

        textarea {
            min-height: 110px !important;
        }

        button,
        .btn,
        input[type="submit"],
        input[type="button"] {
            min-height: 44px;
        }

        /* The theme's JS replaces every <select> with its own widget. */
        .nice-select {
            width: 100% !important;
            float: none !important;
            font-size: 16px !important;
            height: auto !important;
            min-height: 46px !important;
            line-height: 1.4 !important;
            display: flex !important;
            align-items: center !important;
        }

        .nice-select .list {
            width: 100% !important;
            max-height: 260px;
            overflow-y: auto;
        }
    }

    @media (hover: none) and (pointer: coarse) {
        a,
        button,
        [role="button"],
        .nice-select {
            touch-action: manipulation;
        }
    }

    /* ---------------------------------------------------------------
       H. DECORATIVE LAYERS — the theme's floating cut-outs are absolutely
          placed for desktop widths and are what reaches past the edge on
          a phone.
       --------------------------------------------------------------- */
    @media (max-width: 991.98px) {
        [class^="elementor"],
        [class*=" elementor"] {
            max-width: 100%;
        }
    }

    @media (max-width: 767.98px) {
        .keyframe1,
        .keyframe2,
        .keyframe3,
        .keyframe4,
        .keyframe5 {
            display: none !important;
        }

    }

    /* The theme writes a stacked, in-flow treatment for each of these
       overhanging pieces — but only inside its `$xs` block, which stops at
       767px, while the columns they sit in stay full width up to 991px and
       the page container stays nearly full width up to 1199px. That leaves
       768px-1199px as a gap where they are still placed with desktop
       offsets and run past the screen. Everything below applies the
       theme's own treatment across that gap; none of it is a new layout.

       About page, "Our Story" composition: the second photo and the
       experience badge sit at `right: -70px` / `right: -50px`. */
    @media (min-width: 768px) and (max-width: 991.98px) {
        .about-service-area .experiance-area {
            position: relative !important;
            width: 100% !important;
            top: 0 !important;
            right: 0 !important;
        }

        .about-service-area .about-img2 {
            position: relative !important;
            width: 100% !important;
            height: 100% !important;
            top: 0 !important;
            right: 0 !important;
            bottom: 0 !important;
            left: 0 !important;
            margin-top: 30px !important;
        }
    }

    /* About page, the badge overlapping the photo's top-right corner:
       `right: -50px` is that far past the screen on anything narrower than
       the desktop container, so it gets clipped in half. Pulled back onto
       the corner it belongs to, and scaled on phones to match the smaller
       photo, so the overlap the design asks for still reads. */
    @media (max-width: 1199.98px) {
        .elementors21 img {
            right: 0 !important;
        }
    }

    @media (max-width: 767.98px) {
        .elementors21 img {
            top: -40px !important;
            width: 120px !important;
            height: auto !important;
        }
    }

    /* About page, team cards: the name panel is placed `left: 20px;
       right: -70px`, so it is 50px wider than its own column. The theme
       already gives it `width: 100%; left: 0` — in its `$xs` block, and in
       the RTL stylesheet for `$md` as well, but not in LTR `$md`. Without
       it the last card in the row hangs past the screen edge. */
    @media (max-width: 1199.98px) {
        .team2-parent-boxarea .team2-textarea {
            left: 0 !important;
            right: 0 !important;
            width: 100% !important;
            margin: 0 !important;
        }
    }

    /* About page, the cut-out behind the "Our Story" photo is hidden below
       992px by the theme's own `d-none`, then reappears at `left: -80px`
       for a container that does not have 80px to spare until 1200px. It
       stays hidden for that stretch, exactly as it already is below it. */
    @media (max-width: 1199.98px) {
        .eleemntors30 {
            display: none !important;
        }
    }

    /* ---------------------------------------------------------------
       I. MOTION — respect the OS setting. The scroll animations are also
          what briefly pushes content past the viewport edge while they
          play.
       --------------------------------------------------------------- */
    @media (prefers-reduced-motion: reduce) {
        *,
        *::before,
        *::after {
            animation-duration: 0.001ms !important;
            animation-iteration-count: 1 !important;
            transition-duration: 0.001ms !important;
            scroll-behavior: auto !important;
        }

        [data-aos] {
            opacity: 1 !important;
            transform: none !important;
        }
    }
</style>

{{--
    ===== FRONTEND-WIDE TEXT LEGIBILITY & CONSISTENCY PASS (PURELY ADDITIVE) =====

    Same placement rationale as the block above: this partial is included by
    layouts/landing on every frontend page and is the last thing in <body>,
    so these rules reach Home, About, Acts, Rules, Legal Knowledge, Course,
    Free Notes, Client, Govt. Examination, Gallery, Contact and the Legal
    Knowledge Library without editing a single page file.

    No new design. Every value below is one of three things:
      (a) a style this site already declares, made to actually render;
      (b) a size this site already uses for the same text on a wider screen,
          applied on the screen where it had been shrunk below readable;
      (c) a colour already used elsewhere in this same footer.
    Nothing existing is edited, removed or reordered. No layout, no spacing,
    no component proportions and no brand colour are changed.
--}}

<!-- The site's CSS asks for Poppins in dozens of places per page - the whole
     footer, the course and note cards, the contact labels, the category
     cards - but Poppins is not among the families the theme loads
     (_typography.scss imports Frank Ruhl Libre, Outfit, Playfair Display,
     Urbanist and Vidaloka). Every one of those declarations has therefore
     been falling back to the generic sans, i.e. Arial. Loading it from the
     same provider the theme already uses is what makes the typography that
     is already written in this codebase actually appear. -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet"
      href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700;800&display=swap">

<style>
    /* =====================================================================
       1. ONE BODY FACE INSTEAD OF THREE
          The same audit run on each page at 390px and 1440px returned:
            Home    arial x162, Playfair x90,  "Poppins" x78
            Course  arial x96,  "Poppins" x34, Playfair x33
            Acts    arial x47,  Playfair x35,  "Poppins" x16
            About   Outfit x72, "Poppins" x35, Playfair x23
          So body copy rendered as Arial on most pages and as Outfit on
          About: two pages of the same site did not read as the same site.

          The cause is one line in the theme's own reset —
          _mobile.scss: `body { font-family: 'arial', sans-serif }` — which
          leaves every element that does not name a font of its own on Arial,
          including all the ones asking for Poppins above.

          Re-declaring it here (one rule, on `body`, no !important) hands
          those elements the face the rest of the stylesheet already asks
          for. Anything that names its own family is untouched: headings keep
          Playfair Display, the theme's Outfit components keep Outfit. This
          is the one change in this block that is visible at a glance —
          deleting this single rule reverts it. */
    body {
        font-family: 'Poppins', 'Outfit', -apple-system, "Segoe UI", Roboto, Arial, sans-serif;
    }

    /* Form controls do not inherit a font family by default. On top of that,
       several pages (contact, acts, course, copys, gallery …) carry a
       `button, input, textarea, select { font-family: revert !important }`
       block added to protect form text from an earlier override — `revert`
       hands them back to the browser's own face, which is why every search
       box and contact field renders in Arial while the label beside it does
       not. Only the family is redirected here; the size and weight those
       blocks set are left exactly as they are. */
    input,
    select,
    textarea,
    button,
    label,
    .nice-select,
    .nice-select .current,
    .nice-select .option {
        font-family: inherit !important;
    }

    /* The About page is the one page still reading in a second face. Its
       body copy comes from theme components that name the theme's own
       `$font2` (Outfit) directly, so the `body` rule above does not reach
       them — measured there as Outfit x72 against Poppins x36, while Course
       and Acts now run Poppins x132 and x63. These are exactly those
       components: the same size, weight, colour, spacing and alignment as
       now, reading in the same face as every other page. */
    .tabs-history-content p,
    .tabs-history-content span,
    .tabs-nav a,
    .about3-textarea-list a,
    .about3-textarea p,
    .about3-textarea span,
    .about3-pera-text p,
    .about-service-content p,
    .experiance-area p,
    .history-header span,
    .team1-header span,
    .teamsname p,
    .casebtn1,
    .welcome-inner-header a,
    .contact-submit-area p,
    .contact-content-area p,
    .contact-widget-area .content a,
    .welcome-btn3 {
        font-family: 'Poppins', 'Outfit', sans-serif !important;
    }

    /* =====================================================================
       2. TEXT THAT HAD BEEN SHRUNK BELOW READABLE
          Each of these is set back to the size this site already uses for
          the same element on a wider screen, so nothing moves out of its own
          hierarchy — labels stay smaller than body copy, body copy stays
          smaller than headings.
       ===================================================================== */

    /* Footer legal line: 13px in the base rule, dropped to 11px at 480px. */
    .footer-copyright {
        font-size: 13px !important;
        line-height: 1.7 !important;
    }

    /* Policy row: 13px in the base rule, dropped to 11px at 480px. */
    .footer-links-bottom a {
        font-size: 13px !important;
    }

    /* Quick Links / Programs / Resources columns: 13px in the base rule,
       dropped to 12px at 768px. Held at the base size so the three footer
       link rows all read at one size on every screen. */
    .footer-links a {
        font-size: 13px !important;
    }

    /* Contact labels (EMAIL / ADDRESS / PHONE / WHATSAPP): 12px in the base
       rule, dropped to 11px at 768px. Held at the base 12px on every screen
       so the same label is the same size on every device. */
    .contact-label {
        font-size: 12px !important;
    }

    /* Inner-page breadcrumb ("Home > Acts"). The theme sets 20px, which a
       mobile step cuts to 12px — the smallest text on those pages. 15px is
       the step the theme uses for secondary text at this width. Phones only;
       the 20px desktop breadcrumb is untouched. */
    @media (max-width: 767.98px) {
        .inner-pages .welcome-inner-section-area .welcome-inner-header a {
            font-size: 15px !important;
            line-height: 1.6 !important;
        }
    }

    /* Card price line, 12px. */
    .course-note-card-price {
        font-size: 13px !important;
    }

    /* Inquiry disclaimer, 12.5px. */
    .legal-knowledge-inquiry-disclaimer {
        font-size: 13px !important;
        line-height: 1.8 !important;
    }

    /* The "View All →" link above each home section (12px) and the "Explore"
       tag on the legal-knowledge category cards (10px, the smallest text
       anywhere on the site) carry their size in a style attribute, which an
       ordinary rule cannot reach — matched on that attribute. The arrow
       glyph inside the tag moves with it so it stays optically centred. */
    a[style*="font-size:12px"][style*="#ff5722"] {
        font-size: 13px !important;
    }

    span[style*="font-size:10px"][style*="#ff5722"] {
        font-size: 12px !important;
    }

    span[style*="font-size:10px"][style*="#ff5722"] i[style*="font-size:8px"] {
        font-size: 10px !important;
    }

    /* Gallery tile count badge, 12px. */
    .gallery-item .group-overlay span {
        font-size: 13px !important;
    }

    /* =====================================================================
       3. CONTRAST — both replacements are colours already used above
          #999 on white measures 2.85:1 and #ff5722 on white 3.16:1, against
          the 4.5:1 that text this size needs to stay legible in daylight or
          on a dimmed screen. #6b6b6b holds the same muted-grey role at
          5.33:1, and #b8410f is the exact orange this footer's own headings
          and tagline already use, at 5.52:1.

          The brand orange is left exactly as it is everywhere it carries
          weight — every button, fill, border and large display heading.
          Only small orange *text on a light background* is stepped down.
       ===================================================================== */
    .footer-copyright,
    .course-note-card-price {
        color: #6b6b6b !important;
    }

    .contact-label,
    .courses-notes-eyebrow,
    .about-lawstudent-eyebrow,
    .legal-knowledge-eyebrow,
    .home-contact-eyebrow,
    a[style*="font-size:12px"][style*="#ff5722"],
    span[style*="font-size:10px"][style*="#ff5722"] {
        color: #b8410f !important;
    }

    /* =====================================================================
       4. TOUCH TARGETS
          Scoped to touch pointers, so the desktop layout keeps its exact
          current spacing. These are links measured at 16-28px tall; 44px is
          the comfortable minimum for a thumb. Padding only — no size,
          colour or alignment of the links themselves is changed.
       ===================================================================== */
    @media (hover: none) and (pointer: coarse) {
        .inner-pages .welcome-inner-section-area .welcome-inner-header a {
            display: inline-block;
            padding: 10px 4px;
        }

        .course-note-link,
        a[style*="font-size:12px"][style*="#ff5722"] {
            display: inline-block;
            padding: 10px 0;
        }

        .footer4-contact-info .contact-info-text a,
        .contact-detail a {
            display: inline-block;
            padding: 6px 0;
        }
    }

    /* =====================================================================
       5. LONG WORDS IN NARROW CARDS
          The theme sets a hyphen-free wrap on paragraphs but not on card
          headings, so a long act or course title overhangs its card once a
          grid track gets narrow.
       ===================================================================== */
    .course-note-card h3,
    .course-note-card h4,
    .legal-knowledge-category-card h3 {
        overflow-wrap: break-word;
    }

    /* =====================================================================
       6. KEYBOARD FOCUS
          The theme clears the outline on every link (`a, a:hover { outline:
          none }`), which leaves anyone navigating by keyboard with no idea
          where they are. Restored as a ring in the footer's own #b8410f,
          shown only for keyboard focus — mouse and touch are unchanged and
          nothing is visible until Tab is pressed.
       ===================================================================== */
    a:focus-visible,
    button:focus-visible,
    input:focus-visible,
    select:focus-visible,
    textarea:focus-visible,
    [tabindex]:focus-visible {
        outline: 2px solid #b8410f;
        outline-offset: 2px;
    }
</style>
