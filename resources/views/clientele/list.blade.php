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
                    <li class="breadcrumb-item">Clientele</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">

                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="{{ route('admin.addclientele') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Student</span>
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
                                                <td colspan="5" class="text-center">No Clienteles Found</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
