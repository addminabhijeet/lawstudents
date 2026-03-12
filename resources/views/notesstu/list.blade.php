@include('layouts.partials.student.dashboard')
<main class="container-fluid py-4">
    <div class="row">

        <!-- Sidebar -->
        <div class="col-md-3 mb-4">
            <ul class="nav flex-column nav-pills">
                <li class="nav-item mb-2">
                    <a class="nav-link active" href="javascript:void(0)">
                        <i class="bi bi-heart-fill me-2"></i> Favourites
                    </a>
                </li>
                @foreach ($categories as $category)
                    <li class="nav-item mb-1">
                        <a class="nav-link" href="javascript:void(0)" id="category-{{ $category->id }}">
                            <i class="bi bi-folder-fill me-2"></i> {{ $category->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>

        <!-- Notes Grid -->
        <div class="col-md-9">
            <div class="row g-3" id="note-full-container">

                @foreach ($categories as $category)
                    @foreach ($category->courses as $course)
                        @php
                            $wishlistedNotes = $course->notes->filter(function ($note) {
                                return $note->wishlists->where('student_id', auth()->id())->count() > 0;
                            });
                        @endphp

                        @foreach ($wishlistedNotes as $note)
                            <div class="col-xl-4 col-lg-6 col-md-6">
                                <div class="card h-100 border-1 shadow-sm">

                                    <div class="card-body d-flex flex-column">

                                        <!-- Title -->
                                        <h5 class="card-title text-truncate fw-bold">{{ $note->title }}</h5>

                                        <!-- Course & Date -->
                                        <p class="text-muted small mb-2">
                                            Course: <strong>{{ $course->title }}</strong> |
                                            {{ $note->created_at->format('d M Y') }}
                                        </p>

                                        <!-- Badge & Size -->
                                        <div class="mb-3 d-flex justify-content-between align-items-center">
                                            <span class="badge bg-primary">{{ $category->name }}</span>
                                            <span class="text-success fw-bold">{{ $note->formatted_size }}</span>
                                        </div>

                                        <!-- Buttons -->
                                        <div class="mt-auto d-flex gap-2 flex-wrap">
                                            @php
                                                $token = Crypt::encrypt(
                                                    json_encode([
                                                        'note_id' => $note->id,
                                                        'ip' => request()->ip(),
                                                        'expires_at' => now()->addMinutes(5),
                                                    ]),
                                                );
                                            @endphp

                                            <button class="btn btn-sm btn-outline-primary flex-grow-1"
                                                onclick="openPDF('{{ route('student.viewnote', $note->id) }}?token={{ $token }}','{{ $note->id }}')">
                                                View
                                            </button>

                                            @if ($note->is_downloadable)
                                                <a href="{{ route('student.downloadnote', $note->id) }}"
                                                    class="btn btn-sm btn-success flex-grow-1">
                                                    Download
                                                </a>
                                            @endif

                                            @php
                                                $isWishlisted = \App\Models\NoteWishlist::where(
                                                    'student_id',
                                                    auth()->id(),
                                                )
                                                    ->where('note_id', $note->id)
                                                    ->exists();
                                            @endphp

                                            <button
                                                class="btn btn-sm {{ $isWishlisted ? 'btn-danger' : 'btn-outline-danger' }} flex-grow-1 wishlist-btn"
                                                data-note="{{ $note->id }}">
                                                ❤
                                            </button>
                                        </div>

                                    </div>

                                    <!-- Favourite Badge -->
                                    <div class="position-absolute top-0 end-0 m-2">
                                        <span class="badge bg-warning text-dark">Favourite</span>
                                    </div>

                                </div>
                            </div>
                        @endforeach
                    @endforeach
                @endforeach

                @if ($categories->pluck('courses')->flatten()->pluck('notes')->flatten()->filter(fn($n) => $n->wishlists->where('student_id', auth()->id())->count() > 0)->isEmpty())
                    <div class="col-12 text-center mt-4">
                        <p class="text-muted fw-bold">You have no favourite notes yet.</p>
                    </div>
                @endif

            </div>
        </div>

    </div>
</main>
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
