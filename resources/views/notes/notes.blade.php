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
                        <div class="col-lg-4 col-md-6">
                            <div class="blog-boxarea">

                                {{-- IMAGE / PDF SECTION --}}
                                <div class="blog-images">

                                    @if ($note->file_path)
                                        <img id="preview-img-{{ $note->id }}"
                                            src="{{ asset('img/images/blog-img1.png') }}"
                                            style="width:100%; height:250px; object-fit:cover; display:block;">

                                        <iframe id="pdf-frame-{{ $note->id }}"
                                            style="width:100%; height:250px; border:none; display:none;">
                                        </iframe>

                                        <script>
                                            (function() {
                                                var pdfUrl = "{{ route('frontend.viewnotes', $note->id) }}";
                                                var iframe = document.getElementById("pdf-frame-{{ $note->id }}");
                                                var image = document.getElementById("preview-img-{{ $note->id }}");

                                                fetch(pdfUrl, {
                                                        method: 'HEAD'
                                                    })
                                                    .then(function(response) {
                                                        if (response.ok) {
                                                            iframe.src = pdfUrl + "#toolbar=0&navpanes=0";
                                                            iframe.style.display = "block";
                                                            image.style.display = "none";
                                                        }
                                                    })
                                                    .catch(function() {
                                                        // keep default image
                                                    });
                                            })
                                            ();
                                        </script>
                                    @else
                                        <img src="{{ asset('img/images/blog-img1.png') }}"
                                            style="width:100%; height:250px; object-fit:cover;">
                                    @endif

                                    {{-- Optional date badge --}}
                                    <div class="date-img">
                                        <img src="{{ asset('img/images/date9.png') }}" alt="">
                                    </div>

                                </div>

                                {{-- CONTENT SECTION --}}
                                <div class="blog-all-textarea">

                                    <div class="blog-text-area">

                                        <div class="blog-name-area">
                                            <img src="{{ asset('img/icons/contact-img1.svg') }}" alt="">
                                            <a href="#">
                                                <p>{{ $course->title }}</p>
                                            </a>
                                        </div>

                                        <div class="blog-name-area">
                                            <img src="{{ asset('img/icons/tax-img1.svg') }}" alt="">
                                            <a href="#">
                                                <p>{{ $note->formatted_size }}</p>
                                            </a>
                                        </div>

                                    </div>

                                    <a href="{{ route('frontend.viewnotes', $note->id) }}" target="_blank">
                                        {{ $note->title }}
                                    </a>

                                    <p>
                                        Free downloadable study material for {{ $course->title }} students.
                                    </p>

                                    @if (auth()->check())
                                        <a href="{{ route('frontend.viewnote', $note->id) }}" class="readmore">
                                            Download PDF <i class="fa-light fa-arrow-right"></i>
                                        </a>
                                    @else
                                        <a href="{{ route('google.login') }}" class="readmore">
                                            Download PDF <i class="fa-light fa-arrow-right"></i>
                                        </a>
                                    @endif

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

                let fallback = iframe.parentElement.querySelector(".fallback-img");

                // If iframe fails to load within 3 seconds → show fallback
                let timer = setTimeout(function() {
                    iframe.style.display = "none";
                    if (fallback) fallback.style.display = "block";
                }, 3000);

                iframe.onload = function() {
                    clearTimeout(timer);

                    try {
                        let doc = iframe.contentDocument || iframe.contentWindow.document;

                        if (!doc || doc.body.innerHTML.trim() === "") {
                            iframe.style.display = "none";
                            if (fallback) fallback.style.display = "block";
                        }

                    } catch (e) {
                        iframe.style.display = "none";
                        if (fallback) fallback.style.display = "block";
                    }
                };

            });

        });
    </script>
    <!--===== BLOG ENDS =======-->
@endsection
