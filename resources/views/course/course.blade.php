@extends('layouts.landing', ['title' => 'Law Students'])

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

                    <div class="category-grid"
                        style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:20px;">

                        @foreach ($categories as $category)
                            <div class="category-card"
                                style="border:1px solid #e4e6eb; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.05); background:#fff;">

                                <!-- CATEGORY HEADER -->
                                <div
                                    style="padding:15px; font-size:18px; font-weight:600; display:flex; justify-content:space-between; align-items:center; background:#f9f9f9;">
                                    <span>{{ $category->name }}</span>
                                </div>

                                <!-- COURSES GRID -->
                                <div class="courses-grid"
                                    style="display:grid; grid-template-columns:repeat(auto-fill, minmax(200px, 1fr)); gap:15px; padding:15px;">
                                    @foreach ($category->courses as $course)
                                        <div class="course-card"
                                            style="border:1px solid #eee; border-radius:20px; padding:16px; background: linear-gradient(145deg, #ffffff, #f9f9f9); 
            display:flex; flex-direction:column; justify-content:space-between; box-shadow: 0 6px 12px rgba(0,0,0,0.08); 
            transition: transform 0.3s ease, box-shadow 0.3s ease;">

                                            <div>
                                                <h4
                                                    style="font-size:16px; font-weight:700; margin-bottom:6px; color:#222; line-height:1.3;">
                                                    {{ $course->title }}
                                                </h4>

                                                <div
                                                    style="font-size:13px; color:#555; margin-bottom:6px; display:flex; align-items:center; gap:6px;">
                                                    📄 Notes: {{ $course->notes->count() }}
                                                </div>

                                                <div style="font-size:13px; color:#777; margin-bottom:4px;">
                                                    Price: <span
                                                        style="font-weight:600; color:#000;">₹{{ $course->price ?? 0 }}</span>
                                                </div>

                                                <div style="font-size:13px; color:#777;">
                                                    Discount: <span
                                                        style="font-weight:600; color:#FF4C4C;">₹{{ $course->discount ?? 0 }}</span>
                                                </div>
                                            </div>

                                            <div style="margin-top:12px; display:flex; gap:8px; flex-wrap:wrap;">
                                                <a href=""
                                                    style="flex:1; text-align:center; background: linear-gradient(135deg, #25D366, #128C7E); 
                  color:#fff; padding:10px 0; border-radius:30px; font-size:13px; text-decoration:none; 
                  font-weight:600; box-shadow: 0 4px 8px rgba(0,0,0,0.15); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                                    Enroll Now
                                                </a>
                                            </div>
                                        </div>

                                        <script>
                                            // Hover effect for card
                                            const cards = document.querySelectorAll('.course-card');
                                            cards.forEach(card => {
                                                card.addEventListener('mouseenter', () => {
                                                    card.style.transform = 'translateY(-6px)';
                                                    card.style.boxShadow = '0 12px 24px rgba(0,0,0,0.12)';
                                                });
                                                card.addEventListener('mouseleave', () => {
                                                    card.style.transform = 'translateY(0)';
                                                    card.style.boxShadow = '0 6px 12px rgba(0,0,0,0.08)';
                                                });
                                            });

                                            // Hover effect for button
                                            const buttons = document.querySelectorAll('.course-card a');
                                            buttons.forEach(btn => {
                                                btn.addEventListener('mouseenter', () => {
                                                    btn.style.transform = 'scale(1.08)';
                                                    btn.style.boxShadow = '0 6px 12px rgba(0,0,0,0.2)';
                                                });
                                                btn.addEventListener('mouseleave', () => {
                                                    btn.style.transform = 'scale(1)';
                                                    btn.style.boxShadow = '0 4px 8px rgba(0,0,0,0.15)';
                                                });
                                            });
                                        </script>
                                    @endforeach

                                    <!-- CHILD CATEGORIES -->
                                    @foreach ($category->children as $child)
                                        <div class="child-category-card"
                                            style="border:1px solid #eee; border-radius:8px; padding:12px; background:#f0fdf4; display:flex; flex-direction:column;">

                                            <h5 style="font-size:14px; font-weight:600; margin-bottom:8px;">
                                                {{ $child->name }}</h5>

                                            <div class="child-courses-grid"
                                                style="display:grid; grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:10px;">
                                                @foreach ($child->courses as $childCourse)
                                                    <div class="course-card"
                                                        style="border:1px solid #ddd; border-radius:6px; padding:10px; background:#ffffff; display:flex; flex-direction:column; justify-content:space-between;">

                                                        <div>
                                                            <h6 style="font-size:14px; font-weight:500; margin-bottom:5px;">
                                                                {{ $childCourse->title }}</h6>
                                                            <div style="font-size:12px; color:#555;">Notes:
                                                                {{ $childCourse->notes->count() }}</div>
                                                        </div>

                                                        <div style="margin-top:8px; display:flex; gap:5px; flex-wrap:wrap;">
                                                            @foreach ($childCourse->notes as $note)
                                                                @if (auth()->check())
                                                                    <a href="{{ route('frontend.viewnote', $note->id) }}"
                                                                        style="flex:1; text-align:center; background:#25D366; color:#fff; padding:4px 0; border-radius:20px; font-size:11px; text-decoration:none;">
                                                                        Download
                                                                    </a>
                                                                @else
                                                                    <a href="{{ route('google.login') }}"
                                                                        style="flex:1; text-align:center; background:#25D366; color:#fff; padding:4px 0; border-radius:20px; font-size:11px; text-decoration:none;">
                                                                        Download
                                                                    </a>
                                                                @endif
                                                            @endforeach
                                                        </div>

                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    @endforeach

                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
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
