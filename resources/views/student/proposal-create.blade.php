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
                        <input type="text" class="form-control" placeholder="Subject">
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Related <span class="text-danger">*</span></label>
                        <select class="form-control" data-select2-selector="icon">
                            <option value="lead" data-icon="feather-at-sign">Lead</option>
                            <option value="coustomer" data-icon="feather-users">Coustomer</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Lead <span class="text-danger">*</span></label>
                        <select class="form-select" data-select2-selector="user">
                            <option value="1" data-user="1">Alexandra Della - Website design and development
                            </option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Discount </label>
                        <select class="form-select" data-select2-selector="default">
                            <option value="">No Discount</option>
                            <option value="">Before Tax</option>

                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Visibility:</label>
                        <select class="form-select form-control" data-select2-selector="visibility">
                            <option value="public" data-icon="feather-globe">Public</option>
                            <option value="private" data-icon="feather-lock">Private</option>

                        </select>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Start <span class="text-danger">*</span></label>
                            <input class="form-control" id="startDate" placeholder="Pick start date ">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Due <span class="text-danger">*</span></label>
                            <input class="form-control" id="dueDate" placeholder="Pick due date">
                        </div>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Tags:</label>
                        <select class="form-select form-control" data-select2-selector="tag" multiple>
                            <option value="primary" data-bg="bg-primary">Team</option>
                            <option value="teal" data-bg="bg-teal">Primary</option>

                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Assignee:</label>
                        <select class="form-select form-control" data-select2-selector="user" multiple>
                            <option value="alex@outlook.com" data-user="1">alex@outlook.com</option>
                            <option value="john.deo@outlook.com" data-user="2">john.deo@outlook.com</option>

                        </select>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="mb-4">
                        <label class="form-label">To <span class="text-danger">*</span></label>
                        <select class="form-select form-control" data-select2-selector="user">
                            <option value="alex@outlook.com" data-user="1">alex@outlook.com</option>
                            <option value="john.deo@outlook.com" data-user="2">john.deo@outlook.com</option>

                        </select>
                    </div>
                    <div>
                        <label class="form-label">Address <span class="text-danger">*</span></label>
                        <div class="row">
                            <div class="col-lg-6 mb-4">
                                <input type="text" class="form-control mb-2" placeholder="Address Line 1">
                            </div>
                            <div class="col-lg-6 mb-4">
                                <input type="text" class="form-control" placeholder="Address Line 2">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Email <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Emial">
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Phone <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Phone">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Country <span class="text-danger">*</span></label>
                            <select class="form-control" data-select2-selector="country">
                                <option data-country="af">Afghanistan</option>
                                <option data-country="ax">Åland Islands</option>

                                <option data-country="ye">Yemen</option>
                                <option data-country="zm">Zambia</option>
                                <option data-country="zw">Zimbabwe</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">State</label>
                            <select class="form-control" data-select2-selector="state">
                                <option data-state="al">Alabama</option>
                                <option data-state="ak" selected>Alaska</option>

                                <option data-state="wi">Wisconsin</option>
                                <option data-state="wy">Wyoming</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">City </label>
                            <select class="form-control" data-select2-selector="city">
                                <option data-city="bg-primary">Akutan</option>

                                <option data-city="bg-cyan">Kodiak Island Borough</option>
                                <option data-city="bg-warning">Kodiak Station</option>
                                <option data-city="bg-darken">Kotzebue</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Timezone </label>
                            <select class="form-control" data-select2-selector="tzone">
                                <option data-tzone="feather-moon">(GMT -12:00) Eniwetok, Kwajalein</option>

                                <option data-tzone="feather-sun">(GMT +13:00) Apia, Nukualofa</option>
                                <option data-tzone="feather-sun">(GMT +14:00) Line Islands, Tokelau</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Currency</label>
                            <select class="form-control" data-select2-selector="currency">
                                <option data-currency="vu">VUV - Vanuatu Vatu - VT</option>
                            </select>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <label class="form-label">Status </label>
                            <select class="form-control" data-select2-selector="status">
                                <option value="teal" data-bg="bg-teal">Sent</option>
                            </select>
                        </div>
                    </div>
                    <hr class="my-5">
                    <div class="row mb-4">
                        <div class="form-check form-switch form-switch-sm ps-5">
                            <input class="form-check-input c-pointer" type="checkbox" id="commentSwitch">
                            <label class="form-check-label fw-500 text-dark c-pointer" for="commentSwitch">Allow
                                Comments</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card stretch stretch-full">
                <div class="card-body">
                    <div class="row">
                        <div class="col-lg-8">
                            <div class="mb-4">
                                <h5 class="fw-bold">Add Items:</h5>
                                <span class="fs-12 text-muted">Add items to proposal</span>
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
                                        <tr id="addr0">
                                            <td>1</td>
                                            <td><input type="text" name="product[]" placeholder="Product Name"
                                                    class="form-control"></td>
                                            <td><input type="number" name="qty[]" placeholder="Qty"
                                                    class="form-control qty" step="1" min="1"></td>
                                            <td><input type="number" name="price[]" placeholder="Unit Price"
                                                    class="form-control price" step="1.00"></td>
                                            <td><input type="number" name="total[]" placeholder="0.00"
                                                    class="form-control total" readonly=""></td>
                                        </tr>
                                        <tr id="addr1">
                                            <td>3</td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="d-flex justify-content-end gap-2 mt-3">
                                <button id="delete_row" class="btn btn-md bg-soft-danger text-danger">Delete</button>
                                <button id="add_row" class="btn btn-md btn-primary">Add Items</button>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-4">
                                <h5 class="fw-bold">Grand Total:</h5>
                                <span class="fs-12 text-muted">Grand total proposal</span>
                            </div>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tab_logic_total">
                                    <tbody>
                                        <tr class="single-item">
                                            <th class="fs-10 text-dark text-uppercase">Sub Total</th>
                                            <td class="w-25"><input type="number" name="sub_total"
                                                    placeholder="0.00"
                                                    class="form-control border-0 bg-transparent p-0" id="sub_total"
                                                    readonly=""></td>
                                        </tr>
                                        <tr class="single-item">
                                            <th class="fs-10 text-dark text-uppercase">Tax</th>
                                            <td class="w-25">
                                                <div class="input-group mb-2 mb-sm-0">
                                                    <input type="number"
                                                        class="form-control border-0 bg-transparent p-0"
                                                        id="tax" placeholder="0">
                                                    <div class="input-group-addon">%</div>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr class="single-item">
                                            <th class="fs-10 text-dark text-uppercase">Tax Amount</th>
                                            <td class="w-25"><input type="number" name="tax_amount"
                                                    id="tax_amount" placeholder="0.00"
                                                    class="form-control border-0 bg-transparent p-0" readonly="">
                                            </td>
                                        </tr>
                                        <tr class="single-item">
                                            <th class="fs-10 text-dark text-uppercase bg-gray-100">Grand Total</th>
                                            <td class="bg-gray-100 w-25"><input type="number" name="total_amount"
                                                    id="total_amount" placeholder="0.00"
                                                    class="form-control border-0 bg-transparent p-0 fw-700 text-dark"
                                                    readonly=""></td>
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
