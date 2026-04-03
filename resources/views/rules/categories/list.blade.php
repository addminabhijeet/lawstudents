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
                    <li class="breadcrumb-item">Rules Categories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addrulescategory') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Rules Categories</span>
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
                                <table class="table table-hover" id="rulesCategoriesList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Category Name</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $index => $categorie)
                                        <tr>
                                            {{-- Correct numbering with pagination --}}
                                            <td>{{ $categories->firstItem() + $index }}</td>
                                            <td>{{ $categorie->name }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('admin.editrulescategory', $categorie->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                    <form action="{{ route('admin.deleterulescategory', $categorie->id) }}" method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger"
                                                            onclick="return confirm('Are you sure you want to delete this category?')">
                                                            Delete
                                                        </button>
                                                    </form>
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

                                {{-- Pagination links --}}
                                <div class="mt-3">
                                    {{ $categories->links() }}
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $categories->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($categories->getUrlRange(1, $categories->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $categories->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$categories->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $categories->nextPageUrl() }}"
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