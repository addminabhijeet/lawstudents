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
                                <div class="blog-images">
                                    @if ($note->file_path)
                                        <iframe
                                            src="{{ route('frontend.viewnotes', $note->id) }}#toolbar=0&navpanes=0&scrollbar=0"
                                            width="100%" height="250px" style="border:1px solid #ddd; border-radius:8px;">
                                        </iframe>
                                    @else
                                        <img src="{{ asset('img/images/blog-img1.png') }}" alt="">
                                    @endif
                                </div>

                                <div class="blog-all-textarea">

                                    <a href="{{ route('admin.viewnote', $note->id) }}" target="_blank">
                                        {{ $note->title }}
                                    </a>

                                    <p>
                                        Course: {{ $course->title }}
                                    </p>

                                    <p>
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
    <!--===== BLOG ENDS =======-->
@endsection
