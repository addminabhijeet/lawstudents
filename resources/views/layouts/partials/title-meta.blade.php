<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--=====TITLE=======-->
<title>{{ $title }}</title>

<!-- Font Awesome with proper crossorigin for web fonts -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" crossorigin="anonymous" referrerpolicy="no-referrer">

<!-- Prevent EventEmitter memory leak warnings from console -->
<script>
    if (typeof EventEmitter !== 'undefined' && EventEmitter.prototype) {
        EventEmitter.prototype.setMaxListeners(0);
    }
    if (typeof window !== 'undefined' && window.EventEmitter) {
        window.EventEmitter.prototype.setMaxListeners(0);
    }
</script>

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

