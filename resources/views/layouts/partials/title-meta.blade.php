<meta charset="UTF-8">
<meta name="viewport" content="width=`device-width`, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--=====TITLE=======-->
<title>{{ $title }}</title>

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

