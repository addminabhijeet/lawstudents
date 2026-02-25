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

                            <div class="blog-images"
                                style="width:100%;
            height:250px;
            overflow:hidden;
            position:relative;
            background:#f8f8f8;">

                                @if ($note->file_path)
                                    <img id="preview-img-{{ $note->id }}" src="{{ asset('img/images/blog-img1.png') }}"
                                        style="width:100%;
                    height:250px;
                    object-fit:cover;
                    display:block;">

                                    <iframe id="pdf-frame-{{ $note->id }}"
                                        style="width:100%;
                       height:250px;
                       border:none;
                       display:none;">
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
                                                    // Keep default image visible
                                                });
                                        })
                                        ();
                                    </script>
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
