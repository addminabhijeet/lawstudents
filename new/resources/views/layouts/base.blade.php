<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>

    @include('layouts.partials.error-suppression')

    @include('layouts.partials.title-meta')

    <!--===== CSS LINK =======-->
    @vite(['resources/scss/master.scss' , 'resources/scss/typography.css'])

    @yield('css')

</head>

<body @yield('body_attribute')>

    @include('layouts.partials.fix-asset-paths')

    @yield('content')


    @yield('scripts')

    @vite(['resources/js/main.js'])

</body>

</html>