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
    </main>

    @include('layouts.partials.footer')

    <script src="{{ $themeAsset('assets/theme/js/inner.js') }}"></script>
    <script src="{{ $themeAsset('assets/theme/js/readable.js') }}" defer></script>

    @yield('scripts')
</body>

</html>
