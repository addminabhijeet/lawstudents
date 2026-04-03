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
                    <li class="breadcrumb-item">Rules</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addrules') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Rules</span>
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
                                <table class="table table-hover" id="rulesList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Category Name</th>
                                            <th>Subcategory Name</th>
                                            <th>File Name</th>
                                            <th>Button Name / Description</th>
                                            <th>Date Uploaded</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($subcategories as $index => $subcategory)
                                        @php
                                        $pdfs = json_decode($subcategory->pdfs, true) ?? [];
                                        @endphp

                                        @forelse ($pdfs as $file)
                                        <tr>
                                            <td>{{ $subcategories->firstItem() + $index }}</td>
                                            <td>{{ $subcategory->category->name ?? 'N/A' }}</td>
                                            <td>{{ $subcategory->name }}</td>
                                            <td>{{ pathinfo($file, PATHINFO_BASENAME) }}</td>
                                            <td>{{ $subcategory->description ?? 'No description' }}</td>
                                            <td>{{ $subcategory->created_at->format('Y-m-d, h:i A') }}</td>
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('admin.editrulessubcategory', $subcategory->id) }}" class="btn btn-sm btn-primary">Edit</a>

                                                    <a href="{{ asset('storage/' . $file) }}" target="_blank" class="btn btn-sm btn-primary">View</a>

                                                    <form method="POST" action="{{ route('admin.rulessubcategoryfiledelete', $subcategory->id) }}" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="file" value="{{ $file }}">
                                                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Delete this file?')">Delete</button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No files found for {{ $subcategory->name }}</td>
                                        </tr>
                                        @endforelse
                                        @empty
                                        <tr>
                                            <td colspan="7" class="text-center">No subcategories found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>
                                </table>

                                {{-- Pagination --}}
                                <div class="mt-3">
                                    {{ $subcategories->links() }}
                                </div>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $ruless->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $ruless->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($ruless->getUrlRange(1, $ruless->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $ruless->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$ruless->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $ruless->nextPageUrl() }}"
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