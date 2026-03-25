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

            <!-- ================= FORM ================= -->
            <div class="card border-0 shadow-sm mb-4">
                <div class="card-header bg-light">
                    <h6 class="mb-0">
                        {{ isset($editItem) ? 'Update Gallery Item' : 'Add New Gallery Images' }}
                    </h6>
                </div>

                <div class="card-body">
                    <form
                        action="{{ isset($editItem) ? route('admin.updategallery', $editItem->id) : route('admin.storegallery') }}"
                        method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Image Upload -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Upload Image</label>

                            <input type="file" name="{{ isset($editItem) ? 'image' : 'image[]' }}"
                                class="form-control" {{ isset($editItem) ? '' : 'multiple' }}>
                        </div>

                        <!-- Preview -->
                        @if (isset($editItem))
                            <div class="mb-3">
                                <label class="form-label fw-semibold">Current Image</label><br>
                                <img src="{{ asset('storage/' . $editItem->image) }}" class="img-thumbnail rounded"
                                    width="150">
                            </div>
                        @endif

                        <!-- Description -->
                        <div class="mb-3">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control" rows="3" placeholder="Enter description...">{{ $editItem->description ?? '' }}</textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-save me-1"></i>
                                {{ isset($editItem) ? 'Update' : 'Save' }}
                            </button>

                            @if (isset($editItem))
                                <a href="{{ route('admin.listgallery') }}" class="btn btn-outline-secondary">
                                    Cancel
                                </a>
                            @endif
                        </div>

                    </form>
                </div>
            </div>

            <!-- ================= GALLERY ================= -->
            <div class="row g-4">

                @forelse ($gallery as $img)
                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                        <div class="card h-100 border-0 shadow-sm">

                            <!-- Image -->
                            <img src="{{ asset('storage/' . $img->image) }}" class="card-img-top rounded-top"
                                style="height:140px; object-fit:cover;">

                            <!-- Content -->
                            <div class="card-body p-2 text-center">

                                <!-- Description -->
                                <small class="text-muted d-block mb-2 text-truncate">
                                    {{ $img->description ?? 'No description' }}
                                </small>

                                <!-- Actions -->
                                <div class="d-flex justify-content-center gap-2">

                                    <!-- Edit -->
                                    <a href="{{ route('admin.editgallery', $img->id) }}"
                                        class="btn btn-sm btn-outline-primary" title="Edit">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.deletegallery', $img->id) }}" method="POST"
                                        onsubmit="return confirm('Delete this image?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-outline-danger" title="Delete">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>

                @empty
                    <div class="col-12">
                        <div class="alert alert-light text-center">
                            <i class="fa fa-image fa-2x mb-2 text-muted"></i>
                            <p class="mb-0">No gallery images found</p>
                        </div>
                    </div>
                @endforelse

            </div>

        </div>

    </div>

    <!-- [ Main Content ] end -->
</main>
@include('layouts.partials.admin.theme')
