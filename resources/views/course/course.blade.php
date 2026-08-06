@extends('layouts.landing', ['title' => 'Courses'])

@section('content')
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Courses</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Courses</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== COURSES SECTION STARTS =======-->
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
                                        <div class="dropdown-item-course" data-category-id="all"
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
                                <input type="text" id="courseSearch" class="form-control"
                                    placeholder="Search courses..." onkeyup="searchCourses(this.value)"
                                    style="padding:14px 16px 14px 16px; padding-right:40px; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#128C7E'; this.style.boxShadow='0 0 0 3px rgba(18,140,126,0.1)';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.06)';">
                                <i class="fa-solid fa-search" style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                                                      color:#9ca3af; pointer-events:none; font-size:14px;"></i>

                                <div id="courseSuggestions"
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

                <!-- COURSES GRID -->
                <div class="courses-container" style="display: grid; grid-template-columns: repeat(auto-fill, minmax(250px, 1fr)); gap: 25px; margin-bottom: 40px;">

                    @forelse ($allCourses as $course)
                    <div class="course-card-item" data-category-id="{{ $course->category_id }}" data-course-id="{{ $course->id }}"
                        style="border:1px solid #ddd; border-radius:12px; overflow:hidden; background:#fff;
                                box-shadow:0 2px 8px rgba(0,0,0,0.08); transition: all 0.3s ease; display: flex; flex-direction: column;">

                        <!-- THUMBNAIL -->
                        @if($course->thumbnail)
                        <div style="width:100%; height:180px; overflow:hidden; background:#f0f0f0;">
                            <img src="{{ asset('storage/app/public/' . $course->thumbnail) }}" alt="{{ $course->title }}"
                                style="width:100%; height:100%; object-fit:cover; transition: transform 0.3s ease;">
                        </div>
                        @else
                        <div style="width:100%; height:180px; background:linear-gradient(135deg, #667eea 0%, #764ba2 100%); display:flex; align-items:center; justify-content:center;">
                            <i class="fa-solid fa-book" style="font-size:48px; color:#fff;"></i>
                        </div>
                        @endif

                        <!-- CONTENT -->
                        <div style="padding:16px; flex:1; display:flex; flex-direction:column; justify-content:space-between;">

                            <div>
                                <h4 style="font-size:16px; font-weight:700; margin:0 0 8px 0; color:#1f2937; line-height:1.4;">
                                    {{ $course->title }}
                                </h4>

                                <div style="font-size:13px; color:#6b7280; margin-bottom:8px; display:flex; align-items:center; gap:6px;">
                                    <i class="fa-solid fa-file-pdf" style="color:#128C7E;"></i>
                                    Notes: {{ $course->notes->count() }}
                                </div>

                                <div style="font-size:13px; color:#6b7280; margin-bottom:8px;">
                                    Price: <span style="font-weight:700; color:#1f2937;">₹{{ number_format($course->price ?? 0, 2) }}</span>
                                </div>

                                @if($course->discount)
                                <div style="font-size:13px; color:#6b7280;">
                                    Discount: <span style="font-weight:700; color:#ef4444;">₹{{ number_format($course->discount ?? 0, 2) }}</span>
                                </div>
                                @endif
                            </div>

                            <!-- BUTTONS -->
                            <div style="margin-top:16px; display:flex; gap:10px;">
                                <a href=""
                                    style="flex:1; text-align:center; background: linear-gradient(135deg, #10b981, #059669);
                                            color:#fff; padding:11px 0; border-radius:8px; font-size:13px; font-weight:600;
                                            text-decoration:none; border:none; cursor:pointer;
                                            transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(16, 185, 129, 0.3);">
                                    Enroll Now
                                </a>

                                @if($course->brochure)
                                <a href="{{ asset('storage/app/public/' . $course->brochure) }}" target="_blank"
                                    style="flex:1; text-align:center; background: linear-gradient(135deg, #3b82f6, #2563eb);
                                            color:#fff; padding:11px 0; border-radius:8px; font-size:13px; font-weight:600;
                                            text-decoration:none; border:none; cursor:pointer;
                                            transition: all 0.3s ease; box-shadow: 0 4px 12px rgba(59, 130, 246, 0.3);">
                                    Brochure
                                </a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @empty
                    <div style="grid-column: 1 / -1; text-align: center; padding: 40px 20px;">
                        <i class="fa-solid fa-inbox" style="font-size: 48px; color: #9ca3af; margin-bottom: 16px;"></i>
                        <p style="font-size: 16px; color: #6b7280;">No courses found</p>
                    </div>
                    @endforelse

                </div>

                <!-- PAGINATION -->
                @if($allCourses->hasPages())
                <div style="display: flex; justify-content: center; align-items: center; margin-top: 40px;">
                    <nav aria-label="Page navigation" style="width: 100%;">
                        <ul class="pagination" style="display: flex; justify-content: center; align-items: center; gap: 5px; margin: 0; padding: 0; list-style: none;">

                            <!-- Previous Button -->
                            @if($allCourses->onFirstPage())
                            <li class="page-item disabled">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                             border: 2px solid #e5e7eb; border-radius: 6px; color: #9ca3af; cursor: not-allowed;">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </span>
                            </li>
                            @else
                            <li class="page-item">
                                <a href="{{ $allCourses->previousPageUrl() }}"
                                    style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                            border: 2px solid #e5e7eb; border-radius: 6px; color: #374151; text-decoration: none;
                                            transition: all 0.3s ease; cursor: pointer;"
                                    onmouseover="this.style.borderColor='#128C7E'; this.style.color='#128C7E';"
                                    onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#374151';">
                                    <i class="fa-solid fa-chevron-left"></i>
                                </a>
                            </li>
                            @endif

                            <!-- Page Numbers -->
                            @foreach($allCourses->getUrlRange(1, $allCourses->lastPage()) as $page => $url)
                                @if($page == $allCourses->currentPage())
                                <li class="page-item active">
                                    <span style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                                 background: linear-gradient(135deg, #ff9800, #ff7043); border: 2px solid #ff9800;
                                                 border-radius: 6px; color: #fff; font-weight: 700; cursor: pointer;">
                                        {{ $page }}
                                    </span>
                                </li>
                                @elseif($page == 1 || $page == $allCourses->lastPage() || abs($page - $allCourses->currentPage()) <= 1)
                                <li class="page-item">
                                    <a href="{{ $url }}"
                                        style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                                border: 2px solid #e5e7eb; border-radius: 6px; color: #374151; text-decoration: none;
                                                font-weight: 600; transition: all 0.3s ease; cursor: pointer;"
                                        onmouseover="this.style.borderColor='#128C7E'; this.style.color='#128C7E'; this.style.background='#f0fdf4';"
                                        onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#374151'; this.style.background='transparent';">
                                        {{ $page }}
                                    </a>
                                </li>
                                @elseif($page == 2 && $allCourses->currentPage() > 3)
                                <li style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                                    <span style="color: #9ca3af;">...</span>
                                </li>
                                @elseif($page == $allCourses->lastPage() - 1 && $allCourses->currentPage() < $allCourses->lastPage() - 2)
                                <li style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;">
                                    <span style="color: #9ca3af;">...</span>
                                </li>
                                @endif
                            @endforeach

                            <!-- Next Button -->
                            @if($allCourses->hasMorePages())
                            <li class="page-item">
                                <a href="{{ $allCourses->nextPageUrl() }}"
                                    style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                            border: 2px solid #e5e7eb; border-radius: 6px; color: #374151; text-decoration: none;
                                            transition: all 0.3s ease; cursor: pointer;"
                                    onmouseover="this.style.borderColor='#128C7E'; this.style.color='#128C7E';"
                                    onmouseout="this.style.borderColor='#e5e7eb'; this.style.color='#374151';">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </a>
                            </li>
                            @else
                            <li class="page-item disabled">
                                <span style="display: inline-flex; align-items: center; justify-content: center; width: 40px; height: 40px;
                                             border: 2px solid #e5e7eb; border-radius: 6px; color: #9ca3af; cursor: not-allowed;">
                                    <i class="fa-solid fa-chevron-right"></i>
                                </span>
                            </li>
                            @endif

                        </ul>
                    </nav>
                </div>
                @endif

            </div>
        </div>
    </div>
</div>
<!--===== COURSES SECTION ENDS =======-->

<!-- ENHANCED STYLING & FUNCTIONALITY -->
<style>
    /* Hover effects for course cards */
    .course-card-item {
        transition: all 0.3s ease;
    }

    .course-card-item:hover {
        box-shadow: 0 12px 24px rgba(0,0,0,0.12);
        transform: translateY(-8px);
    }

    .course-card-item:hover img {
        transform: scale(1.05);
    }

    /* Button hover effects */
    .course-card-item a:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 16px rgba(0,0,0,0.15);
    }

    /* Dropdown Item Styling */
    .dropdown-item-course:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #fff !important;
    }

    .dropdown-item-course:hover i {
        color: #fff !important;
    }

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

    /* Search Input Focus */
    #courseSearch:focus {
        border-color: #128C7E;
        box-shadow: 0 0 0 3px rgba(18,140,126,0.1);
    }

    /* Suggestions hover */
    #courseSuggestions div:hover {
        background: #f0fdf4;
    }

    /* Pagination responsiveness */
    @media (max-width: 768px) {
        .pagination {
            flex-wrap: wrap;
        }

        .pagination li {
            margin: 4px;
        }
    }

    /* No courses found message */
    .no-courses-message {
        text-align: center;
        padding: 60px 20px;
    }
