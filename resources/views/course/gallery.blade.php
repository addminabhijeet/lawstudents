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
                    <li class="breadcrumb-item">Gallery</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full shadow-sm border-0">

                        <div class="card-header text-white">
                            <h5 class="mb-0">Gallery Settings</h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ route('admin.storegallery') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf

                                <div class="mb-3">
                                    <label class="form-label">Gallery Images</label>

                                    <input type="file" name="image[]" class="form-control" multiple>

                                </div>

                                <div class="mb-3">
                                    <label class="form-label">Description</label>

                                    <textarea name="description" class="form-control" rows="3" placeholder="Enter image description"></textarea>

                                </div>

                                <button type="submit" class="btn btn-primary">
                                    Save Gallery
                                </button>

                            </form>
                        </div>

                    </div>
                </div>
            </div>
            <div class="row mt-4">
                @foreach (\App\Models\Gallery::latest()->get() as $img)
                    <div class="col-md-2 mb-3 text-center">

                        <img src="{{ asset('storage/app/public/' . $img->image) }}" class="img-thumbnail"
                            style="width:100%; height:120px; object-fit:cover;">

                        @if ($img->description)
                            <small class="d-block mt-1 text-muted">
                                {{ $img->description }}
                            </small>
                        @endif

                    </div>
                @endforeach

            </div>
        </div>

    </div>

    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
