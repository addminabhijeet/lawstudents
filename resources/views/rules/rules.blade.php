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

                <div style="max-width:600px; margin:0 auto 20px; position:relative;">
                    <input type="text" id="noteSearch" class="form-control"
                        placeholder="Search Rules..." onkeyup="searchNotes(this.value)">

                    <div id="searchSuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none; position:absolute; width:100%; background:#fff; z-index:999;">
                    </div>
                </div>

                @foreach ($categories as $category)
                <!-- CATEGORY -->
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

                    <div onclick="toggleAccordion('cat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
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
                function toggleAccordion(id) { return; }

                function searchNotes(query) {
                    let box = document.getElementById('searchSuggestions');
                    if (query.length < 1) {
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
                    document.querySelectorAll('[id^="cat"]').forEach(cat => {
                        cat.parentElement.style.display = 'none';
                        cat.querySelectorAll('.rule-highlight').forEach(r => r.classList.remove('rule-highlight'));
                    });

                    let catContainer = document.getElementById('cat' + catId)?.parentElement;
                    if (catContainer) catContainer.style.display = 'block';

                    let sub = document.getElementById('sub' + subId);
                    if (sub) {
                        sub.querySelectorAll('[data-rule-id]').forEach(r => r.style.display = 'none');

                        let ruleDiv = sub.querySelector(`div[data-rule-id='${ruleId}']`);
                        if (ruleDiv) {
                            ruleDiv.style.display = 'block';
                            ruleDiv.classList.add('rule-highlight');
                            ruleDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }

                        sub.style.display = 'block';
                        sub.parentElement.style.display = 'block';
                    }

                    document.getElementById('searchSuggestions').style.display = 'none';
                }

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