@extends('layouts.landing', ['title' => 'Acts'])

@section('content')
<!-- ===== MODERN MOBILE REDESIGN FOR ACTS PAGE ======= -->
<style>
    /* ===== MODERN MOBILE-FIRST DESIGN IMPROVEMENTS ===== */
    * {
        box-sizing: border-box;
    }

    /* ===== MODERN BUTTON STYLES ===== */
    button, .btn, a[class*="btn"] {
        border-radius: 8px !important;
        padding: 14px 28px !important;
        font-weight: 600 !important;
        transition: all 0.3s ease !important;
        min-height: 44px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1) !important;
    }

    button:hover, .btn:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 4px 12px rgba(0,0,0,0.15) !important;
    }

    /* ===== MODERN CARD STYLES ===== */
    .accordion-item, .card, [class*="box"] {
        border: none !important;
        border-radius: 12px !important;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08) !important;
        transition: all 0.3s ease !important;
        overflow: hidden;
    }

    .accordion-item:hover, .card:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.12) !important;
    }

    /* ===== MODERN SPACING ===== */
    .container {
        padding: 20px !important;
    }

    .row {
        margin: -15px !important;
    }

    .row > * {
        padding: 15px !important;
    }

    /* ===== MODERN ACCORDION STYLES ===== */
    .accordion-button {
        border-radius: 8px !important;
        border: none !important;
        padding: 16px 20px !important;
        font-weight: 600 !important;
        background: #f8f8f8 !important;
        transition: all 0.3s ease;
    }

    .accordion-button:hover {
        background: #f0f0f0 !important;
    }

    .accordion-button:not(.collapsed) {
        background: #ff5722 !important;
        color: white !important;
        box-shadow: 0 4px 12px rgba(255, 87, 34, 0.3) !important;
    }

    .accordion-body {
        padding: 20px !important;
    }

    /* ===== MODERN FORM STYLES ===== */
    input, textarea, select {
        border-radius: 8px !important;
        border: 1px solid #e0e0e0 !important;
        padding: 12px 14px !important;
        font-size: 14px !important;
        transition: all 0.3s ease;
        width: 100% !important;
    }

    input:focus, textarea:focus, select:focus {
        border-color: #ff5722 !important;
        box-shadow: 0 0 0 3px rgba(255, 87, 34, 0.1) !important;
        outline: none !important;
    }

    /* ===== MODERN SEARCH STYLES ===== */
    .search-container, [class*="search"] {
        background: white;
        border-radius: 12px;
        padding: 16px;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    /* ===== RESPONSIVE GRID ===== */
    @media (max-width: 768px) {
        .col-lg-4 {
            flex: 0 0 50% !important;
            max-width: 50% !important;
        }

        .col-lg-6 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .container {
            padding: 16px !important;
        }

        .row {
            margin: -10px !important;
        }

        .row > * {
            padding: 10px !important;
        }
    }

    @media (max-width: 576px) {
        .col-lg-4, .col-md-6 {
            flex: 0 0 100% !important;
            max-width: 100% !important;
        }

        .container {
            padding: 12px !important;
        }

        .row {
            margin: -8px !important;
        }

        .row > * {
            padding: 8px !important;
        }

        button, .btn {
            width: 100% !important;
            margin-bottom: 12px !important;
        }

        input, textarea, select {
            font-size: 16px !important; /* Prevents zoom on iOS */
        }
    }

    /* ===== HEADING STYLES FOR ACTS PAGE (MODERN) ===== */
    /* Heading styles to match about page EXACTLY */
    h1 {
        font-size: 60px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 60px !important;
    }

    h2 {
        font-size: 46px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
        line-height: 1.3 !important;
    }

    h3 {
        font-size: 40px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    /* Override inline h3 styles for Find Your Act heading */
    h3[style*="font-size:18px"] {
        font-size: 40px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    /* Increase description and info text sizes - all dynamic content */
    .act-category div[style*="font-size:13px"],
    .act-category p[style*="font-size:13px"],
    .act-category span[style*="font-size:13px"],
    .accordion-content div[style*="font-size:13px"],
    .accordion-content p[style*="font-size:13px"],
    .accordion-content span[style*="font-size:13px"],
    [data-act-id] div[style*="font-size:13px"],
    [data-act-id] p[style*="font-size:13px"],
    [data-act-id] span[style*="font-size:13px"] {
        font-size: 15px !important;
        margin-bottom: 12px !important;
        font-family: 'Playfair Display', serif !important;
    }

    /* Handle other common dynamic font sizes */
    .act-category div[style*="font-size:14px"],
    .act-category p[style*="font-size:14px"],
    .act-category span[style*="font-size:14px"],
    .accordion-content div[style*="font-size:14px"],
    .accordion-content p[style*="font-size:14px"],
    .accordion-content span[style*="font-size:14px"] {
        font-size: 16px !important;
        font-family: 'Playfair Display', serif !important;
    }

    /* Handle 15px dynamic content */
    .act-category div[style*="font-size:15px"],
    .act-category p[style*="font-size:15px"],
    .act-category span[style*="font-size:15px"],
    .accordion-content div[style*="font-size:15px"],
    .accordion-content p[style*="font-size:15px"],
    .accordion-content span[style*="font-size:15px"] {
        font-size: 17px !important;
        font-family: 'Playfair Display', serif !important;
    }

    /* Protect form labels and buttons */
    label {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    button, input, textarea, select {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    @media (max-width: 768px) {
        h1 {
            font-size: 48px !important;
        }

        h2 {
            font-size: 36px !important;
        }

        h3 {
            font-size: 32px !important;
        }

        h3[style*="font-size:18px"] {
            font-size: 32px !important;
        }

        .act-category div[style*="font-size:13px"],
        .act-category p[style*="font-size:13px"],
        .act-category span[style*="font-size:13px"],
        .accordion-content div[style*="font-size:13px"],
        .accordion-content p[style*="font-size:13px"],
        .accordion-content span[style*="font-size:13px"] {
            font-size: 14px !important;
        }

        .act-category div[style*="font-size:14px"],
        .act-category p[style*="font-size:14px"],
        .act-category span[style*="font-size:14px"],
        .accordion-content div[style*="font-size:14px"],
        .accordion-content p[style*="font-size:14px"],
        .accordion-content span[style*="font-size:14px"] {
            font-size: 15px !important;
        }

        .act-category div[style*="font-size:15px"],
        .act-category p[style*="font-size:15px"],
        .act-category span[style*="font-size:15px"],
        .accordion-content div[style*="font-size:15px"],
        .accordion-content p[style*="font-size:15px"],
        .accordion-content span[style*="font-size:15px"] {
            font-size: 16px !important;
        }
    }

    @media (max-width: 576px) {
        h1 {
            font-size: 36px !important;
        }

        h2 {
            font-size: 28px !important;
        }

        h3 {
            font-size: 24px !important;
        }

        h3[style*="font-size:18px"] {
            font-size: 24px !important;
        }

        .act-category div[style*="font-size:13px"],
        .act-category p[style*="font-size:13px"],
        .act-category span[style*="font-size:13px"],
        .accordion-content div[style*="font-size:13px"],
        .accordion-content p[style*="font-size:13px"],
        .accordion-content span[style*="font-size:13px"] {
            font-size: 13px !important;
        }

        .act-category div[style*="font-size:14px"],
        .act-category p[style*="font-size:14px"],
        .act-category span[style*="font-size:14px"],
        .accordion-content div[style*="font-size:14px"],
        .accordion-content p[style*="font-size:14px"],
        .accordion-content span[style*="font-size:14px"] {
            font-size: 14px !important;
        }

        .act-category div[style*="font-size:15px"],
        .act-category p[style*="font-size:15px"],
        .act-category span[style*="font-size:15px"],
        .accordion-content div[style*="font-size:15px"],
        .accordion-content p[style*="font-size:15px"],
        .accordion-content span[style*="font-size:15px"] {
            font-size: 15px !important;
        }
    }
</style>
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Acts</h1>
                    <a href="{{ route('frontend.home') }}">Home <span><i class="fa-light fa-angle-right"></i></span> Acts</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->
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
                            <i class="fa-solid fa-sliders" style="margin-right:8px; color:#128C7E;"></i>Find Your Act
                        </h3>
                        <p style="font-size:13px; color:#6b7280; margin:0;">Filter by category or search by keywords</p>
                    </div>

                    <!-- FILTER AND SEARCH ROW -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:15px;">

                        <!-- CATEGORY DROPDOWN FILTER -->
                        <div class="category-filter-wrapper" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-filter" style="margin-right:6px;"></i>Act Category
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
                                        <div class="dropdown-item-act" data-category-id="all"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    font-weight:600; color:#128C7E; background:linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
                                                    transition: all 0.2s ease;">
                                            <i class="fa-solid fa-list" style="margin-right:8px;"></i>All Acts
                                        </div>

                                        @foreach ($categories as $category)
                                        <!-- Parent Category -->
                                        <div class="dropdown-parent-act" data-category-id="{{ $category->id }}"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    display:flex; justify-content:space-between; align-items:center;
                                                    transition: all 0.2s ease; font-weight:500; color:#1f2937;">
                                            <span>
                                                <i class="fa-solid fa-folder" style="margin-right:8px; color:#128C7E;"></i>
                                                {{ $category->name }}
                                            </span>
                                        </div>
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
                                <input type="text" id="actSearch" class="form-control"
                                    placeholder="Search Acts..." onkeyup="searchActs(this.value)"
                                    style="padding:14px 16px 14px 16px; padding-right:40px; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#128C7E'; this.style.boxShadow='0 0 0 3px rgba(18,140,126,0.1)';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.06)';">
                                <i class="fa-solid fa-search" style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                                                      color:#9ca3af; pointer-events:none; font-size:14px;"></i>

                                <div id="actSuggestions"
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
                <div class="act-category" data-category-id="{{ $category->id }}" style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

                    <div onclick="toggleAccordion('actCat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
                    </div>

                    <!-- 🔥 OPEN BY DEFAULT -->
                    <div id="actCat{{ $category->id }}" class="accordion-content" style="max-height:1000px;">

                        @foreach ($category->subcategories as $sub)
                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">

                            <div onclick="toggleAccordion('actSub{{ $sub->id }}')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <!-- 🔥 OPEN BY DEFAULT -->
                            <div id="actSub{{ $sub->id }}" class="accordion-content" style="padding:10px; max-height:1000px;">

                                @foreach ($sub->acts as $act)
                                <!-- ACT -->
                                <div data-act-id="{{ $act->id }}" style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">
                                    <div style="font-weight:600;">
                                        {{ $act->description }}
                                    </div>

                                    <!-- PDFs -->
                                    @if ($act->pdfs)
                                    @foreach ($act->pdfs as $index => $pdf)
                                    <div style="margin-top:5px; display:flex; justify-content:space-between; align-items:center;">
                                        <span style="font-size:12px;">PDF {{ $index + 1 }}</span>
                                        <div>
                                            <a href="{{ asset('storage/app/public/' . $pdf) }}" target="_blank" style="margin-right:10px; font-size:12px;">View</a>

                                            @if (auth()->check())
                                            <a href="{{ asset('storage/app/public/' . $pdf) }}" download style="font-size:12px; color:green;">Download</a>
                                            @else
                                            <a href="{{ route('google.login') }}" style="font-size:12px; color:green;">Download</a>
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
        </div>
    </div>
</div>

<style>
    /* Dynamic content text styling to match about page */
    .act-category > div:first-child {
        font-size: 40px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    .accordion-content > div > div:first-child {
        font-size: 36px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    [data-act-id] > div:first-child {
        font-size: 32px !important;
        font-family: 'Playfair Display', serif !important;
        font-weight: 500 !important;
    }

    /* Protect button and link text from heading styles */
    a, button, input, span, p {
        font-size: revert !important;
        font-family: revert !important;
        font-weight: revert !important;
    }

    /* Restore View/Download button text */
    a[href*="storage"], a[style*="color:green"] {
        font-size: 12px !important;
        color: inherit !important;
        font-weight: 400 !important;
        font-family: inherit !important;
    }

    .act-highlight {
        border: 2px solid #28a745 !important;
        background: #e6ffe6;
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

    /* Dropdown Item Styling */
    .dropdown-item-act:hover,
    .dropdown-parent-act:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #fff !important;
    }

    .dropdown-item-act:hover i,
    .dropdown-parent-act:hover i {
        color: #fff !important;
    }

    /* Search Input Focus */
    #actSearch:focus {
        border-color: #128C7E;
        box-shadow: 0 0 0 3px rgba(18,140,126,0.1);
    }

    /* Suggestions hover */
    #actSuggestions div:hover {
        background: #f0fdf4;
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

<script>
    let selectedActCategoryId = 'all';

    // Open/Close Dropdown
    document.getElementById('categoryDropdownBtn').addEventListener('click', function() {
        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = menu.style.maxHeight === '0px' || !menu.style.maxHeight ? menu.scrollHeight + 'px' : '0px';
        this.style.background = menu.style.maxHeight !== '0px' ? '#f9f9f9' : '#fff';
    });

    // Handle Category Click
    document.querySelectorAll('.dropdown-parent-act').forEach(item => {
        item.addEventListener('click', function() {
            const categoryId = this.dataset.categoryId;
            const categoryName = this.querySelector('span').innerText.replace(/[^\w\s-]/g, '').trim();

            selectedActCategoryId = categoryId;
            document.getElementById('selectedCategory').innerText = categoryName;

            // Close dropdown
            let menu = document.getElementById('categoryDropdownMenu');
            menu.style.maxHeight = '0px';
            document.getElementById('categoryDropdownBtn').style.background = '#fff';

            // Filter
            filterActsByCategory(categoryId);
        });
    });

    // Handle "All Categories" Option
    document.querySelector('[data-category-id="all"]').addEventListener('click', function() {
        selectedActCategoryId = 'all';
        document.getElementById('selectedCategory').innerText = 'All Categories';

        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = '0px';
        document.getElementById('categoryDropdownBtn').style.background = '#fff';

        filterActsByCategory('all');
    });

    // Dropdown Item Hover Effects
    document.querySelectorAll('.dropdown-item-act, .dropdown-parent-act').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.background = '#e8f5f3';
        });

        item.addEventListener('mouseleave', function() {
            if (item.classList.contains('dropdown-item-act')) {
                this.style.background = '#f9f9f9';
            } else {
                this.style.background = '';
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

    // Filter acts by category
    function filterActsByCategory(categoryId) {
        const categoryCards = document.querySelectorAll('.act-category');

        categoryCards.forEach(card => {
            if (categoryId === 'all') {
                card.style.display = 'block';
            } else {
                const cardCategoryId = card.dataset.categoryId;
                if (cardCategoryId == categoryId) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }

    function toggleAccordion(id) {
        return; // disabled toggle
    }

    function searchActs(query) {
        let box = document.getElementById('actSuggestions');

        if (query.length < 3) {
            box.style.display = 'none';
            return;
        }

        fetch(`{{ route('frontend.actssearch') }}?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    box.innerHTML = '<div style="padding:10px;">No results</div>';
                } else {
                    box.innerHTML = data.map(item => `
                        <div style="padding:10px; cursor:pointer;"
                             onclick="openActSearch(${item.category_id}, ${item.subcategory_id}, ${item.note_id})">
                            ${item.title}
                        </div>
                    `).join('');
                }
                box.style.display = 'block';
            });
    }

    function openActSearch(catId, subId, actId) {
        // Hide all categories
        document.querySelectorAll('[id^="actCat"]').forEach(cat => {
            cat.parentElement.style.display = 'none';
            cat.querySelectorAll('.act-highlight').forEach(a => a.classList.remove('act-highlight'));
        });

        // Show only relevant category
        let catContainer = document.getElementById('actCat' + catId)?.parentElement;
        if (catContainer) catContainer.style.display = 'block';

        // Show only the relevant act
        let sub = document.getElementById('actSub' + subId);
        if (sub) {
            sub.querySelectorAll('[data-act-id]').forEach(a => a.style.display = 'none');

            let actDiv = sub.querySelector(`div[data-act-id='${actId}']`);
            if (actDiv) {
                actDiv.style.display = 'block';
                actDiv.classList.add('act-highlight');
                actDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            // Show subcategory container
            sub.style.display = 'block';
            sub.parentElement.style.display = 'block';
        }

        document.getElementById('actSuggestions').style.display = 'none';
    }

    document.addEventListener('click', function(e) {
        let box = document.getElementById('actSuggestions');
        let input = document.getElementById('actSearch');
        if (!box.contains(e.target) && e.target !== input) {
            box.style.display = 'none';
        }
    });

    // ===== ENSURE AOS ELEMENTS ARE VISIBLE AFTER FILTERING =====
    // This function resets the visibility of AOS elements
    function ensureAOSElementsVisible() {
        // Ensure all data-aos elements are visible
        document.querySelectorAll('[data-aos]').forEach(element => {
            element.style.opacity = '1';
            element.style.visibility = 'visible';
            element.style.transform = 'none';
        });

        // Reinitialize AOS if available
        if (typeof AOS !== 'undefined' && AOS.init) {
            AOS.refresh();
        }
    }

    // Override the filterActsByCategory function to reset AOS
    const originalFilter = filterActsByCategory;
    window.filterActsByCategory = function(categoryId) {
        originalFilter(categoryId);
        // Reset AOS visibility after filter
        setTimeout(() => {
            ensureAOSElementsVisible();
        }, 100);
    };

    // Override openActSearch to reset AOS
    const originalOpenActSearch = openActSearch;
    window.openActSearch = function(catId, subId, actId) {
        originalOpenActSearch(catId, subId, actId);
        // Reset AOS visibility after search
        setTimeout(() => {
            ensureAOSElementsVisible();
        }, 100);
    };

    // Ensure elements are visible on initial page load
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(() => {
            ensureAOSElementsVisible();
        }, 500);
    });

    // Also ensure visibility when page is fully loaded
    window.addEventListener('load', function() {
        ensureAOSElementsVisible();
    });
</script>
@endsection