</style>

<script>
    // ===== CATEGORY DROPDOWN FUNCTIONALITY =====
    let selectedCourseCategory = 'all';

    // Open/Close Dropdown
    document.getElementById('categoryDropdownBtn').addEventListener('click', function() {
        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = menu.style.maxHeight === '0px' || !menu.style.maxHeight ? menu.scrollHeight + 'px' : '0px';
        this.style.background = menu.style.maxHeight !== '0px' ? '#f9f9f9' : '#fff';
    });

    // Handle Category Item Click
    document.querySelectorAll('.dropdown-category-item-course').forEach(item => {
        item.addEventListener('click', function(e) {
            e.stopPropagation();
            const categoryId = this.dataset.categoryId;
            const categoryName = this.querySelector('span:last-of-type').innerText.trim();

            selectedCourseCategory = categoryId;
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
        selectedCourseCategory = 'all';
        document.getElementById('selectedCategory').innerHTML =
            '<i class="fa-solid fa-layer-group" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>All Categories';

        // Close dropdown
        document.getElementById('categoryDropdownMenu').style.maxHeight = '0px';
        document.getElementById('categoryDropdownBtn').style.background = '#fff';

        // Show all courses
        filterCoursesByCategory('all');
    });

    // Dropdown Item Hover Effects
    document.querySelectorAll('.dropdown-item-course, .dropdown-category-item-course, .dropdown-item-child-course').forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (item.classList.contains('dropdown-item-course') && item.dataset.categoryId === 'all') {
                this.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                this.style.color = '#fff';
            }
        });

        item.addEventListener('mouseleave', function() {
            if (item.classList.contains('dropdown-item-course') && item.dataset.categoryId === 'all') {
                this.style.background = 'linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%)';
                this.style.color = '#128C7E';
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
        const courseCards = document.querySelectorAll('.course-card-item');
        let visibleCount = 0;

        courseCards.forEach(card => {
            if (categoryId === 'all') {
                card.style.display = 'block';
                card.style.animation = 'fadeIn 0.3s ease';
                visibleCount++;
            } else {
                const cardCategoryId = card.dataset.categoryId;
                if (cardCategoryId == categoryId) {
                    card.style.display = 'block';
                    card.style.animation = 'fadeIn 0.3s ease';
                    visibleCount++;
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
    function searchCourses(query) {
        let suggestionBox = document.getElementById('courseSuggestions');

        if (query.length < 2) {
            suggestionBox.style.display = 'none';
            suggestionBox.innerHTML = '';
            return;
        }

        fetch(`{{ route('frontend.coursesearch') }}?q=${encodeURIComponent(query)}`)
            .then(response => response.json())
            .then(data => {
                if (data.length === 0) {
                    suggestionBox.innerHTML = '<div style="padding:12px; text-align:center; color:#9ca3af;">No courses found</div>';
                } else {
                    suggestionBox.innerHTML = data.map(item => `
                        <div style="padding:12px 16px; border-bottom:1px solid #eee; cursor:pointer; transition: background 0.2s ease;"
                             onmouseover="this.style.background='#f0fdf4';"
                             onmouseout="this.style.background='transparent';"
                             onclick="highlightCourse(${item.course_id})">
                            <div style="font-weight:600; color:#1f2937;">${item.title}</div>
                            <div style="font-size:12px; color:#9ca3af; margin-top:4px;">
                                <i class="fa-solid fa-graduation-cap" style="margin-right:4px;"></i>${item.category_name}
                            </div>
                        </div>
                    `).join('');
                }
                suggestionBox.style.display = 'block';
            })
            .catch(error => console.log('Search error:', error));
    }

    function highlightCourse(courseId) {
        const courseCard = document.querySelector(`[data-course-id="${courseId}"]`);
        if (courseCard) {
            courseCard.scrollIntoView({ behavior: 'smooth', block: 'center' });
            courseCard.style.background = '#fff3cd';
            setTimeout(() => {
                courseCard.style.background = '#fff';
            }, 2000);
        }
        document.getElementById('courseSuggestions').style.display = 'none';
        document.getElementById('courseSearch').value = '';
    }

    // Close suggestions when clicking outside
    document.addEventListener('click', function(e) {
        let box = document.getElementById('courseSuggestions');
        let input = document.getElementById('courseSearch');
        if (!box.contains(e.target) && e.target !== input) {
            box.style.display = 'none';
        }
    });

    // AOS visibility fix (same as acts page)
    function ensureAOSElementsVisible() {
        document.querySelectorAll('[data-aos]').forEach(element => {
            element.style.opacity = '1';
            element.style.visibility = 'visible';
            element.style.transform = 'none';
        });

        if (typeof AOS !== 'undefined' && AOS.init) {
            AOS.refresh();
        }
    }

    // Call on page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            ensureAOSElementsVisible();
        }, 500);
    });

    window.addEventListener('load', function() {
        ensureAOSElementsVisible();
    });
</script>

@endsection
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