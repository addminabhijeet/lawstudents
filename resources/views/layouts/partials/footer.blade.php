<!--===== FOOTER STARTS =======-->
<div class="footer3-section-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="footer-all-section-area sp5">
                    <div class="row">
                        <div class="col-lg-3 col-md-6">
                            <div class="footer-last-section">
                                <div class="footer-imgage"
                                    style="width:160px; height:70px; display:flex; align-items:center; justify-content:flex-start; overflow:hidden; margin-bottom:15px;">
                                    <img src="/img/logo/logo5.png" alt=""
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
                                        : 'Revolutionize Your Future: Harness the Power of Technology for Unparalleled
                                            Growth and Success!';
                                @endphp

                                <div class="footer-text-area">
                                    <p>{{ $description }}</p>
                                    <div class="social-list-area">
                                        <ul>
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
                                    <li><a href="{{ route('frontend.notes') }}">Free Notes</a></li>
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
                                    <li><img src="/img/icons/footer-location1.svg" alt=""><a href="#">{{ $address }}</a>
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
