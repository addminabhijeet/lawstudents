@extends('layouts.landing', ['title' => 'Free Notes'])

@section('content')

<style>
    .pdf-protected-viewer {
        position: relative;
        height: 600px;
        overflow: auto;
        background: #f4f6f9;
    }

    .pdf-protected-viewer {
        user-select: none;
    }

    #pdfContainer {
        user-select: none;
        -webkit-user-select: none;
    }

    #pdfCanvas {
        display: block;
        margin: auto;
    }

    #watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg);
        font-size: 38px;
        opacity: 0.15;
        pointer-events: none;
        white-space: nowrap;
        text-align: center;
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
                    <h1>Free Notes</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Free Notes</a>
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

                <!-- SEARCH -->
                <div style="max-width:600px; margin:0 auto 20px; position:relative;">
                    <input type="text" id="copySearch" class="form-control"
                        placeholder="Search Free Notes..." onkeyup="searchCopys(this.value)">

                    <div id="copySuggestions"
                        style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none; position:absolute; width:100%; background:#fff; z-index:999;">
                    </div>
                </div>

                @foreach ($categories as $category)
                <!-- CATEGORY -->
                <div style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">
                    <div onclick="toggleAccordion('copyCat{{ $category->id }}')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        {{ $category->name }}
                    </div>

                    <div id="copyCat{{ $category->id }}" class="accordion-content" style="max-height:1000px;">
                        @foreach ($category->subcategories as $sub)
                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">
                            <div onclick="toggleAccordion('copySub{{ $sub->id }}')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                {{ $sub->name }}
                            </div>

                            <div id="copySub{{ $sub->id }}" class="accordion-content" style="padding:10px; max-height:1000px;">
                                @foreach ($sub->copys as $copy)
                                <div data-copy-id="{{ $copy->id }}" style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">
                                    @foreach ($copy->pdfs as $index => $pdf)
                                    <div style="margin-top:5px; display:flex; justify-content:space-between; align-items:center;">
                                        <span style="font-size:12px;">PDF {{ $index + 1 }}</span>
                                        <div>
                                            @if(auth()->check())
                                            <a href="{{ route('frontend.viewnoteWatermarked', [$copy->id, $index]) }}" target="_blank" style="font-size:12px; color:green;">View PDF</a>
                                            <span style="margin:0 5px;">|</span>
                                            <a href="{{ route('frontend.viewnote', [$copy->id, $index]) }}" style="font-size:12px; color:blue;">Download</a>
                                            @else
                                            <a href="{{ route('google.login') }}" style="font-size:12px; color:green;">View PDF</a>
                                            @endif
                                        </div>
                                    </div>
                                    @endforeach
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
    .copy-highlight {
        border: 2px solid #28a745 !important;
        background: #e6ffe6;
    }

    .accordion-content {
        max-height: none !important;
        overflow: visible !important;
        transition: none;
    }

    #copySuggestions div:hover {
        background: #f1f1f1;
    }
</style>

<script>
    function toggleAccordion(id) {
        return; // Disabled toggle
    }

    function searchCopys(query) {
        let box = document.getElementById('copySuggestions');
        if (query.length < 3) {
            box.style.display = 'none';
            return;
        }

        fetch(`{{ route('frontend.copyssearch') }}?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    box.innerHTML = '<div style="padding:10px;">No results</div>';
                } else {
                    box.innerHTML = data.map(item => `
                        <div style="padding:10px; cursor:pointer;"
                             onclick="openCopySearch(${item.category_id}, ${item.subcategory_id}, ${item.copy_id})">
                            ${item.title}
                        </div>
                    `).join('');
                }
                box.style.display = 'block';
            });
    }

    function openCopySearch(catId, subId, copyId) {
        // Hide all categories
        document.querySelectorAll('[id^="copyCat"]').forEach(cat => {
            cat.parentElement.style.display = 'none';
            cat.querySelectorAll('.copy-highlight').forEach(c => c.classList.remove('copy-highlight'));
        });

        // Show only relevant category
        let catContainer = document.getElementById('copyCat' + catId)?.parentElement;
        if (catContainer) catContainer.style.display = 'block';

        // Show only relevant copy
        let sub = document.getElementById('copySub' + subId);
        if (sub) {
            sub.querySelectorAll('[data-copy-id]').forEach(c => c.style.display = 'none');

            let copyDiv = sub.querySelector(`div[data-copy-id='${copyId}']`);
            if (copyDiv) {
                copyDiv.style.display = 'block';
                copyDiv.classList.add('copy-highlight');
                copyDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            sub.style.display = 'block';
            sub.parentElement.style.display = 'block';
        }

        document.getElementById('copySuggestions').style.display = 'none';
    }

    document.addEventListener('click', function(e) {
        let box = document.getElementById('copySuggestions');
        let input = document.getElementById('copySearch');
        if (!box.contains(e.target) && e.target !== input) {
            box.style.display = 'none';
        }
    });
</script>

<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">
                <div id="pdfContainer" class="pdf-protected-viewer" style="position:relative;">

                    <div id="watermark">
                        Law Students
                    </div>

                    <canvas id="pdfCanvas"></canvas>

                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-secondary" onclick="prevPage()">Prev</button>
                        <span id="pageInfo"></span>
                        <button class="btn btn-sm btn-primary" onclick="nextPage()">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    let pdfDoc = null;
    let pageNum = 1;
    let totalPages = 0;
    let currentFileUrl = '';

    function openPDF(fileUrl, studentName, studentEmail) {
        currentFileUrl = fileUrl;
        pageNum = 1;

        let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
        modal.show();

        pdfjsLib.getDocument(fileUrl).promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderPage(pageNum, studentName, studentEmail);
        });
    }

    function renderPage(num, studentName, studentEmail) {
        pdfDoc.getPage(num).then(function(page) {
            let canvas = document.getElementById('pdfCanvas');
            let ctx = canvas.getContext('2d');
            let container = document.getElementById('pdfContainer');

            let viewport = page.getViewport({
                scale: 1
            });
            let scale = container.clientWidth / viewport.width;
            let scaledViewport = page.getViewport({
                scale: scale
            });

            canvas.height = scaledViewport.height;
            canvas.width = scaledViewport.width;

            page.render({
                canvasContext: ctx,
                viewport: scaledViewport
            }).promise.then(function() {
                // watermark
                let watermarkText = `${studentName} - ${studentEmail} - ${new Date().toLocaleString()}`;
                ctx.font = "28px Arial";
                ctx.fillStyle = "rgba(150,150,150,0.20)";
                ctx.textAlign = "center";
                ctx.save();
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.rotate(-Math.PI / 6);
                for (let y = -canvas.height; y < canvas.height; y += 200) {
                    ctx.fillText(watermarkText, 0, y);
                }
                ctx.restore();
            });
        });

        document.getElementById("pageInfo").innerText = "Page " + num + " / " + totalPages;
    }

    function nextPage() {
        if (pageNum < totalPages) pageNum++, renderPage(pageNum);
    }

    function prevPage() {
        if (pageNum > 1) pageNum--, renderPage(pageNum);
    }

    // clear canvas on modal close
    document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function() {
        let canvas = document.getElementById('pdfCanvas');
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    });
</script>
@endsection