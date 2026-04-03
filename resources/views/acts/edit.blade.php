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
                                @method('PUT')

                                <!-- Category -->
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select">
                                        @foreach($categories as $category)
                                        <option value="{{ $category->id }}" {{ old('category_id', $acts->category_id) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>

                                <!-- Subcategory -->
                                <div class="mb-3">
                                    <label class="form-label">Subcategory</label>
                                    <select name="subcategory_id" id="subcategory_id" class="form-select"></select>
                                </div>

                                <!-- Existing PDFs -->
                                @if(!empty($acts->pdfs) && count($acts->pdfs))
                                <div class="mb-3">
                                    <label class="form-label">Existing PDFs</label>

                                    <ul class="list-group">
                                        @foreach($acts->pdfs as $key => $file)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">

                                            <span>{{ basename($file) }}</span>

                                            <div>
                                                <!-- View -->
                                                <a href="{{ asset('storage/app/public/' . $file) }}" target="_blank" class="btn btn-sm btn-info">
                                                    View
                                                </a>

                                                <!-- Delete -->
                                                <form action="{{ route('admin.deleteaddfile', [$acts->id, $key]) }}"
                                                    method="POST"
                                                    style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')

                                                    <button type="submit" class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Delete this PDF?')">
                                                        Remove
                                                    </button>
                                                </form>
                                            </div>

                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif

                                <!-- Upload New PDFs -->
                                <div class="mb-3">
                                    <label class="form-label">Add More PDFs</label>

                                    <input type="file" name="pdfs[]" id="pdfInput" class="form-control" multiple>

                                    <!-- Preview List -->
                                    <ul id="previewList" class="list-group mt-3"></ul>
                                </div>



                                <!-- Description -->
                                <div class="mb-3">
                                    <textarea name="description" class="form-control">{{ old('description', $acts->description) }}</textarea>
                                </div>

                                <button class="btn btn-primary">Update</button>
                            </form>

                            <script>
                                document.addEventListener('DOMContentLoaded', function() {
                                    const categories = JSON.parse('@json($categories)'.replace(/&quot;/g, '"'));
                                    const categorySelect = document.getElementById('category_id');
                                    const subcategorySelect = document.getElementById('subcategory_id');

                                    function populateSubcategories(catId, selectedSub = null) {
                                        subcategorySelect.innerHTML = '';
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

                                    const catId = "{{ old('category_id', $acts->category_id) }}";
                                    const subId = "{{ old('subcategory_id', $acts->subcategory_id) }}";

                                    populateSubcategories(catId, subId);

                                    categorySelect.addEventListener('change', function() {
                                        populateSubcategories(this.value);
                                    });
                                });
                            </script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {

                                    let selectedFiles = [];

                                    const input = document.getElementById('pdfInput');
                                    const previewList = document.getElementById('previewList');
                                    const form = input.closest('form');

                                    if (!input) return;

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
                <button type="button" class="btn btn-sm btn-danger remove-btn" data-index="${index}">
                    Remove
                </button>
            `;

                                            previewList.appendChild(li);
                                        });
                                    }

                                    // ✅ Event delegation (correct way)
                                    previewList.addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-btn')) {
                                            const index = e.target.getAttribute('data-index');
                                            selectedFiles.splice(index, 1);
                                            renderList();
                                        }
                                    });

                                    // ✅ Attach files before submit
                                    form.addEventListener('submit', function() {
                                        const dataTransfer = new DataTransfer();

                                        selectedFiles.forEach(file => {
                                            dataTransfer.items.add(file);
                                        });

                                        input.files = dataTransfer.files;
                                    });

                                });
                            </script>
                            <script>
                                document.addEventListener('DOMContentLoaded', function() {

                                    let selectedFiles = [];

                                    const input = document.getElementById('pdfInput');
                                    const previewList = document.getElementById('previewList');
                                    const form = input.closest('form');

                                    if (!input) return; // safety

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
                <button type="button" class="btn btn-sm btn-danger remove-btn" data-index="${index}">
                    Remove
                </button>
            `;

                                            previewList.appendChild(li);
                                        });
                                    }

                                    // ✅ FIX: use event delegation instead of inline onclick
                                    previewList.addEventListener('click', function(e) {
                                        if (e.target.classList.contains('remove-btn')) {
                                            const index = e.target.getAttribute('data-index');
                                            selectedFiles.splice(index, 1);
                                            renderList();
                                        }
                                    });

                                    // ✅ IMPORTANT: Attach files before submit
                                    form.addEventListener('submit', function() {
                                        const dataTransfer = new DataTransfer();

                                        selectedFiles.forEach(file => {
                                            dataTransfer.items.add(file);
                                        });

                                        input.files = dataTransfer.files;
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