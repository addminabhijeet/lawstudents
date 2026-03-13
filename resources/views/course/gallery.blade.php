@php
    $setting = $gallery ? $gallery->first() : null;
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
                            <form action="{{ route('admin.storegallery') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <input type="hidden" name="gallery_id" value="{{ $gallery->id ?? '' }}">

                                <div class="mb-3">
                                    <label class="form-label">Gallery Image</label>
                                    <input type="file" name="image_1" class="form-control">

                                    @if ($gallery && $gallery->image)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $gallery->image_1) }}" width="150"
                                                class="img-thumbnail">
                                        </div>
                                    @endif
                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Save Gallery
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
