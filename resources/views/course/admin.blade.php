@php
$setting = $admin ? $admin->first() : null;
@endphp

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
                    <li class="breadcrumb-item">Admin</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Admin Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.updatedetails', $admin->id ?? 1) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Images</label>

                                    <input type="file" name="image" class="form-control">

                                    @if (!empty($admin->image))
                                    <img src="{{ asset('storage/app/public/' . $admin->image) }}" width="120"
                                        class="mt-2">
                                    @endif

                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Description</label>

                                    <textarea name="description" class="form-control" rows="3">{{ $admin->description ?? '' }}</textarea>

                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Name</label>

                                    <input type="text" name="name" class="form-control"
                                        value="{{ $admin->name ?? '' }}" placeholder="Name">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Mobile</label>

                                    <input type="text" name="mobile" class="form-control"
                                        value="{{ $admin->mobile ?? '' }}" placeholder="Mobile">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Email</label>

                                    <input type="email" name="webemail" class="form-control"
                                        value="{{ $admin->webemail ?? '' }}" placeholder="Email">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Address</label>

                                    <input type="text" name="webaddress" class="form-control"
                                        value="{{ $admin->webaddress ?? '' }}" placeholder="Website">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Center Address</label>

                                    <textarea name="centerone" value="{{ $admin->centerone ?? '' }}" class="form-control" placeholder="Website">{{ $admin->centerone ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Center Two Address</label>

                                    <textarea name="centertwo" value="{{ $admin->centertwo ?? '' }}" class="form-control" placeholder="Website">{{ $admin->centertwo ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Terms & Conditions</label>

                                    <textarea name="terms" value="{{ $admin->terms ?? '' }}" class="form-control" placeholder="Website">{{ $admin->terms ?? '' }}</textarea>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Accountant Signature</label>

                                    <input type="file" name="accsign" class="form-control">

                                    @if (!empty($admin->accsign))
                                    <img src="{{ asset('storage/app/public/' . $admin->accsign) }}" width="120"
                                        class="mt-2">
                                    @endif

                                </div>


                                <div class="mb-3">
                                    <label class="form-label">LinkedIn</label>

                                    <input type="text" name="linkedin" class="form-control"
                                        value="{{ $admin->linkedin ?? '' }}" placeholder="LinkedIn">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Facebook Link</label>

                                    <input type="text" name="facebook" class="form-control"
                                        value="{{ $admin->facebook ?? '' }}" placeholder="Facebook">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Instagram Link</label>

                                    <input type="text" name="instagram" class="form-control"
                                        value="{{ $admin->instagram ?? '' }}" placeholder="Instagram">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Pinterest Link</label>

                                    <input type="text" name="pinterest" class="form-control"
                                        value="{{ $admin->pinterest ?? '' }}" placeholder="Pinterest">
                                </div>


                                <div class="mb-3">
                                    <label class="form-label">Twitter Link</label>

                                    <input type="text" name="twitter" class="form-control"
                                        value="{{ $admin->twitter ?? '' }}" placeholder="Twitter">
                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Default Password</label>
                                    <input type="text" name="defaultpass" class="form-control"
                                        value="{{ $admin->defaultpass ?? '' }}" placeholder="Default Password">
                                </div>


                                <button type="submit" class="btn btn-primary">
                                    Update
                                </button>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')