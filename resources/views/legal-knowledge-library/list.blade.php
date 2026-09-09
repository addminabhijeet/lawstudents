@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Legal Knowledge</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addlegalknowledgelibrary') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Legal Knowledge</span>
                        </a>
                    </div>
                </div>
                <div class="d-md-none d-flex align-items-center">
                    <a href="javascript:void(0)" class="page-header-right-open-toggle">
                        <i class="feather-align-right fs-20"></i>
                    </a>
                </div>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Category</th>
                                            <th>Subcategory</th>
                                            <th>Description</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @forelse ($notes as $note)
                                        <tr>
                                            <!-- Serial -->
                                            <td>{{ $loop->iteration }}</td>

                                            <!-- Category -->
                                            <td>{{ $note->category?->name }}</td>

                                            <!-- Subcategory -->
                                            <td>{{ $note->subcategory?->name }}</td>

                                            <!-- Description -->
                                            <td>{{ $note->description }}</td>

                                            <!-- Actions -->
                                            <td>
                                                <div class="d-flex flex-column gap-2">

                                                    <!-- Edit -->
                                                    <a href="{{ route('admin.editlegalknowledgelibrary', $note->id) }}"
                                                        class="btn btn-sm btn-primary w-100">
                                                        Edit
                                                    </a>

                                                    <!-- Delete Whole Entry -->
                                                    <form method="POST"
                                                        action="{{ route('admin.legalknowledgelibraryfiledelete', $note->id) }}">
                                                        @csrf

                                                        <button class="btn btn-sm btn-danger w-100"
                                                            onclick="return confirm('Delete this entry and all PDFs?')">
                                                            Delete
                                                        </button>
                                                    </form>

                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="5" class="text-center">No Legal Knowledge Entry Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $notes->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $notes->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($notes->getUrlRange(1, $notes->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $notes->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$notes->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $notes->nextPageUrl() }}"
                                                    aria-label="Next">
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
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
