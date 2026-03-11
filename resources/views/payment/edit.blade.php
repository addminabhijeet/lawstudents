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

                    <div class="col-xl-12">
                        <div class="card invoice-container">
                            <div class="card-body p-0">
                                <div class="px-4 pt-4">
                                    <div class="d-md-flex align-items-center justify-content-between">

                                        <div class="d-md-flex align-items-center justify-content-end gap-4">
                                            <div class="form-group mb-3 mb-md-0">
                                                <label class="form-label">Issue Date:</label>
                                                <input id="issueDate" class="form-control" name="issue_date"
                                                    value="{{ old('issue_date', optional($payment->issue_date)->format('Y-m-d')) }}">
                                            </div>
                                            <div class="form-group">
                                                <label class="form-label">Due Date:</label>
                                                <input id="dueDate" class="form-control" name="due_date"
                                                    value="{{ old('due_date', optional($payment->due_date)->format('Y-m-d')) }}">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-dashed">
                                <div class="px-4 row justify-content-between">
                                    <div class="col-xl-3">
                                        <div class="form-group mb-3">
                                            <label for="InvoiceLabel" class="form-label">Invoice Label</label>
                                            <input type="text" class="form-control" name="invoice_label"
                                                value="{{ old('invoice_label', $payment->invoice_label) }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-3">
                                        <div class="form-group mb-3">
                                            <label for="InvoiceNumber" class="form-label">Invoice Number</label>
                                            <input type="text" class="form-control" name="invoice_number"
                                                value="{{ old('invoice_number', $payment->invoice_number) }}">
                                        </div>
                                    </div>
                                    <div class="col-xl-6">
                                        <div class="form-group mb-3">
                                            <label for="InvoiceProduct" class="form-label">Invoice Product</label>
                                            <input type="text" class="form-control" name="invoice_product"
                                                value="{{ old('invoice_product', $payment->invoice_product) }}">
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-dashed">
                                <div class="row px-4 justify-content-between">
                                    <div class="col-xl-5 mb-4 mb-sm-0">
                                        <div class="mb-4">
                                            <h6 class="fw-bold">Invoice From:</h6>
                                            <span class="fs-12 text-muted">Send an invoice and get paid</span>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="InvoiceName" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="from_name"
                                                    value="{{ old('from_name', $payment->from_name) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="InvoiceEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="from_email"
                                                    value="{{ old('from_email', $payment->from_email) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="InvoicePhone" class="col-sm-3 col-form-label">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="from_phone"
                                                    value="{{ old('from_phone', $payment->from_phone) }}">

                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="InvoiceAddress"
                                                class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea rows="5" class="form-control" name="from_address">{{ old('from_address', $payment->from_address) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xl-5">
                                        <div class="mb-4">
                                            <h6 class="fw-bold">Invoice To:</h6>
                                            <span class="fs-12 text-muted">Send an invoice and get paid</span>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="ClientName" class="col-sm-3 col-form-label">Name</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="to_name"
                                                    value="{{ old('to_name', $payment->to_name) }}">

                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="ClientEmail" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="to_email"
                                                    value="{{ old('to_email', $payment->to_email) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row mb-3">
                                            <label for="ClientPhone" class="col-sm-3 col-form-label">Phone</label>
                                            <div class="col-sm-9">
                                                <input type="text" class="form-control" name="to_phone"
                                                    value="{{ old('to_phone', $payment->to_phone) }}">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="ClientAddress" class="col-sm-3 col-form-label">Address</label>
                                            <div class="col-sm-9">
                                                <textarea rows="5" class="form-control" name="to_address">{{ old('to_address', $payment->to_address) }}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <hr class="border-dashed">
                                <div class="px-4 clearfix">
                                    <div class="mb-4 d-flex align-items-center justify-content-between">
                                        <div>
                                            <h6 class="fw-bold">Add Items:</h6>
                                            <span class="fs-12 text-muted">Add items to invoice</span>
                                        </div>
                                        <div class="avatar-text avatar-sm" data-bs-toggle="tooltip"
                                            data-bs-trigger="hover" title="Informations">
                                            <i class="feather feather-info"></i>
                                        </div>
                                    </div>
                                    <div class="table-responsive">
                                        <table class="table table-bordered overflow-hidden" id="tab_logic">
                                            <thead>
                                                <tr class="single-item">
                                                    <th class="text-center">#</th>
                                                    <th class="text-center wd-450">Product</th>
                                                    <th class="text-center wd-150">Qty</th>
                                                    <th class="text-center wd-150">Price</th>
                                                    <th class="text-center wd-150">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $items = old('items', $payment->items ?? []); @endphp

                                                @foreach ($items as $index => $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        <td>
                                                            <input type="text"
                                                                name="items[{{ $index }}][product]"
                                                                class="form-control"
                                                                value="{{ $item['product'] ?? '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="number"
                                                                name="items[{{ $index }}][qty]"
                                                                class="form-control qty"
                                                                value="{{ $item['qty'] ?? 1 }}">
                                                        </td>

                                                        <td>
                                                            <input type="number"
                                                                name="items[{{ $index }}][price]"
                                                                class="form-control price"
                                                                value="{{ $item['price'] ?? 0 }}">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control total" readonly
                                                                value="{{ $item['total'] ?? 0 }}">
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>

                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end gap-2 mt-3">
                                        <button id="delete_row"
                                            class="btn btn-sm bg-soft-danger text-danger">Delete</button>
                                        <button id="add_row" class="btn btn-sm btn-primary">Add Items</button>
                                    </div>
                                </div>
                                <hr class="border-dashed">
                                <div class="px-4 pb-4">
                                    <div class="form-group">
                                        <label for="InvoiceNote" class="form-label">Invoice Note:</label>
                                        <textarea rows="6" name="invoice_note" class="form-control">{{ old('invoice_note', $payment->invoice_note) }}</textarea>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 text-end">
                        <button type="submit" class="btn btn-primary">Update Payment</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
