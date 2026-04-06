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
                    <li class="breadcrumb-item">Payments</li>
                    <li class="breadcrumb-item">List</li>
                </ul>
            </div>
        </div>

        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->



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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($payments as $key => $payment)
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
                                                <a href="" class="fw-bold">
                                                    #{{ $payment->invoice_number }}
                                                </a>
                                            </td>

                                            <td>
                                                <a href="javascript:void(0)" class="hstack gap-3">
                                                    <div class="avatar-image avatar-md bg-primary text-white">
                                                        {{ strtoupper(substr($payment->to_name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <span class="text-truncate-1-line">
                                                            {{ $payment->to_name }}
                                                        </span>
                                                        <small class="fs-12 fw-normal text-muted">
                                                            {{ $payment->to_email }}
                                                        </small>
                                                    </div>
                                                </a>
                                            </td>

                                            <td class="fw-bold text-dark">
                                                ₹{{ number_format($payment->grand_total, 2) }}
                                                {{ $payment->currency }}
                                            </td>

                                            <td>
                                                {{ \Carbon\Carbon::parse($payment->created_at)->format('Y-m-d, h:i A') }}
                                            </td>

                                            <td>
                                                <a href="javascript:void(0);">
                                                    #{{ strtoupper(Str::random(10)) }}
                                                </a>
                                            </td>

                                            <td>
                                                @if ($payment->payment_status == 'paid')
                                                <div class="badge bg-soft-success text-success">Completed</div>
                                                @elseif($payment->payment_status == 'pending')
                                                <div class="badge bg-soft-warning text-warning">Pending</div>
                                                @elseif($payment->payment_status == 'failed')
                                                <div class="badge bg-soft-danger text-danger">Failed</div>
                                                @else
                                                <div class="badge bg-soft-secondary text-secondary">
                                                    {{ ucfirst($payment->payment_status) }}
                                                </div>
                                                @endif
                                            </td>

                                            <!-- Corrected Actions -->
                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    <a href="{{ route('student.viewpayment', $payment->id) }}"
                                                        class="avatar-text avatar-md">
                                                        <i class="feather feather-eye"></i>
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                        @empty
                                        <tr>
                                            <td colspan="8" class="text-center">No Payments Found</td>
                                        </tr>
                                        @endforelse
                                    </tbody>

                                </table>
                                <div class="d-flex justify-content-center mt-3">
                                    <nav>
                                        <ul class="pagination pagination-sm mb-0">
                                            <!-- Previous Page -->
                                            <li class="page-item {{ $payments->onFirstPage() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $payments->previousPageUrl() }}"
                                                    aria-label="Previous">
                                                    <span aria-hidden="true">&laquo;</span>
                                                    <span class="visually-hidden">Previous</span>
                                                </a>
                                            </li>

                                            <!-- Page Numbers -->
                                            @foreach ($payments->getUrlRange(1, $payments->lastPage()) as $page => $url)
                                            <li
                                                class="page-item {{ $payments->currentPage() == $page ? 'active' : '' }}">
                                                <a class="page-link"
                                                    href="{{ $url }}">{{ $page }}</a>
                                            </li>
                                            @endforeach

                                            <!-- Next Page -->
                                            <li class="page-item {{ !$payments->hasMorePages() ? 'disabled' : '' }}">
                                                <a class="page-link" href="{{ $payments->nextPageUrl() }}"
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
@include('layouts.partials.admin.theme')