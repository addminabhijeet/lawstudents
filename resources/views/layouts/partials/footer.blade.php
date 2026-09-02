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

/* Footer text - responsive sizing */
.footer-text-area p {
    font-size: 13px !important;
    line-height: 1.6 !important;
    color: #666 !important;
    margin-bottom: 20px !important;
}

@media (min-width: 576px) {
    .footer-text-area p {
        font-size: 14px !important;
    }
}

@media (min-width: 768px) {
    .footer-text-area p {
        font-size: 14px !important;
    }
}

@media (min-width: 1200px) {
    .footer-text-area p {
        font-size: 15px !important;
    }
}

/* Footer links - responsive sizing */
.about-links-area ul li a,
.get-links-area ul li a {
    font-size: 13px !important;
    color: #333 !important;
    transition: all 0.3s ease !important;
}

@media (min-width: 576px) {
    .about-links-area ul li a,
    .get-links-area ul li a {
        font-size: 13px !important;
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
        font-size: 14px !important;
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
    font-size: 13px !important;
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

.footer-btn button {
    font-size: 13px !important;
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
</style>

<div class="footer3-section-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-all-section-area sp5">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-last-section text-center">
                                <div class="footer-imgage"
                                    style="width:350px; height:90px; display:flex; align-items:center; justify-content:center; overflow:hidden; margin:0 auto 15px;">
                                    <img src="assets/images/logo-full.png" alt=""
                                        style="width:100%; height:100%; object-fit:contain;">
                                </div>

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

                                <div class="footer-text-area text-center">
                                    <p>{!! nl2br($description) !!}</p>

                                    <div class="social-list-area">
                                        <ul style="display:flex; justify-content:center; padding:0;">
                                            <li><a href="{{ $facebook }}"><i
                                                        class="fa-brands fa-facebook-f"></i></a></li>
                                            <li><a href="{{ $twitter }}"><i class="fa-brands fa-x-twitter"></i></a>
                                            </li>
                                            <li><a href="{{ $linkedin }}"><i class="fa-brands fa-linkedin"></i></a>
                                            </li>
                                            <li><a href="{{ $instagram }}"><i class="fa-brands fa-instagram"></i></a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-6">
                            <div class="about-links-area">
                                <h3>About Link</h3>
                                <ul>
                                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                                    <li><a href="{{ route('frontend.acts') }}">Acts</a></li>
                                    <li><a href="{{ route('frontend.rules') }}">Rules</a></li>
                                    <li><a href="{{ route('frontend.copys') }}">Free Notes</a></li>
                                    <li><a href="{{ route('frontend.clientele') }}">Client</a></li>
                                    <li><a href="{{ route('frontend.course') }}">Course</a></li>
                                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                                    <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
                                    <li><a href="{{ route('login') }}">Login</a></li>
                                </ul>
                            </div>
                        </div>

                        <div class="col-lg-3 col-md-6">
                            <div class="get-links-area">
                                <h3>Get In Touch</h3>
                                <ul>
                                    <li><img src="/img/icons/footer-email2.svg" alt=""><a
                                            href="maito:{{ $email }}">{{ $email }}</a></li>
                                    <li><img src="/img/icons/footer-location1.svg" alt=""><a
                                            href="#">{{ $address }}</a>
                                    </li>
                                    <li><img src="/img/icons/footer-phn.svg" alt=""><a
                                            href="tel:{{ $mobile }}">{{ $mobile }}</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="footer-contact-area">
                                <h3>Subscribe Our Newsletter</h3>
                                <div class="footer-form-area">
                                    <form>
                                        <input type="email" placeholder="Enter Your Email">
                                        <div class="footer-btn">
                                            <button type="submit">Subscribe <i
                                                    class="fa-light fa-arrow-right"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="copyright-pera">
                    <p>© Copyright 2024 Law Students</p>
                    <a href="#">Privacy Policy</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== FOOTER ENDS =======-->
