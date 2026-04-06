@include('layouts.partials.admin.dashboard')
@php
$user = \App\Models\User::first();
@endphp
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


                    <div class="card invoice-container">

                        <div class="card-header">
                            <!-- Print button -->
                            <div class="card-header">
                                <!-- Print button -->
                                <a href="javascript:void(0);" id="print-btn-{{ $payment->id }}"
                                    class="d-flex me-1 printBTN"
                                    onclick="printInvoice(this.closest('.invoice-container'))">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip" title="Print Invoice">
                                        <i class="feather feather-printer"></i>
                                    </div>
                                </a>

                                <!-- Download button -->
                                <!-- <a href="javascript:void(0);" id="download-btn-{{ $payment->id }}"
                                    class="d-flex me-1 file-download"
                                    onclick="downloadInvoice(this.closest('.invoice-container'))">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                        title="Download Invoice">
                                        <i class="feather feather-download"></i>
                                    </div>
                                </a> -->
                            </div>
                        </div>

                        <div class="card-body p-0" id="invoice-body-{{ $payment->id }}">
                            <div class="px-3 pt-2 pb-1">
                                <div class="row align-items-center text-center text-sm-start g-1">

                                    <!-- LEFT: centerone -->
                                    <div class="col-12 col-sm-4 mb-2 mb-sm-0">
                                        <strong>
                                            <address class="text-muted small mb-0 lh-sm">
                                                @if (!empty($user?->centerone))
                                                {!! collect(explode(' ', trim($user->centerone)))
                                                ->chunk(3)
                                                ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                ->implode('<br>') !!}
                                                <br>
                                                @else
                                                P.O. Box 18728,<br>
                                                DeLorean New York<br>
                                                VAT No: 2617 348 2752<br>
                                                @endif
                                            </address>
                                        </strong>
                                    </div>

                                    <!-- CENTER: Logo -->
                                    <div class="col-12 col-sm-4 text-center mb-2 mb-sm-0">
                                        <img src="{{ asset('assets/images/logo-full.png') }}"
                                            class="img-fluid mb-1"
                                            style="max-height: 55px;"
                                            alt="Logo">
                                        <div class="fw-bold text-dark small lh-sm">
                                            <strong>Mobile:</strong> {{ $user->mobile ?? '-' }}<br>
                                            <strong>Email:</strong> {{ $user->webemail ?? ($user->email ?? '-') }}
                                        </div>
                                    </div>

                                    <!-- RIGHT: centertwo -->
                                    <div class="col-12 col-sm-4 text-sm-end">
                                        <strong>
                                            <address class="text-muted small mb-0 lh-sm">
                                                @if (!empty($user?->centertwo))
                                                {!! collect(explode(' ', trim($user->centertwo)))
                                                ->chunk(3)
                                                ->map(fn($chunk) => implode(' ', $chunk->toArray()))
                                                ->implode('<br>') !!}
                                                <br>
                                                @else
                                                P.O. Box 18728,<br>
                                                DeLorean New York<br>
                                                VAT No: 2617 348 2752<br>
                                                @endif
                                            </address>
                                        </strong>
                                    </div>

                                </div>
                            </div>
                            <hr class="border-dashed my-2">
                            <div class="px-4 py-3">
                                <div class="d-sm-flex gap-4 justify-content-center align-items-start">

                                    <!-- LEFT: Invoiced To -->
                                    <div class="text-sm-end">
                                        <h2 class="fs-16 fw-bold text-dark mb-2">Invoiced To:</h2>
                                        <address class="text-muted lh-sm">
                                            {{ $payment->to_name }}<br>
                                            {{ $payment->to_address }}<br>
                                            Email: {{ $payment->to_email }}<br>
                                            Phone: {{ $payment->to_phone }}
                                        </address>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-end border-end-dashed border-gray-500 d-none d-sm-block"></div>

                                    <!-- CENTER: Bank Details -->
                                    <div class="text-center px-3">
                                        <h2 class="fs-16 fw-bold text-dark mb-2">Bank Details:</h2>
                                        <div class="text-muted lh-sm">
                                            <div>Account Holder name:</div>
                                            <div>RIZWANA BEGUM</div>
                                            <div>State Bank of India</div>
                                            <div>A/c no. 41669065973</div>
                                            <div>Branch: Newtown Rajarhat (05112)</div>
                                            <div>IFS CODE: SBIN0005112</div>
                                        </div>
                                    </div>

                                    <!-- Divider -->
                                    <div class="border-end border-end-dashed border-gray-500 d-none d-sm-block"></div>

                                    <!-- RIGHT: Payment Details -->
                                    <div class="mt-4 mt-sm-0">
                                        <h2 class="fs-16 fw-bold text-dark mb-2">Payment Details:</h2>
                                        <div class="text-muted lh-sm">
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
                                                <span class="text-muted">Invoice:</span>
                                                <span class="fw-bold text-primary">
                                                    {{ $payment->invoice_number }}
                                                </span>
                                            </div>

                                            @if ($payment->payment_status !== 'paid' && !is_null($payment->due_date))
                                            <div>
                                                <span class="text-muted">Due Date:</span>
                                                <span class="fw-bold text-dark">
                                                    {{ $payment->due_date->format('d M, Y') }}
                                                </span>
                                            </div>
                                            @endif

                                            @if (!is_null($payment->issue_date))
                                            <div>
                                                <span class="text-muted">Issued Date:</span>
                                                <span class="fw-bold text-dark">
                                                    {{ $payment->issue_date->format('d M, Y') }}
                                                </span>
                                            </div>
                                            @endif
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
                                        $courses = \App\Models\Course::whereIn('id', $courseIds)->get();
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

                                        {{-- Grand Total --}}
                                        <tr>
                                            <td class="fw-bold text-dark text-end border-end">Grand Amount
                                            </td>
                                            <td class="fw-bolder text-dark text-end">
                                                {{ $payment->currency }}
                                                {{ number_format($payment->grand_total, 2) }}
                                            </td>
                                        </tr>

                                        {{-- Tax --}}
                                        @if ($payment->paid_amount > 0)
                                        <tr>
                                            <td class="fw-semibold text-dark text-end border-end">
                                                Paid Amount
                                            </td>
                                            <td class="fw-bold text-success text-end">
                                                - {{ $payment->currency }}
                                                {{ number_format($payment->paid_amount, 2) }}
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="fw-semibold text-dark text-end border-end">
                                                Remaining Amount
                                            </td>
                                            <td class="fw-bold text-dark text-end">
                                                {{ $payment->currency }}
                                                {{ number_format($payment->remaining_amount, 2) }}
                                            </td>
                                        </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                            <hr class="border-dashed my-2">
                            <div class="px-3">
                                @if ($payment->invoice_note)
                                <div class="alert alert-dismissible p-2 mt-2 mb-2 alert-soft-warning-message">
                                    <p class="mb-0 small">
                                        <strong>NOTES:</strong><br>
                                        {{ $payment->invoice_note }}
                                    </p>
                                </div>
                                @endif
                            </div>

                            <div class="px-3 pt-2 d-sm-flex align-items-start justify-content-between">

                                <!-- TERMS -->
                                <div class="mb-2 mb-sm-0">
                                    <h6 class="fs-13 fw-bold mb-1">Terms & Conditions:</h6>
                                    <ul class="list-unstyled lh-sm fs-12 mb-0">
                                        @if ($user && $user->terms)
                                        {!! nl2br(e($user->terms)) !!}
                                        @else
                                        <li>1.All payments are due within 7 days from the date of invoice issuance.</li>
                                        <li>2.Payments can be made via cheque, credit/debit card, or online bank transfer.</li>
                                        <li>3.This invoice is computer-generated and does not require a physical signature.</li>
                                        @endif
                                    </ul>
                                </div>

                                <!-- SIGNATURE 1 -->
                                <div class="text-center">
                                    @if ($user && $user->diraccsign)
                                    <img src="{{ asset('storage/app/public/' . $user->diraccsign) }}"
                                        class="img-fluid" style="max-height:60px;" alt="signature">
                                    @else
                                    <img src="assets/images/general/signature.png"
                                        class="img-fluid" style="max-height:60px;" alt="default signature">
                                    @endif

                                    <h6 class="fs-13 fw-bold mt-1 mb-0 lh-sm">
                                        Signature:<br>
                                        Sd/-<br>
                                        (RIZWANA BEGUM)
                                    </h6>

                                    @if (!is_null($payment->issue_date))
                                    <p class="fs-11 fw-semibold text-muted mb-0">
                                        {{ $payment->issue_date->format('d M, Y') }}
                                    </p>
                                    @endif
                                </div>

                                <!-- SIGNATURE 2 -->
                                <div class="text-center">
                                    @if ($user && $user->accsign)
                                    <img src="{{ asset('storage/app/public/' . $user->accsign) }}"
                                        class="img-fluid" style="max-height:60px;" alt="signature">
                                    @else
                                    <img src="assets/images/general/signature.png"
                                        class="img-fluid" style="max-height:60px;" alt="default signature">
                                    @endif

                                    <h6 class="fs-13 fw-bold mt-1 mb-0 lh-sm">
                                        Signature:<br>
                                        Sd/-<br>
                                        (ARITRO FOUZDAR)
                                    </h6>

                                    @if (!is_null($payment->issue_date))
                                    <p class="fs-11 fw-semibold text-muted mb-0">
                                        {{ $payment->issue_date->format('d M, Y') }}
                                    </p>
                                    @endif
                                </div>

                            </div>
                            <hr class="border-dashed my-2">

                            <div class="px-4 pb-4 text-center">
                                <div class="fw-bold text-dark">
                                    Advocate Rizwana Begum
                                </div>
                                <div class="text-muted small">
                                    B. A. (Hons); M. A.; LL. M. (1st Class); PGDCL (Cyber Law-NALSAR-1st Class)
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
<!-- Add this in your blade file before </body> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.11.0/html2pdf.bundle.min.js"></script>
<script>
    function printInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Get the inner card-body
        var bodyContent = invoiceContainer.querySelector('.card-body.p-0');
        if (!bodyContent) return;

        var printContents = bodyContent.cloneNode(true);

        var printWindow = window.open('', '', 'height=800,width=1200');
        printWindow.document.write('<html><head><title>Invoice</title>');

        // Include all CSS
        Array.from(document.querySelectorAll('link[rel="stylesheet"], style')).forEach(function(node) {
            printWindow.document.write(node.outerHTML);
        });

        printWindow.document.write('</head><body>');
        printWindow.document.body.appendChild(printContents);
        printWindow.document.write('</body></html>');

        printWindow.document.close();
        printWindow.focus();
        printWindow.print();
    }

    function downloadInvoice(invoiceContainer) {
        if (!invoiceContainer) return;

        // Get the inner card-body
        var bodyContent = invoiceContainer.querySelector('.card-body.p-0');
        if (!bodyContent) return;

        var pdfContent = bodyContent.cloneNode(true);

        // Temporary off-screen container
        var container = document.createElement('div');
        container.style.position = 'absolute';
        container.style.left = '-9999px';
        container.appendChild(pdfContent);
        document.body.appendChild(container);

        // Filename from invoice number
        var invoiceId = bodyContent.id || 'invoice';
        var filename = invoiceId + '.pdf';

        var opt = {
            filename: filename,
            image: {
                type: 'jpeg',
                quality: 2
            },
            html2canvas: {
                scale: 2
            },
            jsPDF: {
                unit: 'in',
                format: 'a4',
                orientation: 'portrait'
            }
        };

        html2pdf().set(opt).from(container).save().finally(() => container.remove());
    }
</script>
@include('layouts.partials.admin.theme')