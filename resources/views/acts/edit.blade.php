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
                    <li class="breadcrumb-item">Edit Acts</li>
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
                           <form action="{{ route('admin.updateacts', $acts->id) }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- Category -->
    <div class="mb-3">
        <label for="category_id" class="form-label">Category</label>
        <select name="category_id" id="category_id" class="form-select" required>
            <option value="">Select Category</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $acts->category_id == $category->id ? 'selected' : '' }}>
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
            @foreach($subcategories as $sub)
                <option value="{{ $sub->id }}" {{ $acts->subcategory_id == $sub->id ? 'selected' : '' }}>
                    {{ $sub->name }}
                </option>
            @endforeach
        </select>
        @error('subcategory_id')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Existing PDFs -->
    @php
        $pdfs = json_decode($acts->pdfs, true) ?: [$acts->pdfs];
    @endphp
    @if (!empty($pdfs))
        <div class="mb-3">
            <label class="form-label">Existing PDF(s)</label>
            @foreach($pdfs as $file)
                <div class="mb-1">
                    <a href="{{ asset('storage/' . $file) }}" target="_blank">{{ pathinfo($file, PATHINFO_BASENAME) }}</a>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Upload new PDFs -->
    <div class="mb-3">
        <label for="pdfs" class="form-label">Upload PDF(s)</label>
        <input type="file" name="pdfs[]" id="pdfs" class="form-control" multiple>
        @error('pdfs.*')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <!-- Description -->
    <div class="mb-3">
        <label for="description" class="form-label">Button Name / Description</label>
        <textarea name="description" id="description" class="form-control" rows="3">{{ old('description', $acts->description) }}</textarea>
        @error('description')
            <small class="text-danger">{{ $message }}</small>
        @enderror
    </div>

    <div class="d-flex justify-content-end">
        <button type="submit" class="btn btn-primary">Update acts</button>
    </div>
</form>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const categories = JSON.parse('@json($categories)'.replace(/&quot;/g,'"'));
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');

        categorySelect.addEventListener('change', function() {
            subcategorySelect.innerHTML = '<option value="">Select Subcategory</option>';
            const selectedCategory = categories.find(c => c.id == this.value);
            if (selectedCategory && selectedCategory.subcategories) {
                selectedCategory.subcategories.forEach(sub => {
                    const option = document.createElement('option');
                    option.value = sub.id;
                    option.textContent = sub.name;
                    subcategorySelect.appendChild(option);
                });
            }
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
