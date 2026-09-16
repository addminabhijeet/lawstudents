<!--===== FOOTER STARTS =======-->
<style>
/* ===== MODERN MOBILE-FIRST FOOTER DESIGN ===== */
.law-footer {
    background: linear-gradient(135deg, #0a141c 0%, #1a2332 50%, #0f1923 100%);
    color: #ffffff;
    padding: 80px 0 0;
    font-family: 'Poppins', sans-serif;
    position: relative;
    overflow: hidden;
}

@media (max-width: 768px) {
    .law-footer {
        padding: 60px 0 0;
    }
}

@media (max-width: 576px) {
    .law-footer {
        padding: 40px 0 0;
    }
}

.law-footer::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #ff5722 0%, #ff7043 50%, #ff5722 100%);
}

.law-footer .footer-content {
    padding: 60px 0;
}

/* ===== FOOTER SECTIONS ===== */
.footer-section {
    margin-bottom: 40px;
}

.footer-section-title {
    font-family: 'Playfair Display', serif !important;
    font-size: 24px !important;
    font-weight: 600 !important;
    color: #ff5722;
    margin-bottom: 25px;
    position: relative;
    padding-bottom: 15px;
    text-transform: uppercase;
    letter-spacing: 1px;
}

.footer-section-title::after {
    content: '';
    position: absolute;
    bottom: 0;
    left: 0;
    width: 50px;
    height: 3px;
    background: #ff5722;
    border-radius: 2px;
}

/* ===== ABOUT SECTION ===== */
.footer-about {
    display: flex;
    flex-direction: column;
    gap: 20px;
}

.footer-logo-section {
    display: flex;
    align-items: center;
    gap: 15px;
    margin-bottom: 20px;
}

.footer-logo-section img {
    width: 50px;
    height: 50px;
    object-fit: contain;
}

.footer-logo-text h3 {
    font-family: 'Playfair Display', serif;
    font-size: 22px;
    font-weight: 600;
    color: #ff5722;
    margin: 0;
}

.footer-description {
    font-size: 15px;
    line-height: 1.8;
    color: #b0bcc4;
    margin: 0;
}

/* ===== LINKS SECTION ===== */
.footer-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.footer-links li {
    margin-bottom: 12px;
}

.footer-links a {
    color: #b0bcc4;
    text-decoration: none;
    font-size: 15px;
    transition: all 0.3s ease;
    display: flex;
    align-items: center;
    gap: 8px;
}

.footer-links a::before {
    content: '▸';
    color: #ff5722;
    font-weight: bold;
}

.footer-links a:hover {
    color: #ff5722;
    padding-left: 8px;
}

/* ===== CONTACT SECTION ===== */
.footer-contact-item {
    display: flex;
    gap: 15px;
    margin-bottom: 20px;
    padding: 15px;
    background: rgba(255, 87, 34, 0.08);
    border-radius: 8px;
    border-left: 3px solid #ff5722;
    transition: all 0.3s ease;
}

.footer-contact-item:hover {
    background: rgba(255, 87, 34, 0.15);
    transform: translateX(5px);
}

.contact-icon {
    width: 45px;
    height: 45px;
    background: #ff5722;
    border-radius: 8px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: white;
    font-size: 20px;
    flex-shrink: 0;
}

.contact-details {
    display: flex;
    flex-direction: column;
    gap: 5px;
}

.contact-label {
    font-size: 12px;
    color: #ff5722;
    text-transform: uppercase;
    font-weight: 600;
    letter-spacing: 0.5px;
}

.contact-value {
    font-size: 15px;
    color: #ffffff;
    font-weight: 500;
}

.contact-value a {
    color: #ffffff;
    text-decoration: none;
    transition: all 0.3s ease;
}

.contact-value a:hover {
    color: #ff5722;
}

/* ===== SOCIAL ICONS ===== */
.footer-social {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
    margin-top: 20px;
}

.social-icon {
    width: 42px;
    height: 42px;
    background: rgba(255, 87, 34, 0.2);
    border: 2px solid #ff5722;
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ff5722;
    text-decoration: none;
    transition: all 0.3s ease;
    font-size: 18px;
}

.social-icon:hover {
    background: #ff5722;
    color: #ffffff;
    transform: translateY(-4px);
    box-shadow: 0 8px 20px rgba(255, 87, 34, 0.3);
}

