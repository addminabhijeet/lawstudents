<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">
<meta http-equiv="cache-control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="expires" content="0">

<!--=====TITLE=======-->
<title>{{ $title }}</title>

<!-- Font Awesome - Multiple CDN sources for redundancy -->
<link rel="preload" as="style" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'">
<noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">
</noscript>

<!-- Fallback Font Awesome CSS for reliability -->
<style>
    @import url('https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css');
</style>

<!--=====FAV ICON=======-->
@if (isset($logo4))
    <link rel="shortcut icon" href="/img/logo/logo4.png">
@elseif (isset($logo8))
    <link rel="shortcut icon" href="/img/logo/logo8.png">
@elseif (isset($logo2))
    <link rel="shortcut icon" href="/img/logo/logo2.png">
@elseif (isset($logo10))
    <link rel="shortcut icon" href="/img/logo/logo10.png">
@elseif (isset($logo11))
    <link rel="shortcut icon" href="/img/logo/logo11.png">
@else
    <link rel="shortcut icon" href="/img/logo/logo6.png">
@endif

