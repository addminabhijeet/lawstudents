@extends('layouts.landing', ['title' => 'Free Notes'])

@section('content')
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Free Notes</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Free Notes</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== BLOG STARTS =======-->
<div class="blog1-section-area sp3">
    <div class="container">
        <div class="row">

            <div style="width:100%; max-width:1100px; margin:auto;">

                <!-- SEARCH -->
                <div style="max-width:600px; margin:0 auto 20px; position:relative;">
                    <input type="text" id="noteSearch" class="form-control"
                        placeholder="Search Free Notes..." onkeyup="searchNotes(this.value)">

                    <div id="searchSuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none; position:absolute; width:100%; background:#fff; z-index:999;">
                    </div>
                </div>

                @foreach ($categories as $category)

                <!-- CATEGORY -->
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

                    <div onclick="toggleAccordion('cat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
                    </div>

                    <!-- 🔥 OPEN BY DEFAULT -->
                    <div id="cat{{ $category->id }}" class="accordion-content" style="max-height:1000px;">

                        @foreach ($category->subcategories as $sub)

                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">

                            <div onclick="toggleAccordion('sub{{ $sub->id }}')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <!-- 🔥 OPEN BY DEFAULT -->
                            <div id="sub{{ $sub->id }}" class="accordion-content" style="padding:10px; max-height:1000px;">

                                @foreach ($sub->copys as $copy)

                                <!-- Free Notes -->
                                <div style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">

                                    <div style="font-weight:600;">
                                        {{ $copy->description }}
                                    </div>

                                    <!-- PDFs -->
                                    @if ($copy->pdfs)
                                    @foreach ($copy->pdfs as $index => $pdf)

                                    <div style="margin-top:5px; display:flex; justify-content:space-between;">

                                        <span style="font-size:12px;">PDF {{ $index + 1 }}</span>

                                        <div>
                                            <a href="{{ route('frontend.viewnotes', [$copy->id, $index]) }}"
                                                target="_blank"
                                                style="margin-right:10px; font-size:12px;">
                                                View
                                            </a>

                                            @if (auth()->check())
                                            <a href="{{ route('frontend.viewnote', [$copy->id, $index]) }}"
                                                style="font-size:12px; color:green;">
                                                Download
                                            </a>
                                            @else
                                            <a href="{{ route('google.login') }}"
                                                style="font-size:12px; color:green;">
                                                Download
                                            </a>
                                            @endif
                                        </div>

                                    </div>

                                    @endforeach
                                    @endif

                                </div>

                                @endforeach

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>

                @endforeach

            </div>

            <!-- STYLES -->
            <style>
                .accordion-content {
                    max-height: none !important;
                    /* 🔥 Always visible */
                    overflow: visible !important;
                    transition: none;
                }

                #searchSuggestions div:hover {
                    background: #f1f1f1;
                }
            </style>

            <!-- SCRIPT -->
            <script>
                function toggleAccordion(id) {
                    // 🔥 Disabled toggle (kept for compatibility)
                    return;
                }

                // SEARCH
                function searchNotes(query) {
                    let box = document.getElementById('searchSuggestions');

                    if (query.length < 3) {
                        box.style.display = 'none';
                        return;
                    }

                    fetch(`{{ route('frontend.search') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {

                            if (!data.length) {
                                box.innerHTML = '<div style="padding:10px;">No results</div>';
                            } else {
                                box.innerHTML = data.map(item => `
                                    <div style="padding:10px; cursor:pointer;"
                                        onclick="openSearch(${item.category_id}, ${item.subcategory_id})">
                                        ${item.title}
                                    </div>
                                `).join('');
                            }

                            box.style.display = 'block';
                        });
                }

                function openSearch(catId, subId) {
                    let cat = document.getElementById('cat' + catId);
                    let sub = document.getElementById('sub' + subId);

                    if (cat) cat.style.maxHeight = "none";
                    if (sub) sub.style.maxHeight = "none";

                    document.getElementById('searchSuggestions').style.display = 'none';
                }

                // CLOSE SEARCH ON OUTSIDE CLICK
                document.addEventListener('click', function(e) {
                    let box = document.getElementById('searchSuggestions');
                    let input = document.getElementById('noteSearch');

                    if (!box.contains(e.target) && e.target !== input) {
                        box.style.display = 'none';
                    }
                });
            </script>

            <!-- NOTE: Pagination removed because copy are nested collections and not paginated -->
        </div>
    </div>
</div>
@endsection