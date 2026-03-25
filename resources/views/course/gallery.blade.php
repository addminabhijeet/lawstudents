@include('layouts.partials.admin.dashboard')

<main class="nxl-container">
    <div class="nxl-content">

        <!-- Header -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Gallery</li>
                    <li class="breadcrumb-item">Manage</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row">

                <!-- ================= ADD / UPDATE FORM ================= -->
                <div class="col-lg-12">
                    <div class="card shadow-sm border-0">
                        <div class="card-header text-white">
                            <h5 class="mb-0">
                                {{ isset($editItem) ? 'Update Gallery' : 'Add Gallery' }}
                            </h5>
                        </div>

                        <div class="card-body">
                            <form action="{{ isset($editItem) ? route('admin.updategallery', $editItem->id) : route('admin.storegallery') }}"
                                  method="POST"
                                  enctype="multipart/form-data">
                                @csrf

                                @if(isset($editItem))
                                    @method('POST')
                                @endif

                                <!-- Image -->
                                <div class="mb-3">
                                    <label class="form-label">Gallery Images</label>

                                    <input type="file"
                                           name="{{ isset($editItem) ? 'image' : 'image[]' }}"
                                           class="form-control"
                                           {{ isset($editItem) ? '' : 'multiple' }}>
                                </div>

                                <!-- Preview (Edit Mode) -->
                                @if(isset($editItem))
                                    <div class="mb-3">
                                        <img src="{{ asset('storage/' . $editItem->image) }}"
                                             width="120"
                                             class="img-thumbnail">
                                    </div>
                                @endif

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Description</label>

                                    <textarea name="description"
                                              class="form-control"
                                              rows="3"
                                              placeholder="Enter image description">{{ $editItem->description ?? '' }}</textarea>
                                </div>

                                <!-- Buttons -->
                                <button type="submit" class="btn btn-primary">
                                    {{ isset($editItem) ? 'Update' : 'Save' }}
                                </button>

                                @if(isset($editItem))
                                    <a href="{{ route('admin.listgallery') }}" class="btn btn-secondary">
                                        Cancel
                                    </a>
                                @endif

                            </form>
                        </div>
                    </div>
                </div>

            </div>

            <!-- ================= GALLERY LIST ================= -->
            <div class="row mt-4">

                @forelse ($gallery as $img)
                    <div class="col-md-2 mb-4">

                        <div class="card shadow-sm border-0">

                            <img src="{{ asset('storage/' . $img->image) }}"
                                 class="card-img-top"
                                 style="height:120px; object-fit:cover;">

                            <div class="card-body text-center p-2">

                                @if ($img->description)
                                    <small class="d-block text-muted mb-2">
                                        {{ $img->description }}
                                    </small>
                                @endif

                                <div class="d-flex justify-content-center gap-1">

                                    <!-- EDIT -->
                                    <a href="{{ route('admin.editgallery', $img->id) }}"
                                       class="btn btn-sm btn-primary">
                                        <i class="fa fa-edit"></i>
                                    </a>

                                    <!-- DELETE -->
                                    <form action="{{ route('admin.deletegallery', $img->id) }}"
                                          method="POST"
                                          onsubmit="return confirm('Delete this image?')">
                                        @csrf
                                        @method('DELETE')

                                        <button class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </button>
                                    </form>

                                </div>

                            </div>

                        </div>

                    </div>
                @empty
                    <div class="col-12 text-center">
                        <p>No Gallery Images Found</p>
                    </div>
                @endforelse

            </div>

        </div>
    </div>
</main>

@include('layouts.partials.admin.theme')