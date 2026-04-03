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
                    <li class="breadcrumb-item">Acts</li>
                    <li class="breadcrumb-item">Add Acts</li>
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
                            <form action="{{ route('admin.storeacts') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                <!-- Category -->
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Subcategory -->
                                <div class="mb-3">
                                    <label for="subcategory_id" class="form-label">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                    @error('subcategory_id')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Upload PDF(s) -->
                                <div class="mb-3">
                                    <label for="pdf" class="form-label">Upload PDF</label>
                                    <input type="file" name="pdf[]" id="pdf" class="form-control" multiple>
                                    @error('pdf')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                    @error('pdf.*')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Button Name</label>
                                    <textarea name="description" id="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                                    @error('description')
                                    <small class="text-danger">{{ $message }}</small>
                                    @enderror
                                </div>

                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary">Add acts</button>
                                </div>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const categories = JSON.parse('@json($categories)'.replace(/&quot;/g, '"'));
                                    const categorySelect = document.getElementById('category_id');
                                    const subcategorySelect = document.getElementById('subcategory_id');

                                    function populateSubcategories(selectedCategoryId, selectedSubcategoryId = null) {
                                        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                                        const category = categories.find(c => c.id == selectedCategoryId);
                                        if (category && category.subcategories) {
                                            category.subcategories.forEach(sub => {
                                                const option = document.createElement('option');
                                                option.value = sub.id;
                                                option.textContent = sub.name;
                                                if (sub.id == selectedSubcategoryId) option.selected = true;
                                                subcategorySelect.appendChild(option);
                                            });
                                        }
                                    }

                                    // Populate on page load if old values exist (after validation error)
                                    const oldCategoryId = "{{ old('category_id') }}";
                                    const oldSubcategoryId = "{{ old('subcategory_id') }}";
                                    if (oldCategoryId) {
                                        populateSubcategories(oldCategoryId, oldSubcategoryId);
                                    }

                                    // Populate dynamically on change
                                    categorySelect.addEventListener('change', function() {
                                        populateSubcategories(this.value);
                                    });
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>