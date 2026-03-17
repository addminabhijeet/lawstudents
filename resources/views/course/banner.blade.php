@php
    $setting = $banner ? $banner->first() : null;
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
                    <li class="breadcrumb-item">Banner</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Banner Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.storebanner') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">

                                <div class="row">

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 1 (1425 X 600)</label>
                                        <input type="file" name="image_1" class="form-control">

                                        @if ($banner && $banner->image_1)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/app/public/' . $banner->image_1) }}"
                                                    width="150">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 2 (1425 X 600)</label>
                                        <input type="file" name="image_2" class="form-control">

                                        @if ($banner && $banner->image_2)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/app/public/' . $banner->image_2) }}"
                                                    width="150">
                                            </div>
                                        @endif
                                    </div>

                                    <div class="col-md-4 mb-3">
                                        <label class="form-label">Banner Image 3 (1425 X 600)</label>
                                        <input type="file" name="image_3" class="form-control">

                                        @if ($banner && $banner->image_3)
                                            <div class="mt-2">
                                                <img src="{{ asset('storage/app/public/' . $banner->image_3) }}"
                                                    width="150" class="img-thumbnail">
                                            </div>
                                        @endif
                                    </div>

                                </div>

                                <div class="text-end mt-3">
                                    <button type="submit" class="btn btn-primary">
                                        Save Banner
                                    </button>
                                </div>

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
