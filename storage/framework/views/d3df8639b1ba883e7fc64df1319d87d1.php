<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="ie=edge">

<!--=====TITLE=======-->
<title><?php echo e($title); ?></title>

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
<?php if(isset($logo4)): ?>
    <link rel="shortcut icon" href="/img/logo/logo4.png">
<?php elseif(isset($logo8)): ?>
    <link rel="shortcut icon" href="/img/logo/logo8.png">
<?php elseif(isset($logo2)): ?>
    <link rel="shortcut icon" href="/img/logo/logo2.png">
<?php elseif(isset($logo10)): ?>
    <link rel="shortcut icon" href="/img/logo/logo10.png">
<?php elseif(isset($logo11)): ?>
    <link rel="shortcut icon" href="/img/logo/logo11.png">
<?php else: ?>
    <link rel="shortcut icon" href="/img/logo/logo6.png">
<?php endif; ?>

<?php /**PATH C:\xampp\htdocs\lawstudents\resources\views/layouts/partials/title-meta.blade.php ENDPATH**/ ?>