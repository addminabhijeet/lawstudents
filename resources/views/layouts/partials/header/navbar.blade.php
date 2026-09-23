@php
    // Site contact details, as before: first user record with sensible fallbacks.
    $user = \App\Models\User::first();
    $email = !empty($user->webemail) ? $user->webemail : 'lawstudents.edu@gmail.com';
    $mobile = !empty($user->mobile) ? $user->mobile : '+916624536320';
@endphp

<!--===== TOP BAR =======-->
<div class="topbar" id="topbar">
    <div class="wrap">
        <div class="topbar-tags"><span>•</span> Legal Education <span>•</span> Legal Knowledge <span>•</span> Legal
            Resources</div>
        <div class="topbar-contact">
            <a href="mailto:{{ $email }}" aria-label="Email"><img
                    src="{{ asset('assets/theme/images/icons/email3.svg') }}" alt="">{{ $email }}</a>
            <a href="tel:{{ $mobile }}" aria-label="Phone"><img
                    src="{{ asset('assets/theme/images/icons/phone3.svg') }}" alt="">{{ $mobile }}</a>
        </div>
    </div>
</div>

<!--===== HEADER STARTS =======-->
<header class="site-header" id="siteHeader">
    <div class="wrap">
        <div class="nav-wrap">
            <a href="{{ route('frontend.home') }}" class="nav-logo"><picture>
                    <source type="image/webp" srcset="{{ asset('assets/theme/images/logo-full-720.webp') }}">
                    <img src="{{ asset('assets/theme/images/logo-full-720.png') }}" alt="Law Students" width="720"
                        height="241" loading="eager" fetchpriority="high">
                </picture></a>
            <nav aria-label="Main">
                <ul class="nav-menu">
                    <li><a href="{{ route('frontend.home') }}"
                            @if (request()->routeIs('frontend.home')) aria-current="page" @endif>Home</a></li>
                    <li><a href="{{ route('frontend.about') }}"
                            @if (request()->routeIs('frontend.about')) aria-current="page" @endif>About Us</a></li>
                    <li class="has-drop">
                        <a href="{{ route('frontend.acts') }}"
                            @if (request()->routeIs('frontend.acts', 'frontend.rules')) aria-current="page" @endif>Bare
                            Acts &amp; Rules</a>
                        <div class="dropdown">
                            <a href="{{ route('frontend.acts') }}">Acts</a>
                            <a href="{{ route('frontend.rules') }}">Rules</a>
                        </div>
                    </li>
                    <li><a href="{{ route('frontend.legal-knowledge') }}"
                            @if (request()->routeIs('frontend.legal-knowledge')) aria-current="page" @endif>Legal
                            Knowledge</a></li>
                    <li class="has-drop">
                        <a href="{{ route('frontend.course') }}"
                            @if (request()->routeIs('frontend.course', 'frontend.copys')) aria-current="page" @endif>Course
                            &amp; Notes</a>
                        <div class="dropdown">
                            <a href="{{ route('frontend.course') }}">Course</a>
                            <a href="{{ route('frontend.copys') }}">Free Notes</a>
                        </div>
                    </li>
                    <li><a href="{{ route('frontend.clientele') }}"
                            @if (request()->routeIs('frontend.clientele')) aria-current="page" @endif>Client</a></li>
                    <li><a href="{{ route('frontend.govtexams') }}"
                            @if (request()->routeIs('frontend.govtexams')) aria-current="page" @endif>Centre &amp;
                            State Govt. Examination</a></li>
                    <li><a href="{{ route('frontend.gallery') }}"
                            @if (request()->routeIs('frontend.gallery')) aria-current="page" @endif>Gallery</a></li>
                    <li><a href="{{ route('frontend.contact') }}"
                            @if (request()->routeIs('frontend.contact')) aria-current="page" @endif>Contact Us</a>
                    </li>
                </ul>
            </nav>
            <a href="{{ route('login') }}" class="btn-login">Login / Register</a>
            <div class="burger" id="burger" role="button" tabindex="0" aria-label="Menu" aria-expanded="false"
                aria-controls="mobileMenu"><span></span><span></span><span></span></div>
        </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="{{ route('frontend.home') }}">Home</a></li>
            <li><a href="{{ route('frontend.about') }}">About Us</a></li>
            <li><a href="{{ route('frontend.acts') }}">Bare Acts &amp; Rules</a></li>
            <li class="sub"><a href="{{ route('frontend.acts') }}">Acts</a></li>
            <li class="sub"><a href="{{ route('frontend.rules') }}">Rules</a></li>
            <li><a href="{{ route('frontend.legal-knowledge') }}">Legal Knowledge</a></li>
            <li><a href="{{ route('frontend.course') }}">Course &amp; Notes</a></li>
            <li class="sub"><a href="{{ route('frontend.course') }}">Course</a></li>
            <li class="sub"><a href="{{ route('frontend.copys') }}">Free Notes</a></li>
            <li><a href="{{ route('frontend.clientele') }}">Client</a></li>
            <li><a href="{{ route('frontend.govtexams') }}">Centre &amp; State Govt. Examination</a></li>
            <li><a href="{{ route('frontend.gallery') }}">Gallery</a></li>
            <li><a href="{{ route('frontend.contact') }}">Contact Us</a></li>
            <li><a href="{{ route('login') }}">Login / Register</a></li>
        </ul>
    </div>
</header>
<!--===== HEADER ENDS =======-->
