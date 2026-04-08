@include('layouts.partials.admin.dashboard')

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

<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <div class="main-content">
            <div class="content-area">
                <div class="content-area-body pb-0">

                    <div class="row">

                        @foreach($courses as $course)
                        @php
                        $progress = $progressData[$course->id] ?? 0;
                        $progressValue = round($progress);
                        @endphp

                        <div class="col-lg-6 mb-4">

                            <div class="card h-100 shadow-sm">

                                <!-- HEADER -->
                                <div class="card-body bg-light">
                                    <h4 class="fw-bold">{{ $course->title }}</h4>

                                    <p class="text-muted">
                                        {{ $course->description }}
                                    </p>

                                    <div class="d-flex gap-2 flex-wrap">
                                        <span class="badge bg-primary">
                                            {{ $course->category->name }}
                                        </span>

                                        <span class="text-muted">
                                            Level : {{ $course->level }}
                                        </span>

                                        <span class="text-muted">
                                            Duration : {{ $course->duration }}
                                        </span>

                                        <span class="fw-bold text-success">
                                            ₹{{ $course->price }}
                                        </span>
                                    </div>
                                </div>

                                <!-- BODY -->
                                <div class="card-body">

                                    <h6>Course Materials</h6>

                                    <span class="badge bg-secondary mb-2">
                                        {{ $course->notes->count() }} Notes
                                    </span>

                                    <hr>

                                    @forelse($course->notes as $note)
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <div>
                                            <b>{{ $note->title }}</b><br>
                                            <small class="text-muted">
                                                {{ $note->formatted_size }} | {{ $note->page_count }} pages
                                            </small>
                                        </div>
                                    </div>
                                    @empty
                                    <p class="text-muted">No materials available.</p>
                                    @endforelse

                                </div>

                                <!-- FOOTER / PROGRESS -->
                                <div class="card-body border-top">

                                    <h6>Progress</h6>

                                    @if ($progressValue > 0)
                                    <div class="progress">
                                        <div class="progress-bar bg-success progress-bar-dynamic"
                                            data-width="{{ $progressValue }}">
                                            {{ $progressValue }}%
                                        </div>
                                    </div>
                                    @else
                                    <button class="btn btn-primary w-100">
                                        Course Still Not Start by Student
                                    </button>
                                    @endif

                                </div>

                            </div>

                        </div>

                        @endforeach

                    </div>

                </div>
            </div>
        </div>
    </div>
</main>
<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">

                <div id="pdfContainer" class="pdf-protected-viewer">

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
    document.querySelectorAll('.wishlist-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let noteId = this.dataset.note;

            fetch("{{ route('student.wishlist') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    body: JSON.stringify({
                        note_id: noteId
                    })
                })
                .then(res => res.json().catch(() => ({
                    status: "error",
                    message: "Invalid JSON response"
                })))
                .then(data => {
                    if (data.status === "added") {
                        btn.classList.remove("btn-outline-danger");
                        btn.classList.add("btn-danger");
                    } else if (data.status === "removed") {
                        btn.classList.remove("btn-danger");
                        btn.classList.add("btn-outline-danger");
                    }
                })
                .catch(() => {
                    alert("Error adding to wishlist. Check console for details.");
                });
        });
    });
</script>
<script>
    document.addEventListener("contextmenu", e => e.preventDefault());

    document.addEventListener("keydown", function(e) {

        if (e.ctrlKey && (e.key === "s" || e.key === "p" || e.key === "u")) {
            e.preventDefault();
        }

    });
    document.addEventListener("keydown", function(e) {

        if (e.key === "F12") {
            e.preventDefault();
        }

    });
    document.addEventListener("keydown", function(e) {

        if (
            e.key === "PrintScreen" ||
            (e.ctrlKey && e.shiftKey && e.key === "S") ||
            (e.metaKey && e.shiftKey && e.key === "S")
        ) {
            e.preventDefault();
            alert("Screenshot disabled for protected content.");
        }

    });
    setInterval(function() {

        const threshold = 160;

        if (
            window.outerWidth - window.innerWidth > threshold ||
            window.outerHeight - window.innerHeight > threshold
        ) {

            document.body.innerHTML =
                "<h2 style='text-align:center;margin-top:200px'>Developer tools blocked</h2>";

        }

    }, 1000);

    document.getElementById("pdfCanvas").addEventListener("dragstart", function(e) {
        e.preventDefault();
    });
    document.getElementById("pdfContainer").addEventListener("contextmenu", function(e) {
        e.preventDefault();
    });

    function nextPage() {
        if (pageNum < totalPages) {
            pageNum++;
            renderPage(pageNum);
        }
    }

    function prevPage() {
        if (pageNum > 1) {
            pageNum--;
            renderPage(pageNum);
        }
    }
</script>
@include('layouts.partials.admin.theme')