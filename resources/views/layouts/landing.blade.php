<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>

    @include('layouts.partials.title-meta')

    <!--===== CSS LINK =======-->
    @vite(['resources/scss/master.scss' , 'resources/scss/typography.css'])

    @yield('css')

</head>

<body class="inner-pages @yield('body_attribute')">

    @include('layouts.partials.loader')

    @include('layouts.partials.header.navbar')


    @yield('content')


    @include('layouts.partials.cta')

    @include('layouts.partials.footer')

    @yield('scripts')

    @vite(['resources/js/main.js'])

</body>

</html>