<!--===== FOOTER STARTS =======-->

<style>
/* Footer Improvements - Responsive Design & Orange Theme */

/* Orange divider above footer */
.footer3-section-area {
    border-top: 4px solid #ff5722 !important;
    margin-top: 40px !important;
}

/* Responsive padding for footer */
.footer3-section-area {
    padding: 30px 15px !important;
}

@media (min-width: 576px) {
    .footer3-section-area {
        padding: 40px 20px !important;
    }
}

@media (min-width: 768px) {
    .footer3-section-area {
        padding: 50px 30px !important;
    }
}

@media (min-width: 1200px) {
    .footer3-section-area {
        padding: 60px 50px !important;
    }
}

/* Footer alignment - all sections aligned to top */
.footer-all-section-area .row {
    display: flex !important;
    align-items: flex-start !important;
}

.footer-all-section-area .row > div {
    display: flex !important;
    flex-direction: column !important;
    justify-content: flex-start !important;
    align-items: flex-start !important;
}

/* Override Bootstrap column centering - highest specificity */
.footer3-section-area .container .row .col-lg-2,
.footer3-section-area .container .row .col-lg-3,
.footer3-section-area .container .row .col-lg-4 {
    align-items: flex-start !important;
}

/* Direct override for any col with flex */
div[class*="col-lg-"] {
    align-items: flex-start !important;
}

/* Override footer-contact-area centering and remove offset */
.footer-contact-area {
    display: flex !important;
    flex-direction: column !important;
    align-items: flex-start !important;
    justify-content: flex-start !important;
    margin-top: 0 !important;
    padding-top: 0 !important;
}

/* Remove margin-top from footer-contact-area on all screen sizes */
@media (max-width: 575px) {
    .footer-contact-area {
        margin-top: 0 !important;
    }
}

@media (min-width: 576px) and (max-width: 767px) {
    .footer-contact-area {
        margin-top: 0 !important;
    }
}

@media (min-width: 768px) {
    .footer-contact-area {
        margin-top: 0 !important;
    }
}

/* Footer section headers - responsive sizing */
.footer-last-section h3,
.about-links-area h3,
.get-links-area h3,
.footer-contact-area h3 {
    font-size: 16px !important;
    font-weight: 600 !important;
    color: #ff5722 !important;
    margin-bottom: 15px !important;
    text-transform: uppercase !important;
    letter-spacing: 0.5px !important;
}

@media (min-width: 576px) {
    .footer-last-section h3,
    .about-links-area h3,
    .get-links-area h3,
    .footer-contact-area h3 {
        font-size: 17px !important;
    }
}

@media (min-width: 768px) {
    .footer-last-section h3,
    .about-links-area h3,
    .get-links-area h3,
    .footer-contact-area h3 {
        font-size: 18px !important;
    }
}

@media (min-width: 1200px) {
    .footer-last-section h3,
    .about-links-area h3,
    .get-links-area h3,
    .footer-contact-area h3 {
        font-size: 19px !important;
    }
}

/* Footer text - responsive sizing (IMPROVED) */
.footer-text-area p {
    font-size: 14px !important;
    line-height: 1.6 !important;
    color: #666 !important;
    margin-bottom: 20px !important;
}

@media (min-width: 576px) {
    .footer-text-area p {
        font-size: 15px !important;
    }
}

@media (min-width: 768px) {
    .footer-text-area p {
        font-size: 16px !important;
    }
}

@media (min-width: 1200px) {
    .footer-text-area p {
        font-size: 16px !important;
    }
}

/* Footer links - responsive sizing (IMPROVED) */
.about-links-area ul li a,
.get-links-area ul li a {
    font-size: 14px !important;
    color: #333 !important;
    transition: all 0.3s ease !important;
    line-height: 1.6 !important;
}

@media (min-width: 576px) {
    .about-links-area ul li a,
    .get-links-area ul li a {
        font-size: 14px !important;
    }
}

