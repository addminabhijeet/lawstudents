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
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">List Admissions</li>
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
                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">#</th>
                                            <th>Adm. no.</th>
                                            <th>Email</th>
                                            <th>Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $key => $admission)
                                            <tr class="single-item">
                                                <td>
                                                    {{ $loop->iteration }}
                                                </td>

                                                <td>
                                                    <div class="fw-bold">
                                                        {{ $admission->admno }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div>
                                                        <small class="fs-12 fw-normal text-muted">
                                                            {{ $admission->email ?? '-' }}
                                                        </small>
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-dark">
                                                    {{ $admission->full_name }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($admission->created_at)->format('Y-m-d h:iA') }}
                                                </td>

                                                <td>
                                                    <div class="badge bg-soft-success text-success">
                                                        {{ $admission->admission_status }}
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">

                                                        <a href="{{ route('admin.showadmission', $admission->id) }}"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-eye"></i>
                                                        </a>

                                                        <a href="{{ route('admin.editadmission', $admission->id) }}"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-edit"></i>
                                                        </a>

                                                        <form
                                                            action="{{ route('admin.destroyadmission', $admission->id) }}"
                                                            method="POST"
                                                            onsubmit="return confirm('Are you sure you want to delete this admission?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button
                                                                class="avatar-text avatar-md border-0 bg-transparent">
                                                                <i class="feather feather-trash-2 text-danger"></i>
                                                            </button>
                                                        </form>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                        @if ($admissions->isEmpty())
                                            <tr>
                                                <td colspan="8" class="text-center text-muted">No admissions
                                                    admissions
                                                    found.
                                                </td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $admissions->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $admissions->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($admissions->getUrlRange(1, $admissions->lastPage()) as $page => $url)
                                                <li
                                                    class="page-item {{ $admissions->currentPage() == $page ? 'active' : '' }}">
                                                    <a class="page-link"
                                                        href="{{ $url }}">{{ $page }}</a>
                                                </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$admissions->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $admissions->nextPageUrl() }}"
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
<div class="offcanvas offcanvas-end" tabindex="-1" id="paymentSent">
    <div class="offcanvas-header ht-80 px-4 border-bottom border-gray-5">
        <div>
            <h2 class="fs-16 fw-bold text-truncate-1-line">Sent Payment</h2>
            <small class="fs-12 text-muted">Sent payment to your client's</small>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div
        class="py-3 px-4 d-flex justify-content-between align-items-center border-bottom border-bottom-dashed border-gray-5 bg-gray-100">
        <div>
            <span class="fw-bold text-dark">Date:</span>
            <span class="fs-11 fw-medium text-muted">25 MAY, 2023</span>
        </div>
        <div>
            <span class="fw-bold text-dark">Payment No:</span>
            <span class="fs-12 fw-bold text-primary c-pointer">#NXL369852</span>
        </div>
    </div>
    <div class="offcanvas-body">
        <div class="form-group mb-4">
            <label class="form-label">From: <span class="text-danger">*</span></label>
            <input type="email" class="form-control" value="wrapcode.info@gmail.com" placeholder="Clients..."
                readonly="" required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">To: <span class="text-danger">*</span></label>
            <input class="form-control" name="tomailcontent" value="wrapcode.info@gmail.com" placeholder="To..."
                required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">Subject: <span class="text-danger">*</span></label>
            <input type="text" class="form-control" placeholder="Subject..." required>
        </div>
        <div class="form-group mb-4">
            <label class="form-label">URL: </label>
            <input type="url" class="form-control" placeholder="URL...">
        </div>
        <div class="form-group">
            <label class="form-label">Messages:</label>
            <div data-editor-target="editor" class="ht-200"></div>
        </div>
    </div>
    <div class="px-4 gap-2 d-flex align-items-center ht-80 border border-end-0 border-gray-2">
        <a href="javascript:void(0);" class="btn btn-primary w-50" data-alert-target="alertMessage">Sent Payment</a>
        <a href="javascript:void(0);" class="btn btn-danger w-50" data-bs-dismiss="offcanvas">Cancel</a>
    </div>
</div>
@include('layouts.partials.admin.theme')
