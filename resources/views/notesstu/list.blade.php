@include('layouts.partials.student.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <div class="main-content d-flex">

            <!-- [ Sidebar ] -->
            <div class="content-sidebar content-sidebar-md" data-scrollbar-target="#psScrollbarInit">
                <div class="content-sidebar-body">
                    <ul class="nav d-flex flex-column nxl-content-sidebar-item">
                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link note-link active" id="all-category">
                                <i class="feather-heart"></i>
                                <span>Favourites</span>
                            </a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a href="javascript:void(0)" class="nav-link note-link"
                                    id="category-{{ $category->id }}">
                                    <i class="feather-folder"></i>
                                    <span>{{ $category->name }}</span>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- [ Main Area ] -->
            <div class="content-area" data-scrollbar-target="#psScrollbarInit">
                <div class="content-area-body pb-0">

                    <div class="row note-has-grid" id="note-full-container">

                        @foreach ($categories as $category)
                            @foreach ($category->courses as $course)
                                @php
                                    $wishlistedNotes = $course->notes->filter(function ($note) {
                                        return $note->wishlists->where('student_id', auth()->id())->count() > 0;
                                    });
                                @endphp

                                @foreach ($wishlistedNotes as $note)
                                    <div
                                        class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category category-{{ $category->id }}">
                                        <div class="card card-body mb-4 shadow-sm border-0 rounded-3 position-relative">

                                            <span class="side-stick"></span>

                                            <!-- Note Title -->
                                            <h5 class="note-title text-truncate w-75 mb-1 fw-bold">
                                                {{ $note->title }}
                                            </h5>

                                            <!-- Course and Date -->
                                            <p class="fs-11 text-muted mb-2">
                                                Course: <b>{{ $course->title }}</b> |
                                                {{ $note->created_at->format('d F Y') }}
                                            </p>

                                            <!-- Buttons -->
                                            <div class="d-flex gap-2 mt-2">
                                                @php
                                                    $token = Crypt::encrypt(
                                                        json_encode([
                                                            'note_id' => $note->id,
                                                            'ip' => request()->ip(),
                                                            'expires_at' => now()->addMinutes(5),
                                                        ]),
                                                    );
                                                @endphp

                                                <button class="btn btn-sm btn-outline-primary"
                                                    onclick="openPDF('{{ route('student.viewnote', $note->id) }}?token={{ $token }}','{{ $note->id }}')">
                                                    View
                                                </button>

                                            </div>

                                            <!-- Highlight Favourite Notes -->
                                            <div class="position-absolute top-0 end-0 p-2">
                                                <span class="badge bg-warning text-dark">Favourite</span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endforeach
                        @endforeach

                        @if ($categories->pluck('courses')->flatten()->pluck('notes')->flatten()->filter(fn($n) => $n->wishlists->where('student_id', auth()->id())->count() > 0)->isEmpty())
                            <p class="text-muted mt-4 fw-bold text-center">You have no favourite notes yet.</p>
                        @endif

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
                        {{ auth()->guard('student')->user()->name }}
                        <br>
                        {{ auth()->guard('student')->user()->email }}
                        <br>
                        {{ now()->format('d M Y H:i') }}
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
                    "{{ auth()->guard('student')->user()->name }} - {{ auth()->guard('student')->user()->email }}";

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
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
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
@include('layouts.partials.student.theme')

<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/apps-notes-init.min.js') }}"></script>
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>
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
