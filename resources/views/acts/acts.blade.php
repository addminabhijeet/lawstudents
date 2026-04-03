@extends('layouts.landing', ['title' => 'Acts'])

@section('content')
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Acts</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Acts</a>
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
                <div style="max-width:600px; margin:0 auto 20px;">
                    <input type="text" id="noteSearch" class="form-control"
                        placeholder="Search Acts..." onkeyup="searchNotes(this.value)">

                    <div id="searchSuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none;">
                    </div>
                </div>

                @foreach ($categories as $category)

                <!-- CATEGORY -->
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px;">

                    <div onclick="toggleAccordion('cat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
                    </div>

                    <div id="cat{{ $category->id }}" style="max-height:0; overflow:hidden;">

                        @foreach ($category->subcategories as $sub)

                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px;">

                            <div onclick="toggleAccordion('sub{{ $sub->id }}')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <div id="sub{{ $sub->id }}" style="max-height:0; overflow:hidden; padding:10px;">

                                @foreach ($sub->acts as $act)

                                <!-- ACT -->
                                <div style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">

                                    <div style="font-weight:600;">
                                        {{ $act->description }}
                                    </div>

                                    <!-- PDFs -->
                                    @if ($act->pdfs)
                                    @foreach ($act->pdfs as $index => $pdf)

                                    <div style="margin-top:5px; display:flex; justify-content:space-between;">

                                        <span style="font-size:12px;">PDF {{ $index + 1 }}</span>

                                        <div>
                                            <a href="{{ route('frontend.viewnotes', [$act->id, $index]) }}"
                                                target="_blank"
                                                style="margin-right:10px; font-size:12px;">
                                                View
                                            </a>

                                            <a href="{{ route('frontend.viewnote', [$act->id, $index]) }}"
                                                style="font-size:12px; color:green;">
                                                Download
                                            </a>
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

            <!-- SCRIPT -->
            <script>
                function toggleAccordion(id) {
                    let el = document.getElementById(id);

                    if (el.style.maxHeight && el.style.maxHeight !== "0px") {
                        el.style.maxHeight = "0";
                    } else {
                        el.style.maxHeight = el.scrollHeight + "px";
                    }
                }

                // SEARCH
                function searchNotes(query) {
                    let box = document.getElementById('searchSuggestions');

                    if (query.length < 3) {
                        box.style.display = 'none';
                        return;
                    }

                    fetch(`{{ route('frontend.search') }}?q=${query}`)
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
                    document.getElementById('cat' + catId).style.maxHeight = "1000px";
                    document.getElementById('sub' + subId).style.maxHeight = "1000px";

                    document.getElementById('searchSuggestions').style.display = 'none';
                }
            </script>
        </div>

        <div class="col-lg-12 m-auto">
            <div class="pagination-area">
                <nav aria-label="Page navigation example">
                    <ul class="pagination justify-content-center">

                        {{-- Previous Page Link --}}
                        @if ($act->onFirstPage())
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fa-regular fa-angle-left"></i></span>
                        </li>
                        @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $act->previousPageUrl() }}">
                                <i class="fa-regular fa-angle-left"></i>
                            </a>
                        </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($act->getUrlRange(1, $act->lastPage()) as $page => $url)
                        <li class="page-item {{ $page == $act->currentPage() ? 'active' : '' }}">
                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                        </li>
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($act->hasMorePages())
                        <li class="page-item">
                            <a class="page-link" href="{{ $act->nextPageUrl() }}">
                                <i class="fa-regular fa-angle-right"></i>
                            </a>
                        </li>
                        @else
                        <li class="page-item disabled">
                            <span class="page-link"><i class="fa-regular fa-angle-right"></i></span>
                        </li>
                        @endif

                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>
