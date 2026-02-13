@include('layouts.partials.admin.dashboard')
<!-- [ page-header ] start -->
<div class="page-header">
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
                <a href="invoice-create.html" class="btn btn-primary">
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
                                                <label class="custom-control-label" for="checkAllPayment"></label>
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
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_1">
                                                <label class="custom-control-label" for="checkBox_1"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#321456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/1.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Alexandra Della</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">alex.della@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$249.99 USD</td>
                                    <td>2023-04-25, 03:42PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_2">
                                                <label class="custom-control-label" for="checkBox_2"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#987456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md bg-warning text-white">N</div>
                                            <div>
                                                <span class="text-truncate-1-line">Nancy Elliot</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">nancy.elliot@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$120.50 USD</td>
                                    <td>2023-05-20, 12:23PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-warning text-warning">Unpaid</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_3">
                                                <label class="custom-control-label" for="checkBox_3"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#741258</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/2.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Green Cute</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">green.cute@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$300.00 USD</td>
                                    <td>2023-01-02, 10:36AM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_4">
                                                <label class="custom-control-label" for="checkBox_4"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#321456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md bg-teal text-white">H</div>
                                            <div>
                                                <span class="text-truncate-1-line">Henry Leach</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">henry.leach@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$249.99 USD</td>
                                    <td>2023-04-25, 04:22PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_5">
                                                <label class="custom-control-label" for="checkBox_5"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#357895</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/3.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Marianne Audrey</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">marine.adrey@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$150.00 USD</td>
                                    <td>2023-02-15, 05:23PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_6">
                                                <label class="custom-control-label" for="checkBox_6"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#321456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/1.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Alexandra Della</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">alex.della@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$249.99 USD</td>
                                    <td>2023-04-25, 11:43AM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_7">
                                                <label class="custom-control-label" for="checkBox_7"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#987456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md bg-warning text-white">N</div>
                                            <div>
                                                <span class="text-truncate-1-line">Nancy Elliot</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">nancy.elliot@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$120.50 USD</td>
                                    <td>2023-05-20, 03:46PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-warning text-warning">warning</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_8">
                                                <label class="custom-control-label" for="checkBox_8"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#741258</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/2.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Green Cute</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">green.cute@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$300.00 USD</td>
                                    <td>2023-01-02, 02:35PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_9">
                                                <label class="custom-control-label" for="checkBox_9"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#321456</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md bg-teal text-white">H</div>
                                            <div>
                                                <span class="text-truncate-1-line">Henry Leach</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">henry.leach@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$249.99 USD</td>
                                    <td>2023-04-25,06:35PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-danger text-danger">Declined</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <tr class="single-item">
                                    <td>
                                        <div class="item-checkbox ms-1">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input checkbox"
                                                    id="checkBox_10">
                                                <label class="custom-control-label" for="checkBox_10"></label>
                                            </div>
                                        </div>
                                    </td>
                                    <td><a href="invoice-view.html" class="fw-bold">#357895</a></td>
                                    <td>
                                        <a href="javascript:void(0)" class="hstack gap-3">
                                            <div class="avatar-image avatar-md">
                                                <img src="assets/images/avatar/3.png" alt=""
                                                    class="img-fluid">
                                            </div>
                                            <div>
                                                <span class="text-truncate-1-line">Marianne Audrey</span>
                                                <small
                                                    class="fs-12 fw-normal text-muted">marianne.audrey@outlook.com</small>
                                            </div>
                                        </a>
                                    </td>
                                    <td class="fw-bold text-dark">$150.00 USD</td>
                                    <td>2023-02-15, 08:36PM</td>
                                    <td><a href="javascript:void(0);">#SDEG4589SE1E</a></td>
                                    <td>
                                        <div class="badge bg-soft-success text-success">Complted</div>
                                    </td>
                                    <td>
                                        <div class="hstack gap-2 justify-content-end">
                                            <a href="invoice-view.html" class="avatar-text avatar-md">
                                                <i class="feather feather-eye"></i>
                                            </a>
                                            <div class="dropdown">
                                                <a href="javascript:void(0)" class="avatar-text avatar-md"
                                                    data-bs-toggle="dropdown" data-bs-offset="0,21">
                                                    <i class="feather feather-more-horizontal"></i>
                                                </a>
                                                <ul class="dropdown-menu">
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-edit-3 me-3"></i>
                                                            <span>Edit</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item printBTN" href="javascript:void(0)">
                                                            <i class="feather feather-printer me-3"></i>
                                                            <span>Print</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-clock me-3"></i>
                                                            <span>Remind</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-archive me-3"></i>
                                                            <span>Archive</span>
                                                        </a>
                                                    </li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-alert-octagon me-3"></i>
                                                            <span>Report Spam</span>
                                                        </a>
                                                    </li>
                                                    <li class="dropdown-divider"></li>
                                                    <li>
                                                        <a class="dropdown-item" href="javascript:void(0)">
                                                            <i class="feather feather-trash-2 me-3"></i>
                                                            <span>Delete</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- [ Main Content ] end -->
@include('layouts.partials.admin.footer')
