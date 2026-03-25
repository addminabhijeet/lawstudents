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
                                        @php
                                            $latestId = $latestPayments[$payment->student_id] ?? null;
                                        @endphp

                                        <div class="d-md-flex justify-content-end gap-4">
                                            <div class="form-group">
                                                <label>Issue Date:</label>
                                                <input class="form-control" type="date"
                                                    name="payments[{{ $pIndex }}][issue_date]"
                                                    value="{{ optional($payment->issue_date)->format('Y-m-d') }}"
                                                    {{ $payment->id != $latestId ? 'readonly' : '' }}
                                                    min="{{ optional($payment->issue_date)->format('Y-m-d') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Due Date:</label>
                                                <input class="form-control" type="date"
                                                    name="payments[{{ $pIndex }}][due_date]"
                                                    value="{{ optional($payment->due_date)->format('Y-m-d') }}"
                                                    {{ $payment->id != $latestId ? 'readonly' : '' }}
                                                    min="{{ optional($payment->issue_date)->format('Y-m-d') }}">
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
                                                value="{{ $payment->to_name }}" readonly>
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Email</label>
                                            <input type="email" class="form-control"
                                                name="payments[{{ $pIndex }}][to_email]"
                                                value="{{ $payment->to_email }}" readonly>
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Phone</label>
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][to_phone]"
                                                value="{{ $payment->to_phone }}" readonly>
                                        </div>

                                        <div class="col-md-3">
                                            <label>To Address</label>
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][to_address]"
                                                value="{{ $payment->to_address }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Sub Total</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][sub_total]"
                                                value="{{ $payment->sub_total }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Tax %</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][tax_percentage]"
                                                value="{{ $payment->tax_percentage }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Tax Amount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][tax_amount]"
                                                value="{{ $payment->tax_amount }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Discount</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][discount]"
                                                value="{{ $payment->discount }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Discount %</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][discount_percent]"
                                                value="{{ $payment->discount_percent }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Grand Total</label>
                                            <input type="number" step="0.01" class="form-control"
                                                name="payments[{{ $pIndex }}][grand_total]"
                                                value="{{ $payment->grand_total }}" readonly>
                                        </div>

                                        <div class="col-md-2">
                                            <label>Payment Status</label>

                                            <!-- Disabled Select (UI Readonly) -->
                                            <select class="form-control" disabled>
                                                <option value="pending"
                                                    {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>
                                                    Pending
                                                </option>
                                                <option value="partial"
                                                    {{ $payment->payment_status == 'partial' ? 'selected' : '' }}>
                                                    Partial
                                                </option>
                                                <option value="paid"
                                                    {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>
                                                    Paid
                                                </option>
                                            </select>

                                            <!-- Hidden Input (keeps value submitted) -->
                                            <input type="hidden"
                                                name="payments[{{ $pIndex }}][payment_status]"
                                                value="{{ $payment->payment_status }}">
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
                                                value="{{ $payment->remaining_amount }}" readonly>
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
<script>
    document.querySelectorAll('input[name*="[issue_date]"]').forEach(issueInput => {
        const pIndex = issueInput.name.match(/\d+/)[0];
        const dueInput = document.querySelector(`input[name="payments[${pIndex}][due_date]"]`);

        if (!issueInput.readOnly && dueInput) {
            issueInput.addEventListener('change', function() {
                if (dueInput.value < this.value) {
                    dueInput.value = this.value; // adjust due_date
                }
                dueInput.min = this.value;
            });
        }
    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {

        // Convert allPayments JSON to JS array with numeric IDs
        const allPayments = @json($allPayments);

        // Group payments by student_id
        const grouped = {};
        allPayments.forEach((p, index) => {
            if (!grouped[p.student_id]) grouped[p.student_id] = [];
            grouped[p.student_id].push({
                ...p,
                index
            });
        });

        // Iterate over each student's payments
        Object.values(grouped).forEach(payments => {
            // Sort by ID ascending
            payments.sort((a, b) => a.id - b.id);

            // Track the last readonly payment's dates
            let lastIssue = null;
            let lastDue = null;

            payments.forEach(p => {
                const issueInput = document.querySelector(
                    `input[name="payments[${p.index}][issue_date]"]`);
                const dueInput = document.querySelector(
                    `input[name="payments[${p.index}][due_date]"]`);

                if (!issueInput) return;

                // If this payment is readonly, update lastIssue and lastDue
                if (issueInput.readOnly) {
                    lastIssue = issueInput.value;
                    lastDue = dueInput ? dueInput.value : null;
                    return; // nothing else to do for readonly
                }

                // For editable payment, set min strictly
                if (lastIssue) issueInput.min = lastIssue;
                if (dueInput) {
                    const minDue = lastDue && issueInput.value < lastDue ? lastDue : issueInput
                        .value;
                    dueInput.min = minDue;
                }

                // Listen for changes and enforce min strictly
                issueInput.addEventListener('change', function() {
                    if (lastIssue && this.value < lastIssue) this.value = lastIssue;
                    if (dueInput) {
                        const minDue = lastDue && this.value < lastDue ? lastDue : this
                            .value;
                        dueInput.min = minDue;
                        if (dueInput.value < dueInput.min) dueInput.value = dueInput
                        .min;
                    }
                });

                if (dueInput && !dueInput.readOnly) {
                    dueInput.addEventListener('change', function() {
                        if (lastDue && this.value < lastDue) this.value = lastDue;
                    });
                }
            });
        });
    });
</script>
@include('layouts.partials.admin.theme')