/* ===== NEWSLETTER SECTION ===== */
.newsletter-form {
    display: flex;
    flex-direction: column;
    gap: 10px;
    margin-top: 20px;
}

.newsletter-form input {
    padding: 12px 15px;
    border: 2px solid rgba(255, 87, 34, 0.3);
    background: rgba(255, 87, 34, 0.05);
    color: #ffffff;
    border-radius: 6px;
    font-size: 14px;
    transition: all 0.3s ease;
    font-family: 'Poppins', sans-serif;
}

.newsletter-form input::placeholder {
    color: #7a8a96;
}

.newsletter-form input:focus {
    outline: none;
    border-color: #ff5722;
    background: rgba(255, 87, 34, 0.1);
    box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.2);
}

.newsletter-btn {
    padding: 12px 20px;
    background: linear-gradient(135deg, #ff5722 0%, #ff7043 100%);
    color: white;
    border: none;
    border-radius: 6px;
    font-size: 14px;
    font-weight: 600;
    cursor: pointer;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.newsletter-btn:hover {
    background: linear-gradient(135deg, #ff7043 0%, #ff5722 100%);
    transform: translateY(-2px);
    box-shadow: 0 8px 20px rgba(255, 87, 34, 0.3);
}

/* ===== FOOTER BOTTOM ===== */
.footer-bottom {
    border-top: 1px solid rgba(255, 87, 34, 0.2);
    padding: 30px 0;
    background: rgba(0, 0, 0, 0.3);
}

.footer-bottom-content {
    display: flex;
    justify-content: space-between;
    align-items: center;
    flex-wrap: wrap;
    gap: 20px;
}

.footer-copyright {
    font-size: 14px;
    color: #7a8a96;
}

.footer-bottom-links {
    display: flex;
    gap: 20px;
    flex-wrap: wrap;
}

.footer-bottom-links a {
    color: #7a8a96;
    text-decoration: none;
    font-size: 13px;
    transition: all 0.3s ease;
    text-transform: uppercase;
    letter-spacing: 0.5px;
}

.footer-bottom-links a:hover {
    color: #ff5722;
}

/* ===== RESPONSIVE DESIGN ===== */
@media (max-width: 1024px) {
    .law-footer .footer-content {
        padding: 50px 0;
    }

    .footer-section-title {
        font-size: 20px !important;
        margin-bottom: 20px;
    }

    .footer-section {
        margin-bottom: 30px;
    }
}

@media (max-width: 768px) {
    .law-footer {
        padding: 60px 0 0;
    }

    .law-footer .footer-content {
        padding: 40px 0;
    }

    .footer-section {
        margin-bottom: 30px;
        padding-bottom: 25px;
        border-bottom: 1px solid rgba(255, 87, 34, 0.1);
    }

    .footer-section:last-child {
        border-bottom: none;
    }

    .footer-section-title {
        font-size: 18px !important;
        margin-bottom: 15px;
    }

    .footer-bottom-content {
        flex-direction: column;
        text-align: center;
    }

    .footer-bottom-links {
        justify-content: center;
    }

    .footer-contact-item {
        margin-bottom: 15px;
    }

    .social-icon {
        width: 38px;
        height: 38px;
        font-size: 16px;
    }
}

@media (max-width: 576px) {
    .law-footer {
        padding: 50px 0 0;
    }

    .law-footer .footer-content {
        padding: 30px 0;
    }

    .footer-section-title {
        font-size: 16px !important;
        margin-bottom: 12px;
    }

    .footer-section-title::after {
        width: 40px;
    }

    .footer-description {
        font-size: 13px;
    }

    .footer-links a {
        font-size: 13px;
    }

    .contact-value {
        font-size: 13px;
    }

    .footer-copyright {
        font-size: 12px;
    }

    .footer-bottom-links a {
        font-size: 11px;
    }

    .newsletter-form input,
    .newsletter-btn {
        font-size: 13px;
        padding: 10px 12px;
    }

    .social-icon {
        width: 36px;
        height: 36px;
        font-size: 14px;
    }
}
</style>

<footer class="law-footer">
    <div class="container">
        <div class="footer-content">
            <div class="row">
                @php
                    $user = \App\Models\User::first();
                    $address = !empty($user->webaddress) ? $user->webaddress : '224 Legal District, Delhi High Court Marg, New Delhi 110001';
                    $email = !empty($user->webemail) ? $user->webemail : 'lawstudents.edu@gmail.com';
                    $mobile = !empty($user->mobile) ? $user->mobile : '+91 662453 63220';
                    $twitter = !empty($user->twitter) ? $user->twitter : '#';
                    $pinterest = !empty($user->pinterest) ? $user->pinterest : '#';
                    $instagram = !empty($user->instagram) ? $user->instagram : '#';
                    $facebook = !empty($user->facebook) ? $user->facebook : '#';
                    $linkedin = !empty($user->linkedin) ? $user->linkedin : '#';
                    $youtube = !empty($user->youtube) ? $user->youtube : '#';
                @endphp

                <!-- About Section -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <div class="footer-logo-section">
                            <img src="/assets/images/logo-full.png" alt="Law Students">
                            <div class="footer-logo-text">
                                <h3>Law Students</h3>
                            </div>
                        </div>
                        <p class="footer-description">
                            A comprehensive platform dedicated to legal education, examination preparation, and professional growth for aspiring legal professionals.
                        </p>
                        <div class="footer-social">
                            <a href="{{ $facebook }}" class="social-icon" title="Facebook">
                                <i class="fab fa-facebook-f"></i>
                            </a>
                            <a href="{{ $twitter }}" class="social-icon" title="Twitter">
                                <i class="fab fa-x-twitter"></i>
                            </a>
                            <a href="{{ $instagram }}" class="social-icon" title="Instagram">
                                <i class="fab fa-instagram"></i>
                            </a>
                            <a href="{{ $linkedin }}" class="social-icon" title="LinkedIn">
                                <i class="fab fa-linkedin-in"></i>
                            </a>
                            <a href="{{ $youtube }}" class="social-icon" title="YouTube">
                                <i class="fab fa-youtube"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Quick Links -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-section-title">Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('frontend.home') }}">Home</a></li>
                            <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                            <li><a href="{{ route('frontend.course') }}">Courses</a></li>
                            <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                            <li><a href="{{ route('frontend.legal-knowledge') }}">Legal Knowledge</a></li>
                            <li><a href="{{ route('frontend.copys') }}">Study Materials</a></li>
                            <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Services -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-section-title">Programs</h4>
                        <ul class="footer-links">
                            <li><a href="{{ route('frontend.course') }}">LL.B. Entrance Prep</a></li>
                            <li><a href="{{ route('frontend.course') }}">LL.B. (3-Year)</a></li>
                            <li><a href="{{ route('frontend.course') }}">LL.B. (5-Year)</a></li>
                            <li><a href="{{ route('frontend.course') }}">LL.M. Specialization</a></li>
                            <li><a href="{{ route('frontend.course') }}">Judiciary Exams</a></li>
                            <li><a href="{{ route('frontend.course') }}">CA Studies</a></li>
                            <li><a href="{{ route('frontend.course') }}">CS Studies</a></li>
                        </ul>
                    </div>
                </div>

                <!-- Contact & Newsletter -->
                <div class="col-lg-3 col-md-6">
                    <div class="footer-section">
                        <h4 class="footer-section-title">Contact</h4>

                        <div class="footer-contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-envelope"></i>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Email</span>
                                <span class="contact-value">
                                    <a href="mailto:{{ $email }}">{{ $email }}</a>
                                </span>
                            </div>
                        </div>

                        <div class="footer-contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-phone"></i>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Phone</span>
                                <span class="contact-value">
                                    <a href="tel:{{ preg_replace('/[^0-9+]/', '', $mobile) }}">{{ $mobile }}</a>
                                </span>
                            </div>
                        </div>

                        <div class="footer-contact-item">
                            <div class="contact-icon">
                                <i class="fas fa-map-marker-alt"></i>
                            </div>
                            <div class="contact-details">
                                <span class="contact-label">Address</span>
                                <span class="contact-value">{{ $address }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer Bottom -->
    <div class="footer-bottom">
        <div class="container">
            <div class="footer-bottom-content">
                <p class="footer-copyright">
                    &copy; {{ date('Y') }} Law Students. All Rights Reserved.
                </p>
                <div class="footer-bottom-links">
                    <a href="#">Privacy Policy</a>
                    <a href="#">Terms & Conditions</a>
                    <a href="#">Disclaimer</a>
                    <a href="#">Refund Policy</a>
                </div>
            </div>
        </div>
    </div>
</footer>
<!--===== FOOTER ENDS =======-->
