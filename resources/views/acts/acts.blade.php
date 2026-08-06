@extends('layouts.landing', ['title' => 'Acts'])

@section('content')
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Acts</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Acts</a>
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

                <!-- FILTER DROPDOWN & SEARCH -->
                <div style="display:flex; gap:15px; margin-bottom:20px; flex-wrap:wrap; align-items:center; justify-content:center;">

                    <!-- CATEGORY DROPDOWN -->
                    <div class="category-filter-wrapper" style="position:relative; min-width:250px;">
                        <div style="position:relative;">
                            <button type="button" id="categoryDropdownBtn"
                                style="width:100%; padding:12px 15px; background:#fff; border:2px solid #e4e6eb; border-radius:8px;
                                        font-size:14px; font-weight:600; text-align:left; cursor:pointer;
                                        display:flex; justify-content:space-between; align-items:center;
                                        transition: all 0.3s ease; color:#333;">
                                <span id="selectedCategory">All Categories</span>
                                <i class="fa-solid fa-chevron-down" style="font-size:12px;"></i>
                            </button>

                            <!-- DROPDOWN MENU -->
                            <div id="categoryDropdownMenu"
                                style="position:absolute; top:100%; left:0; right:0; background:#fff; border:1px solid #e4e6eb;
                                        border-radius:8px; box-shadow:0 4px 12px rgba(0,0,0,0.1); max-height:0; overflow:hidden;
                                        z-index:1000; transition: max-height 0.3s ease; margin-top:5px;">

                                <div style="max-height:350px; overflow-y:auto;">
                                    <!-- All Categories Option -->
                                    <div class="dropdown-item-act" data-category-id="all"
                                        style="padding:12px 15px; cursor:pointer; border-bottom:1px solid #f0f0f0;
                                                font-weight:600; color:#128C7E; background:#f9f9f9;
                                                transition: background 0.2s ease;">
                                        <i class="fa-solid fa-list" style="margin-right:8px;"></i>All Categories
                                    </div>

                                    @foreach ($categories as $category)
                                    <!-- Parent Category -->
                                    <div class="dropdown-parent-act" data-category-id="{{ $category->id }}"
                                        style="padding:12px 15px; cursor:pointer; border-bottom:1px solid #f0f0f0;
                                                display:flex; justify-content:space-between; align-items:center;
                                                transition: background 0.2s ease; font-weight:500;">
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

                    <!-- SEARCH -->
                    <div class="search-container" style="flex:1; min-width:200px; max-width:400px; position:relative;">
                        <input type="text" id="actSearch" class="form-control"
                            placeholder="Search Acts..." onkeyup="searchActs(this.value)"
                            style="padding-right:40px;">
                        <i class="fa-solid fa-search" style="position:absolute; right:12px; top:50%; transform:translateY(-50%);
                                                              color:#999; pointer-events:none; font-size:14px;"></i>

                        <div id="actSuggestions"
                            style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none;
                                    position:absolute; top:100%; left:0; right:0; background:#fff;
                                    border-radius:0 0 8px 8px; z-index:999;">
                        </div>
                    </div>
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
    .act-highlight {
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
</script>
@endsection