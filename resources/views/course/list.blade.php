@include('layouts.partials.admin.dashboard')
<main class="nxl-container apps-container apps-notes">
    <div class="nxl-content without-header nxl-full-content">
        <!-- [ Main Content ] start -->
        <div class="main-content d-flex">
            <!-- [ Content Sidebar ] start -->
            <div class="content-sidebar content-sidebar-md" data-scrollbar-target="#psScrollbarInit">
                <div class="content-sidebar-header bg-white sticky-top hstack justify-content-between">
                    <h4 class="fw-bolder mb-0">Courses</h4>
                    <a href="javascript:void(0);" class="app-sidebar-close-trigger d-flex">
                        <i class="feather-x"></i>
                    </a>
                </div>
                <div class="content-sidebar-header">
                    <!-- Add Courses Button -->
                    <a href="" class="btn btn-primary w-100" 
                        style="display:block; margin-right: 30px;">
                        <i class="feather-plus me-2"></i>
                        <span>Free Courses</span>
                    </a>

                    <!-- Add Category Button -->
                    <a href="" class="btn btn-primary w-100" 
                        style="display:block;">
                        <i class="feather-plus me-2"></i>
                        <span>Paid Courses</span>
                    </a>

                </div>



                <div class="content-sidebar-body">
                    <ul class="nav d-flex flex-column nxl-content-sidebar-item">

                        <li class="nav-item">
                            <a href="javascript:void(0)" class="nav-link note-link active" id="all-category">
                                <i class="feather-layers"></i>
                                <span>All</span>
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
            <!-- [ Content Sidebar  ] end -->
            <!-- [ Main Area  ] start -->
            <div class="content-area" data-scrollbar-target="#psScrollbarInit">
                <div class="content-area-header sticky-top">
                    <div class="page-header-left d-flex align-items-center gap-2">
                        <a href="javascript:void(0);" class="app-sidebar-open-trigger me-2">
                            <i class="feather-align-left fs-20"></i>
                        </a>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="btn btn-light-brand dropdown-toggle"
                                data-bs-toggle="dropdown" data-bs-offset="0,18">Project Course</a>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li><a class="dropdown-item" href="javascript:void(0)">All Course</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Lead Course</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Client Course</a></li>
                                <li><a class="dropdown-item active" href="javascript:void(0)">Project Course</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Meeting Course</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Personal Course</a></li>
                                <li><a class="dropdown-item" href="javascript:void(0)">Customer Course</a></li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="avatar-text avatar-md" data-bs-toggle="dropdown"
                                data-bs-offset="0,22">
                                <i class="feather-eye"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-eye me-3"></i>
                                        <span>Read</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-eye-off me-3"></i>
                                        <span>Unread</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-star me-3"></i>
                                        <span>Starred</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-shield-off me-3"></i>
                                        <span>Unstarred</span>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-clock me-3"></i>
                                        <span>Snooze</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-check-circle me-3"></i>
                                        <span>Add Tasks</span>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-archive me-3"></i>
                                        <span>Archive</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-alert-octagon me-3"></i>
                                        <span>Report Spam</span>
                                    </a>
                                </li>
                                <li class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" href="javascript:void(0)">
                                        <i class="feather-trash-2 me-3"></i>
                                        <span>Delete</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="d-flex" data-bs-toggle="dropdown"
                                data-bs-offset="0,22" data-bs-auto-close="outside" aria-expanded="false">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Tags">
                                    <i class="feather-tag"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Office"
                                            checked="checked">
                                        <label class="custom-control-label c-pointer" for="Office">Office</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Family">
                                        <label class="custom-control-label c-pointer" for="Family">Family</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Friend"
                                            checked="checked">
                                        <label class="custom-control-label c-pointer" for="Friend">Friend</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Marketplace">
                                        <label class="custom-control-label c-pointer" for="Marketplace"> Marketplace
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Development">
                                        <label class="custom-control-label c-pointer" for="Development"> Development
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-plus me-3"></i>
                                    <span>Create Tag</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-tag me-3"></i>
                                    <span>Manages Tag</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="d-flex" data-bs-toggle="dropdown"
                                data-bs-offset="0,22" data-bs-auto-close="outside" aria-expanded="false">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Labels">
                                    <i class="feather-folder-plus"></i>
                                </div>
                            </a>
                            <div class="dropdown-menu">
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Updates">
                                        <label class="custom-control-label c-pointer" for="Updates">Updates</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Socials">
                                        <label class="custom-control-label c-pointer" for="Socials">Socials</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Primary"
                                            checked="checked">
                                        <label class="custom-control-label c-pointer" for="Primary">Primary</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Forums">
                                        <label class="custom-control-label c-pointer" for="Forums">Forums</label>
                                    </div>
                                </div>
                                <div class="dropdown-item">
                                    <div class="custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" id="Promotions"
                                            checked="checked">
                                        <label class="custom-control-label c-pointer" for="Promotions"> Promotions
                                        </label>
                                    </div>
                                </div>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-plus me-3"></i>
                                    <span>Create Label</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-folder-plus me-3"></i>
                                    <span>Manages Label</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="page-header-right ms-auto">
                        <div class="hstack gap-2">
                            <div class="hstack">
                                <a href="javascript:void(0)" class="search-form-open-toggle">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" title="Search">
                                        <i class="feather feather-search"></i>
                                    </div>
                                </a>
                                <form class="search-form" style="display: none">
                                    <div class="search-form-inner">
                                        <a href="javascript:void(0)" class="search-form-close-toggle">
                                            <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                                data-bs-trigger="hover" title="Search Close">
                                                <i class="feather feather-arrow-left"></i>
                                            </div>
                                        </a>
                                        <input type="search" class="py-3 px-0 border-0 w-100" id="notesSearch"
                                            placeholder="Search...">
                                    </div>
                                </form>
                            </div>
                            <a href="javascript:void(0)" class="d-none d-sm-flex">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Newest">
                                    <i class="feather feather-chevron-left"></i>
                                </div>
                            </a>
                            <a href="javascript:void(0)" class="d-none d-sm-flex">
                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip" data-bs-trigger="hover"
                                    title="Oldest">
                                    <i class="feather feather-chevron-right"></i>
                                </div>
                            </a>
                            <div class="dropdown d-none d-sm-flex">
                                <a href="javascript:void(0)"
                                    class="btn btn-light-brand btn-sm rounded-pill dropdown-toggle"
                                    data-bs-toggle="dropdown" data-bs-offset="0,23">Newest</a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="javascript:void(0)">Title</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Priority</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Category</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Time & Date</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item active" href="javascript:void(0)">Newest</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Oldest</a></li>
                                    <li class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Ascending</a></li>
                                    <li><a class="dropdown-item" href="javascript:void(0)">Descending</a></li>
                                </ul>
                            </div>
                            <div class="dropdown d-none d-sm-flex">
                                <a href="javascript:void(0)" class="d-flex" data-bs-toggle="dropdown"
                                    data-bs-offset="0,22" data-bs-auto-close="outside">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                        data-bs-trigger="hover" title="More Options">
                                        <i class="feather feather-more-vertical"></i>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-plus me-3"></i>
                                        <span>Add to Group</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-user-plus me-3"></i>
                                        <span>Add to Contact</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-eye-off me-3"></i>
                                        <span>Make as Unread</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-sliders me-3"></i>
                                        <span>Filter Messages</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-archive me-3"></i>
                                        <span>Make as Archive</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-slash me-3"></i>
                                        <span>Report Spam</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-sliders me-3"></i>
                                        <span>Report phishing</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-download me-3"></i>
                                        <span>Download Messages</span>
                                    </a>
                                    <div class="dropdown-divider"></div>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-bell-off me-3"></i>
                                        <span>Mute Conversion</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-slash me-3"></i>
                                        <span>Block Conversion</span>
                                    </a>
                                    <a href="javascript:void(0);" class="dropdown-item">
                                        <i class="feather feather-trash-2 me-3"></i>
                                        <span>Delete Conversion</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content-area-body pb-0">
                    <div class="row note-has-grid" id="note-full-container">
                        @foreach ($categories as $category)
                            @foreach ($category->courses as $course)
                                <div
                                    class="col-xxl-4 col-xl-6 col-lg-4 col-sm-6 single-note-item all-category category-{{ $category->id }}">
                                    <div class="card card-body mb-4 stretch stretch-full">
                                        <span class="side-stick"></span>

                                        <h5 class="note-title text-truncate w-75 mb-1">
                                            {{ $course->title }}
                                        </h5>

                                        <p class="fs-11 text-muted note-date">
                                            {{ $course->created_at->format('d F Y') }}
                                        </p>

                                        <div class="note-content flex-grow-1">
                                            <p class="text-muted note-inner-content text-truncate-3-line">
                                                {{ $course->description }}
                                            </p>
                                        </div>

                                        <div class="d-flex align-items-center gap-2">
                                            <span class="badge bg-primary text-truncate w-75 mb-1">
                                                {{ $category->name }}
                                            </span>

                                            <span class="fw-bold text-success">
                                                ₹{{ $course->price }}
                                            </span>
                                        </div>


                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')


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
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
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
<script src="{{ asset('assets/vendors/js/vendors.min.js') }}"></script>
<script src="{{ asset('assets/js/common-init.min.js') }}"></script>
<script src="{{ asset('assets/js/apps-notes-init.min.js') }}"></script>
<script src="{{ asset('assets/js/theme-customizer-init.min.js') }}"></script>

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
