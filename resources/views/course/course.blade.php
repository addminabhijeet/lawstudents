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

                <!-- FILTER AND SEARCH CONTAINER -->
                <div style="background:linear-gradient(135deg, #f9fafb 0%, #ffffff 100%); padding:30px 25px; border-radius:12px;
                            margin-bottom:35px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border:1px solid #e5e7eb;">

                    <!-- HEADER -->
                    <div style="text-align:center; margin-bottom:20px;">
                        <h3 style="font-size:18px; font-weight:700; color:#1f2937; margin:0 0 8px 0;">
                            <i class="fa-solid fa-sliders" style="margin-right:8px; color:#128C7E;"></i>Find Your Course
                        </h3>
                        <p style="font-size:13px; color:#6b7280; margin:0;">Filter by category or search by keywords</p>
                    </div>

                    <!-- FILTER AND SEARCH ROW -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:15px;">

                        <!-- CATEGORY DROPDOWN FILTER -->
                        <div class="category-filter-wrapper" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-filter" style="margin-right:6px;"></i>Course Category
                            </label>
                            <div style="position:relative;">
                                <button type="button" id="categoryDropdownBtn"
                                    style="width:100%; padding:14px 16px; background:#fff; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; font-weight:600; text-align:left; cursor:pointer;
                                            display:flex; justify-content:space-between; align-items:center;
                                            transition: all 0.3s ease; color:#1f2937;
                                            box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                    <span id="selectedCategory" style="display:flex; align-items:center;">
                                        <i class="fa-solid fa-layer-group" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>
                                        All Categories
                                    </span>
                                    <i class="fa-solid fa-chevron-down" style="font-size:12px; color:#9ca3af; transition: transform 0.3s ease;"></i>
                                </button>

                                <!-- DROPDOWN MENU -->
                                <div id="categoryDropdownMenu"
                                    style="position:absolute; top:100%; left:0; right:0; background:#fff; border:2px solid #e5e7eb;
                                            border-radius:10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-height:0; overflow:hidden;
                                            z-index:1000; transition: max-height 0.3s ease, box-shadow 0.3s ease; margin-top:8px;">

                                    <div style="max-height:380px; overflow-y:auto;">
                                        <!-- All Categories Option -->
                                        <div class="dropdown-item" data-category-id="all"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    font-weight:600; color:#128C7E; background:linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
                                                    transition: all 0.2s ease;">
                                            <i class="fa-solid fa-list" style="margin-right:8px;"></i>All Courses
                                        </div>

                                        @include('course.partials.category-tree', ['categories' => $categories, 'depth' => 0])
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEARCH CONTAINER -->
                        <div class="search-container" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-magnifying-glass" style="margin-right:6px;"></i>Quick Search
                            </label>
                            <div style="position:relative;">
                                <input type="text" id="noteSearch" class="form-control"
                                    placeholder="Search notes, course..." onkeyup="searchNotes(this.value)"
                                    style="padding:14px 16px 14px 16px; padding-right:40px; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#128C7E'; this.style.boxShadow='0 0 0 3px rgba(18,140,126,0.1)';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.06)';">
                                <i class="fa-solid fa-search" style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                                                      color:#9ca3af; pointer-events:none; font-size:14px;"></i>

                                <div id="searchSuggestions"
                                    style="border:2px solid #e5e7eb; border-top:0; max-height:250px; overflow:auto; display:none;
                                            position:absolute; top:100%; left:0; right:0; background:#fff;
                                            border-radius:0 0 10px 10px; z-index:999; box-shadow: 0 10px 25px rgba(0,0,0,0.1); margin-top:-2px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RESPONSIVE MOBILE LAYOUT -->
                    <style>
                        @media (max-width: 768px) {
                            .filter-search-grid {
                                grid-template-columns: 1fr !important;
                            }
                        }
                    </style>
                </div>

                <div class="category-grid"
                    style="display:grid; grid-template-columns:repeat(auto-fill, minmax(250px, 1fr)); gap:20px;">

                    @foreach ($categories as $category)
                    <div class="category-card" data-category-id="{{ $category->id }}"
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
                                    @if($course->thumbnail)
                                    <img src="{{ asset('storage/app/public/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                                        style="width:100%; height:150px; object-fit:cover; border-radius:10px; margin-bottom:12px;">
                                    @endif

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

                                    <!-- Add Brochure Button -->
                                    @if($course->brochure)
                                    <a href="{{ asset('storage/app/public/' . $course->brochure) }}" target="_blank"
                                        style="flex:1; text-align:center; background: linear-gradient(135deg, #4A90E2, #357ABD); 
           color:#fff; padding:8px 0; border-radius:30px; font-size:13px; text-decoration:none; 
           font-weight:600; box-shadow: 0 4px 8px rgba(0,0,0,0.15); transition: transform 0.3s ease, box-shadow 0.3s ease;">
                                        Brochure
                                    </a>
                                    @endif
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
                                    {{ $child->name }}
                                </h5>

                                <div class="child-courses-grid"
                                    style="display:grid; grid-template-columns:repeat(auto-fill, minmax(180px, 1fr)); gap:10px;">
                                    @foreach ($child->courses as $childCourse)
                                    <div class="course-card"
                                        style="border:1px solid #ddd; border-radius:6px; padding:10px; background:#ffffff; display:flex; flex-direction:column; justify-content:space-between;">

                                        <div>
                                            <h6 style="font-size:14px; font-weight:500; margin-bottom:5px;">
                                                {{ $childCourse->title }}
                                            </h6>
                                            <div style="font-size:12px; color:#555;">Notes:
                                                {{ $childCourse->notes->count() }}
                                            </div>
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
    // ===== CATEGORY DROPDOWN FUNCTIONALITY =====
    let selectedCategoryId = 'all';

    // Open/Close Dropdown
    document.getElementById('categoryDropdownBtn').addEventListener('click', function() {
        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = menu.style.maxHeight === '0px' || !menu.style.maxHeight ? menu.scrollHeight + 'px' : '0px';
        this.style.background = menu.style.maxHeight !== '0px' ? '#f9f9f9' : '#fff';
    });

    // Handle Category Item Click (for all nesting levels)
    document.querySelectorAll('.dropdown-category-item').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
            const categoryId = this.dataset.categoryId;
            const categoryName = this.querySelector('span:last-of-type').innerText.trim();

            // Update selected category
            selectedCategoryId = categoryId;
            document.getElementById('selectedCategory').innerHTML =
                '<i class="fa-solid fa-layer-group" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>' + categoryName;

            // Close dropdown
            document.getElementById('categoryDropdownMenu').style.maxHeight = '0px';
            document.getElementById('categoryDropdownBtn').style.background = '#fff';

            // Filter courses
            filterCoursesByCategory(categoryId);
        });
    });

    // Handle "All Categories" Option
    document.querySelector('[data-category-id="all"]').addEventListener('click', function() {
        selectedCategoryId = 'all';
        document.getElementById('selectedCategory').innerText = 'All Categories';

        // Close dropdown
        document.getElementById('categoryDropdownMenu').style.maxHeight = '0px';
        document.getElementById('categoryDropdownBtn').style.background = '#fff';

        // Show all courses
        filterCoursesByCategory('all');
    });

    // Dropdown Item Hover Effects
    document.querySelectorAll('.dropdown-item, .dropdown-item-parent, .dropdown-item-child').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.background = item.classList.contains('dropdown-item') ? '#128C7E' : '#e8f5f3';
            if (item.classList.contains('dropdown-item')) {
                this.style.color = '#fff';
            }
        });

        item.addEventListener('mouseleave', function() {
            if (item.classList.contains('dropdown-item')) {
                this.style.background = '#f9f9f9';
                this.style.color = '#128C7E';
            } else {
                this.style.background = item.classList.contains('dropdown-item-parent') ? '' : '#f9f9f9';
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.category-filter-wrapper');
        if (!dropdown.contains(event.target)) {
            document.getElementById('categoryDropdownMenu').style.maxHeight = '0px';
            document.getElementById('categoryDropdownBtn').style.background = '#fff';
        }
    });

    // Filter courses by category
    function filterCoursesByCategory(categoryId) {
        const categoryCards = document.querySelectorAll('.category-card');

        categoryCards.forEach(card => {
            if (categoryId === 'all') {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.3s ease';
            } else {
                const cardCategoryId = card.dataset.categoryId;
                if (cardCategoryId == categoryId) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease';
                } else {
                    card.style.display = 'none';
                }
            }
        });

        // Add smooth fade animation
        if (!document.getElementById('fadeInStyle')) {
            const style = document.createElement('style');
            style.id = 'fadeInStyle';
            style.textContent = `
                @keyframes fadeIn {
                    from { opacity: 0; transform: translateY(10px); }
                    to { opacity: 1; transform: translateY(0); }
                }
            `;
            document.head.appendChild(style);
        }
    }

    // ===== SEARCH FUNCTIONALITY =====
    function searchNotes(query) {
        let suggestionBox = document.getElementById('searchSuggestions');

        if (query.length < 3) {
            suggestionBox.style.display = 'none';
            suggestionBox.innerHTML = '';
            return;
        }

        fetch(`{{ route('frontend.coursesearch') }}?q=${encodeURIComponent(query)}`)
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

<!-- ENHANCED STYLING -->
<style>
    /* Dropdown Button Hover */
    #categoryDropdownBtn:hover {
        border-color: #d1d5db;
        background: #f9fafb;
        box-shadow: 0 4px 6px rgba(0,0,0,0.08);
    }

    #categoryDropdownBtn.active {
        background: #f3f4f6;
        border-color: #128C7E;
    }

    /* Dropdown Item Styling */
    .dropdown-item:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #fff !important;
    }

    .dropdown-item:hover i {
        color: #fff !important;
    }

    .dropdown-category-item:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #fff !important;
    }

    .dropdown-category-item:hover i {
        color: #fff !important;
    }

    /* Search Input Focus */
    #noteSearch:focus {
        border-color: #128C7E;
        box-shadow: 0 0 0 3px rgba(18,140,126,0.1);
    }

    /* Suggestions hover */
    #searchSuggestions div:hover {
        background: #f0fdf4;
    }

    /* Category Cards Hover */
    .category-card {
        transition: all 0.3s ease;
    }

    .category-card:hover {
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        transform: translateY(-2px);
    }

    /* Course Card Hover */
    .course-card {
        transition: all 0.3s ease;
    }

    .course-card:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        transform: translateY(-6px);
    }
</style>

@endsection