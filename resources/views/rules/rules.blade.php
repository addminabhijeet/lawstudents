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

                <!-- SEARCH + FILTER -->
                <div style="max-width:600px; margin:0 auto 20px; position:relative;">

                    <!-- SEARCH BOX -->
                    <input type="text" id="noteSearch" class="form-control"
                        placeholder="Search Rules..." onkeyup="searchNotes(this.value)">

                    <!-- CATEGORY DROPDOWN -->
                    <select id="categoryFilter" class="form-control mt-2" onchange="filterByCategory()">
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>

                    <!-- SUBCATEGORY DROPDOWN -->
                    <select id="subcategoryFilter" class="form-control mt-2" onchange="filterBySubcategory()">
                        <option value="">Select Subcategory</option>
                    </select>

                    <!-- RULE DROPDOWN -->
                    <select id="ruleFilter" class="form-control mt-2" onchange="filterByRule()">
                        <option value="">Select Rule</option>
                    </select>

                    <!-- SEARCH SUGGESTIONS BOX -->
                    <div id="searchSuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none; position:absolute; width:100%; background:#fff; z-index:999;">
                    </div>

                </div>

                <!-- RULES DISPLAY -->
                @foreach ($categories as $category)
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

                    <div style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
                    </div>

                    <div id="cat{{ $category->id }}" class="accordion-content" style="max-height:1000px;">
                        @foreach ($category->subcategories as $sub)
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">
                            <div style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <div id="sub{{ $sub->id }}" class="accordion-content" style="padding:10px; max-height:1000px;">
                                @foreach ($sub->rules as $rule)
                                <div id="rule{{ $rule->id }}" style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">
                                    <div style="font-weight:600;">{{ $rule->description }}</div>

                                    @if ($rule->pdfs)
                                    @foreach ($rule->pdfs as $index => $pdf)
                                    <div style="margin-top:5px; display:flex; justify-content:space-between;">
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

            <!-- STYLES -->
            <style>
                .accordion-content {
                    max-height: none !important;
                    overflow: visible !important;
                    transition: none;
                }

                #searchSuggestions div:hover {
                    background: #f1f1f1;
                }
            </style>

            <!-- SCRIPTS -->
            <script>
                const categories = JSON.parse('{!! addslashes(json_encode($categories)) !!}');

                function toggleAccordion(id) {
                    return;
                } // Disabled

                // SEARCH FUNCTION
                function searchNotes(query) {
                    let box = document.getElementById('searchSuggestions');
                    if (query.length < 3) {
                        box.style.display = 'none';
                        return;
                    }

                    fetch(`{{ route('frontend.search') }}?q=${encodeURIComponent(query)}`)
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
                    document.querySelectorAll('[id^="cat"]').forEach(el => el.style.maxHeight = "0");
                    document.querySelectorAll('[id^="sub"]').forEach(el => el.style.maxHeight = "0");
                    document.querySelectorAll('[id^="rule"]').forEach(el => el.style.display = "none");

                    let cat = document.getElementById('cat' + catId);
                    let sub = document.getElementById('sub' + subId);
                    let rule = document.getElementById('rule' + ruleId);

                    if (cat) cat.style.maxHeight = "none";
                    if (sub) sub.style.maxHeight = "none";
                    if (rule) rule.style.display = "block";

                    document.getElementById('searchSuggestions').style.display = 'none';
                }

                // CLOSE SEARCH ON OUTSIDE CLICK
                document.addEventListener('click', function(e) {
                    let box = document.getElementById('searchSuggestions');
                    let input = document.getElementById('noteSearch');
                    if (!box.contains(e.target) && e.target !== input) box.style.display = 'none';
                });

                // CASCADING DROPDOWNS
                const catSelect = document.getElementById('categoryFilter');
                const subSelect = document.getElementById('subcategoryFilter');
                const ruleSelect = document.getElementById('ruleFilter');

                function filterByCategory() {
                    let catId = catSelect.value;
                    subSelect.innerHTML = '<option value="">Select Subcategory</option>';
                    ruleSelect.innerHTML = '<option value="">Select Rule</option>';
                    document.querySelectorAll('[id^="rule"]').forEach(el => el.style.display = "none");

                    if (!catId) return;

                    let cat = categories.find(c => c.id == catId);
                    cat.subcategories.forEach(sub => {
                        let opt = document.createElement('option');
                        opt.value = sub.id;
                        opt.text = sub.name;
                        subSelect.appendChild(opt);
                    });

                    cat.subcategories.forEach(sub => {
                        sub.rules.forEach(rule => {
                            document.getElementById('rule' + rule.id).style.display = "block";
                        });
                    });
                }

                function filterBySubcategory() {
                    let subId = subSelect.value;
                    ruleSelect.innerHTML = '<option value="">Select Rule</option>';
                    document.querySelectorAll('[id^="rule"]').forEach(el => el.style.display = "none");

                    if (!subId) return;

                    categories.forEach(cat => {
                        let sub = cat.subcategories.find(s => s.id == subId);
                        if (sub) {
                            sub.rules.forEach(rule => {
                                let opt = document.createElement('option');
                                opt.value = rule.id;
                                opt.text = rule.description;
                                ruleSelect.appendChild(opt);
                                document.getElementById('rule' + rule.id).style.display = "block";
                            });
                        }
                    });
                }

                function filterByRule() {
                    let ruleId = ruleSelect.value;
                    document.querySelectorAll('[id^="rule"]').forEach(el => el.style.display = "none");
                    if (!ruleId) return;
                    let rule = document.getElementById('rule' + ruleId);
                    if (rule) rule.style.display = "block";
                }
            </script>

        </div>
    </div>
