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
                            <h5 class="mb-0">
                                {{ isset($editItem) ? 'Update Gallery Item' : 'Add New Gallery Images' }}
                            </h5>
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

                                <!-- GROUP -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Select Group</label>

                                    <select name="group_name" class="form-control">
                                        <option value="">-- Select Group --</option>
                                        @foreach ($groups as $group)
                                        <option value="{{ $group }}"
                                            {{ (isset($editItem) && $editItem->group_name == $group) ? 'selected' : '' }}>
                                            {{ $group }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Or Create New Group</label>
                                    <input type="text" name="new_group" class="form-control" placeholder="Enter new group name">
                                </div>

                                <!-- Preview -->
                                @if (isset($editItem))
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Current Image</label><br>
                                    <img src="{{ asset('storage/app/public/' . $editItem->image) }}"
                                        class="img-thumbnail rounded" width="150">
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

                        @forelse ($gallery as $groupName => $images)

                        <!-- GROUP TITLE -->
                        <div class="col-12">
                            <h5 class="mt-4 mb-3 text-primary">
                                {{ $groupName ?? 'Ungrouped' }}
                            </h5>
                        </div>

                        @foreach ($images as $img)
                        <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                            <div class="card h-100 border-0 shadow-sm">

                                <img src="{{ asset('storage/app/public/' . $img->image) }}"
                                    class="card-img-top rounded-top" style="height:140px; object-fit:cover;">

                                <div class="card-body p-2 text-center">

                                    <small class="text-muted d-block mb-2 text-truncate">
                                        {{ $img->description ?? 'No description' }}
                                    </small>

                                    <div class="d-flex justify-content-center gap-2">

                                        <a href="{{ route('admin.editgallery', $img->id) }}"
                                            class="btn btn-sm btn-outline-primary">
                                            <i class="fa fa-edit"></i>
                                        </a>

                                        <form action="{{ route('admin.deletegallery', $img->id) }}" method="POST"
                                            onsubmit="return confirm('Delete this image?')">
                                            @csrf
                                            @method('DELETE')

                                            <button class="btn btn-sm btn-outline-danger">
                                                <i class="fa fa-trash"></i>
                                            </button>
                                        </form>

                                    </div>

                                </div>

                            </div>

                        </div>
                        @endforeach

                        @empty
                        <div class="col-12 text-center">
                            No gallery images found
                        </div>
                        @endforelse

                    </div>

                </div>

            </div>

        </div>
    </div>
</main>
@include('layouts.partials.admin.theme')