@media (min-width: 768px) {
    .about-links-area ul li a,
    .get-links-area ul li a {
        font-size: 14px !important;
    }
}

@media (min-width: 1200px) {
    .about-links-area ul li a,
    .get-links-area ul li a {
        font-size: 15px !important;
    }
}

/* Footer links hover effect */
.about-links-area ul li a:hover,
.get-links-area ul li a:hover {
    color: #ff5722 !important;
    margin-left: 5px !important;
}

/* Social icons styling */
.social-list-area ul li a {
    width: 40px !important;
    height: 40px !important;
    display: inline-flex !important;
    align-items: center !important;
    justify-content: center !important;
    border-radius: 50% !important;
    background-color: #ff5722 !important;
    color: white !important;
    transition: all 0.3s ease !important;
    margin: 0 8px !important;
}

@media (min-width: 768px) {
    .social-list-area ul li a {
        width: 45px !important;
        height: 45px !important;
        margin: 0 10px !important;
    }
}

.social-list-area ul li a:hover {
    background-color: #e64a19 !important;
    transform: translateY(-3px) !important;
}

/* Newsletter form - responsive */
.footer-form-area form {
    display: flex !important;
    flex-direction: column !important;
    gap: 10px !important;
}

@media (min-width: 768px) {
    .footer-form-area form {
        display: flex !important;
        flex-direction: row !important;
        gap: 0 !important;
    }
}

.footer-form-area input {
    font-size: 14px !important;
    padding: 12px 15px !important;
    border: 1px solid #ddd !important;
    border-radius: 4px 0 0 4px !important;
    flex: 1 !important;
}

@media (min-width: 576px) {
    .footer-form-area input {
        font-size: 14px !important;
        padding: 13px 16px !important;
    }
}

@media (min-width: 768px) {
    .footer-form-area input {
        font-size: 15px !important;
        padding: 13px 18px !important;
    }
}

.footer-btn button {
    font-size: 14px !important;
    padding: 12px 20px !important;
    background-color: #ff5722 !important;
    color: white !important;
    border: none !important;
    border-radius: 0 4px 4px 0 !important;
    cursor: pointer !important;
    transition: all 0.3s ease !important;
    font-weight: 600 !important;
}

@media (min-width: 576px) {
    .footer-btn button {
        font-size: 14px !important;
        padding: 13px 25px !important;
    }
}

@media (min-width: 768px) {
    .footer-btn button {
        font-size: 15px !important;
        padding: 13px 28px !important;
    }
}

@media (min-width: 768px) {
    .footer-form-area input {
        border-radius: 4px 0 0 4px !important;
    }

    .footer-btn button {
        border-radius: 0 4px 4px 0 !important;
    }
}

.footer-btn button:hover {
    background-color: #e64a19 !important;
}

/* Copyright section - responsive */
.copyright-pera {
    margin-top: 30px !important;
    padding-top: 20px !important;
    border-top: 1px solid #eee !important;
    display: flex !important;
    justify-content: space-between !important;
    align-items: center !important;
    flex-wrap: wrap !important;
    gap: 15px !important;
}

.copyright-pera p {
    font-size: 12px !important;
    color: #999 !important;
    margin: 0 !important;
    line-height: 1.5 !important;
}

@media (min-width: 576px) {
    .copyright-pera p {
        font-size: 13px !important;
    }
}

@media (min-width: 1200px) {
    .copyright-pera p {
        font-size: 13px !important;
    }
}

.copyright-pera a {
    font-size: 12px !important;
    color: #ff5722 !important;
    text-decoration: none !important;
    transition: all 0.3s ease !important;
}

@media (min-width: 576px) {
    .copyright-pera a {
        font-size: 13px !important;
    }
}

@media (min-width: 1200px) {
    .copyright-pera a {
        font-size: 13px !important;
    }
}

.copyright-pera a:hover {
    text-decoration: underline !important;
    color: #e64a19 !important;
}