</div>
@endsection
<script>
    (function() {
        // ------------------- VARIABLES -------------------
        let categories = JSON.parse('@json($categories)'.replace(/&quot;/g, '"'));
        let searchInput = document.getElementById('noteSearch');
        let categorySelect = document.getElementById('categoryFilter');
        let subSelect = document.getElementById('subcategoryFilter');
        let ruleSelect = document.getElementById('ruleFilter');
        let suggestionsBox = document.getElementById('searchSuggestions');

        // ------------------- SEARCH FUNCTION -------------------
        searchInput.addEventListener('input', function() {
            let query = this.value.trim();
            if (query.length < 3) {
                suggestionsBox.style.display = 'none';
                filterRules();
                return;
            }

            fetch(`{{ route('frontend.search') }}?q=${encodeURIComponent(query)}`)
                .then(res => res.json())
                .then(data => {
                    if (!data.length) {
                        suggestionsBox.innerHTML = '<div style="padding:10px;">No results</div>';
                    } else {
                        suggestionsBox.innerHTML = data.map(item => `
                        <div style="padding:10px; cursor:pointer;" 
                             onclick="window.openSearch(${item.category_id}, ${item.subcategory_id}, ${item.note_id})">
                            ${item.title}
                        </div>
                    `).join('');
                    }
                    suggestionsBox.style.display = 'block';
                });
        });

        // ------------------- FILTER CASCADING -------------------
        categorySelect.addEventListener('change', function() {
            let catId = this.value;
            subSelect.innerHTML = '<option value="">Select Subcategory</option>';
            ruleSelect.innerHTML = '<option value="">Select Rule</option>';
            ruleSelect.disabled = true;

            if (!catId) {
                subSelect.disabled = true;
                filterRules();
                return;
            }

            let selectedCat = categories.find(c => c.id == catId);
            selectedCat.subcategories.forEach(sub => {
                let opt = document.createElement('option');
                opt.value = sub.id;
                opt.text = sub.name;
                subSelect.appendChild(opt);
            });

            subSelect.disabled = false;
            filterRules(catId);
        });

        subSelect.addEventListener('change', function() {
            let subId = this.value;
            ruleSelect.innerHTML = '<option value="">Select Rule</option>';

            if (!subId) {
                ruleSelect.disabled = true;
                filterRules(null, null);
                return;
            }

            let rules = [];
            categories.forEach(cat => {
                cat.subcategories.forEach(sub => {
                    if (sub.id == subId) rules = sub.rules;
                });
            });

            rules.forEach(rule => {
                let opt = document.createElement('option');
                opt.value = rule.id;
                opt.text = rule.description;
                ruleSelect.appendChild(opt);
            });

            ruleSelect.disabled = false;
            filterRules(null, subId);
        });

        ruleSelect.addEventListener('change', function() {
            let ruleId = this.value;
            filterRules(null, null, ruleId);
        });

        // ------------------- FILTER FUNCTION -------------------
        function filterRules(catId = null, subId = null, ruleId = null) {
            let query = searchInput.value.trim().toLowerCase();

            categories.forEach(cat => {
                let catDiv = document.getElementById('cat' + cat.id);
                let subVisible = false;

                cat.subcategories.forEach(sub => {
                    let subDiv = document.getElementById('sub' + sub.id);
                    let ruleVisible = false;

                    sub.rules.forEach(rule => {
                        let ruleDiv = document.getElementById('rule' + rule.id);
                        if (!ruleDiv) return;

                        let matchesQuery = !query || rule.description.toLowerCase().includes(query) ||
                            cat.name.toLowerCase().includes(query) ||
                            sub.name.toLowerCase().includes(query);
                        let matchesCat = !catId || cat.id == catId;
                        let matchesSub = !subId || sub.id == subId;
                        let matchesRule = !ruleId || rule.id == ruleId;

                        let visible = matchesQuery && matchesCat && matchesSub && matchesRule;
                        ruleDiv.style.display = visible ? 'block' : 'none';

                        if (visible) ruleVisible = true;
                    });

                    subDiv.style.display = ruleVisible ? 'block' : 'none';
                    if (ruleVisible) subVisible = true;
                });

                catDiv.style.display = subVisible ? 'block' : 'none';
            });
        }

        // ------------------- OPEN SEARCH FROM SUGGESTION -------------------
        window.openSearch = function(catId, subId, ruleId) {
            categorySelect.value = catId;
            categorySelect.dispatchEvent(new Event('change'));

            subSelect.value = subId;
            subSelect.dispatchEvent(new Event('change'));

            ruleSelect.value = ruleId;
            filterRules(catId, subId, ruleId);

            suggestionsBox.style.display = 'none';
        }

        // ------------------- CLOSE SUGGESTIONS ON OUTSIDE CLICK -------------------
        document.addEventListener('click', function(e) {
            if (!suggestionsBox.contains(e.target) && e.target !== searchInput) {
                suggestionsBox.style.display = 'none';
            }
        });
    })();
</script>
@endsection