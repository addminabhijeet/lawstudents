@include('layouts.partials.admin.dashboard')

<main class="nxl-container">
    <!-- main contents -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header d-flex justify-content-between align-items-center">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb ms-3">
                    <li class="breadcrumb-item">Categories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>

            <div class="page-header-right ms-auto d-flex align-items-center gap-2">
                <a href="javascript:void(0);" class="btn btn-primary" id="add-category">
                    <i class="feather-plus me-2"></i> Add Category
                </a>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h6 class="mb-0">Categories</h6>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $allCategories = [];
                                            function flattenCategories($cats, $depth = 0, &$result = []) {
                                                foreach ($cats as $cat) {
                                                    $result[] = ['category' => $cat, 'depth' => $depth];
                                                    if ($cat->children->count() > 0) {
                                                        flattenCategories($cat->children, $depth + 1, $result);
                                                    }
                                                }
                                                return $result;
                                            }
                                            $flatCategories = flattenCategories($categories);
                                        @endphp

                                        @forelse ($flatCategories as $item)
                                        @php $category = $item['category']; $depth = $item['depth']; @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <span style="margin-left: {{ $depth * 20 }}px; display: inline-block;">
                                                    @if($depth > 0)
                                                        <i class="feather-corner-down-right text-muted" style="font-size: 12px;"></i>
                                                    @endif
                                                    @if($category->children->count() > 0)
                                                        <i class="feather-folder text-warning"></i>
                                                    @else
                                                        <i class="feather-layers text-info"></i>
                                                    @endif
                                                    {{ $category->name }}
                                                    @if($category->parent_id)
                                                        <small class="text-muted">(Depth: {{ $depth }})</small>
                                                    @else
                                                        <span class="badge bg-success">Main</span>
                                                    @endif
                                                </span>
                                            </td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-light edit-category"
                                                        data-id="{{ $category->id }}">
                                                        <i class="feather-edit"></i>
                                                    </a>
                                                    <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-category"
                                                        data-id="{{ $category->id }}">
                                                        <i class="feather-trash-2"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="3" class="text-center">No Categories Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->previousPageUrl() }}" aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                            <li class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$categories->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->nextPageUrl() }}" aria-label="Next">
                                                    <span aria-hidden="true">&raquo;</span>
                                                    <span class="visually-hidden">Next</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>
@include('layouts.partials.admin.theme')
<div class="modal fade" id="addnotesmodal" tabindex="-1" data-bs-keyboard="false" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Add Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="notes-box">
                    <div class="notes-content">
                        <form action="{{ route('admin.storecourse') }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <!-- Category -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Title -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Course Title</label>
                                    <input type="text" name="title" class="form-control" minlength="5"
                                        placeholder="Enter Course Title" required>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Course Description</label>
                                    <textarea name="description" class="form-control" minlength="10" rows="4"
                                        placeholder="Enter Course Description"></textarea>
                                </div>

                                <!-- Duration -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Duration (in Months)</label>
                                    <input type="number" name="duration" class="form-control"
                                        placeholder="Enter Course Duration in Months">
                                </div>

                                <!-- Discount -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control"
                                        placeholder="Enter Discount Amount">
                                </div>

                                <!-- Brochure PDF -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Upload Brochure (PDF)</label>
                                    <input type="file" name="brochure" class="form-control"
                                        accept="application/pdf">
                                </div>

                                <!-- Price -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        placeholder="Enter Course Price">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Add Course</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Body -->
        </div>
    </div>
</div>

<div class="modal fade" id="deleteCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title text-danger">Delete Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="deleteCategoryForm" method="POST">
                @csrf
                @method('DELETE')

                <div class="modal-body text-center">
                    <h6>Are you sure you want to delete this category?</h6>
                    <p class="text-muted">This action cannot be undone.</p>
                </div>

                <div class="modal-footer justify-content-center">
                    <button type="submit" class="btn btn-danger">
                        Yes, Delete
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="modal fade" id="editCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form id="editCategoryForm" method="POST">
                @csrf

                <input type="hidden" name="id" id="edit_category_id">

                <div class="modal-body">

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" id="edit_category_name" class="form-control" required>
                    </div>

                    <!-- Parent Category - Supports Unlimited Nesting -->
                    <div class="mb-3">
                        <label class="form-label">Parent Category <span class="badge bg-info">Optional</span></label>
                        <select name="parent_id" id="edit_parent_id" class="form-control">
                            <option value="">-- No Parent (Main Category) --</option>

                            @php
                                function renderEditCategoryOptions($cats, $depth = 0, $excludeId = null) {
                                    foreach ($cats as $cat) {
                                        if ($cat->id != $excludeId) {
                                            $indent = str_repeat('─ ', $depth);
                                            echo '<option value="' . $cat->id . '">' . $indent . $cat->name . '</option>';
                                            if ($cat->children->count() > 0) {
                                                renderEditCategoryOptions($cat->children, $depth + 1, $excludeId);
                                            }
                                        }
                                    }
                                }
                                renderEditCategoryOptions($categories);
                            @endphp
                        </select>
                        <small class="text-muted d-block mt-2">Select a parent to create unlimited nested levels. Leave empty for top-level categories.</small>
                    </div>

                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Update Category
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="editnotesmodal" tabindex="-1" data-bs-keyboard="false" role="dialog">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered" role="document">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header">
                <h5 class="modal-title" id="modalTitleId">Edit Course</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <div class="notes-box">
                    <div class="notes-content">
                        <form id="editCourseForm" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="row">
                                <input type="hidden" name="id" id="edit_course_id">
                                <!-- Category -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Select Category</label>
                                    <select name="category_id" class="form-control" required>
                                        <option value="">-- Select Category --</option>
                                        @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Title -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Course Title</label>
                                    <input type="text" name="title" class="form-control" minlength="5"
                                        placeholder="Enter Course Title" required>
                                </div>

                                <!-- Description -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Course Description</label>
                                    <textarea name="description" class="form-control" minlength="10" rows="4"
                                        placeholder="Enter Course Description"></textarea>
                                </div>

                                <!-- Duration -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Duration (in Months)</label>
                                    <input type="number" name="duration" class="form-control"
                                        placeholder="Enter Course Duration in Months">
                                </div>

                                <!-- Discount -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Discount</label>
                                    <input type="number" step="0.01" name="discount" class="form-control"
                                        placeholder="Enter Discount Amount">
                                </div>

                                <!-- Brochure PDF -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Upload Brochure (PDF)</label>
                                    <input type="file" name="brochure" class="form-control"
                                        accept="application/pdf">
                                    <div id="existingBrochure" class="mb-2"></div>
                                </div>

                                <!-- Price -->
                                <div class="col-md-12 mb-3">
                                    <label class="form-label">Price</label>
                                    <input type="number" step="0.01" name="price" class="form-control"
                                        placeholder="Enter Course Price">
                                </div>
                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer">
                                <button type="submit" class="btn btn-success">Update Course</button>
                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-- End Modal Body -->
        </div>
    </div>
