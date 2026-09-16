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
