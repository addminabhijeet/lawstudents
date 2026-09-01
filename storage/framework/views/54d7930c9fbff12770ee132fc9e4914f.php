<?php echo $__env->make('layouts.partials.student.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

                    <!-- COURSE HEADER -->
                    <div class="card mb-4 bg-light">
                        <div class="card-body">

                            <h2 class="fw-bold"><?php echo e($course->title); ?></h2>

                            <p class="text-muted mb-2">
                                <?php echo e($course->description); ?>

                            </p>

                            <div class="d-flex flex-wrap gap-3">

                                <span class="badge bg-primary">
                                    <?php echo e($course->category->name); ?>

                                </span>

                                <span class="text-muted">
                                    Level : <?php echo e($course->level); ?>

                                </span>

                                <span class="text-muted">
                                    Duration : <?php echo e($course->duration); ?>

                                </span>

                                <span class="fw-bold text-success">
                                    ₹<?php echo e($course->price); ?>

                                </span>

                            </div>

                        </div>
                    </div>


                    <div class="row">

                        <!-- LEFT CONTENT -->
                        <div class="col-lg-8">

                            <!-- COURSE DESCRIPTION -->
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h5 class="mb-0">Course Description</h5>
                                </div>

                                <div class="card-body">
                                    <p><?php echo e($course->description); ?></p>
                                </div>
                            </div>


                            <!-- COURSE MATERIALS -->
                            <div class="card">

                                <div class="card-header d-flex justify-content-between">
                                    <h5 class="mb-0">Course Materials</h5>

                                    <span class="badge bg-secondary">
                                        <?php echo e($course->notes->count()); ?> Notes
                                    </span>
                                </div>

                                <div class="card-body">

                                    <?php $__empty_1 = true; $__currentLoopData = $course->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div
                                        class="d-flex justify-content-between align-items-center border-bottom py-3">

                                        <div class="d-flex align-items-center gap-3">

                                            <div
                                                class="icon-md bg-light rounded d-flex align-items-center justify-content-center">
                                                📄
                                            </div>

                                            <div>
                                                <h6 class="mb-1">
                                                    <?php echo e($note->title); ?>

                                                </h6>

                                                <small class="text-muted">
                                                    <?php echo e($note->formatted_size); ?>

                                                    |
                                                    <?php echo e($note->page_count); ?> pages
                                                </small>
                                            </div>

                                        </div>

                                        <div class="d-flex gap-2">

                                            <?php
                                            $token = Crypt::encrypt(
                                            json_encode([
                                            'note_id' => $note->id,
                                            'ip' => request()->ip(),
                                            'expires_at' => now()->addMinutes(5),
                                            ]),
                                            );
                                            ?>

                                            <?php
                                            $isWishlisted = \App\Models\NoteWishlist::where(
                                            'student_id',
                                            auth()->id(),
                                            )
                                            ->where('note_id', $note->id)
                                            ->exists();
                                            ?>

                                            <button
                                                class="btn btn-sm <?php echo e($isWishlisted ? 'btn-danger' : 'btn-outline-danger'); ?> wishlist-btn"
                                                data-note="<?php echo e($note->id); ?>">
                                                ❤
                                            </button>

                                            <button class="btn btn-sm btn-outline-primary"
                                                onclick="openPDF(`<?php echo e(route('student.viewnote', $note->id)); ?>?token=<?php echo e($token); ?>`, `<?php echo e($note->id); ?>`)">
                                                View
                                            </button>

                                            <?php if($note->is_downloadable): ?>
                                            <a href="<?php echo e(route('student.downloadnote', $note->id)); ?>"
                                                class="btn btn-sm btn-success">
                                                Download
                                            </a>
                                            <?php endif; ?>

                                        </div>

                                    </div>

                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>

                                    <p class="text-muted">No materials available.</p>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>


                        <!-- RIGHT SIDEBAR -->
                        <div class="col-lg-4">

                            <div class="card sticky-top" style="top:100px">

                                <div class="card-body">

                                    <h5 class="fw-bold mb-3">
                                        Course Details
                                    </h5>

                                    <ul class="list-unstyled mb-4">

                                        <li class="mb-2">
                                            <b>Price :</b>
                                            ₹<?php echo e($course->price); ?>

                                        </li>

                                        <li class="mb-2">
                                            <b>Level :</b>
                                            <?php echo e($course->level); ?>

                                        </li>

                                        <li class="mb-2">
                                            <b>Duration :</b>
                                            <?php echo e($course->duration); ?>

                                        </li>

                                        <li class="mb-2">
                                            <b>Total Notes :</b>
                                            <?php echo e($course->notes->count()); ?>

                                        </li>

                                        <li class="mb-2">
                                            <b>Instructor :</b>
                                            <?php echo e($course->instructor_id); ?>

                                        </li>

                                    </ul>

                                    <?php
                                    $progress = \App\Models\NoteProgress::where('student_id', auth()->id())
                                    ->where('course_id', $course->id)
                                    ->avg('progress_percent');

                                    $progressValue = round($progress ?? 0);
                                    ?>

                                    <?php if($progress): ?>
                                    <div class="progress mb-2">
                                        <div class="progress-bar bg-success progress-bar-dynamic"
                                            data-width="<?php echo e($progressValue); ?>">
                                            <?php echo e($progressValue); ?>%
                                        </div>
                                    </div>
                                    <?php else: ?>
                                    <button class="btn btn-primary w-100 mb-2">
                                        Start Course
                                    </button>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>


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

                    <div id="watermark">
                        <?php echo e(auth()->guard('student')->user()->name); ?>

                        <br>
                        <?php echo e(auth()->guard('student')->user()->email); ?>

                        <br>
                        <?php echo e(now()->format('d M Y H:i')); ?>

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

    function openPDF(url, noteId) {

        window.currentNoteId = noteId;

        pageNum = 1;

        let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
        modal.show();

        pdfjsLib.getDocument(url).promise.then(function(pdf) {

            pdfDoc = pdf;
            totalPages = pdf.numPages;

            renderPage(pageNum);
        });
    }

    function renderPage(num) {
        pdfDoc.getPage(num).then(function(page) {

            let canvas = document.getElementById('pdfCanvas');
            let ctx = canvas.getContext('2d');

            let container = document.getElementById('pdfContainer');

            // get original viewport
            let viewport = page.getViewport({
                scale: 1
            });

            // calculate scale to fit container width
            let scale = container.clientWidth / viewport.width;

            let scaledViewport = page.getViewport({
                scale: scale
            });

            canvas.height = scaledViewport.height;
            canvas.width = scaledViewport.width;

            let renderContext = {
                canvasContext: ctx,
                viewport: scaledViewport
            };

            page.render(renderContext).promise.then(function() {

                let watermarkText =
                    "<?php echo e(auth()->guard('student')->user()->name); ?> - <?php echo e(auth()->guard('student')->user()->email); ?>";

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

            fetch("/student/save-progress", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                },
                body: JSON.stringify({
                    note_id: window.currentNoteId,
                    page: pageNum,
                    total_pages: totalPages
                })
            });
        });
        document.getElementById("pageInfo").innerText =
            "Page " + num + " / " + totalPages;
    }

    document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function() {
        document.getElementById('pdfCanvas').getContext('2d').clearRect(0, 0, 9999, 9999);
    });
</script>

<script>
    document.querySelectorAll('.wishlist-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            let noteId = this.dataset.note;

            fetch("<?php echo e(route('student.wishlist')); ?>", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
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
<?php echo $__env->make('layouts.partials.student.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/coursestu/view.blade.php ENDPATH**/ ?>