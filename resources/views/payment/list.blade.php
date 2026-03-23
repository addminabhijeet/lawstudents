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
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Status</th>
                                            <th class="text-end">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $groupedPayments = $payments->groupBy('student_id');
                                        @endphp

                                        @forelse($groupedPayments as $studentId => $studentPayments)
                                            @php
                                                $firstPayment = $studentPayments->first();
                                            @endphp
                                            <tr class="single-item">
                                                <td>
                                                    <div class="item-checkbox ms-1">
                                                        <div class="custom-control custom-checkbox">
                                                            <input type="checkbox" class="custom-control-input checkbox"
                                                                id="checkBox_{{ $studentId }}">
                                                            <label class="custom-control-label"
                                                                for="checkBox_{{ $studentId }}"></label>
                                                        </div>
                                                    </div>
                                                </td>

                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <span class="text-truncate-1-line">
                                                                {{ $firstPayment->to_name }}
                                                            </span>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td>
                                                    <a class="hstack gap-3">
                                                        <div>
                                                            <small class="fs-12 fw-normal text-muted">
                                                                {{ $firstPayment->to_email }}
                                                            </small>
                                                        </div>
                                                    </a>
                                                </td>

                                                <td>
                                                    @if ($firstPayment->payment_status == 'paid')
                                                        <div class="badge bg-soft-success text-success">Completed</div>
                                                    @elseif($firstPayment->payment_status == 'pending')
                                                        <div class="badge bg-soft-warning text-warning">Pending</div>
                                                    @elseif($firstPayment->payment_status == 'failed')
                                                        <div class="badge bg-soft-danger text-danger">Failed</div>
                                                    @else
                                                        <div class="badge bg-soft-secondary text-secondary">
                                                            {{ ucfirst($firstPayment->payment_status) }}
                                                        </div>
                                                    @endif
                                                </td>

                                                <td>
                                                    <div class="hstack gap-2 justify-content-end">
                                                        {{-- View buttons for each payment --}}
                                                        @foreach ($studentPayments as $payment)
                                                            <a href="{{ route('admin.viewpayment', $payment->id) }}"
                                                                class="avatar-text avatar-md"
                                                                title="View #{{ $payment->invoice_number }}">
                                                                <i class="feather feather-eye"></i>
                                                            </a>
                                                        @endforeach

                                                        {{-- Single Edit button for student --}}
                                                        <a href="{{ route('admin.editpayment', $firstPayment->id) }}"
                                                            class="avatar-text avatar-md">
                                                            <i class="feather feather-edit"></i>
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
