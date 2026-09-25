@php
    // Same source as the header's contact strip.
    $footerUser = \App\Models\User::first();
    $footerEmail = !empty($footerUser->webemail) ? $footerUser->webemail : 'lawstudents.edu@gmail.com';
    $footerMobile = !empty($footerUser->mobile) ? $footerUser->mobile : '+916624536320';
    $footerAddress = !empty($footerUser->webaddress) ? $footerUser->webaddress : '224 Legal District, Delhi High Court Marg, New Delhi 110001';
    $footerWhatsapp = preg_replace('/[^0-9]/', '', $footerMobile);
    $footerSocialUrl = function ($url, $platformHomepage) {
        $url = trim((string) $url);
        if ($url === '' || $url === '#') {
            return $platformHomepage;
        }

        $normalizedUrl = preg_match('/^https?:\/\//i', $url) ? $url : 'https://' . ltrim($url, '/');
        $parts = parse_url($normalizedUrl);
        $host = strtolower($parts['host'] ?? '');
        $path = trim($parts['path'] ?? '', '/');
        $genericSocialHosts = [
            'facebook.com', 'www.facebook.com',
            'x.com', 'www.x.com',
            'twitter.com', 'www.twitter.com',
            'instagram.com', 'www.instagram.com',
            'linkedin.com', 'www.linkedin.com',
            'youtube.com', 'www.youtube.com',
            'pinterest.com', 'www.pinterest.com',
        ];

        if (in_array($host, $genericSocialHosts, true) && $path === '') {
            return $platformHomepage;
        }

        return $normalizedUrl;
    };

    $footerSocialLinks = [
        'Facebook' => ['url' => $footerSocialUrl($footerUser->facebook ?? null, 'https://www.facebook.com'), 'icon' => 'icon-brand-facebook'],
        'X' => ['url' => $footerSocialUrl($footerUser->twitter ?? null, 'https://www.x.com'), 'icon' => 'icon-brand-x'],
        'Instagram' => ['url' => $footerSocialUrl($footerUser->instagram ?? null, 'https://www.instagram.com'), 'icon' => 'icon-brand-instagram'],
        'LinkedIn' => ['url' => $footerSocialUrl($footerUser->linkedin ?? null, 'https://www.linkedin.com'), 'icon' => 'icon-brand-linkedin'],
        'YouTube' => ['url' => $footerSocialUrl($footerUser->youtube ?? null, 'https://www.youtube.com'), 'icon' => 'icon-brand-youtube'],
        'Pinterest' => ['url' => $footerSocialUrl($footerUser->pinterest ?? null, 'https://www.pinterest.com'), 'icon' => 'icon-brand-pinterest'],
    ];

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
                        <p><a href="mailto:{{ $footerEmail }}">{{ $footerEmail }}</a></p>
                    </div>
                </div>
                <div class="footer-contact-item">
                    <div>
                        <h6>Address</h6>
                        <p>{{ $footerAddress }}</p>
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
                    <li><a href="{{ route('frontend.announcements') }}">Announcements</a></li>
                    <li><a href="{{ route('frontend.govtexams') }}">Competitive Exams</a></li>
                </ul>
            </div>
            <div class="footer-col">
                <h4>Social Media</h4>
                <div class="social-row">
                    @foreach ($footerSocialLinks as $footerSocialName => $footerSocial)
                        <a href="{{ $footerSocial['url'] }}" title="{{ $footerSocialName }}" aria-label="{{ $footerSocialName }}" target="_blank" rel="noopener"><span class="site-icon {{ $footerSocial['icon'] }}" aria-hidden="true"></span></a>
                    @endforeach
                    <a href="https://wa.me/{{ $footerWhatsapp }}" title="WhatsApp" aria-label="WhatsApp"><span class="site-icon icon-brand-whatsapp" aria-hidden="true"></span></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <div class="footer-links">
                <a href="{{ route('frontend.privacy') }}">Privacy Policy</a><span class="sep">|</span>
                <a href="{{ route('frontend.terms') }}">Terms &amp; Conditions</a><span class="sep">|</span>
                <a href="{{ route('frontend.disclaimer') }}">Disclaimer</a><span class="sep">|</span>
                <a href="{{ route('frontend.refund') }}">Refund Policy</a><span class="sep">|</span>
                <a href="{{ route('frontend.sitemap') }}">Sitemap</a>
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
