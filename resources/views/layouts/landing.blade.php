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
    @endphp

    <link rel="stylesheet" href="{{ asset('assets/theme/css/site.css') }}">
    @if ($usesInnerCss)
        <link rel="stylesheet" href="{{ asset('assets/theme/css/inner.css') }}">
    @endif

    <noscript>
        <style>
            .se-pre-con { display: none !important }
            .reveal { opacity: 1 !important; transform: none !important }
        </style>
    </noscript>

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

    <script src="{{ asset('assets/theme/js/inner.js') }}"></script>

    @yield('scripts')
</body>

</html>
