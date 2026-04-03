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
                    <li class="breadcrumb-item">Rules</li>
                    <li class="breadcrumb-item">Add Rules</li>
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
                            <form action="{{ route('admin.storerules') }}" method="POST" enctype="multipart/form-data">
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

                                <!-- PDFs Upload -->
                                <div class="mb-3">
                                    <label class="form-label">Upload PDFs</label>

                                    <input type="file" name="pdfs[]" id="pdfInput" class="form-control" multiple>

                                    <ul id="previewList" class="list-group mt-3"></ul>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Button Name / Description</label>
                                    <textarea name="description" class="form-control">{{ old('description') }}</textarea>
                                </div>

                                <button class="btn btn-primary">Add Rules</button>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>

<script>
    let selectedFiles = [];

    const input = document.getElementById('pdfInput');
    const previewList = document.getElementById('previewList');
    const form = input.closest('form');

    input.addEventListener('change', function(e) {
        selectedFiles = [...selectedFiles, ...Array.from(e.target.files)];
        renderList();
        input.value = '';
    });

    function renderList() {
        previewList.innerHTML = '';

        selectedFiles.forEach((file, index) => {
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';

            li.innerHTML = `
                <span>${file.name}</span>
                <button type="button" class="btn btn-sm btn-danger" onclick="removeFile(${index})">
                    Remove
                </button>
            `;

            previewList.appendChild(li);
        });
    }

    function removeFile(index) {
        selectedFiles.splice(index, 1);
        renderList();
    }

    // Attach files before submit
    form.addEventListener('submit', function() {
        const dataTransfer = new DataTransfer();

        selectedFiles.forEach(file => {
            dataTransfer.items.add(file);
        });

        input.files = dataTransfer.files;
    });
</script>
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