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
                    <li class="breadcrumb-item">Client</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
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
                                <table class="table table-hover" id="clienteleList">
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
                                        @forelse ($clienteles as $clientele)
                                            @php
                                                // Make sure $pdfs is always an array of arrays
                                                $pdfs = [];
                                                if (!empty($clientele->pdfs)) {
                                                    $pdfs[] = [
                                                        'file' => $clientele->pdfs,
                                                        'description' => $clientele->description,
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

                                                        <td>{{ \Carbon\Carbon::parse($clientele->created_at)->format('Y-m-d, h:i A') }}
                                                        </td>

                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">
                                                                <a href="{{ route('admin.editclientele', [$clientele->id]) }}"
                                                                    class="btn btn-sm btn-primary">Edit</a>

                                                                <a href="{{ asset('storage/app/public/' . $item['file']) }}"
                                                                    class="btn btn-sm btn-primary">View</a>

                                                                <form method="POST"
                                                                    action="{{ route('admin.clientelefiledelete', [$clientele->id]) }}"
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
                                                <td colspan="5" class="text-center">No Client Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $clienteles->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $clienteles->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($clienteles->getUrlRange(1, $clienteles->lastPage()) as $page => $url)
                                                <li
                                                    class="page-item {{ $clienteles->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$clienteles->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $clienteles->nextPageUrl() }}"
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
