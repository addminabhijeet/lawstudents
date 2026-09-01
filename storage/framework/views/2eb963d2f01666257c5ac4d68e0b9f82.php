<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

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

                        <?php if($courses->isEmpty()): ?>
                        <div class="col-12">
                            <div class="alert alert-warning text-center">
                                No any course enrolled by student
                            </div>
                        </div>
                        <?php else: ?>

                        <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                        $progress = $progressData[$course->id] ?? 0;
                        $progressValue = round($progress);
                        ?>

                        <div class="col-lg-6 mb-4">

                            <div class="card h-100 shadow-sm">

                                <!-- HEADER -->
                                <div class="card-body bg-light">
                                    <h4 class="fw-bold"><?php echo e($course->title); ?></h4>

                                    <p class="text-muted">
                                        <?php echo e($course->description); ?>

                                    </p>

                                    <div class="d-flex gap-2 flex-wrap">
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

                                <!-- BODY -->
                                <div class="card-body">

                                    <h6>Course Materials</h6>

                                    <span class="badge bg-secondary mb-2">
                                        <?php echo e($course->notes->count()); ?> Notes
                                    </span>

                                    <hr>

                                    <?php $__empty_1 = true; $__currentLoopData = $course->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="d-flex justify-content-between border-bottom py-2">
                                        <div>
                                            <b><?php echo e($note->title); ?></b><br>
                                            <small class="text-muted">
                                                <?php echo e($note->formatted_size); ?> | <?php echo e($note->page_count); ?> pages
                                            </small>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <p class="text-muted">No materials available.</p>
                                    <?php endif; ?>

                                </div>

                                <!-- FOOTER / PROGRESS -->
                                <div class="card-body border-top">

                                    <h6>Progress</h6>

                                    <?php if(!isset($progressData[$course->id])): ?>
                                    <!-- NOT PURCHASED -->
                                    <button class="btn btn-danger w-100">
                                        Course Still not purchased by student
                                    </button>

                                    <?php elseif($progressValue > 0): ?>
                                    <!-- IN PROGRESS -->
                                    <div class="progress">
                                        <div class="progress-bar bg-success progress-bar-dynamic"
                                            data-width="<?php echo e($progressValue); ?>">
                                            <?php echo e($progressValue); ?>%
                                        </div>
                                    </div>

                                    <?php else: ?>
                                    <!-- PURCHASED BUT NOT STARTED -->
                                    <button class="btn btn-primary w-100">
                                        Course Still Not Started by Student
                                    </button>
                                    <?php endif; ?>

                                </div>

                            </div>

                        </div>

                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
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
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/student/viewactivity.blade.php ENDPATH**/ ?>