/* Footer section spacing */
.footer-all-section-area .row > div {
    margin-bottom: 30px !important;
}

@media (min-width: 768px) {
    .footer-all-section-area .row > div {
        margin-bottom: 0 !important;
    }
}

/* Get in touch list styling */
.get-links-area ul li {
    display: flex !important;
    align-items: center !important;
    margin-bottom: 12px !important;
    gap: 10px !important;
}

.get-links-area ul li img {
    width: 20px !important;
    height: 20px !important;
    min-width: 20px !important;
}

/* About links list styling */
.about-links-area ul li {
    margin-bottom: 8px !important;
}

.about-links-area ul {
    padding-left: 0 !important;
    list-style: none !important;
}

/* Text centering for mobile */
@media (max-width: 767px) {
    .about-links-area,
    .get-links-area {
        text-align: center !important;
    }

    .about-links-area ul,
    .get-links-area ul {
        display: flex !important;
        flex-direction: column !important;
        align-items: center !important;
    }

    .get-links-area ul li {
        justify-content: center !important;
    }
}

/* ===== DESIGN IMPROVEMENTS: Visual Hierarchy & Professional Polish ===== */

/* IMPROVEMENT 1: Enhanced Header Styling - Make Headers More Distinctive */
.footer-last-section h3,
.about-links-area h3,
.get-links-area h3,
.footer-contact-area h3 {
    font-size: 18px !important;
    font-weight: 700 !important;
    text-transform: uppercase !important;
    letter-spacing: 1px !important;
    color: #ff5722 !important;
    margin-bottom: 20px !important;
    position: relative !important;
    padding-bottom: 12px !important;
}

@media (min-width: 576px) {
    .footer-last-section h3,
    .about-links-area h3,
    .get-links-area h3,
    .footer-contact-area h3 {
        font-size: 19px !important;
    }
}

@media (min-width: 768px) {
    .footer-last-section h3,
    .about-links-area h3,
    .get-links-area h3,
    .footer-contact-area h3 {
        font-size: 20px !important;
    }
}

/* Header divider line using ::after pseudo-element */
.footer-last-section h3::after,
.about-links-area h3::after,
.get-links-area h3::after,
.footer-contact-area h3::after {
    content: '' !important;
    position: absolute !important;
    bottom: 0 !important;
    left: 0 !important;
    width: 40px !important;
    height: 3px !important;
    background: #ff5722 !important;
}

/* IMPROVEMENT 2: Enhanced Whitespace & Section Padding */
.footer-all-section-area {
    padding: 40px !important;
}

@media (min-width: 768px) {
    .footer-all-section-area {
        padding: 50px 40px !important;
    }
}

/* IMPROVEMENT 3: Visual Section Separation - Borders & Backgrounds */
@media (min-width: 768px) {
    .about-links-area {
        border-left: 4px solid #ff5722 !important;
        padding-left: 20px !important;
        background: rgba(255, 87, 34, 0.03) !important;
        padding: 20px 20px 20px 20px !important;
        border-radius: 6px !important;
    }

    .get-links-area {
        border-left: 4px solid #ff5722 !important;
        padding-left: 20px !important;
        background: rgba(255, 87, 34, 0.03) !important;
        padding: 20px 20px 20px 20px !important;
        border-radius: 6px !important;
    }

    .footer-contact-area {
        border-left: 4px solid #ff5722 !important;
        padding-left: 20px !important;
        background: linear-gradient(135deg, rgba(255, 87, 34, 0.08) 0%, rgba(255, 87, 34, 0.03) 100%) !important;
        padding: 20px !important;
        border-radius: 6px !important;
    }
}

/* IMPROVEMENT 4: Link Styling with Orange Bullet Points */
.about-links-area ul li a::before,
.get-links-area ul li a::before {
    content: '' !important;
    display: inline-block !important;
    width: 6px !important;
    height: 6px !important;
    background: #ff5722 !important;
    border-radius: 50% !important;
    margin-right: 10px !important;
    vertical-align: middle !important;
}

