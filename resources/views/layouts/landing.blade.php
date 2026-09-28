<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>{{ $title ?? 'Law Students' }}</title>
    @hasSection('meta_description')
        <meta name="description" content="@yield('meta_description')">
    @endif

    <link rel="icon" href="{{ asset('assets/theme/images/logo11.png') }}">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700;800;900&family=Poppins:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">

    @php
        // The home page is built from the theme's index.html, which is styled by
        // site.css alone; every inner page adds inner.css on top.
        $usesInnerCss = !trim($__env->yieldContent('skip_inner_css'));

        // Version each theme file by its modification time, so browsers fetch a
        // changed file at once instead of running a stale cached copy.
        $themeAsset = fn($path) => asset($path) . '?v=' . @filemtime(public_path($path));
    @endphp

    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/site.css') }}">
    @if ($usesInnerCss)
        <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/inner.css') }}">
    @endif
    {{-- Wide-monitor layer (min-width queries only); loads last so it can extend both sheets above. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/large-screen.css') }}">
    {{-- Senior-readability layer: larger rem-based type, AAA-contrast text, big targets, PDF finder. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/readable.css') }}">
    {{-- Navbar layer: the header's rules are spread over the sheets above, so it loads last. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/navbar.css') }}">
    {{-- Footer layer: same reason, the footer is styled across site.css and readable.css. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/footer.css') }}">

    {{-- Runs before first paint: return visits start without the preloader, but
         slow page loads can reveal it again after a short delay. --}}
    <script>
        (function (d) {
            try {
                if (sessionStorage.getItem('ls-visited')) {
                    d.classList.add('ls-return');
                    setTimeout(function () {
                        if (document.readyState !== 'complete') {
                            d.classList.remove('ls-return');
                            d.classList.add('ls-slow-load');
                        }
                    }, 700);
                }
                sessionStorage.setItem('ls-visited', '1');
            } catch (e) {}
        })(document.documentElement);
    </script>

    <noscript>
        <style>
            .se-pre-con { display: none !important }
            .reveal { opacity: 1 !important; transform: none !important }
        </style>
    </noscript>

    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/icons.css') }}">

    @yield('css')
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/page-intros.css') }}">
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/academic-pages.css') }}">
    {{-- Line-drawing patterns on the academic sections that had none. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/section-patterns.css') }}">
    {{-- Page flow: content first on list and form pages, shorter pages on phones (page-flow.js). --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/page-flow.css') }}">
    {{-- Hero, page banners and footer without the periodic golden sweep. --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/still-banners.css') }}">
    {{-- Responsive layer: fits the newer content to every screen width (additive, loads last). --}}
    <link rel="stylesheet" href="{{ $themeAsset('assets/theme/css/responsive-content.css') }}">
</head>

<body class="@yield('body_class', 'inner-page')">

    <!--===== PRELOADER STARTS =======-->
    <div class="se-pre-con" id="preloader">
        <div class="preloader-icon">
            <div class="preloader-ring"></div>
            <div class="preloader-ring two"></div>
            <img src="{{ asset('assets/theme/images/preloader.svg') }}" alt="Loading" loading="eager">
            <div class="preloader-text">Law Students</div>
        </div>
    </div>
    <!--===== PRELOADER ENDS =======-->

    {{-- .skip-link is styled in inner.css only, exactly as in the theme. --}}
    @if ($usesInnerCss)
        <a class="skip-link" href="#main">Skip to main content</a>
    @endif

    @include('layouts.partials.header.navbar')

    <main id="main">
        @yield('content')
        <x-academic-page :page="str_replace('frontend.', '', request()->route()?->getName() ?? '')" />
    </main>

    @include('layouts.partials.footer')
    {{-- Right after the footer markup and before inner.js / home.js, which it has to run ahead of. --}}
    <script src="{{ $themeAsset('assets/theme/js/footer.js') }}"></script>
    {{-- Page flow: after the page markup, before inner.js sets the page up. --}}
    <script src="{{ $themeAsset('assets/theme/js/page-flow.js') }}"></script>

    <script src="{{ $themeAsset('assets/theme/js/inner.js') }}"></script>
    <script src="{{ $themeAsset('assets/theme/js/readable.js') }}" defer></script>
    {{-- Listing pages: ?q= opens them already searched (the home page's cards link that way). --}}
    <script src="{{ $themeAsset('assets/theme/js/deeplink.js') }}"></script>
    {{-- Form fields: phone 10 digits, one @ in an email, letters in names (listeners only). --}}
    <script src="{{ $themeAsset('assets/js/form-guard.js') }}"></script>

    @yield('scripts')
</body>

</html>
