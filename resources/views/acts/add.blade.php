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
                                    <label class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Subcategory -->
                                <div class="mb-3">
                                    <label class="form-label">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-select" required>
                                        <option value="">Select Subcategory</option>
                                    </select>
                                </div>

                                <!-- PDFs -->
                                <div class="mb-3">
                                    <label class="form-label">Uploaded PDFs</label>
                                    <input type="file" name="pdfs[]" class="form-control" multiple>
                                    @if(!empty($act->pdfs))
                                    <ul class="list-group">
                                        @foreach($act->pdfs as $key => $file)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                            <!-- File Name -->
                                            <span>{{ basename($file) }}</span>

                                            <div>
                                                <!-- View Button -->
                                                <a href="{{ asset('storage/app/public/' . $file) }}" target="_blank" class="btn btn-sm btn-info">
                                                    View
                                                </a>

                                                <!-- Delete Button -->
                                                <form action="{{ route('admin.deleteaddfile', [$act->id, $key]) }}"
                                                    method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure you want to delete this PDF?')">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>

                                        </li>
                                        @endforeach
                                    </ul>
                                    @else
                                    <p>No PDFs uploaded.</p>
                                    @endif
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Button Name</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <button class="btn btn-primary">Add Acts</button>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const categories = JSON.parse('@json($categories)'.replace(/&quot;/g, '"'));
                                    const categorySelect = document.getElementById('category_id');
                                    const subcategorySelect = document.getElementById('subcategory_id');

                                    function populateSubcategories(catId, selectedSub = null) {
                                        subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
                                        const cat = categories.find(c => c.id == catId);
                                        if (cat && cat.subcategories) {
                                            cat.subcategories.forEach(sub => {
                                                const opt = document.createElement('option');
                                                opt.value = sub.id;
                                                opt.textContent = sub.name;
                                                if (sub.id == selectedSub) opt.selected = true;
                                                subcategorySelect.appendChild(opt);
                                            });
                                        }
                                    }

                                    const oldCat = "{{ old('category_id') }}";
                                    const oldSub = "{{ old('subcategory_id') }}";

                                    if (oldCat) populateSubcategories(oldCat, oldSub);

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