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
                    <a href="javascript:void(0);" class="btn btn-primary w-100" id="add-notes"
                        style="display:block; margin-right: 30px;">
                        <i class="feather-plus me-2"></i>
                        <span>Add Courses</span>
                    </a>

                    <!-- Add Category Button -->
                    <a href="javascript:void(0);" class="btn btn-primary w-100" id="add-category"
                        style="display:block;">
                        <i class="feather-plus me-2"></i>
                        <span>Add Category</span>
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
            <div class="content-area-body pb-0">
                <div class="row note-has-grid">
                    <form action="{{ route('admin.updateclientele', $clientele->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label>Description</label>
                            <textarea name="description" class="form-control" rows="3">{{ $clientele->description }}</textarea>
                        </div>

                        <h5>Existing PDFs</h5>
                        @if (!empty($clientele->pdfs))
                            @foreach ($clientele->pdfs as $index => $pdf)
                                <div class="mb-2">
                                    <a href="{{ asset('storage/' . $pdf['file']) }}"
                                        target="_blank">{{ pathinfo($pdf['file'], PATHINFO_FILENAME) }}</a>
                                    <input type="text" name="pdf_descriptions[{{ $index }}]"
                                        class="form-control mt-1" value="{{ $pdf['description'] ?? '' }}"
                                        placeholder="Description">

                                    <form method="POST"
                                        action="{{ route('admin.clientelefiledelete', $clientele->id) }}"
                                        class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <input type="hidden" name="file" value="{{ $pdf['file'] }}">
                                        <button type="submit" class="btn btn-sm btn-danger mt-1">Delete</button>
                                    </form>
                                </div>
                            @endforeach
                        @endif

                        <h5>Add New PDFs</h5>
                        <div id="newPdfsContainer">
                            <div class="mb-2">
                                <input type="file" name="pdfs[]" class="form-control">
                                <input type="text" name="pdf_descriptions[]" class="form-control mt-1"
                                    placeholder="Description">
                            </div>
                        </div>

                        <button type="button" id="addPdfBtn" class="btn btn-sm btn-secondary mb-3">Add Another
                            PDF</button>

                        <button type="submit" class="btn btn-primary">Update Clientele</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')
