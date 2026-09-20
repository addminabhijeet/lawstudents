@php
    // Same source as the header's contact strip.
    $footerUser = \App\Models\User::first();
    $footerEmail = !empty($footerUser->webemail) ? $footerUser->webemail : 'lawstudents.edu@gmail.com';
    $footerMobile = !empty($footerUser->mobile) ? $footerUser->mobile : '+916624536320';
    $footerWhatsapp = preg_replace('/[^0-9]/', '', $footerMobile);
    $footerFacebook = !empty($footerUser->facebook) ? $footerUser->facebook : '#';
    $footerTwitter = !empty($footerUser->twitter) ? $footerUser->twitter : '#';
    $footerInstagram = !empty($footerUser->instagram) ? $footerUser->instagram : '#';
    $footerLinkedin = !empty($footerUser->linkedin) ? $footerUser->linkedin : '#';
    $footerPinterest = !empty($footerUser->pinterest) ? $footerUser->pinterest : '#';
@endphp

<!--===== FOOTER STARTS =======-->
<footer class="site-footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-col footer-logo">
                <img src="{{ asset('assets/theme/images/logo-full.png') }}" alt="Law Students" loading="lazy"
                    decoding="async">
                <p class="footer-tag">Learn Law.<br>Understand Law.<br>Build Your Future.</p>
            </div>
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('frontend.home') }}">Home</a></li>
                    <li><a href="{{ route('frontend.about') }}">About Us</a></li>
                    <li><a href="{{ route('frontend.clientele') }}">Client</a></li>
                    <li><a href="{{ route('frontend.acts') }}">Acts &amp; Rules</a></li>
                    <li><a href="{{ route('frontend.legal-knowledge') }}">Legal Knowledge</a></li>
                    <li><a href="{{ route('frontend.course') }}">All Courses</a></li>
                    <li><a href="{{ route('frontend.copys') }}">Study Materials</a></li>
                    <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Programs</h4>
                <ul>
                    <li><a href="{{ route('frontend.course') }}?cat=44">LL.B. Entrance Prep</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=45">LL.B. (3-Year)</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=46">LL.B. (5-Year)</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=47">LL.M. Specialization</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=48">Judiciary Exams</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=49">CSEET Preparation</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=50">CA Studies</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=51">CS Studies</a></li>
                    <li><a href="{{ route('frontend.course') }}?cat=52">CMA Studies</a></li>
                </ul>
            </div>
        </div>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Contact</h4>
                <div class="footer-contact-item">
                    <div>
                        <h6>Email</h6>
                        <p>{{ $footerEmail }}</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div>
                        <h6>Address</h6>
                        <p>224 Legal District, Delhi High Court Marg, New Delhi 110001</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div>
                        <h6>Phone</h6>
                        <p>{{ $footerMobile }}</p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div>
                        <h6>WhatsApp</h6>
                        <p>{{ $footerMobile }}</p>
                    </div>
                </div>
            </div>
            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                    <li><a href="{{ route('frontend.rules') }}">Rules &amp; Regulations</a></li>
                    <li><a href="#">Announcements</a></li>
                    <li><a href="{{ route('frontend.govtexams') }}">Competitive Exams</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Social Media</h4>
                <div class="social-row">
                    <a href="{{ $footerFacebook }}" title="Facebook">f</a>
                    <a href="{{ $footerTwitter }}" title="Twitter">𝕏</a>
                    <a href="{{ $footerInstagram }}" title="Instagram">◎</a>
                    <a href="{{ $footerLinkedin }}" title="LinkedIn">in</a>
                    <a href="{{ $footerPinterest }}" title="Pinterest">▶</a>
                    <a href="https://wa.me/{{ $footerWhatsapp }}" title="WhatsApp">✆</a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-links">
                <a href="#">Privacy Policy</a><span class="sep">|</span>
                <a href="#">Terms &amp; Conditions</a><span class="sep">|</span>
                <a href="#">Disclaimer</a><span class="sep">|</span>
                <a href="#">Refund Policy</a><span class="sep">|</span>
                <a href="#">Sitemap</a>
            </div>
            <div class="copyright">© {{ date('Y') }} Law Student. All Rights Reserved.</div>
        </div>
    </div>
</footer>
<!--===== FOOTER ENDS =======-->

<!--===== SCROLL PROGRESS =======-->
<div class="progress-wrap" id="progressWrap">
    <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
        <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" id="progressPath" />
    </svg>
</div>

<a href="https://wa.me/{{ $footerWhatsapp }}" class="wa-float" title="WhatsApp Us" aria-label="WhatsApp"
    target="_blank" rel="noopener">✆</a>
