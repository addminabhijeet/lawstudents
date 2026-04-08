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

                <!-- SEARCH -->
                <div style="max-width:600px; margin:0 auto 20px; position:relative;">
                    <input type="text" id="actSearch" class="form-control"
                        placeholder="Search Acts..." onkeyup="searchActs(this.value)">

                    <div id="actSuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none; position:absolute; width:100%; background:#fff; z-index:999;">
                    </div>
                </div>

                @foreach ($categories as $category)
                <!-- CATEGORY -->
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">

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