<meta charset="UTF-8">
<meta name="viewport" content="width=`device-width`, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--=====TITLE=======-->
<title><?= $title ?></title>

<!--=====FAV ICON=======-->
<?php if (isset($logo4)): ?>
    <link rel="shortcut icon" href="/img/logo/logo4.png">
<?php elseif (isset($logo8)): ?>
    <link rel="shortcut icon" href="/img/logo/logo8.png">
<?php elseif (isset($logo2)): ?>
    <link rel="shortcut icon" href="/img/logo/logo2.png">
<?php elseif (isset($logo10)): ?>
    <link rel="shortcut icon" href="/img/logo/logo10.png">
<?php elseif (isset($logo11)): ?>
    <link rel="shortcut icon" href="/img/logo/logo11.png">
<?php else: ?>
    <link rel="shortcut icon" href="/img/logo/logo6.png">
<?php endif; ?>