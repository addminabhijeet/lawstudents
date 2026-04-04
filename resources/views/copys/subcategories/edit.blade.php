@include('layouts.partials.admin.dashboard')
<main class="nxl-container">
    <div class="nxl-content">
        <!-- [ page-header ] start -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Free Notes Subcategories</li>
                    <li class="breadcrumb-item">Edit</li>
                </ul>
            </div>
            <div class="page-header-right ms-auto">
                <div class="page-header-right-items">
                    <!-- Existing header buttons remain unchanged -->
                </div>
            </div>
        </div>
        <!-- [ page-header ] end -->

        <!-- [ Main Content ] start -->
        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card stretch stretch-full">
                        <div class="card-body">
                            <form action="{{ route('admin.updatecopysubcategory', $subcategories->id) }}" method="POST">
                                @csrf
                               

                                <div class="mb-3">
                                    <label for="copy_category_id" class="form-label">Select Category</label>
                                    <select name="copy_category_id" id="copy_category_id" class="form-control">
                                        @foreach($categories as $categories)
                                        <option value="{{ $categories->id }}" {{ old('copy_category_id', $subcategories->copy_category_id) == $categories->id ? 'selected' : '' }}>
                                            {{ $categories->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('copy_category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="name" class="form-label">Subcategory Name</label>
                                    <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $subcategories->name) }}">
                                    @error('name')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Update Subcategory</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>
@include('layouts.partials.admin.theme')