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
    $footerYoutube = !empty($footerUser->youtube) ? $footerUser->youtube : '#';
    $footerPinterest = !empty($footerUser->pinterest) ? $footerUser->pinterest : '#';

    // Programs column: the course page filters on ?cat=<category id>, so read the
    // ids and labels straight from the categories table rather than hard-coding
    // them. Listed in the order the design shows them; any category that no
    // longer exists simply drops out instead of leaving a dead filter link.
    $footerProgramIds = [44, 45, 46, 47, 48, 49, 50, 51, 52];
    $footerPrograms = \App\Models\Category::whereIn('id', $footerProgramIds)
        ->pluck('name', 'id')
        ->sortBy(fn($name, $id) => array_search($id, $footerProgramIds));
@endphp

<!--===== FOOTER STARTS =======-->
<footer class="site-footer">
    <div class="wrap">
        <div class="footer-grid">
            <div class="footer-col footer-logo">
                {{-- Light version of the logo (cream "Law" and emblem, gold "Students") for the dark footer. --}}
                <picture>
                    <source type="image/webp" srcset="{{ asset('assets/theme/images/logo-full-720-light.webp') }}">
                    <img src="{{ asset('assets/theme/images/logo-full-720-light.png') }}" alt="Law Students"
                        width="720" height="241" loading="lazy" decoding="async">
                </picture>
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
                    @foreach ($footerPrograms as $programId => $programName)
                        <li><a
                                href="{{ route('frontend.course') }}?cat={{ $programId }}">{{ $programName }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="footer-grid">
            <div class="footer-col">
                <h4>Contact</h4>
                <div class="footer-contact-item">
                    <div>
                        <h6>Email</h6>
                        <p><a href="mailto:{{ $footerEmail }}">{!! str_replace('@', '@<wbr>', e($footerEmail)) !!}</a></p>
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
                        <p><a href="tel:{{ $footerMobile }}">{{ $footerMobile }}</a></p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div>
                        <h6>WhatsApp</h6>
                        <p><a href="https://wa.me/{{ $footerWhatsapp }}" target="_blank" rel="noopener">{{ $footerMobile }}</a></p>
                    </div>
                </div>
            </div>
            <div class="footer-col">
                <h4>Resources</h4>
                <ul>
                    <li><a href="{{ route('frontend.acts') }}">Bare Acts</a></li>
                    <li><a href="{{ route('frontend.rules') }}">Rules &amp; Regulations</a></li>
                    <li><a href="{{ route('frontend.legalknowledgelibrary') }}">Legal Knowledge PDFs</a></li>
                    <li><a href="#">Announcements</a></li>
                    <li><a href="{{ route('frontend.govtexams') }}">Competitive Exams</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Social Media</h4>
                <div class="social-row">
                    <a href="{{ $footerFacebook }}" title="Facebook" aria-label="Facebook"><span class="site-icon icon-brand-facebook" aria-hidden="true"></span></a>
                    <a href="{{ $footerTwitter }}" title="X" aria-label="X"><span class="site-icon icon-brand-x" aria-hidden="true"></span></a>
                    <a href="{{ $footerInstagram }}" title="Instagram" aria-label="Instagram"><span class="site-icon icon-brand-instagram" aria-hidden="true"></span></a>
                    <a href="{{ $footerLinkedin }}" title="LinkedIn" aria-label="LinkedIn"><span class="site-icon icon-brand-linkedin" aria-hidden="true"></span></a>
                    <a href="{{ $footerYoutube }}" title="YouTube" aria-label="YouTube"><span class="site-icon icon-brand-youtube" aria-hidden="true"></span></a>
                    <a href="{{ $footerPinterest }}" title="Pinterest" aria-label="Pinterest"><span class="site-icon icon-brand-pinterest" aria-hidden="true"></span></a>
                    <a href="https://wa.me/{{ $footerWhatsapp }}" title="WhatsApp" aria-label="WhatsApp"><span class="site-icon icon-brand-whatsapp" aria-hidden="true"></span></a>
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
            <div class="copyright">© {{ date('Y') }} Law Students. All Rights Reserved.</div>
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
    target="_blank" rel="noopener"><span class="site-icon icon-brand-whatsapp" aria-hidden="true"></span></a>
