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
                    <h5 class="m-b-10">Admin</h5>
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
                                <a href="javascript:void(0);" id="download-btn-{{ $payment->id }}"
                                    class="d-flex me-1 file-download"
                                    onclick="downloadInvoice(this.closest('.invoice-container'))">
                                    <div class="avatar-text avatar-md" data-bs-toggle="tooltip"
                                        title="Download Invoice">
                                        <i class="feather feather-download"></i>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="card-body p-0" id="invoice-body-{{ $payment->id }}">
                            <div class="px-4 pt-4">
                                <div class="d-sm-flex align-items-center justify-content-between">
                                    <div>
                                        <div class="fs-24 fw-bolder font-montserrat-alt text-uppercase">
                                            <img src="{{ asset('assets/images/logo-full.png') }}" class="img-fluid"
                                                style="max-height: 60px;" alt="Logo">
                                        </div>
                                        <address class="text-muted">
                                            @if (!empty($user?->webaddress))
                                                {!! collect(explode(' ', $user->webaddress))->chunk(5)->map(fn($chunk) => $chunk->implode(' '))->implode('<br>') !!}
                                                <br>
                                                Mobile: {{ $user->mobile ?? '-' }}<br>
                                                Email: {{ $user->webemail ?? ($user->email ?? '-') }}
                                            @else
                                                P.O. Box 18728,<br>
                                                DeLorean New York<br>
                                                VAT No: 2617 348 2752<br>
                                                Mobile: {{ $user->mobile ?? '-' }}<br>
                                                Email: {{ $user->webemail ?? ($user->email ?? '-') }}
                                            @endif
                                        </address>
                                    </div>
                                    <div class="lh-lg pt-3 pt-sm-0">
                                        <h2 class="fs-4 fw-bold text-primary">Invoice</h2>
                                        <div>
                                            <span class="fw-bold text-dark">Invoice:</span>
                                            <span class="fw-bold text-primary">{{ $payment->invoice_number }}</span>
                                        </div>
                                        @if ($payment->payment_status !== 'paid' && !is_null($payment->due_date))
                                            <div>
                                                <span class="fw-bold text-dark">Due Date:</span>
                                                <span class="text-muted">
                                                    {{ $payment->due_date->format('d M, Y') }}
                                                </span>
                                            </div>
                                        @endif
                                        @if (!is_null($payment->issue_date))
                                            <div>
                                                <span class="fw-bold text-dark">Issued Date:</span>
                                                <span class="text-muted">
                                                    {{ $payment->issue_date->format('d M, Y') }}
                                                </span>
                                            </div>
                                        @endif
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
                                    <div class="border-end border-end-dashed border-gray-500 d-none d-sm-block">
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
                                        <tr>
                                            <td class="fw-semibold text-dark text-end border-end">
                                                Paid Amount
                                            </td>
                                            <td class="fw-bold text-dark text-end">
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

                                    </tbody>
                                </table>
                            </div>
                            <hr class="border-dashed mt-0">
                            <div class="px-4">
                                @if ($payment->invoice_note)
                                    <div class="alert alert-dismissible p-4 mt-3 alert-soft-warning-message">
                                        <p class="mb-0">
                                            <strong>NOTES:</strong><br>
                                            {{ $payment->invoice_note }}
                                        </p>
                                    </div>
                                @endif

                            </div>
                            <div class="px-4 pt-4 d-sm-flex align-items-center justify-content-between">
                                <div class="mb-5 mb-sm-0">
                                    <h6 class="fs-13 fw-bold mb-3">Terms &amp; Conditions:</h6>
                                    <ul class="list-unstyled lh-lg fs-12">
                                        <li># All payments are due within 7 days from the date of invoice
                                            issuance.</li>
                                        <li># Payments can be made via cheque, credit/debit card, or online bank
                                            transfer.</li>

                                        <li># This invoice is computer-generated and does not require a physical
                                            signature.</li>
                                    </ul>
                                </div>
                                <div class="text-center">
                                    @if ($user && $user->accsign)
                                        <img src="{{ asset('storage/app/public/' . $user->accsign) }}"
                                            class="img-fluid wd-100" alt="signature">
                                    @else
                                        <img src="assets/images/general/signature.png" class="img-fluid wd-100"
                                            alt="default signature">
                                    @endif

                                    <h6 class="fs-13 fw-bold mt-2">Account Manager</h6>
                                    <p class="fs-11 fw-semibold text-muted">26 MAY 2023, 10:35PM</p>
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
