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
                    <li class="breadcrumb-item">Acts Categories</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addactcategory') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Categories Acts</span>
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
                                <table class="table table-hover" id="actsList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>File Name</th>
                                            <th>Button Name</th>
                                            <th>Date Uploaded</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse ($categories as $categorie)
                                            @php
                                                // Make sure $pdfs is always an array of arrays
                                                $pdfs = [];
                                                if (!empty($categorie->pdfs)) {
                                                    $pdfs[] = [
                                                        'file' => $categorie->pdfs,
                                                        'description' => $categorie->description,
                                                    ];
                                                }
                                            @endphp

                                            @if (!empty($pdfs))
                                                @foreach ($pdfs as $key => $item)
                                                    <tr class="single-item">
                                                        <td>
                                                            {{ $loop->iteration }}
                                                        </td>

                                                        <td>{{ pathinfo($item['file'], PATHINFO_FILENAME) }}</td>

                                                        <td>{{ $item['description'] ?? 'No description' }}</td>

                                                        <td>{{ \Carbon\Carbon::parse($categorie->created_at)->format('Y-m-d, h:i A') }}
                                                        </td>

                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="{{ route('admin.editacts', [$categorie->id]) }}"
                                                                    class="btn btn-sm btn-primary">Edit</a>

                                                                <a href="{{ asset('storage/app/public/' . $item['file']) }}"
                                                                    class="btn btn-sm btn-primary">View</a>

                                                                <form method="POST"
                                                                    action="{{ route('admin.actsfiledelete', [$categorie->id]) }}"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <input type="hidden" name="file"
                                                                        value="{{ $item['file'] }}">
                                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                                        onclick="return confirm('Delete this file?')">Delete</button>
                                                                </form>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @else
                                                <tr>
                                                    <td colspan="5" class="text-center">No Files Found</td>
                                                </tr>
                                            @endif
                                        @empty
                                            <tr>
                                                <td colspan="5" class="text-center">No actss Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
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
