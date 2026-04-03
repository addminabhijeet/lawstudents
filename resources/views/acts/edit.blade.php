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
                                @if(!empty($acts->pdfs))
                                <div class="mb-3">
                                    <label>Existing PDFs</label>
                                    @foreach($acts->pdfs as $file)
                                    <div>
                                        <a href="{{ asset('storage/app/public/' . $file) }}" target="_blank">
                                            {{ basename($file) }}
                                        </a>
                                    </div>
                                    @endforeach
                                </div>
                                @endif

                                <!-- Upload new -->
                                <div class="mb-3">
                                    <input type="file" name="pdfs[]" class="form-control" multiple>
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
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- [ Main Content ] end -->
    </div>
</main>