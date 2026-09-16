<!--
    Asset URL Examples
    This file demonstrates how to use the asset helper functions
    in Blade templates to work on both localhost and live server
-->

<!-- EXAMPLE 1: Using assetUrl() function in image src -->
<img src="{{ assetUrl('img/logo.png') }}" alt="Logo" />

<!-- EXAMPLE 2: Using imgUrl() shorthand for images -->
<img src="{{ imgUrl('banner.jpg') }}" alt="Banner" />

<!-- EXAMPLE 3: Using in CSS background-image -->
<div style="background-image: url('{{ imgUrl('background.png') }}');">
    Content here
</div>

<!-- EXAMPLE 4: Using @asset() Blade directive -->
<img src="@asset('img/logo.png')" alt="Logo" />

<!-- EXAMPLE 5: Using @img() Blade directive -->
<img src="@img('elements/elementor18.png')" alt="Element" />

<!-- EXAMPLE 6: Using @css() for stylesheets -->
<link rel="stylesheet" href="@css('custom.css')">

<!-- EXAMPLE 7: Using @js() for scripts -->
<script src="@js('custom.js')"></script>

<!-- EXAMPLE 8: Multiple images in a loop -->
@foreach(['img1.jpg', 'img2.jpg', 'img3.jpg'] as $image)
    <img src="{{ imgUrl($image) }}" alt="Image" />
@endforeach

<!-- EXAMPLE 9: In data attributes -->
<div data-image="{{ imgUrl('icon.png') }}" class="interactive-element">
    Click me
</div>

<!-- EXAMPLE 10: Original hardcoded paths still work -->
<img src="/img/logo.png" alt="Logo" />
<!-- Above still works because /img/ is absolute path from domain root -->

<!-- EXPLANATION:
    The helpers work by:

    1. On Localhost (http://localhost/lawstudents):
       - assetUrl('img/logo.png') → http://localhost/lawstudents/img/logo.png

    2. On Live Server (https://law.norloxsolutionscrm.com):
       - assetUrl('img/logo.png') → https://law.norloxsolutionscrm.com/img/logo.png

    This ensures images load correctly in both environments!
-->
