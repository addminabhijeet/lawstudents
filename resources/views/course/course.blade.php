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
                        <div class="category-card"
                            style="margin-bottom:20px; border-radius:12px; overflow:hidden; box-shadow:0 4px 10px rgba(0,0,0,0.05); border:1px solid #e4e6eb; background:#fff;">

                            <!-- CATEGORY HEADER -->
                            <div onclick="toggleAccordion('cat{{ $category->id }}', 'cat-group')" class="cat-group"
                                style="cursor:pointer; padding:20px; display:flex; justify-content:space-between; align-items:center; background:#f9fafb; font-size:18px; font-weight:600;">
                                <span>{{ $category->name }}</span>
                                <span
                                    style="background:#25D366; color:#fff; padding:5px 10px; border-radius:20px; font-size:12px;">
                                    {{ $category->courses->sum(fn($c) => $c->notes->count()) }}
                                </span>
                            </div>

                            <!-- CATEGORY BODY -->
                            <div id="cat{{ $category->id }}"
                                style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding:0 20px; background:#fafafa;">

                                <div class="row" style="display:flex; flex-wrap:wrap; gap:15px; margin-top:15px;">
                                    @foreach ($category->courses as $course)
                                        <div class="course-card"
                                            style="flex:1 1 calc(33% - 10px); background:#fff; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.05); overflow:hidden;">

                                            <!-- COURSE HEADER -->
                                            <div onclick="toggleAccordion('course{{ $course->id }}', 'course-group')"
                                                class="course-group"
                                                style="cursor:pointer; padding:15px; background:#f1f3f6; font-weight:500; display:flex; justify-content:space-between; align-items:center;">
                                                <span>{{ $course->title }}</span>
                                                <span
                                                    style="font-size:12px; background:#dee2e6; padding:2px 8px; border-radius:12px;">
                                                    {{ $course->notes->count() }}
                                                </span>
                                            </div>

                                            <!-- COURSE BODY -->
                                            <div id="course{{ $course->id }}"
                                                style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding:10px;">
                                                @foreach ($course->notes as $note)
                                                    <div class="note-card"
                                                        style="margin:8px 0; padding:12px; background:#ffffff; border:1px solid #eee; border-radius:6px; display:flex; justify-content:space-between; align-items:center; flex-direction:column;">

                                                        <div
                                                            style="width:100%; display:flex; justify-content:space-between; margin-bottom:8px;">
                                                            <div>
                                                                <div style="font-weight:500;">{{ $note->title }}</div>
                                                                <div style="font-size:12px; color:#777;">
                                                                    {{ $note->formatted_size }}</div>
                                                            </div>

                                                            <div>
                                                                <div style="font-weight:500;">Price: ₹{{ $course->price }}
                                                                </div>
                                                                <div style="font-size:12px; color:#777;">Discount:
                                                                    ₹{{ $course->discount ?? 0 }}</div>
                                                            </div>
                                                        </div>

                                                        <div
                                                            style="width:100%; display:flex; gap:8px; justify-content:flex-end;">
                                                            @if (auth()->check())
                                                                <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                    style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                    Download
                                                                </a>
                                                            @else
                                                                <a href="{{ route('google.login') }}"
                                                                    style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                    Download
                                                                </a>
                                                            @endif

                                                            <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                Enroll Now
                                                            </a>
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach
                                </div>

                                <!-- SUB-CATEGORIES -->
                                @foreach ($category->children as $child)
                                    <div style="margin-top:20px; padding-top:10px; border-top:1px dashed #ddd;">

                                        <div onclick="toggleAccordion('sub{{ $child->id }}', 'sub-group')"
                                            class="sub-group"
                                            style="cursor:pointer; padding:12px; background:#e9f5ee; border-radius:6px; display:flex; justify-content:space-between; font-weight:600;">
                                            <span>{{ $child->name }}</span>
                                        </div>

                                        <div id="sub{{ $child->id }}"
                                            style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding-left:10px;">
                                            <div class="row"
                                                style="display:flex; flex-wrap:wrap; gap:15px; margin-top:10px;">
                                                @foreach ($child->courses as $childCourse)
                                                    <div class="childcourse-card"
                                                        style="flex:1 1 calc(33% - 10px); background:#fff; border-radius:10px; box-shadow:0 2px 6px rgba(0,0,0,0.05); overflow:hidden;">

                                                        <div onclick="toggleAccordion('childcourse{{ $childCourse->id }}', 'childcourse-group')"
                                                            class="childcourse-group"
                                                            style="cursor:pointer; padding:12px; background:#f8f9fa; border-radius:6px; display:flex; justify-content:space-between; font-weight:500;">
                                                            <span>{{ $childCourse->title }}</span>
                                                        </div>

                                                        <div id="childcourse{{ $childCourse->id }}"
                                                            style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding:10px;">
                                                            @foreach ($childCourse->notes as $note)
                                                                <div class="note-card"
                                                                    style="margin:8px 0; padding:12px; background:#ffffff; border:1px solid #eee; border-radius:6px; display:flex; justify-content:space-between; align-items:center; flex-direction:column;">
                                                                    <div
                                                                        style="width:100%; display:flex; justify-content:space-between;">
                                                                        <div>
                                                                            <div style="font-weight:500;">
                                                                                {{ $note->title }}</div>
                                                                            <div style="font-size:12px; color:#777;">
                                                                                {{ $note->formatted_size }}</div>
                                                                        </div>
                                                                    </div>
                                                                    <div
                                                                        style="width:100%; display:flex; gap:8px; justify-content:flex-end; margin-top:8px;">
                                                                        @if (auth()->check())
                                                                            <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                                style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                                Download
                                                                            </a>
                                                                        @else
                                                                            <a href="{{ route('google.login') }}"
                                                                                style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                                Download
                                                                            </a>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                    </div>
                                @endforeach

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
