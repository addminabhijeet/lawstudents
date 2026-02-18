@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Payment</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Payment</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <div class="d-flex d-md-none">
                        <a href="javascript:void(0)" class="page-header-right-close-toggle">
                            <i class="feather-arrow-left me-2"></i>
                            <span>Back</span>
                        </a>
                    </div>
                    <div class="d-flex align-items-center gap-2 page-header-right-items-wrapper">
                        <a href="javascript:void(0);" class="btn btn-icon btn-light-brand" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne">
                            <i class="feather-bar-chart"></i>
                        </a>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-filter"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-eye me-3"></i>
                                    <span>All</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-send me-3"></i>
                                    <span>Sent</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-book-open me-3"></i>
                                    <span>Open</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-archive me-3"></i>
                                    <span>Draft</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-bell me-3"></i>
                                    <span>Revised</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-shield-off me-3"></i>
                                    <span>Declined</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-check me-3"></i>
                                    <span>Accepted</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-briefcase me-3"></i>
                                    <span>Leads</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-wifi-off me-3"></i>
                                    <span>Expired</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="feather-users me-3"></i>
                                    <span>Customers</span>
                                </a>
                            </div>
                        </div>
                        <div class="dropdown">
                            <a class="btn btn-icon btn-light-brand" data-bs-toggle="dropdown" data-bs-offset="0, 10"
                                data-bs-auto-close="outside">
                                <i class="feather-paperclip"></i>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end">
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-pdf me-3"></i>
                                    <span>PDF</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-csv me-3"></i>
                                    <span>CSV</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-xml me-3"></i>
                                    <span>XML</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-txt me-3"></i>
                                    <span>Text</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-filetype-exe me-3"></i>
                                    <span>Excel</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="javascript:void(0);" class="dropdown-item">
                                    <i class="bi bi-printer me-3"></i>
                                    <span>Print</span>
                                </a>
                            </div>
                        </div>
                        <a href="{{ route('admin.addadmission') }}" class="btn btn-primary">
                            <i class="feather-plus me-2"></i>
                            <span>Add Admission</span>
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
        <div id="collapseOne" class="accordion-collapse collapse page-header-collapse">
            <div class="accordion-body pb-2">
                <div class="row">
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Paid</span>
                                        <span class="fs-20 fw-bold d-block">78/100</span>
                                    </a>
                                    <div class="badge bg-soft-success text-success">
                                        <i class="feather-arrow-up fs-10 me-1"></i>
                                        <span>36.85%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Unpaid</span>
                                        <span class="fs-20 fw-bold d-block">38/50</span>
                                    </a>
                                    <div class="badge bg-soft-danger text-danger">
                                        <i class="feather-arrow-down fs-10 me-1"></i>
                                        <span>23.45%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Overdue</span>
                                        <span class="fs-20 fw-bold d-block">15/30</span>
                                    </a>
                                    <div class="badge bg-soft-success text-success">
                                        <i class="feather-arrow-up fs-10 me-1"></i>
                                        <span>25.44%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-3 col-md-6">
                        <div class="card stretch stretch-full">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between">
                                    <a href="javascript:void(0);" class="fw-bold d-block">
                                        <span class="d-block">Draft</span>
                                        <span class="fs-20 fw-bold d-block">3/10</span>
                                    </a>
                                    <div class="badge bg-soft-danger text-danger">
                                        <i class="feather-arrow-down fs-10 me-1"></i>
                                        <span>12.68%</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
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
                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="btn-group mb-1">
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input"
                                                            id="checkAllPayment">
                                                        <label class="custom-control-label"
                                                            for="checkAllPayment"></label>
                                                    </div>
                                                </div>
                                            </th>
                                            <th>Invoice</th>
                                            <th>Client</th>
                                            <th>Amount</th>
                                            <th>Date</th>
                                            <th>Transaction</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($admissions as $key => $admission)
                                            <tr class="single-item">
                                                <td>
                                                    <div class="item-checkbox ms-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox"
                                                                class="custom-control-input checkbox"
                                                                id="checkBox_{{ $key }}">
                                                            <label class="custom-control-label"
                                                                for="checkBox_{{ $key }}"></label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a href="{{ route('admin.addadmission', $admission->id) }}"
                                                        class="fw-bold">
                                                        #ADM{{ $admission->id }}
                                                    </a>
                                                </td>

                                                <td>
                                                    <div>
                                                        <span
                                                            class="text-truncate-1-line">{{ $admission->full_name }}</span>
                                                        <small class="fs-12 fw-normal text-muted">
                                                            {{ $admission->email ?? '-' }}
                                                        </small>
                                                    </div>
                                                </td>

                                                <td class="fw-bold text-dark">
                                                    {{ $admission->course_name }}
                                                </td>

                                                <td>
                                                    {{ \Carbon\Carbon::parse($admission->created_at)->format('Y-m-d h:iA') }}
                                                </td>

                                                <td>#TXN{{ $admission->id }}</td>

                                                <td>
                                                    <div class="badge bg-soft-success text-success">
                                                        Active
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
                                                            method="POST">
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
    @include('layouts.partials.admin.footer')
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
