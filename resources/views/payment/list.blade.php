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
                                @php
                                // Group payments by student_id
                                $groupedPayments = $payments->groupBy('student_id');
                                @endphp

                                <table class="table table-hover" id="paymentList">
                                    <thead>
                                        <tr>
                                            <th class="wd-30">
                                                <div class="btn-group mb-1">
                                                    <div class="custom-control custom-checkbox ms-1">
                                                        <input type="checkbox" class="custom-control-input" id="checkAllPayment">
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
                                        @forelse($groupedPayments as $studentId => $studentPayments)
                                        @php
                                        $firstPayment = $studentPayments->first();
                                        @endphp
                                        <tr class="single-item">
                                            <td>
                                                <div class="item-checkbox ms-1">
                                                    <div class="custom-control custom-checkbox">
                                                        <input type="checkbox" class="custom-control-input checkbox" id="checkBox_{{ $loop->iteration }}">
                                                        <label class="custom-control-label" for="checkBox_{{ $loop->iteration }}"></label>
                                                    </div>
                                                </div>
                                            </td>

                                            <td>
                                                <a href="#" class="fw-bold">#{{ $firstPayment->invoice_number }}</a>
                                            </td>

                                            <td>
                                                <a href="javascript:void(0)" class="hstack gap-3">
                                                    <div class="avatar-image avatar-md bg-primary text-white">
                                                        {{ strtoupper(substr($firstPayment->to_name, 0, 1)) }}
                                                    </div>
                                                    <div>
                                                        <span class="text-truncate-1-line">{{ $firstPayment->to_name }}</span>
                                                        <small class="fs-12 fw-normal text-muted">{{ $firstPayment->to_email }}</small>
                                                    </div>
                                                </a>
                                            </td>

                                            <td class="fw-bold text-dark">₹{{ number_format($firstPayment->grand_total, 2) }} {{ $firstPayment->currency }}</td>

                                            <td>{{ \Carbon\Carbon::parse($firstPayment->created_at)->format('Y-m-d, h:i A') }}</td>

                                            <td>
                                                <a href="javascript:void(0);">#{{ strtoupper(Str::random(10)) }}</a>
                                            </td>

                                            <td>
                                                @if ($firstPayment->payment_status == 'paid')
                                                <div class="badge bg-soft-success text-success">Completed</div>
                                                @elseif($firstPayment->payment_status == 'pending')
                                                <div class="badge bg-soft-warning text-warning">Pending</div>
                                                @elseif($firstPayment->payment_status == 'failed')
                                                <div class="badge bg-soft-danger text-danger">Failed</div>
                                                @else
                                                <div class="badge bg-soft-secondary text-secondary">{{ ucfirst($firstPayment->payment_status) }}</div>
                                                @endif
                                            </td>

                                            <td>
                                                <div class="hstack gap-2 justify-content-end">
                                                    {{-- Only one view button for the first payment of the student --}}
                                                    <a href="{{ route('student.viewpayment', $firstPayment->id) }}" class="avatar-text avatar-md">
                                                        <i class="feather feather-eye"></i>
                                                    </a>
                                                </div>

                                                {{-- Single Edit button for student --}}
                                                <a href="{{ route('admin.editpayment', $firstPayment->id) }}"
                                                    class="avatar-text avatar-md">
                                                    <i class="feather feather-edit"></i>
                                                </a>
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