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
                    <h1>Rules</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Rules</a>
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
                            <i class="fa-solid fa-sliders" style="margin-right:8px; color:#128C7E;"></i>Find Your Rule
                        </h3>
                        <p style="font-size:13px; color:#6b7280; margin:0;">Filter by category or search by keywords</p>
                    </div>

                    <!-- FILTER AND SEARCH ROW -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:15px;">

                        <!-- CATEGORY DROPDOWN FILTER -->
                        <div class="category-filter-wrapper" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-filter" style="margin-right:6px;"></i>Rule Category
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
                                            <i class="fa-solid fa-list" style="margin-right:8px;"></i>All Rules
                                        </div>

                                        @foreach ($categories as $category)
                                        <!-- Parent Category -->
                                        <div class="dropdown-item-parent" data-category-id="{{ $category->id }}"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    display:flex; justify-content:space-between; align-items:center;
                                                    transition: all 0.2s ease; font-weight:500; color:#1f2937;">
                                            <span>
                                                <i class="fa-solid fa-folder" style="margin-right:8px; color:#128C7E;"></i>
                                                {{ $category->name }}
                                            </span>
                                            @if($category->subcategories->count() > 0)
                                            <i class="fa-solid fa-chevron-right" style="font-size:12px; color:#d1d5db; transition: transform 0.2s ease;"></i>
                                            @endif
                                        </div>

                                        <!-- Child Categories (Subcategories) -->
                                        @if($category->subcategories->count() > 0)
                                        @foreach ($category->subcategories as $sub)
                                        <div class="dropdown-item-child" data-parent-id="{{ $category->id }}" data-category-id="{{ $sub->id }}"
                                            style="padding:12px 16px 12px 40px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    background:#fafbfc; font-size:13px; color:#4b5563;
                                                    transition: all 0.2s ease; display:none;">
                                            <i class="fa-solid fa-tag" style="margin-right:8px; color:#25D366; font-size:11px;"></i>
                                            {{ $sub->name }}
                                        </div>
                                        @endforeach
                                        @endif
                                        @endforeach
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
                                    placeholder="Search Rules..." onkeyup="searchNotes(this.value)"
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

                @foreach ($categories as $category)
                <!-- CATEGORY -->
                <div data-category-id="{{ $category->id }}" style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

                    <div onclick="toggleAccordion('cat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        <i class="fa-solid fa-folder-open" style="margin-right:8px; color:#128C7E;"></i>{{ $category->name }}
                    </div>

                    <!-- 🔥 OPEN BY DEFAULT -->
                    <div id="cat{{ $category->id }}" class="accordion-content" style="max-height:1000px;">

                        @foreach ($category->subcategories as $sub)
                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">

                            <div onclick="toggleAccordion('sub{{ $sub->id }}')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <!-- 🔥 OPEN BY DEFAULT -->
                            <div id="sub{{ $sub->id }}" class="accordion-content" style="padding:10px; max-height:1000px;">

                                @foreach ($sub->rules as $rule)
                                <!-- RULE -->
                                <div data-rule-id="{{ $rule->id }}" style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">
                                    <div style="font-weight:600;">
                                        {{ $rule->description }}
                                    </div>

                                    <!-- PDFs -->
                                    @if ($rule->pdfs)
                                    @foreach ($rule->pdfs as $index => $pdf)
                                    <div style="margin-top:5px; display:flex; justify-content:space-between; align-items:center;">
                                        <span style="font-size:12px;">PDF {{ $index + 1 }}</span>
                                        <div>
                                            <!-- VIEW button -->
                                            <a href="{{ asset('storage/app/public/' . $pdf) }}" target="_blank" style="margin-right:10px; font-size:12px;">
                                                View
                                            </a>

                                            <!-- DOWNLOAD button -->
                                            @if (auth()->check())
                                            <a href="{{ asset('storage/app/public/' . $pdf) }}" download style="font-size:12px; color:green;">
                                                Download
                                            </a>
                                            @else
                                            <a href="{{ route('google.login') }}" style="font-size:12px; color:green;">
                                                Download
                                            </a>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                                @endforeach

                            </div>
                        </div>
                        @endforeach

                    </div>
                </div>
                @endforeach

            </div>
            <style>
                .rule-highlight {
                    border: 2px solid #28a745 !important;
                    background: #e6ffe6;
                }
            </style>
            <!-- STYLES -->
            <style>
                .accordion-content {
                    max-height: none !important;
                    /* 🔥 Always visible */
                    overflow: visible !important;
                    transition: none;
                }

                #searchSuggestions div:hover {
                    background: #f1f1f1;
                }
            </style>

            <!-- SCRIPT -->
            <script>
                // ===== CATEGORY DROPDOWN FUNCTIONALITY =====
                let selectedCategoryId = 'all';

                // Dropdown Button Hover Effects
                document.getElementById('categoryDropdownBtn').addEventListener('mouseenter', function() {
                    if (this.style.borderColor !== 'rgb(18, 140, 126)') {
                        this.style.borderColor = '#d1d5db';
                        this.style.background = '#f9fafb';
                        this.style.boxShadow = '0 4px 6px rgba(0,0,0,0.08)';
                    }
                });

                document.getElementById('categoryDropdownBtn').addEventListener('mouseleave', function() {
                    if (this.style.borderColor !== 'rgb(18, 140, 126)') {
                        this.style.borderColor = '#e5e7eb';
                        this.style.background = '#fff';
                        this.style.boxShadow = '0 1px 3px rgba(0,0,0,0.06)';
                    }
                });

                // Open/Close Dropdown
                document.getElementById('categoryDropdownBtn').addEventListener('click', function() {
                    let menu = document.getElementById('categoryDropdownMenu');
                    const isOpen = menu.style.maxHeight && menu.style.maxHeight !== '0px';
                    menu.style.maxHeight = !isOpen ? menu.scrollHeight + 'px' : '0px';

                    // Update button styling when open
                    if (!isOpen) {
                        this.style.background = '#f3f4f6';
                        this.style.borderColor = '#128C7E';
                        this.querySelector('i').style.transform = 'rotate(180deg)';
                        this.querySelector('i').style.color = '#128C7E';
                    } else {
                        this.style.background = '#fff';
                        this.style.borderColor = '#e5e7eb';
                        this.querySelector('i').style.transform = 'rotate(0deg)';
                        this.querySelector('i').style.color = '#9ca3af';
                    }
                });

                // Handle Parent Category Click
                document.querySelectorAll('.dropdown-item-parent').forEach(item => {
                    item.addEventListener('click', function() {
                        const categoryId = this.dataset.categoryId;
                        const categoryName = this.querySelector('span').innerText.replace(/[^\w\s-]/g, '').trim();

                        // Update selected category
                        selectedCategoryId = categoryId;
                        document.getElementById('selectedCategory').innerText = categoryName;

                        // Close dropdown
                        const menu = document.getElementById('categoryDropdownMenu');
                        const btn = document.getElementById('categoryDropdownBtn');
                        menu.style.maxHeight = '0px';
                        btn.style.background = '#fff';
                        btn.style.borderColor = '#e5e7eb';
                        btn.querySelector('i').style.transform = 'rotate(0deg)';
                        btn.querySelector('i').style.color = '#9ca3af';

                        // Filter categories
                        filterCategoriesBy(categoryId);
                    });

                    // Toggle subcategories on hover
                    this.addEventListener('mouseenter', function() {
                        const parentId = this.dataset.categoryId;
                        const children = document.querySelectorAll(`.dropdown-item-child[data-parent-id="${parentId}"]`);
                        children.forEach(child => child.style.display = 'block');
                    });
                });

                // Handle Child Category Click
                document.querySelectorAll('.dropdown-item-child').forEach(item => {
                    item.addEventListener('click', function(e) {
                        e.stopPropagation();
                        const categoryId = this.dataset.categoryId;
                        const categoryName = this.innerText.replace(/[^\w\s-]/g, '').trim();

                        // Update selected category
                        selectedCategoryId = categoryId;
                        document.getElementById('selectedCategory').innerText = categoryName;

                        // Close dropdown
                        const menu = document.getElementById('categoryDropdownMenu');
                        const btn = document.getElementById('categoryDropdownBtn');
                        menu.style.maxHeight = '0px';
                        btn.style.background = '#fff';
                        btn.style.borderColor = '#e5e7eb';
                        btn.querySelector('i').style.transform = 'rotate(0deg)';
                        btn.querySelector('i').style.color = '#9ca3af';

                        // Filter categories
                        filterCategoriesBy(categoryId);
                    });
                });

                // Handle "All Categories" Option
                document.querySelector('[data-category-id="all"]').addEventListener('click', function() {
                    selectedCategoryId = 'all';
                    document.getElementById('selectedCategory').innerText = 'All Categories';

                    // Close dropdown
                    const menu = document.getElementById('categoryDropdownMenu');
                    const btn = document.getElementById('categoryDropdownBtn');
                    menu.style.maxHeight = '0px';
                    btn.style.background = '#fff';
                    btn.style.borderColor = '#e5e7eb';
                    btn.querySelector('i').style.transform = 'rotate(0deg)';
                    btn.querySelector('i').style.color = '#9ca3af';

                    // Show all categories
                    filterCategoriesBy('all');
                });

                // Dropdown Item Hover Effects
                document.querySelectorAll('.dropdown-item, .dropdown-item-parent, .dropdown-item-child').forEach(item => {
                    item.addEventListener('mouseenter', function() {
                        if (item.classList.contains('dropdown-item')) {
                            this.style.background = 'linear-gradient(135deg, #10b981 0%, #059669 100%)';
                            this.style.color = '#fff';
                        } else if (item.classList.contains('dropdown-item-parent')) {
                            this.style.background = '#eff6ff';
                            this.style.color = '#0c4a6e';
                        } else {
                            this.style.background = '#dbeafe';
                            this.style.color = '#164e63';
                        }
                    });

                    item.addEventListener('mouseleave', function() {
                        if (item.classList.contains('dropdown-item')) {
                            this.style.background = 'linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%)';
                            this.style.color = '#128C7E';
                        } else if (item.classList.contains('dropdown-item-parent')) {
                            this.style.background = '';
                            this.style.color = '#1f2937';
                        } else {
                            this.style.background = '#fafbfc';
                            this.style.color = '#4b5563';
                        }
                    });
                });

                // Close dropdown when clicking outside
                document.addEventListener('click', function(event) {
                    const dropdown = document.querySelector('.category-filter-wrapper');
                    if (!dropdown.contains(event.target)) {
                        const menu = document.getElementById('categoryDropdownMenu');
                        const btn = document.getElementById('categoryDropdownBtn');
                        menu.style.maxHeight = '0px';
                        btn.style.background = '#fff';
                        btn.style.borderColor = '#e5e7eb';
                        if (btn.querySelector('i')) {
                            btn.querySelector('i').style.transform = 'rotate(0deg)';
                            btn.querySelector('i').style.color = '#9ca3af';
                        }
                    }
                });

                // Filter categories by ID
                function filterCategoriesBy(categoryId) {
                    const categoryDivs = document.querySelectorAll('[data-category-id]');

                    categoryDivs.forEach(div => {
                        if (categoryId === 'all') {
                            div.style.display = 'block';
                            div.style.animation = 'fadeIn 0.3s ease';
                        } else {
                            if (div.dataset.categoryId == categoryId) {
                                div.style.display = 'block';
                                div.style.animation = 'fadeIn 0.3s ease';
                            } else {
                                div.style.display = 'none';
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

                function toggleAccordion(id) {
                    return; // Disabled toggle
                }

                function searchNotes(query) {
                    let box = document.getElementById('searchSuggestions');
                    if (query.length < 3) {
                        box.style.display = 'none';
                        return;
                    }

                    fetch(`{{ route('frontend.rulessearch') }}?q=${encodeURIComponent(query)}`)
                        .then(res => res.json())
                        .then(data => {
                            if (!data.length) {
                                box.innerHTML = '<div style="padding:10px;">No results</div>';
                            } else {
                                box.innerHTML = data.map(item => `
                    <div style="padding:10px; cursor:pointer;"
                         onclick="openSearch(${item.category_id}, ${item.subcategory_id}, ${item.note_id})">
                        ${item.title}
                    </div>
                `).join('');
                            }
                            box.style.display = 'block';
                        });
                }

                function openSearch(catId, subId, ruleId) {
                    // Hide all categories
                    document.querySelectorAll('[id^="cat"]').forEach(cat => {
                        cat.parentElement.style.display = 'none'; // Hide the entire category container
                        cat.querySelectorAll('.rule-highlight').forEach(r => r.classList.remove('rule-highlight'));
                    });

                    // Show only the relevant category container
                    let catContainer = document.getElementById('cat' + catId)?.parentElement;
                    if (catContainer) catContainer.style.display = 'block';

                    // Hide all subcategories inside this category
                    let sub = document.getElementById('sub' + subId);
                    if (sub) {
                        sub.querySelectorAll('[data-rule-id]').forEach(r => r.style.display = 'none');

                        // Show only the searched rule
                        let ruleDiv = sub.querySelector(`div[data-rule-id='${ruleId}']`);
                        if (ruleDiv) {
                            ruleDiv.style.display = 'block';
                            ruleDiv.classList.add('rule-highlight');
                            ruleDiv.scrollIntoView({
                                behavior: 'smooth',
                                block: 'center'
                            });
                        }

                        // Show only the relevant subcategory container
                        sub.style.display = 'block';
                        sub.parentElement.style.display = 'block';
                    }

                    // Hide search suggestions
                    document.getElementById('searchSuggestions').style.display = 'none';
                }

                // CLOSE SEARCH ON OUTSIDE CLICK
                document.addEventListener('click', function(e) {
                    let box = document.getElementById('searchSuggestions');
                    let input = document.getElementById('noteSearch');
                    if (!box.contains(e.target) && e.target !== input) {
                        box.style.display = 'none';
                    }
                });
            </script>

        </div>
    </div>
</div>

@endsection