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

                    @foreach ($allPayments as $pIndex => $payment)
                        <input type="hidden" name="payments[{{ $pIndex }}][id]" value="{{ $payment->id }}">

                        <div class="col-xl-12 mb-4">
                            <div class="card invoice-container">
                                <div class="card-body p-0">

                                    <!-- HEADER -->
                                    <div class="px-4 pt-4">
                                        <h5 class="fw-bold text-primary">Payment #{{ $payment->invoice_number }}</h5>

                                        <div class="d-md-flex justify-content-end gap-4">
                                            <div class="form-group">
                                                <label>Issue Date:</label>
                                                <input class="form-control"
                                                    name="payments[{{ $pIndex }}][issue_date]"
                                                    value="{{ optional($payment->issue_date)->format('Y-m-d') }}">
                                            </div>

                                            <div class="form-group">
                                                <label>Due Date:</label>
                                                <input class="form-control"
                                                    name="payments[{{ $pIndex }}][due_date]"
                                                    value="{{ optional($payment->due_date)->format('Y-m-d') }}">
                                            </div>
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- BASIC INFO -->
                                    <div class="px-4 row">
                                        <div class="col-xl-4">
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][invoice_label]"
                                                value="{{ $payment->invoice_label }}">
                                        </div>

                                        <div class="col-xl-4">
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][invoice_number]"
                                                value="{{ $payment->invoice_number }}">
                                        </div>

                                        <div class="col-xl-4">
                                            <input type="text" class="form-control"
                                                name="payments[{{ $pIndex }}][invoice_product]"
                                                value="{{ $payment->invoice_product }}">
                                        </div>
                                    </div>

                                    <hr>

                                    <!-- ITEMS -->
                                    <div class="px-4">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Product</th>
                                                    <th>Qty</th>
                                                    <th>Price</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php $items = $payment->items ?? []; @endphp

                                                @foreach ($items as $i => $item)
                                                    <tr>
                                                        <td>{{ $loop->iteration }}</td>

                                                        <td>
                                                            <input type="text"
                                                                name="payments[{{ $pIndex }}][items][{{ $i }}][product]"
                                                                class="form-control"
                                                                value="{{ $item['product'] ?? '' }}">
                                                        </td>

                                                        <td>
                                                            <input type="number"
                                                                name="payments[{{ $pIndex }}][items][{{ $i }}][qty]"
                                                                class="form-control" value="{{ $item['qty'] ?? 1 }}">
                                                        </td>

                                                        <td>
                                                            <input type="number"
                                                                name="payments[{{ $pIndex }}][items][{{ $i }}][price]"
                                                                class="form-control" value="{{ $item['price'] ?? 0 }}">
                                                        </td>
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
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
@include('layouts.partials.admin.theme')