</div>

<!--! ================================================================ !-->
<!--! END: Modal Add Notes !-->
<!--! ================================================================ !-->

<div class="modal fade" id="addCategoryModal" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <form action="{{ route('admin.storecategory') }}" method="POST">
                @csrf

                <div class="modal-body">

                    <!-- Category Name -->
                    <div class="mb-3">
                        <label class="form-label">Category Name</label>
                        <input type="text" name="name" class="form-control" placeholder="Enter Category Name"
                            required>
                    </div>

                    <!-- Parent Category - Supports Unlimited Nesting -->
                    <div class="mb-3">
                        <label class="form-label">Parent Category <span class="badge bg-info">Optional</span></label>
                        <select name="parent_id" class="form-control" id="parentCategorySelect">
                            <option value="">-- No Parent (Main Category) --</option>
                            @php
                                function renderAddCategoryOptions($cats, $depth = 0) {
                                    foreach ($cats as $cat) {
                                        $indent = str_repeat('─ ', $depth);
                                        echo '<option value="' . $cat->id . '">' . $indent . $cat->name . '</option>';
                                        if ($cat->children->count() > 0) {
                                            renderAddCategoryOptions($cat->children, $depth + 1);
                                        }
                                    }
                                }
                                renderAddCategoryOptions($categories);
                            @endphp
                        </select>
                        <small class="text-muted d-block mt-2">Select a parent to create unlimited nested levels. Leave empty for top-level categories.</small>
                    </div>
                </div>

                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">
                        Add Category
                    </button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

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

<script>
    $(document).on("click", ".edit-course", function(e) {
        e.preventDefault();

        let id = $(this).data("id");

        $.ajax({
            url: "/admin/course-edit/" + id,
            type: "GET",
            success: function(data) {

                let modal = $("#editnotesmodal");

                // Set values safely
                modal.find("input[name='id']").val(data.id);
                modal.find("select[name='category_id']").val(data.category_id);
                modal.find("input[name='title']").val(data.title);
                modal.find("textarea[name='description']").val(data.description);
                modal.find("input[name='duration']").val(data.duration);
                modal.find("input[name='discount']").val(data.discount);
                modal.find("input[name='price']").val(data.price);

                // Set form action
                $("#editCourseForm").attr("action", "/admin/course-update/" + data.id);

                // Show existing brochure
                if (data.brochure) {
                    $("#existingBrochure").html(`
                    <a href="/storage/${data.brochure}" target="_blank" class="text-primary">
                        View Current Brochure
                    </a>
                `);
                } else {
                    $("#existingBrochure").html(
                        `<span class="text-muted">No brochure uploaded</span>`);
                }

                // Reset file input
                modal.find("input[name='brochure']").val("");

                // Show modal
                modal.modal("show");
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
            }
        });
    });
</script>

<script>
    $(document).on("click", ".edit-category", function() {

        let id = $(this).data("id");

        $.ajax({
            url: "/admin/category-edit/" + id,
            type: "GET",
            success: function(data) {

                $("#edit_category_id").val(data.id);
                $("#edit_category_name").val(data.name);
                $("#edit_parent_id").val(data.parent_id);

                // Set form action
                $("#editCategoryForm").attr("action", "/admin/category-update/" + data.id);

                // Handle main category checkbox
                if (!data.parent_id) {
                    $("#editMainCategoryCheck").prop("checked", true);
                    $("#edit_parent_id").prop("disabled", true);
                } else {
                    $("#editMainCategoryCheck").prop("checked", false);
                    $("#edit_parent_id").prop("disabled", false);
                }

                $("#editCategoryModal").modal("show");
            }
        });

    });

    // Parent category selection logic for edit form
    $(document).on("click", ".edit-category", function() {
        // When edit modal loads, properly set parent_id
        setTimeout(function() {
            const parentSelect = $("#edit_parent_id");
            const currentParentId = parentSelect.val();

            // Remove the current category from parent options to prevent selecting itself
            const currentCategoryId = $("#edit_category_id").val();
            parentSelect.find('option').prop('disabled', false);

            // Disable the current category and its children from being selected as parent
            parentSelect.find('option[value="' + currentCategoryId + '"]').prop('disabled', true);
        }, 100);
    });
</script>

<script>
    $(document).on("click", ".delete-category", function() {

        let id = $(this).data("id");

        // Set form action dynamically
        $("#deleteCategoryForm").attr("action", "/admin/category-delete/" + id);

        // Show modal
        $("#deleteCategoryModal").modal("show");
    });
</script>