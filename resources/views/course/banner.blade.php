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
        <div class="card shadow-sm border-0">
            <div class="card-header text-white">
                <h5 class="mb-0">banner Settings</h5>
            </div>

            <div class="card-body">
                <form action="{{ route('admin.storebanner') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <input type="hidden" name="banner_id" value="{{ $banner->id ?? '' }}">
                    <div class="mb-3">
                        <label class="form-label">Banner Image</label>
                        <input type="file" name="image" class="form-control">

                        @if (isset($banner) && $banner->image)
                            <div class="mt-2">
                                <img src="{{ asset('storage/' . $banner->image) }}" width="150"
                                    class="img-thumbnail">
                            </div>
                        @endif
                    </div>

                    <div class="d-flex justify-content-end">
                        <button type="submit" class="btn btn-primary">
                            Save Banner
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