/* IMPROVEMENT 5: Enhanced Link Hover Effects */
.about-links-area ul li a,
.get-links-area ul li a {
    position: relative !important;
    transition: all 0.3s ease !important;
}

.about-links-area ul li a:hover::before,
.get-links-area ul li a:hover::before {
    background: #e64a19 !important;
    transform: scale(1.3) !important;
}

.about-links-area ul li a:hover,
.get-links-area ul li a:hover {
    color: #ff5722 !important;
    padding-left: 8px !important;
}

/* IMPROVEMENT 6: Enhanced Button Styling with Gradient & Shadow */
.footer-btn button {
    background: linear-gradient(135deg, #ff5722 0%, #ff7043 100%) !important;
    box-shadow: 0 4px 15px rgba(255, 87, 34, 0.25) !important;
    transition: all 0.3s ease !important;
    font-weight: 700 !important;
}

.footer-btn button:hover {
    background: linear-gradient(135deg, #e64a19 0%, #ff5722 100%) !important;
    box-shadow: 0 6px 20px rgba(255, 87, 34, 0.35) !important;
    transform: translateY(-2px) !important;
}

/* IMPROVEMENT 7: Enhanced Input Field Styling */
.footer-form-area input {
    border: 2px solid #ff5722 !important;
    transition: all 0.3s ease !important;
    background: #fafafa !important;
}

.footer-form-area input:focus {
    border-color: #e64a19 !important;
    box-shadow: 0 0 10px rgba(255, 87, 34, 0.2) !important;
    background: white !important;
    outline: none !important;
}

.footer-form-area input::placeholder {
    color: #bbb !important;
}

/* IMPROVEMENT 8: Increased List Item Spacing */
.about-links-area ul li,
.get-links-area ul li {
    margin-bottom: 14px !important;
}

/* IMPROVEMENT 9: Newsletter Section Enhancement */
.footer-contact-area h3 {
    font-size: 19px !important;
}

@media (min-width: 768px) {
    .footer-contact-area h3 {
        font-size: 21px !important;
    }
}

/* IMPROVEMENT 10: Social Icons Hover Enhancement */
.social-list-area ul li a {
    transition: all 0.3s ease !important;
}

.social-list-area ul li a:hover {
    background-color: #e64a19 !important;
    transform: translateY(-4px) scale(1.05) !important;
    box-shadow: 0 6px 15px rgba(255, 87, 34, 0.3) !important;
}

/* IMPROVEMENT 11: Footer All Section Area Spacing Optimization */
@media (min-width: 768px) {
    .footer-all-section-area .row > div {
        margin-bottom: 0 !important;
        padding-right: 20px !important;
    }

    .footer-all-section-area .row > div:last-child {
        padding-right: 0 !important;
    }
}

/* IMPROVEMENT 12: Text Area Padding Optimization */
.footer-text-area {
    margin-bottom: 25px !important;
}

@media (min-width: 768px) {
    .footer-text-area {
        margin-bottom: 0 !important;
    }
}

/* ENHANCEMENT: Social Media Icons in Social Media Section */
.about-links-area ul li a[href*="facebook"],
.about-links-area ul li a[href*="twitter"],
.about-links-area ul li a[href*="instagram"],
.about-links-area ul li a[href*="linkedin"] {
    transition: all 0.3s ease !important;
    position: relative !important;
}

.about-links-area ul li a[href*="facebook"]:hover,
.about-links-area ul li a[href*="twitter"]:hover,
.about-links-area ul li a[href*="instagram"]:hover,
.about-links-area ul li a[href*="linkedin"]:hover {
    background-color: #e64a19 !important;
    transform: translateY(-4px) scale(1.05) !important;
    box-shadow: 0 6px 15px rgba(255, 87, 34, 0.3) !important;
}

/* ENHANCEMENT: Footer Bottom - Full Width Containers */
.copyright-pera {
    margin-left: -9999px !important;
    margin-right: -9999px !important;
    padding-left: calc(9999px + 15px) !important;
    padding-right: calc(9999px + 15px) !important;
    display: flex !important;
    justify-content: center !important;
    flex-wrap: wrap !important;
    gap: 15px !important;
}

.copyright-pera a {
    transition: all 0.3s ease !important;
}

.footer3-section-area .copyright-pera {
    padding-top: 20px !important;
    padding-bottom: 20px !important;
}

/* Orange links container styling - already in inline styles, just ensure full width */
/* White copyright container styling - already in inline styles, just ensure full width */

/* ===== END DESIGN IMPROVEMENTS ===== */
</style>

<div class="footer3-section-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-all-section-area sp5">
                    @php
                        $user = \App\Models\User::first();
                        $address = !empty($user->webaddress) ? $user->webaddress : 'email@gmail.com';
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

                    <!-- First Row: Logo, Quick Links, Courses -->
                    <div class="row">
                        <!-- Column 1: Logo and Description -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <!-- Logo Image -->
                                <div style="margin-bottom: 20px;">
                                    <img src="assets/images/logo-full.png" alt="Law Students Logo" style="width: 250px; height: auto; max-width: 100%;">
                                </div>

                                <div style="margin-top: 15px;">
                                    <p style="font-size: 14px; line-height: 1.6; color: #333; margin: 0; margin-bottom: 20px;">{!! nl2br($description) !!}</p>
                                </div>
                            </div>
                        </div>

                        <!-- Column 2: Quick Links -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <h3>QUICK LINKS</h3>
                                <ul>
                                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                    <li><a href="{{ route('frontend.acts') }}">Acts & Rules</a></li>
                                    <li><a href="{{ route('frontend.copys') }}">Legal Knowledge</a></li>
                                    <li><a href="{{ route('frontend.course') }}">Courses</a></li>
                                    <li><a href="{{ route('frontend.copys') }}">Free Notes</a></li>
                                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Courses -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <h3>COURSES</h3>
                                <ul>
                                    <li><a href="{{ route('frontend.course') }}">LL.B. Entrance</a></li>
                                    <li><a href="{{ route('frontend.course') }}">LL.B. 3 Years</a></li>
                                    <li><a href="{{ route('frontend.course') }}">LL.B. 5 Years</a></li>
                                    <li><a href="{{ route('frontend.course') }}">LL.M.</a></li>
                                    <li><a href="{{ route('frontend.course') }}">Judiciary</a></li>
                                    <li><a href="{{ route('frontend.course') }}">CSEET</a></li>
                                    <li><a href="{{ route('frontend.course') }}">CA</a></li>
                                    <li><a href="{{ route('frontend.course') }}">CS</a></li>
                                    <li><a href="{{ route('frontend.course') }}">CMA</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <!-- Second Row: Contact, Resources, Social Media -->
                    <div class="row" style="margin-top: 30px;">
                        <!-- Column 1: Contact -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <h3>CONTACT</h3>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <!-- Email -->
                                    <li style="margin-bottom: 25px; display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                                        <div style="width: 40px; height: 40px; background-color: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <img src="/img/icons/footer-email2.svg" alt="Email" style="width: 20px; height: 20px;">
                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 12px; font-weight: 600; color: #ff5722; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Email</span>
                                            <a href="mailto:{{ $email }}" style="color: #333; text-decoration: none; font-size: 13px; font-weight: 500; transition: color 0.3s ease;" onmouseover="this.style.color='#ff5722'" onmouseout="this.style.color='#333'">{{ $email }}</a>
                                        </div>
                                    </li>

                                    <!-- Address -->
                                    <li style="margin-bottom: 25px; display: flex; align-items: flex-start; gap: 15px; transition: all 0.3s ease;">
                                        <div style="width: 40px; height: 40px; background-color: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; margin-top: 2px;">
                                            <img src="/img/icons/footer-location1.svg" alt="Address" style="width: 20px; height: 20px;">
                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 12px; font-weight: 600; color: #ff5722; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Address</span>
                                            <a href="#" style="color: #333; text-decoration: none; font-size: 13px; font-weight: 500; line-height: 1.5; transition: color 0.3s ease;" onmouseover="this.style.color='#ff5722'" onmouseout="this.style.color='#333'">{{ $address }}</a>
                                        </div>
                                    </li>

                                    <!-- Phone -->
                                    <li style="display: flex; align-items: center; gap: 15px; transition: all 0.3s ease;">
                                        <div style="width: 40px; height: 40px; background-color: #fff3e0; border-radius: 8px; display: flex; align-items: center; justify-content: center; flex-shrink: 0;">
                                            <img src="/img/icons/footer-phn.svg" alt="Phone" style="width: 20px; height: 20px;">
                                        </div>
                                        <div style="display: flex; flex-direction: column;">
                                            <span style="font-size: 12px; font-weight: 600; color: #ff5722; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 4px;">Phone</span>
                                            <a href="tel:{{ $mobile }}" style="color: #333; text-decoration: none; font-size: 13px; font-weight: 500; transition: color 0.3s ease;" onmouseover="this.style.color='#ff5722'" onmouseout="this.style.color='#333'">{{ $mobile }}</a>
                                        </li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 2: Resources -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <h3>RESOURCES</h3>
                                <ul>
                                    <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                                    <li><a href="{{ route('frontend.rules') }}">Rules</a></li>
                                    <li><a href="#">Notifications</a></li>
                                    <li><a href="#">Govt. Exams</a></li>
                                </ul>
                            </div>
                        </div>

                        <!-- Column 3: Social Media -->
                        <div class="col-lg-4 col-md-6">
                            <div class="about-links-area">
                                <h3>SOCIAL MEDIA</h3>
                                <ul style="list-style: none; padding: 0; display: flex; gap: 15px; flex-wrap: wrap;">
                                    <li>
                                        <a href="{{ $facebook }}" style="width: 45px; height: 45px; background-color: #ff5722; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; text-decoration: none;">
                                            <i class="fa-brands fa-facebook-f"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $twitter }}" style="width: 45px; height: 45px; background-color: #ff5722; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; text-decoration: none;">
                                            <i class="fa-brands fa-x-twitter"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $instagram }}" style="width: 45px; height: 45px; background-color: #ff5722; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; text-decoration: none;">
                                            <i class="fa-brands fa-instagram"></i>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ $linkedin }}" style="width: 45px; height: 45px; background-color: #ff5722; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; text-decoration: none;">
                                            <i class="fa-brands fa-linkedin"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Bottom Links -->
                <div class="copyright-pera" style="margin-top: 30px; background-color: #ff5722; color: white;">
                    <a href="#" style="color: white; text-decoration: none; font-weight: 600;">Privacy Policy</a>
                    <span style="color: rgba(255, 255, 255, 0.6);">|</span>
                    <a href="#" style="color: white; text-decoration: none; font-weight: 600;">Terms & Conditions</a>
                    <span style="color: rgba(255, 255, 255, 0.6);">|</span>
                    <a href="#" style="color: white; text-decoration: none; font-weight: 600;">Disclaimer</a>
                    <span style="color: rgba(255, 255, 255, 0.6);">|</span>
                    <a href="#" style="color: white; text-decoration: none; font-weight: 600;">Refund Policy</a>
                    <span style="color: rgba(255, 255, 255, 0.6);">|</span>
                    <a href="#" style="color: white; text-decoration: none; font-weight: 600;">Sitemap</a>
                </div>

                <!-- Copyright -->
                <div class="copyright-pera" style="background-color: white; text-align: center;">
                    <p style="color: #666; margin: 0; font-size: 14px;">© 2026 LawStudent. All Rights Reserved.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== FOOTER ENDS =======-->
