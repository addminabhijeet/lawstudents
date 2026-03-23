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
                    <li class="breadcrumb-item">Payment</li>
                    <li class="breadcrumb-item">Edit</li>
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
                <form method="POST" action="{{ route('admin.updatepayment', $payment->id) }}"
                    enctype="multipart/form-data">
                    @csrf
                    @php
                        $latestPayments = $allPayments->groupBy('student_id')->map(function ($items) {
                            return $items->max('id');
                        });
                    @endphp
                    @foreach ($allPayments as $pIndex => $payment)
                        <input type="hidden" name="payments[{{ $pIndex }}][id]" value="{{ $payment->id }}">

                        <div class="col-xl-12 mb-4">
                            <div class="card invoice-container">
                                <div class="card-body p-0">

                                    <!-- HEADER -->
                                    <div class="px-4 pt-4">
                                        <h5 class="fw-bold text-primary">{{ $payment->invoice_number }}</h5>

                                        <div class="d-md-flex justify-content-end gap-4">
                                            <div class="form-group">
                                                <label>Issue Date:</label>
                                                <input class="form-control" type="date"
                                                    name="payments[{{ $pIndex }}][issue_date]"
                                                    value="{{ optional($payment->issue_date)->format('Y-m-d') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Due Date:</label>
                                                <input class="form-control" type="date"
                                                    name="payments[{{ $pIndex }}][due_date]"
                                                    value="{{ optional($payment->due_date)->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- BASIC INFO -->
                                    <div class="px-4 row g-3">
                                        <div class="col-md-3">
                                            <label>To Name</label>
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][to_name]"
                                                value="{{ $payment->to_name }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Email</label>
                                            <input type="email" class="form-control"
                                                name="payments[{{ $pIndex }}][to_email]"
                                                value="{{ $payment->to_email }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Phone</label>
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][to_phone]"
                                                value="{{ $payment->to_phone }}">
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Address</label>
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][to_address]"
                                                value="{{ $payment->to_address }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Sub Total</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][sub_total]"
                                                value="{{ $payment->sub_total }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Tax %</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][tax_percentage]"
                                                value="{{ $payment->tax_percentage }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Tax Amount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][tax_amount]"
                                                value="{{ $payment->tax_amount }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Discount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][discount]"
                                                value="{{ $payment->discount }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Discount %</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][discount_percent]"
                                                value="{{ $payment->discount_percent }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Grand Total</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][grand_total]"
                                                value="{{ $payment->grand_total }}">
                                        </div>

                                        <div class="col-md-2">
                                            <label>Payment Status</label>
                                            <select class="form-control"
                                                name="payments[{{ $pIndex }}][payment_status]">
                                                <option value="pending"
                                                    {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>
                                                    Pending</option>
                                                <option value="partial"
                                                    {{ $payment->payment_status == 'partial' ? 'selected' : '' }}>
                                                    Partial</option>
                                                <option value="paid"
                                                    {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                                </option>
                                            </select>
                                        </div>
                                        @php
                                            $latestId = $latestPayments[$payment->student_id] ?? null;
                                        @endphp

                                        <input type="hidden" name="payments[{{ $pIndex }}][id]"
                                            value="{{ $payment->id }}">

                                        <div class="col-md-2">
                                            <label>Paid Amount</label>

                                            <input type="number" step="0.01"
                                                id="{{ $payment->id == $latestId ? 'latest-paid-amount' : '' }}"
                                                class="form-control paid-amount"
                                                name="payments[{{ $pIndex }}][paid_amount]"
                                                value="{{ $payment->paid_amount }}"
                                                {{ $payment->id != $latestId ? 'readonly' : '' }}
                                                max="{{ $payment->remaining_amount }}"
                                                data-max="{{ $payment->remaining_amount }}">

                                            <small class="text-danger d-none error-msg">
                                                Paid amount cannot be greater than remaining amount
                                            </small>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <label>Remaining Amount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][remaining_amount]"
                                                value="{{ $payment->remaining_amount }}">
                                        </div>

                                        <div class="col-md-4">
                                            <label>Invoice Note</label>
                                            <textarea class="form-control" name="payments[{{ $pIndex }}][invoice_note]">{{ $payment->invoice_note }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">Update All Payments</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>

<script>
    document.addEventListener('DOMContentLoaded', function() {

        let input = document.getElementById('latest-paid-amount');

        if (!input) return;

        input.addEventListener('input', function() {

            let max = parseFloat(this.dataset.max) || 0;
            let value = parseFloat(this.value) || 0;

            let errorMsg = this.closest('.col-md-2').querySelector('.error-msg');

            if (value > max) {
                this.value = max;

                errorMsg.classList.remove('d-none');
                this.classList.add('is-invalid');

            } else {
                errorMsg.classList.add('d-none');
                this.classList.remove('is-invalid');
            }
        });

    });
</script>
@include('layouts.partials.admin.theme')
