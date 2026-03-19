@include('layouts.partials.student.dashboard')
<main class="nxl-container">
    <!-- main containts -->
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Student</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Applications</li>
                    <li class="breadcrumb-item">View</li>
                </ul>
            </div>
        </div>
        <!-- [ page-header ] end -->
        <!-- [ Main Content ] start -->
        <div class="main-content container-lg">
            <div class="row">
                <div class="col-lg-12">
                    @if ($notFound)
                        <div class="alert alert-warning text-center">
                            <strong>Please Complete Your Payment</strong>
                        </div>
                    @endif

                    @if (!$notFound && $payments->count())
                        @foreach ($payments as $payment)
                            <div class="card invoice-container mb-5">
                                <div class="card invoice-container">
                                    <div class="card-header">
                                        <div class="d-flex align-items-center justify-content-center">
                                            <a href="javascript:void(0)" class="d-flex me-1 printBTN">
                                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Print Invoice"><i
                                                        class="feather feather-printer"></i></div>
                                            </a>
                                            <a href="javascript:void(0)" class="d-flex me-1 file-download">
                                                <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                                    data-bs-trigger="hover" title="Download Invoice"><i
                                                        class="feather feather-download"></i></div>
                                            </a>
                                        </div>
                                    </div>

                                    <div class="card-body p-0">
                                        <div class="px-4 pt-4">
                                            <div class="d-sm-flex align-items-center justify-content-between">
                                                <div>
                                                    <div class="fs-24 fw-bolder font-montserrat-alt text-uppercase">Law
                                                        Students
                                                    </div>
                                                    <address class="text-muted">
                                                        P.O. Box 18728,<br>
                                                        DeLorean New York<br>
                                                        VAT No: 2617 348 2752
                                                    </address>
                                                    <div class="d-flex gap-2">
                                                        <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                            <i class="feather-facebook"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                            <i class="feather-twitter"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                            <i class="feather-instagram"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                            <i class="feather-linkedin"></i>
                                                        </a>
                                                        <a href="javascript:void(0);" class="avatar-text avatar-sm">
                                                            <i class="feather-github"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="lh-lg pt-3 pt-sm-0">
                                                    <h2 class="fs-4 fw-bold text-primary">Invoice</h2>
                                                    <div>
                                                        <span class="fw-bold text-dark">Invoice:</span>
                                                        <span
                                                            class="fw-bold text-primary">{{ $payment->invoice_number }}</span>
                                                    </div>
                                                    <div>
                                                        <span class="fw-bold text-dark">Due Date:</span>
                                                        <span class="text-muted">
                                                            {{ optional($payment->due_date)->format('d M, Y') }}
                                                        </span>

                                                    </div>
                                                    <div>
                                                        <span class="fw-bold text-dark">Issued Date:</span>
                                                        <span class="text-muted">
                                                            {{ optional($payment->issue_date)->format('d M, Y') }}
                                                        </span>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border-dashed">
                                        <div class="px-4 py-sm-5">
                                            <div class="d-sm-flex gap-4 justify-content-center">
                                                <div class="text-sm-end">
                                                    <h2 class="fs-16 fw-bold text-dark mb-3">Invoiced To:</h2>
                                                    <address class="text-muted lh-lg">
                                                        {{ $payment->to_name }}<br>
                                                        {{ $payment->to_address }}<br>
                                                        Email: {{ $payment->to_email }}<br>
                                                        Phone: {{ $payment->to_phone }}
                                                    </address>

                                                </div>
                                                <div
                                                    class="border-end border-end-dashed border-gray-500 d-none d-sm-block">
                                                </div>
                                                <div class="mt-4 mt-sm-0">
                                                    <h2 class="fs-16 fw-bold text-dark mb-3">Payment Details:</h2>
                                                    <div class="text-muted lh-lg">
                                                        <div>
                                                            <span class="text-muted">Total Due:</span>
                                                            <span class="fw-bold text-dark">
                                                                {{ $payment->currency }}
                                                                {{ number_format($payment->grand_total, 2) }}
                                                            </span>

                                                        </div>
                                                        <div>
                                                            <span class="text-muted">Payout Status:</span>
                                                            @php
                                                                $statusColor = match ($payment->payment_status) {
                                                                    'paid' => 'text-success',
                                                                    'failed' => 'text-danger',
                                                                    'cancelled' => 'text-secondary',
                                                                    default => 'text-warning',
                                                                };
                                                            @endphp

                                                            <span class="fw-bold {{ $statusColor }}">
                                                                {{ ucfirst($payment->payment_status) }}
                                                            </span>

                                                        </div>
                                                        <div>
                                                            <span class="text-muted">Card Holder:</span>
                                                            <span class="fw-bold text-dark">Alexandra Della</span>
                                                        </div>
                                                        <div>
                                                            <span class="text-muted">Payment Method:</span>
                                                            <span class="fw-bold text-dark">
                                                                {{ ucfirst(str_replace('_', ' ', $payment->payment_method)) }}
                                                            </span>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <hr class="border-dashed mb-0">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th class="border-end">Enrolled Courses</th>
                                                        <th class="text-end">Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody>

                                                    @php $totalAmount = 0; @endphp

                                                    @if ($payment && $payment->course)
                                                        @php
                                                            $courseIds = explode(',', $payment->course_id);
                                                            $courses = \App\Models\Course::whereIn(
                                                                'id',
                                                                $courseIds,
                                                            )->get();
                                                        @endphp

                                                        @foreach ($courses as $course)
                                                            @php
                                                                $totalAmount += $course->price;
                                                            @endphp
                                                            <tr>
                                                                <td class="border-end">
                                                                    {{ $course->title }}
                                                                </td>
                                                                <td class="text-end fw-semibold">
                                                                    {{ $payment->currency }}
                                                                    {{ number_format($course->price, 2) }}
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif

                                                    {{-- Sub Total --}}
                                                    <tr>
                                                        <td class="fw-semibold text-dark text-end border-end">Sub Total
                                                        </td>
                                                        <td class="fw-bold text-dark text-end">
                                                            {{ $payment->currency }}
                                                            {{ number_format($payment->sub_total, 2) }}
                                                        </td>
                                                    </tr>

                                                    {{-- Discount --}}
                                                    <tr>
                                                        <td class="fw-semibold text-dark text-end border-end">
                                                            Discount ({{ $payment->discount_percent ?? 0 }}%)
                                                        </td>
                                                        <td class="fw-bold text-success text-end">
                                                            - {{ $payment->currency }}
                                                            {{ number_format($payment->discount, 2) }}
                                                        </td>
                                                    </tr>

                                                    {{-- Tax --}}
                                                    <tr>
                                                        <td class="fw-semibold text-dark text-end border-end">
                                                            Tax ({{ $payment->tax_percentage }}%)
                                                        </td>
                                                        <td class="fw-bold text-dark text-end">
                                                            + {{ $payment->currency }}
                                                            {{ number_format($payment->tax_amount, 2) }}
                                                        </td>
                                                    </tr>

                                                    {{-- Grand Total --}}
                                                    <tr>
                                                        <td class="fw-bold text-dark text-end border-end">Grand Amount
                                                        </td>
                                                        <td class="fw-bolder text-dark text-end">
                                                            {{ $payment->currency }}
                                                            {{ number_format($payment->grand_total, 2) }}
                                                        </td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <hr class="border-dashed mt-0">
                                        <div class="px-4">
                                            @if ($payment->invoice_note)
                                                <div
                                                    class="alert alert-dismissible p-4 mt-3 alert-soft-warning-message">
                                                    <p class="mb-0">
                                                        <strong>NOTES:</strong><br>
                                                        {{ $payment->invoice_note }}
                                                    </p>
                                                </div>
                                            @endif

                                        </div>
                                        <div class="px-4 pt-4 d-sm-flex align-items-center justify-content-between">
                                            <div class="mb-5 mb-sm-0">
                                                <h6 class="fs-13 fw-bold mb-3">Tarm &amp; Condition :</h6>
                                                <ul class="list-unstyled lh-lg fs-12">
                                                    <li># All accounts are to be paid within 7 days from receipt of
                                                        invoice.
                                                    </li>
                                                    <li># To be paid by cheque or credit card or direct payment online.
                                                    </li>
                                                    <li># If account is not paid within 7 days the credits details
                                                        supplied as
                                                        confirmation.
                                                    </li>
                                                    <li># This is computer generated receipt and does not require
                                                        physical
                                                        signature.</li>
                                                </ul>
                                            </div>
                                            <div class="text-center">
                                                <img src="assets/images/general/signature.png"
                                                    class="img-fluid wd-100" alt="image">
                                                <h6 class="fs-13 fw-bold mt-2">Account Manager</h6>
                                                <p class="fs-11 fw-semibold text-muted">26 MAY 2023, 10:35PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if (!$loop->last)
                                    <div style="margin: 40px 0;">
                                        <hr style="border-top: 1px solid #ddd;">
                                    </div>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.student.theme')
