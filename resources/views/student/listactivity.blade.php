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
                    <li class="breadcrumb-item">Student Activity</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
        </div>

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
                        <div class="card-body p-0">

                            <div class="table-responsive">

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
                                            <td colspan="8" class="text-center text-muted">No Admissions found.
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
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')