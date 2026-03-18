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
                        <h1>Course</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Course</a>
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

                    @foreach ($categories as $category)
                        <div class="card mb-4 shadow-sm">

                            <!-- CATEGORY HEADER -->
                            <div class="card-header d-flex justify-content-between align-items-center"
                                style="cursor:pointer;" onclick="toggleAccordion('cat{{ $category->id }}', 'cat-group')">
                                <h5 class="mb-0">{{ $category->name }}</h5>
                                <span
                                    class="badge bg-success">{{ $category->courses->sum(fn($c) => $c->notes->count()) }}</span>
                            </div>

                            <!-- CATEGORY BODY -->
                            <div id="cat{{ $category->id }}" class="collapse">
                                <div class="card-body">

                                    <div class="row g-3">
                                        @foreach ($category->courses as $course)
                                            <div class="col-md-4">
                                                <div class="card h-100">
                                                    <!-- COURSE HEADER -->
                                                    <div class="card-header d-flex justify-content-between align-items-center"
                                                        style="cursor:pointer;"
                                                        onclick="toggleAccordion('course{{ $course->id }}', 'course-group')">
                                                        <span>{{ $course->title }}</span>
                                                        <span
                                                            class="badge bg-secondary">{{ $course->notes->count() }}</span>
                                                    </div>

                                                    <!-- COURSE BODY -->
                                                    <div id="course{{ $course->id }}" class="collapse card-body">
                                                        @foreach ($course->notes as $note)
                                                            <div class="card mb-2">
                                                                <div class="card-body d-flex flex-column">
                                                                    <div class="d-flex justify-content-between mb-2">
                                                                        <div>
                                                                            <h6 class="card-title mb-1">{{ $note->title }}
                                                                            </h6>
                                                                            <small
                                                                                class="text-muted">{{ $note->formatted_size }}</small>
                                                                        </div>
                                                                        <div class="text-end">
                                                                            <div>Price: ₹{{ $course->price }}</div>
                                                                            <div>Discount: ₹{{ $course->discount ?? 0 }}
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="d-flex gap-2 mt-auto">
                                                                        @if (auth()->check())
                                                                            <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                                class="btn btn-success btn-sm flex-grow-1">
                                                                                Download
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('google.login') }}"
                                                                                class="btn btn-success btn-sm flex-grow-1">
                                                                                Download
                                                                            </a>
                                                                        @endif
                                                                        <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                            class="btn btn-success btn-sm flex-grow-1">
                                                                            Enroll Now
                                                                        </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                    <!-- SUB-CATEGORIES -->
                                    @foreach ($category->children as $child)
                                        <div class="mt-4">
                                            <div class="card bg-light mb-2" style="cursor:pointer;"
                                                onclick="toggleAccordion('sub{{ $child->id }}', 'sub-group')">
                                                <div class="card-body d-flex justify-content-between font-weight-bold">
                                                    <span>{{ $child->name }}</span>
                                                </div>
                                            </div>

                                            <div id="sub{{ $child->id }}" class="collapse">
                                                <div class="row g-3">
                                                    @foreach ($child->courses as $childCourse)
                                                        <div class="col-md-4">
                                                            <div class="card h-100">
                                                                <div class="card-header" style="cursor:pointer;"
                                                                    onclick="toggleAccordion('childcourse{{ $childCourse->id }}', 'childcourse-group')">
                                                                    {{ $childCourse->title }}
                                                                </div>

                                                                <div id="childcourse{{ $childCourse->id }}"
                                                                    class="collapse card-body">
                                                                    @foreach ($childCourse->notes as $note)
                                                                        <div class="card mb-2">
                                                                            <div class="card-body d-flex flex-column">
                                                                                <div>
                                                                                    <h6 class="card-title mb-1">
                                                                                        {{ $note->title }}</h6>
                                                                                    <small
                                                                                        class="text-muted">{{ $note->formatted_size }}</small>
                                                                                </div>
                                                                                <div class="d-flex gap-2 mt-2">
                                                                                    @if (auth()->check())
                                                                                        <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                                            class="btn btn-success btn-sm flex-grow-1">
                                                                                            Download
                                                                                        </a>
                                                                                    @else
                                                                                        <a href="{{ route('google.login') }}"
                                                                                            class="btn btn-success btn-sm flex-grow-1">
                                                                                            Download
                                                                                        </a>
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    @endforeach
                                                                </div>

                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>


                <script>
                    function toggleAccordion(id, groupClass) {

                        let section = document.getElementById(id);
                        let isOpen = section.style.maxHeight && section.style.maxHeight !== "0px";

                        // Close all in same group
                        document.querySelectorAll("." + groupClass).forEach(function(header) {
                            let next = header.nextElementSibling;
                            if (next) {
                                next.style.maxHeight = null;
                            }
                        });

                        // Toggle selected
                        if (!isOpen) {
                            section.style.maxHeight = section.scrollHeight + "px";
                        } else {
                            section.style.maxHeight = null;
                        }
                    }
                </script>
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
    <script>
        function searchNotes(query) {
            let suggestionBox = document.getElementById('searchSuggestions');

            if (query.length < 3) {
                suggestionBox.style.display = 'none';
                suggestionBox.innerHTML = '';
                return;
            }

            fetch(`{{ route('frontend.search') }}?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {

                    if (data.length === 0) {
                        suggestionBox.innerHTML = '<div style="padding:10px;">No results found</div>';
                    } else {
                        suggestionBox.innerHTML = data.map(item => `
                    <div style="padding:10px; border-bottom:1px solid #eee; cursor:pointer;"
                         onclick="openSearchResult(${item.category_id ?? 'null'}, ${item.course_id ?? 'null'}, ${item.note_id ?? 'null'})">

                        <div style="font-weight:600;">${item.title}</div>
                        <div style="font-size:12px; color:#777;">
                            ${item.type}
                        </div>
                    </div>
                `).join('');
                    }

                    suggestionBox.style.display = 'block';
                });
        }

        function openSearchResult(categoryId, courseId, noteId) {

            if (!categoryId) return;

            // Open category accordion
            let categorySection = document.getElementById('cat' + categoryId);

            if (categorySection) {
                categorySection.style.maxHeight = categorySection.scrollHeight + "px";
            }

            if (courseId) {
                let courseSection = document.getElementById('course' + courseId);

                if (courseSection) {
                    courseSection.style.maxHeight = courseSection.scrollHeight + "px";
                }
            }

            if (noteId) {
                let noteElement = document.getElementById('note-' + noteId);

                if (noteElement) {
                    noteElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    noteElement.style.background = '#fff3cd';

                    setTimeout(() => noteElement.style.background = '', 2000);
                }
            }

            document.getElementById('searchSuggestions').style.display = 'none';
        }
    </script>
@endsection
