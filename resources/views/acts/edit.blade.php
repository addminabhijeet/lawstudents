@include('layouts.partials.admin.dashboard')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif
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
                                    <label class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ old('category_id', $acts->category_id) == $category->id ? 'selected' : '' }}>
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

                                <!-- Existing PDFs -->
                                @if (!empty($acts->pdfs))
                                <div class="mb-3">
                                    <label class="form-label">Existing PDFs</label>
                                    <ul class="list-group">
                                        @foreach ($acts->pdfs as $index => $pdf)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                            <!-- File Name -->
                                            <a href="{{ asset('storage/' . $pdf) }}" target="_blank">
                                                {{ pathinfo($pdf, PATHINFO_BASENAME) }}
                                            </a>

                                            <!-- Delete -->
                                            <form action="{{ route('admin.deleteaddfile', [$acts->id, $index]) }}"
                                                method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-danger"
                                                    onclick="return confirm('Delete this PDF?')">
                                                    Remove
                                                </button>
                                            </form>

                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <!-- Upload New PDFs -->
                                <div class="mb-3">
                                    <label class="form-label">Upload More PDFs</label>
                                    <input type="file" name="pdfs[]" id="pdfInput" class="form-control" multiple>

                                    <ul id="previewList" class="list-group mt-3"></ul>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Button Name / Description</label>
                                    <textarea name="description" class="form-control">{{ old('description', $acts->description) }}</textarea>
                                </div>

                                <button class="btn btn-primary">Update Acts</button>
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
    document.addEventListener('DOMContentLoaded', function() {

        console.log("=== DEBUG START ===");

        /* =========================
           SAFE ELEMENT SELECTION
        ========================== */

        const form = document.querySelector('form');
        const input = document.getElementById('pdfInput');
        const previewList = document.getElementById('previewList');
        const categorySelect = document.getElementById('category_id');
        const subcategorySelect = document.getElementById('subcategory_id');

        if (!form) {
            console.error("FORM NOT FOUND ❌");
            return;
        }

        if (!input) {
            console.error("FILE INPUT NOT FOUND ❌");
            return;
        }

        console.log("Form Found ✅");

        /* =========================
           FILE UPLOAD LOGIC
        ========================== */

        let selectedFiles = [];

        input.addEventListener('change', function(e) {
            console.log("Files Selected:", e.target.files);

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

        window.removeFile = function(index) {
            selectedFiles.splice(index, 1);
            renderList();
        };

        /* =========================
           FORM SUBMIT DEBUG
        ========================== */

        form.addEventListener('submit', function() {

            console.log("Form Submitted ✅");

            const dataTransfer = new DataTransfer();

            selectedFiles.forEach(file => {
                dataTransfer.items.add(file);
            });

            input.files = dataTransfer.files;

            const formData = new FormData(form);

            console.log("---- FORM DATA ----");

            for (let [key, value] of formData.entries()) {
                console.log(key, value);
            }

            console.log("Selected Files Count:", input.files.length);
        });

        /* =========================
           CATEGORY → SUBCATEGORY
        ========================== */

        const categories = JSON.parse('@json($categories)'.replace(/&quot;/g, '"'));

        console.log("Categories Loaded:", categories);

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

        const oldCat = "{{ old('category_id', $acts->category_id) }}";
        const oldSub = "{{ old('subcategory_id', $acts->subcategory_id) }}";

        if (oldCat) populateSubcategories(oldCat, oldSub);

        categorySelect.addEventListener('change', function() {
            console.log("Selected Category:", this.value);
            populateSubcategories(this.value);
        });

    });
</script>