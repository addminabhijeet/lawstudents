@include('layouts.partials.admin.dashboard')
<!-- [ page-header ] start -->
<div class="page-header">
    <div class="page-header-left d-flex align-items-center">
        <div class="page-header-title">
            <h5 class="m-b-10">Proposal</h5>
        </div>
        <ul class="breadcrumb">
            <li class="breadcrumb-item"><a href="index.html">Home</a></li>
            <li class="breadcrumb-item">Create</li>
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
                <a href="javascript:void(0);" class="btn btn-light-brand" data-bs-toggle="offcanvas"
                    data-bs-target="#proposalSent">
                    <i class="feather-layers me-2"></i>
                    <span>Save & Send</span>
                </a>
                <a href="javascript:void(0);" class="btn btn-primary successAlertMessage">
                    <i class="feather-save me-2"></i>
                    <span>Save</span>
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
        <div class="col-xl-6">
            <div class="card stretch stretch-full">
                <div class="card-body">

                    <div class="mb-4">
                        <label class="form-label">Subject <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" name="invoice_label"
                            value="{{ old('invoice_label', $payment->invoice_label) }}">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Start</label>
                            <input class="form-control" type="date" name="issue_date"
                                value="{{ old('issue_date', optional($payment->issue_date)->format('Y-m-d')) }}">
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Due</label>
                            <input class="form-control" type="date" name="due_date"
                                value="{{ old('due_date', optional($payment->due_date)->format('Y-m-d')) }}">
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- RIGHT SIDE -->
        <div class="col-xl-6">
            <div class="card stretch stretch-full">
                <div class="card-body">

                    <div class="mb-4">
                        <label class="form-label">To</label>
                        <input type="text" class="form-control" name="to_name"
                            value="{{ old('to_name', $payment->to_name) }}">
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Address</label>
                        <input type="text" class="form-control" name="to_address"
                            value="{{ old('to_address', $payment->to_address) }}">
                    </div>

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Email</label>
                            <input type="text" class="form-control" name="to_email"
                                value="{{ old('to_email', $payment->to_email) }}">
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" name="to_phone"
                                value="{{ old('to_phone', $payment->to_phone) }}">
                        </div>
                    </div>

                    <hr class="my-5">

                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Currency</label>
                            <input type="text" class="form-control" name="currency"
                                value="{{ old('currency', $payment->currency) }}">
                        </div>

                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Status</label>
                            <select class="form-control" name="payment_status">
                                <option value="pending" {{ $payment->payment_status == 'pending' ? 'selected' : '' }}>
                                    Pending</option>
                                <option value="paid" {{ $payment->payment_status == 'paid' ? 'selected' : '' }}>Paid
                                </option>
                                <option value="failed" {{ $payment->payment_status == 'failed' ? 'selected' : '' }}>
                                    Failed</option>
                                <option value="cancelled"
                                    {{ $payment->payment_status == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <!-- ITEMS SECTION -->
        <div class="col-12">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="row">

                        <div class="col-lg-8">
                            <div class="table-responsive">
                                <table class="table table-bordered overflow-hidden" id="tab_logic">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Product</th>
                                            <th>Qty</th>
                                            <th>Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @if (!empty($payment->items))
                                            @foreach ($payment->items as $index => $item)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <input type="text" name="product[]" class="form-control"
                                                            value="{{ $item['product'] ?? '' }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="qty[]" class="form-control"
                                                            value="{{ $item['qty'] ?? 1 }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="price[]" class="form-control"
                                                            value="{{ $item['price'] ?? 0 }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="total[]" class="form-control"
                                                            value="{{ $item['total'] ?? 0 }}" readonly>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- TOTAL SECTION -->
                        <div class="col-lg-4">
                            <div class="table-responsive">
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <th>Sub Total</th>
                                            <td>
                                                <input type="number" name="sub_total"
                                                    class="form-control border-0 bg-transparent"
                                                    value="{{ $payment->sub_total }}" readonly>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Tax %</th>
                                            <td>
                                                <input type="number" name="tax_percentage"
                                                    class="form-control border-0 bg-transparent"
                                                    value="{{ $payment->tax_percentage }}">
                                            </td>
                                        </tr>

                                        <tr>
                                            <th>Tax Amount</th>
                                            <td>
                                                <input type="number" name="tax_amount"
                                                    class="form-control border-0 bg-transparent"
                                                    value="{{ $payment->tax_amount }}" readonly>
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="bg-gray-100">Grand Total</th>
                                            <td class="bg-gray-100">
                                                <input type="number" name="grand_total"
                                                    class="form-control border-0 bg-transparent fw-700"
                                                    value="{{ $payment->grand_total }}" readonly>
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

    </div>
</div>

<!-- [ Main Content ] end -->
@include('layouts.partials.admin.footer')
