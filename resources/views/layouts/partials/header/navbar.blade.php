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
            {{-- The label keeps the visible address/number, so screen readers read it too. --}}
            <a href="mailto:{{ $email }}" aria-label="Email {{ $email }}"><img
                    src="{{ asset('assets/theme/images/icons/email3.svg') }}" alt="">{{ $email }}</a>
            <a href="tel:{{ $mobile }}" aria-label="Call {{ $mobile }}"><img
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
                            <a href="{{ route('frontend.acts') }}"
                                @if (request()->routeIs('frontend.acts')) aria-current="page" @endif><span
                                    class="site-icon icon-scale" aria-hidden="true"></span>Acts</a>
                            <a href="{{ route('frontend.rules') }}"
                                @if (request()->routeIs('frontend.rules')) aria-current="page" @endif><span
                                    class="site-icon icon-clipboard" aria-hidden="true"></span>Rules</a>
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
                            <a href="{{ route('frontend.course') }}"
                                @if (request()->routeIs('frontend.course')) aria-current="page" @endif><span
                                    class="site-icon icon-school" aria-hidden="true"></span>Course</a>
                            <a href="{{ route('frontend.copys') }}"
                                @if (request()->routeIs('frontend.copys')) aria-current="page" @endif><span
                                    class="site-icon icon-file-text" aria-hidden="true"></span>Free Notes</a>
                        </div>
                    </li>
                    <li><a href="{{ route('frontend.clientele') }}"
                            @if (request()->routeIs('frontend.clientele')) aria-current="page" @endif>Client</a></li>
                    {{-- Short label so the menu fits one row on laptops; the ☰ menu keeps the full name. --}}
                    <li><a href="{{ route('frontend.govtexams') }}" title="Centre &amp; State Govt. Examination"
                            @if (request()->routeIs('frontend.govtexams')) aria-current="page" @endif>Govt.
                            Exams</a></li>
                    <li><a href="{{ route('frontend.gallery') }}"
                            @if (request()->routeIs('frontend.gallery')) aria-current="page" @endif>Gallery</a></li>
                    <li><a href="{{ route('frontend.contact') }}"
                            @if (request()->routeIs('frontend.contact')) aria-current="page" @endif>Contact Us</a>
                    </li>
                    {{-- Shown only in the pinned menu row, once the Login button above has scrolled away. --}}
                    <li class="nav-login"><a href="{{ route('login') }}" aria-label="Login / Register"
                            title="Login / Register"><span class="site-icon icon-user" aria-hidden="true"></span><span
                                class="nav-login-text">Login</span></a></li>
                </ul>
            </nav>
            <a href="{{ route('login') }}" class="btn-login"><span class="site-icon icon-user"
                    aria-hidden="true"></span>Login / Register</a>
            <div class="burger" id="burger" role="button" tabindex="0" aria-label="Menu" aria-expanded="false"
                aria-controls="mobileMenu"><span></span><span></span><span></span></div>
        </div>
    </div>
    <div class="mobile-menu" id="mobileMenu">
        <ul>
            <li><a href="{{ route('frontend.home') }}" @if (request()->routeIs('frontend.home')) aria-current="page" @endif>Home</a></li>
            <li><a href="{{ route('frontend.about') }}" @if (request()->routeIs('frontend.about')) aria-current="page" @endif>About Us</a></li>
            {{-- A group is a heading over its pages, not a second link to the first of them. --}}
            <li class="group"><span class="group-label" id="mmActs">Bare Acts &amp; Rules</span>
                <ul aria-labelledby="mmActs">
                    <li class="sub"><a href="{{ route('frontend.acts') }}" @if (request()->routeIs('frontend.acts')) aria-current="page" @endif><span class="site-icon icon-scale" aria-hidden="true"></span>Acts</a></li>
                    <li class="sub"><a href="{{ route('frontend.rules') }}" @if (request()->routeIs('frontend.rules')) aria-current="page" @endif><span class="site-icon icon-clipboard" aria-hidden="true"></span>Rules</a></li>
                </ul>
            </li>
            <li><a href="{{ route('frontend.legal-knowledge') }}" @if (request()->routeIs('frontend.legal-knowledge')) aria-current="page" @endif>Legal Knowledge</a></li>
            <li class="group"><span class="group-label" id="mmCourse">Course &amp; Notes</span>
                <ul aria-labelledby="mmCourse">
                    <li class="sub"><a href="{{ route('frontend.course') }}" @if (request()->routeIs('frontend.course')) aria-current="page" @endif><span class="site-icon icon-school" aria-hidden="true"></span>Course</a></li>
                    <li class="sub"><a href="{{ route('frontend.copys') }}" @if (request()->routeIs('frontend.copys')) aria-current="page" @endif><span class="site-icon icon-file-text" aria-hidden="true"></span>Free Notes</a></li>
                </ul>
            </li>
            <li><a href="{{ route('frontend.clientele') }}" @if (request()->routeIs('frontend.clientele')) aria-current="page" @endif>Client</a></li>
            <li><a href="{{ route('frontend.govtexams') }}" @if (request()->routeIs('frontend.govtexams')) aria-current="page" @endif>Centre &amp; State Govt. Examination</a></li>
            <li><a href="{{ route('frontend.gallery') }}" @if (request()->routeIs('frontend.gallery')) aria-current="page" @endif>Gallery</a></li>
            <li><a href="{{ route('frontend.contact') }}" @if (request()->routeIs('frontend.contact')) aria-current="page" @endif>Contact Us</a></li>
            <li class="mm-login"><a href="{{ route('login') }}"><span class="site-icon icon-user" aria-hidden="true"></span>Login / Register</a></li>
        </ul>
    </div>
</header>
<!--===== HEADER ENDS =======-->
