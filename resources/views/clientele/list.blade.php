@include('layouts.partials.admin.dashboard')

<main class="nxl-container">
    <div class="nxl-content">

        <!-- Header -->
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

            <div class="page-header-right ms-auto">
                <div class="d-flex align-items-center gap-2">
                    <a href="{{ route('admin.addclientele') }}" class="btn btn-primary">
                        <i class="feather-plus me-2"></i>
                        <span>Add Student</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="main-content">

            {{-- Alerts (Same as ID Card Page) --}}
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
                                                        <td>{{ $loop->iteration }}</td>

                                                        <!-- File Name -->
                                                        <td>
                                                            <a class="hstack gap-3">
                                                                <div>
                                                                    <span class="text-truncate-1-line">
                                                                        {{ pathinfo($item['file'], PATHINFO_FILENAME) }}
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </td>

                                                        <!-- Description -->
                                                        <td>
                                                            <small class="fs-12 fw-normal text-muted">
                                                                {{ $item['description'] ?? 'No description' }}
                                                            </small>
                                                        </td>

                                                        <!-- Date -->
                                                        <td>
                                                            {{ \Carbon\Carbon::parse($clientele->created_at)->format('Y-m-d, h:i A') }}
                                                        </td>

                                                        <!-- Actions -->
                                                        <td>
                                                            <div class="hstack gap-2 justify-content-end">

                                                                <!-- Edit -->
                                                                <a href="{{ route('admin.editclientele', [$clientele->id]) }}"
                                                                    class="avatar-text avatar-md"
                                                                    title="Edit">
                                                                    <i class="feather feather-edit"></i>
                                                                </a>

                                                                <!-- View -->
                                                                <a href="{{ asset('storage/app/public/' . $item['file']) }}"
                                                                    target="_blank"
                                                                    class="avatar-text avatar-md"
                                                                    title="View File">
                                                                    <i class="feather feather-eye"></i>
                                                                </a>

                                                                <!-- Delete -->
                                                                <form method="POST"
                                                                    action="{{ route('admin.clientelefiledelete', [$clientele->id]) }}"
                                                                    class="d-inline">
                                                                    @csrf
                                                                    @method('DELETE')

                                                                    <input type="hidden" name="file"
                                                                        value="{{ $item['file'] }}">

                                                                    <button type="submit"
                                                                        class="avatar-text avatar-md text-danger"
                                                                        title="Delete"
                                                                        onclick="return confirm('Delete this file?')">
                                                                        <i class="feather feather-trash-2"></i>
                                                                    </button>
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

                                <!-- Pagination (Same Style) -->
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">

                                            <!-- Previous -->
                                            <li class="page-item {{ $clienteles->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $clienteles->previousPageUrl() }}">
                                                    &laquo;
                                                </a>
                                            </li>

                                            <!-- Pages -->
                                            @foreach ($clienteles->getUrlRange(1, $clienteles->lastPage()) as $page => $url)
                                                <li class="page-item {{ $clienteles->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next -->
                                            <li class="page-item {{ !$clienteles->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $clienteles->nextPageUrl() }}">
                                                    &raquo;
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
</main>

@include('layouts.partials.admin.theme')