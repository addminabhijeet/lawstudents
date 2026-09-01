<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
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
                    <li class="breadcrumb-item">Edit Rules</li>
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
                            <form action="<?php echo e(route('admin.updaterules', $rules->id)); ?>" method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>
                           

                                <!-- Category -->
                                <div class="mb-3">
                                    <label class="form-label">Category</label>
                                    <select name="category_id" id="category_id" class="form-select" required>
                                        <option value="">Select Category</option>
                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <option value="<?php echo e($category->id); ?>"
                                            <?php echo e(old('category_id', $rules->category_id) == $category->id ? 'selected' : ''); ?>>
                                            <?php echo e($category->name); ?>

                                        </option>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
                                <?php if(!empty($rules->pdfs)): ?>
                                <div class="mb-3">
                                    <label class="form-label">Existing PDFs</label>
                                    <ul class="list-group">
                                        <?php $__currentLoopData = $rules->pdfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <a href="<?php echo e(asset('storage/' . $pdf)); ?>" target="_blank">
                                                <?php echo e(pathinfo($pdf, PATHINFO_BASENAME)); ?>

                                            </a>
                                        </li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                </div>
                                <?php endif; ?>

                                <!-- Upload New PDFs -->
                                <div class="mb-3">
                                    <label class="form-label">Upload More PDFs</label>
                                    <input type="file" name="pdfs[]" id="pdfInput" class="form-control" multiple>

                                    <ul id="previewList" class="list-group mt-3"></ul>
                                </div>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label">Button Name / Description</label>
                                    <textarea name="description" class="form-control"><?php echo e(old('description', $rules->description)); ?></textarea>
                                </div>

                                <button class="btn btn-primary">Update Rules</button>
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
        const categories = JSON.parse('<?php echo json_encode($categories, 15, 512) ?>'.replace(/&quot;/g, '"'));
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

        const oldCat = "<?php echo e(old('category_id', $rules->category_id)); ?>";
        const oldSub = "<?php echo e(old('subcategory_id', $rules->subcategory_id)); ?>";

        if (oldCat) populateSubcategories(oldCat, oldSub);

        categorySelect.addEventListener('change', function() {
            populateSubcategories(this.value);
        });
    });
</script>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/rules/edit.blade.php ENDPATH**/ ?>