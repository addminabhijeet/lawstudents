@extends('layouts.landing', ['title' => 'Law Students || Criminal Law || Free Notes'])

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

                    <div class="search-container" style="max-width:600px; margin:0 auto 20px;">
                        <input type="text" id="noteSearch" class="form-control"
                            placeholder="Search notes, category, course..." onkeyup="searchNotes(this.value)">

                        <div id="searchSuggestions"
                            style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none;">
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12 m-auto">
                <div class="pagination-area">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                            {{-- Previous Page Link --}}
                            @if ($courses->onFirstPage())
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-regular fa-angle-left"></i></span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $courses->previousPageUrl() }}">
                                        <i class="fa-regular fa-angle-left"></i>
                                    </a>
                                </li>
                            @endif

                            {{-- Pagination Elements --}}
                            @foreach ($courses->getUrlRange(1, $courses->lastPage()) as $page => $url)
                                <li class="page-item {{ $page == $courses->currentPage() ? 'active' : '' }}">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endforeach

                            {{-- Next Page Link --}}
                            @if ($courses->hasMorePages())
                                <li class="page-item">
                                    <a class="page-link" href="{{ $courses->nextPageUrl() }}">
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
    </div>
@endsection
