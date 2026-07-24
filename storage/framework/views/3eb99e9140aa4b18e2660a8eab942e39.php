<?php echo $__env->make('layouts.partials.student.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <div class="main-content d-flex">

            <div class="content-area" data-scrollbar-target="#psScrollbarInit">
                <div class="content-area-body pb-0">
                    <?php if($notFound): ?>
                        <div class="alert alert-warning text-center">
                            <strong>Please Complete Your Payment to get Course</strong>
                        </div>
                    <?php endif; ?>

                    <?php if(!$notFound && $categories): ?>
                        <div class="row note-has-grid g-4" id="note-full-container">

                            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php $__currentLoopData = $category->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div
                                        class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category category-<?php echo e($category->id); ?>">

                                        <a href="<?php echo e(route('student.viewcourse', $course->id)); ?>"
                                            class="text-decoration-none text-dark">

                                            <div class="card h-100 shadow-sm stretch stretch-full">

                                                <!-- COURSE HEADER -->
                                                <div class="card-body d-flex flex-column">

                                                    <span class="side-stick"></span>

                                                    <div class="d-flex align-items-center mb-3">

                                                        <div class="bg-light rounded p-2 me-2">
                                                            📚
                                                        </div>

                                                        <h5 class="note-title text-truncate mb-0">
                                                            <?php echo e($course->title); ?>

                                                        </h5>

                                                    </div>

                                                    <p class="fs-11 text-muted note-date mb-2">
                                                        <?php echo e($course->created_at->format('d F Y')); ?>

                                                    </p>

                                                    <!-- DESCRIPTION -->
                                                    <div class="note-content flex-grow-1 mb-3">

                                                        <p class="text-muted note-inner-content text-truncate-3-line">
                                                            <?php echo e($course->description); ?>

                                                        </p>

                                                    </div>

                                                    <!-- COURSE META -->
                                                    <div
                                                        class="d-flex justify-content-between align-items-center mt-auto">

                                                        <span class="badge bg-light text-dark border">
                                                            <?php echo e($category->name); ?>

                                                        </span>

                                                        <span class="fw-bold text-success fs-5">
                                                            ₹<?php echo e($course->price); ?>

                                                        </span>

                                                    </div>

                                                </div>

                                                <!-- CARD FOOTER -->
                                                <div class="card-footer bg-white border-0 pt-0">

                                                    <div class="d-flex justify-content-between align-items-center">

                                                        <small class="text-muted">
                                                            View Course
                                                        </small>

                                                        <span class="badge bg-primary">
                                                            Open
                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                        </a>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>
<?php echo $__env->make('layouts.partials.student.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

<!--! ================================================================ !-->
<!--! [Start] Search Modal !-->
<!--! ================================================================ !-->
<div class="modal fade-scale" id="searchModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-lg modal-dialog-top modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header search-form py-0">
                <div class="input-group">
                    <span class="input-group-text">
                        <i class="feather-search fs-4 text-muted"></i>
                    </span>
                    <input type="text" class="form-control search-input-field" placeholder="Search...">
                    <span class="input-group-text">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </span>
                </div>
            </div>
            <div class="modal-body">
                <div class="searching-for mb-5">
                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">I'm searching for...</h4>
                    <div class="row g-1">
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <i class="feather-compass"></i>
                                <span>Recent</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <i class="feather-command"></i>
                                <span>Command</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <i class="feather-users"></i>
                                <span>Peoples</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <i class="feather-file"></i>
                                <span>Files</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <i class="feather-video"></i>
                                <span>Medias</span>
                            </a>
                        </div>
                        <div class="col-md-4 col-xl-2">
                            <a href="javascript:void(0);"
                                class="d-flex align-items-center gap-2 px-3 lh-lg border rounded-pill">
                                <span>More</span>
                                <i class="feather-chevron-down"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <div class="recent-result mb-5">
                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Recnet <span
                            class="badge small bg-gray-200 rounded ms-1 text-dark">3</span></h4>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-airplay fs-5"></i>
                            <div class="fs-13 fw-semibold">CRM dashboard redesign</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">/<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-file-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">Create new eocument</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">N /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-user-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">Invite project colleagues</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">P /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                </div>
                <div class="command-result mb-5">
                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Command <span
                            class="badge small bg-gray-200 rounded ms-1 text-dark">5</span></h4>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-user fs-5"></i>
                            <div class="fs-13 fw-semibold">My profile</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">P /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-users fs-5"></i>
                            <div class="fs-13 fw-semibold">Team profile</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">T /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-user-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">Invite colleagues</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">I /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-briefcase fs-5"></i>
                            <div class="fs-13 fw-semibold">Create new project</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">CP /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-life-buoy fs-5"></i>
                            <div class="fs-13 fw-semibold">Support center</div>
                        </a>
                        <a href="javascript:void(0);" class="badge border rounded text-dark">SC /<i
                                class="feather-command ms-1"></i></a>
                    </div>
                </div>
                <div class="file-result mb-4">
                    <h4 class="fs-13 fw-normal text-gray-600 mb-3">Files <span
                            class="badge small bg-gray-200 rounded ms-1 text-dark">3</span></h4>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-folder-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">CRM Desing Project <span
                                    class="fs-12 fw-normal text-muted">(56.74 MB)</span></div>
                        </a>
                        <a href="javascript:void(0);" class="file-download"><i class="feather-download"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-folder-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">Admin Dashboard Project <span
                                    class="fs-12 fw-normal text-muted">(46.83 MB)</span></div>
                        </a>
                        <a href="javascript:void(0);" class="file-download"><i class="feather-download"></i></a>
                    </div>
                    <div class="d-flex align-items-center justify-content-between">
                        <a href="javascript:void(0);" class="d-flex align-items-start gap-3">
                            <i class="feather-folder-plus fs-5"></i>
                            <div class="fs-13 fw-semibold">CRM Dashboard Project <span
                                    class="fs-12 fw-normal text-muted">(68.59 MB)</span></div>
                        </a>
                        <a href="javascript:void(0);" class="file-download"><i class="feather-download"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="position-fixed" style="right: 5px; bottom: 5px; z-index: 999999">
    <div id="toast" class="toast bg-black hide" data-bs-delay="3000" role="alert" aria-live="assertive"
        aria-atomic="true">
        <div
            class="toast-header px-3 bg-transparent d-flex align-items-center justify-content-between border-bottom border-light border-opacity-10">
            <div class="text-white mb-0 mr-auto">Downloading...</div>
            <a href="javascript:void(0)" class="ms-2 mb-1 close fw-normal" data-bs-dismiss="toast"
                aria-label="Close">
                <span class="text-white">&times;</span>
            </a>
        </div>
        <div class="toast-body p-3 text-white">
            <h6 class="fs-13 text-white">Project.zip</h6>
            <span class="text-light fs-11">4.2mb of 5.5mb</span>
        </div>
        <div class="toast-footer p-3 pt-0 border-top border-light border-opacity-10">
            <div class="progress mt-3" style="height: 5px">
                <div class="progress-bar progress-bar-striped progress-bar-animated w-75 bg-dark" role="progressbar"
                    aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
            </div>
        </div>
    </div>
</div>
<script src="<?php echo e(asset('assets/vendors/js/vendors.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/common-init.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/apps-notes-init.min.js')); ?>"></script>
<script src="<?php echo e(asset('assets/js/theme-customizer-init.min.js')); ?>"></script>
<script>
    function removeNote() {
        $(".remove-note")
            .off("click")
            .on("click", function(event) {
                event.stopPropagation();
                $(this).parents(".single-note-item").remove();
            });
    }

    function favouriteNote() {
        $(".favourite-note")
            .off("click")
            .on("click", function(event) {
                event.stopPropagation();
                $(this).parents(".single-note-item").toggleClass("note-favourite");
            });
    }

    function addLabelGroups() {
        $(".category-selector .badge-group-item")
            .off("click")
            .on("click", function(event) {
                event.preventDefault();
                /* Act on the event */
                var getclass = this.className;
                var getSplitclass = getclass.split(" ")[0];
                if ($(this).hasClass("badge-tasks")) {
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-works")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-social")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-archive")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-priority")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-personal")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-business")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-important");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                } else if ($(this).hasClass("badge-important")) {
                    $(this).parents(".single-note-item").removeClass("note-tasks");
                    $(this).parents(".single-note-item").removeClass("note-works");
                    $(this).parents(".single-note-item").removeClass("note-social");
                    $(this).parents(".single-note-item").removeClass("note-archive");
                    $(this).parents(".single-note-item").removeClass("note-priority");
                    $(this).parents(".single-note-item").removeClass("note-personal");
                    $(this).parents(".single-note-item").removeClass("note-business");
                    $(this).parents(".single-note-item").toggleClass(getSplitclass);
                }
            });
    }
    var $btns = $(".note-link").click(function() {

        if (this.id == "all-category") {
            $("#note-full-container> div").fadeIn();
        } else {
            $("#note-full-container> div").hide();
            $("#note-full-container> div." + this.id).fadeIn();
        }

        $btns.removeClass("active");
        $(this).addClass("active");
    });

    $("#add-notes").on("click", function(event) {
        $("#addnotesmodal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-n-add").show();
    });

    $("#add-category").on("click", function(event) {
        $("#addCategoryModal").modal("show");
        $("#btn-n-save").hide();
        $("#btn-n-add").show();
    });
    // Button add
    $("#btn-n-add").on("click", function(event) {
        event.preventDefault();
        /* Act on the event */
        var today = new Date();
        var dd = String(today.getDate()).padStart(2, "0");
        var mm = String(today.getMonth()); //January is 0!
        var yyyy = today.getFullYear();
        var monthNames = ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"];
        today = dd + " " + monthNames[mm] + " " + yyyy;

        var $_noteTitle = document.getElementById("note-has-title").value;
        var $_noteDescription = document.getElementById("note-has-description").value;

        $html =
            '<div class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category"><div class="card card-body mb-4 stretch stretch-full">' +
            '<span class="side-stick"></span>' +
            '<h5 class="note-title text-truncate w-75 mb-1" data-noteHeading="' + $_noteTitle + '">' +
            $_noteTitle + '<i class="point bi bi-circle-fill ms-1 fs-7"></i></h5>' +
            '<p class="fs-11 text-muted note-date">' + today + "</p>" +
            '<div class="note-content flex-grow-1">' +
            '<p class="text-muted note-inner-content text-truncate-3-line" data-noteContent="' +
            $_noteDescription + '">' + $_noteDescription + "</p>" + "</div>" +
            '<div class="d-flex align-items-center gap-1">' +
            '<span class="avatar-text avatar-sm"><i class="feather-star favourite-note"></i></span>' +
            '<span class="avatar-text avatar-sm"><i class="feather-trash-2 remove-note"></i></span>' +
            '<div class="ms-auto">' + '<div class="dropdown btn-group category-selector">' +
            '<a class="nav-link dropdown-toggle category-dropdown label-group p-0" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">' +
            '<div class="category">' + '<div class="category-tasks"></div>' +
            '<div class="category-works"></div>' + '<div class="category-works"></div>' +
            '<div class="category-social"></div>' + '<div class="category-archive"></div>' +
            '<div class="category-priority"></div>' + '<div class="category-personal"></div>' +
            '<div class="category-business"></div>' + '<div class="category-important"></div>' + "</div>" +
            "</a>" + '<div class="dropdown-menu dropdown-menu-right category-menu">' +
            '<a class="note-tasks badge-group-item badge-tasks dropdown-item position-relative category-tasks" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-danger rounded-circle fs-12 me-3"></i>Tasks </a>' +
            '<a class="note-works badge-group-item badge-works dropdown-item position-relative category-works" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-primary rounded-circle fs-12 me-3"></i>Works </a>' +
            '<a class="note-social badge-group-item badge-social dropdown-item position-relative category-social" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-info rounded-circle fs-12 me-3"></i>Social </a>' +
            '<a class="note-archive badge-group-item badge-archive dropdown-item position-relative category-archive" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-dark rounded-circle fs-12 me-3"></i>Archive </a>' +
            '<a class="note-archive badge-group-item badge-priority dropdown-item position-relative category-priority" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-danger rounded-circle fs-12 me-3"></i>Priority </a>' +
            '<a class="note-archive badge-group-item badge-personal dropdown-item position-relative category-personal" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-primary rounded-circle fs-12 me-3"></i>Personal </a>' +
            '<a class="note-business badge-group-item badge-business dropdown-item position-relative category-business" href="javascript:void(0);"> <i class="wd-5 ht-5 bg-warning rounded-circle me-3"></i>Business </a>' +
            '<a class="note-important badge-group-item badge-important dropdown-item position-relative category-important" href="javascript:void(0);"> <span class="wd-5 ht-5 bg-success rounded-circle me-3"></span>Important </a>' +
            "</div>" + "</div>" + "</div>" + "</div>" + "</div></div> ";

        $("#note-full-container").prepend($html);
        $("#addnotesmodal").modal("hide");

        removeNote();
        favouriteNote();
        addLabelGroups();
    });
    $("#addnotesmodal").on("hidden.bs.modal", function(event) {
        event.preventDefault();
        document.getElementById("note-has-title").value = "";
        document.getElementById("note-has-description").value = "";
    });
    removeNote();
    favouriteNote();
    addLabelGroups();
    $("#btn-n-add").attr("disabled", "disabled");

    $("#note-has-title").keyup(function() {
        var empty = false;
        $("#note-has-title").each(function() {
            if ($(this).val() == "") {
                empty = true;
            }
        });

        if (empty) {
            $("#btn-n-add").attr("disabled", "disabled");
        } else {
            $("#btn-n-add").removeAttr("disabled");
        }
    });
</script>

<script>
    const mainCheck = document.getElementById('mainCategoryCheck');
    const parentSelect = document.getElementById('parentCategorySelect');

    mainCheck.addEventListener('change', function() {
        if (this.checked) {
            parentSelect.value = ""; // set parent_id to null
            parentSelect.disabled = true; // disable select
        } else {
            parentSelect.disabled = false; // enable select
        }
    });
</script>
<?php /**PATH C:\xampp\htdocs\lawstudents\resources\views/coursestu/list.blade.php ENDPATH**/ ?>