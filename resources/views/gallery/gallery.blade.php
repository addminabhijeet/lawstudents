@extends('layouts.landing', ['title' => 'Law Students'])

@section('content')
<!-- ===== HEADING STYLES FOR GALLERY PAGE ======= -->
<style>
    /* Heading styles to match about page EXACTLY */
    h1 {
        font-size: 60px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 60px !important;
    }

    h2 {
        font-size: 46px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 1.3 !important;
    }

    h3 {
        font-size: 40px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    h4 {
        font-size: 32px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    /* Increase gallery card size */
    .group-card {
        transform: scale(1.1) !important;
    }

    .image-stack {
        height: 280px !important;
    }

    .stack-img {
        height: 280px !important;
    }

    .group-title {
        font-size: 18px !important;
        font-weight: 600 !important;
        margin-top: 15px !important;
    }

    .overlay span {
        font-size: 14px !important;
    }

    /* Increase gallery container spacing */
    .team2-section-area.team-inner {
        padding: 60px 20px !important;
    }

    /* Increase gallery grid gaps */
    .row.g-4 {
        gap: 30px !important;
        justify-content: center !important;
        display: flex !important;
        flex-wrap: wrap !important;
    }

    /* Center gallery columns */
    .row.g-4 > div {
        display: flex !important;
        justify-content: center !important;
    }

    .row.g-4 > div .group-card {
        width: 100% !important;
    }

    /* Center gallery container */
    .team2-section-area.team-inner .container {
        text-align: center !important;
    }

    /* Protect form labels and buttons */
    label {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    button, input, textarea, select {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 48px !important;
        }

        h2 {
            font-size: 36px !important;
        }

        h3 {
            font-size: 32px !important;
        }

        h4 {
            font-size: 24px !important;
        }

        .group-card {
            transform: scale(1) !important;
        }

        .image-stack {
            height: 220px !important;
        }

        .stack-img {
            height: 220px !important;
        }

        .team2-section-area.team-inner {
            padding: 50px 15px !important;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 36px !important;
        }

        h2 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 24px !important;
        }

        h4 {
            font-size: 20px !important;
        }

        .image-stack {
            height: 180px !important;
        }

        .stack-img {
            height: 180px !important;
        }

        .team2-section-area.team-inner {
            padding: 40px 10px !important;
        }
    }
</style>
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Gallery</h1>
                    <a href="{{ route('frontend.home') }}">Home <span><i class="fa-light fa-angle-right"></i></span>Gallery</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== TEAM STARTS =======-->
<div class="team2-section-area team-inner sp3">
    <div class="container">
        <div class="row g-4">

            @php
            $grouped = $gallery->groupBy(function ($item) {
            return $item->group_name ?: 'Ungrouped';
            });
            @endphp

            @foreach ($grouped as $groupName => $items)

            <div class="col-lg-3 col-md-6">

                <div class="group-card"
                    onclick="openGalleryModal(this)"
                    data-images='@json($items->pluck("image"))'>

                    <div class="image-stack">

                        @foreach ($items->take(3) as $index => $item)
                        <img src="{{ asset('storage/app/public/' . $item->image) }}"
                            class="stack-img stack-{{ $index }}">
                        @endforeach

                        <div class="overlay">
                            <span>{{ $items->count() }} Photos</span>
                        </div>

                    </div>

                    <!-- GROUP TITLE -->
                    <div class="group-title text-center mb-2">
                        <strong>{{ $groupName }}</strong>
                    </div>

                </div>

            </div>

            @endforeach

        </div>
    </div>
</div>
<!-- MODAL -->
<div id="galleryModal" class="lightbox">
    <span class="close-btn" onclick="closeModal()">&times;</span>
    <img id="modalImage">
    <button class="nav prev" onclick="prevImage()"><i class="fa-solid fa-chevron-left"></i></button>
    <button class="nav next" onclick="nextImage()"><i class="fa-solid fa-chevron-right"></i></button>
</div>

<!--===== TEAM ENDS =======-->

<style>
    .group-card {
        cursor: pointer;
        position: relative;
    }

    .image-stack {
        position: relative;
        height: 220px;
    }

    .stack-img {
        position: absolute;
        width: 100%;
        height: 220px;
        object-fit: cover;
        border-radius: 12px;
        transition: 0.4s;
    }

    .stack-0 {
        top: 0;
        left: 0;
        z-index: 3;
    }

    .stack-1 {
        top: 8px;
        left: 8px;
        z-index: 2;
    }

    .stack-2 {
        top: 16px;
        left: 16px;
        z-index: 1;
    }

    .group-card:hover .stack-img {
        transform: scale(1.05);
    }

    .overlay {
        position: absolute;
        bottom: 0;
        left: 0;
        right: 0;
        padding: 15px;
        border-radius: 12px;
        background: linear-gradient(to top, rgba(0, 0, 0, 0.7), transparent);
        color: #fff;
    }

    .overlay h6 {
        margin: 0;
        font-size: 16px;
    }

    .overlay span {
        font-size: 12px;
        opacity: 0.8;
    }

    /* LIGHTBOX */
    .lightbox {
        display: none;
        position: fixed;
        inset: 0;
        background: rgba(0, 0, 0, 0.95);
        z-index: 9999;
        justify-content: center;
        align-items: center;
    }

    .lightbox img {
        max-width: 85%;
        max-height: 85%;
        border-radius: 10px;
        animation: fadeIn 0.3s ease;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: scale(0.95);
        }

        to {
            opacity: 1;
            transform: scale(1);
        }
    }

    .close-btn {
        position: absolute;
        top: 20px;
        right: 30px;
        font-size: 32px;
        color: #fff;
        cursor: pointer;
    }

    .nav {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        font-size: 30px;
        color: #fff;
        background: none;
        border: none;
        cursor: pointer;
    }

    .prev {
        left: 20px;
    }

    .next {
        right: 20px;
    }
</style>

<script>
    let galleryImages = [];
    let currentIndex = 0;

    // ✅ FIXED (no inline JSON parsing issue)
    function openGalleryModal(el) {
        let images = JSON.parse(el.getAttribute('data-images'));

        galleryImages = images.map(img => `{{ asset('storage/app/public') }}/${img}`);
        currentIndex = 0;

        document.getElementById('galleryModal').style.display = 'flex';
        showImage();
    }

    function showImage() {
        document.getElementById('modalImage').src = galleryImages[currentIndex];
    }

    function nextImage() {
        currentIndex = (currentIndex + 1) % galleryImages.length;
        showImage();
    }

    function prevImage() {
        currentIndex = (currentIndex - 1 + galleryImages.length) % galleryImages.length;
        showImage();
    }

    function closeModal() {
        document.getElementById('galleryModal').style.display = 'none';
    }

    /* keyboard support */
    document.addEventListener('keydown', function(e) {
        let modal = document.getElementById('galleryModal');

        if (modal.style.display === 'flex') {
            if (e.key === 'ArrowRight') nextImage();
            if (e.key === 'ArrowLeft') prevImage();
            if (e.key === 'Escape') closeModal();
        }
    });
</script>
@endsection