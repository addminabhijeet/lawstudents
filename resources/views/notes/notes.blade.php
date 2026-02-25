@extends('layouts.landing', ['title' => 'Lawsy || Criminal Law || Free Notes'])

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
                @foreach ($courses as $course)
                    @foreach ($course->notes as $note)
                        <div class="col-lg-4 col-md-6" style="flex:0 0 33.3333%; max-width:33.3333%;">

                            <div class="blog-boxarea"
                                style="width:100%; height:420px; 
                        border:1px solid #eee; 
                        border-radius:10px; 
                        overflow:hidden; 
                        display:flex; 
                        flex-direction:column;">

                                <div class="blog-images"
                                    style="width:100%; 
                            height:250px; 
                            overflow:hidden; 
                            position:relative;
                            background:#f8f8f8;">

                                    @if ($note->file_path)
                                        <iframe
                                            src="{{ route('frontend.viewnotes', $note->id) }}#toolbar=0&navpanes=0&scrollbar=0"
                                            style="width:100%; 
                                   height:250px; 
                                   border:none;"
                                            onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                        </iframe>

                                        <img src="{{ asset('img/images/blog-img1.png') }}"
                                            style="display:none; 
                                   width:100%; 
                                   height:250px; 
                                   object-fit:cover;">
                                    @else
                                        <img src="{{ asset('img/images/blog-img1.png') }}"
                                            style="width:100%; 
                                   height:250px; 
                                   object-fit:cover;">
                                    @endif

                                </div>

                                <div class="blog-all-textarea"
                                    style="flex:1; 
                            padding:15px; 
                            overflow:hidden;">

                                    <a href="{{ route('frontend.viewnotes', $note->id) }}" target="_blank"
                                        style="font-weight:600; 
                              display:block; 
                              white-space:nowrap; 
                              overflow:hidden; 
                              text-overflow:ellipsis;">
                                        {{ $note->title }}
                                    </a>

                                    <p style="margin:8px 0 4px 0;">
                                        Course: {{ $course->title }}
                                    </p>

                                    <p style="margin:0;">
                                        Size: {{ $note->formatted_size }}
                                    </p>

                                </div>

                            </div>

                        </div>
                    @endforeach
                @endforeach
            </div>

            <div class="col-lg-12 m-auto">
                <div class="pagination-area">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Previous">
                                    <span aria-hidden="true"><i class="fa-regular fa-angle-left"></i></span>
                                </a>
                            </li>
                            <li class="page-item"><a class="page-link active" href="#">1</a></li>
                            <li class="page-item"><a class="page-link" href="#">2</a></li>
                            <li class="page-item"><a class="page-link" href="#">3</a></li>
                            <li class="page-item"><a class="page-link" href="#">...</a></li>
                            <li class="page-item"><a class="page-link" href="#">12</a></li>
                            <li class="page-item">
                                <a class="page-link" href="#" aria-label="Next">
                                    <span aria-hidden="true"><i class="fa-regular fa-angle-right"></i></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll(".pdf-frame").forEach(function(iframe) {

                iframe.addEventListener("load", function() {
                    try {
                        // If iframe loads a 404 page, detect it
                        if (iframe.contentDocument.body.innerText.includes("404")) {
                            iframe.style.display = "none";
                            iframe.parentElement.querySelector(".fallback-img").style.display =
                                "block";
                        }
                    } catch (e) {
                        // If cross-origin error occurs → show fallback
                        iframe.style.display = "none";
                        iframe.parentElement.querySelector(".fallback-img").style.display = "block";
                    }
                });

            });
        });
    </script>
    <!--===== BLOG ENDS =======-->
@endsection
