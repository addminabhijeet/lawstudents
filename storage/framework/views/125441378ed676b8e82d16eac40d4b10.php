<?php
$groups = $groups ?? collect();
?>
<?php echo $__env->make('layouts.partials.admin.dashboard', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<main class="nxl-container">
    <div class="nxl-content">

        <!-- HEADER -->
        <div class="page-header">
            <div class="page-header-left d-flex align-items-center">
                <div class="page-header-title">
                    <h5 class="m-b-10">Admin</h5>
                </div>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item">Gallery</li>
                    <li class="breadcrumb-item">Update</li>
                </ul>
            </div>
        </div>

        <div class="main-content">
            <div class="row">
                <div class="col-lg-12">

                    <!-- FORM -->
                    <div class="card stretch stretch-full shadow-sm border-0">
                        <div class="card-header text-white">
                            <h5 class="mb-0">
                                <?php echo e(isset($editItem) ? 'Update Gallery Item' : 'Add New Gallery Images'); ?>

                            </h5>
                        </div>

                        <div class="card-body">
                            <form
                                action="<?php echo e(isset($editItem) ? route('admin.updategallery', $editItem->id) : route('admin.storegallery')); ?>"
                                method="POST" enctype="multipart/form-data">
                                <?php echo csrf_field(); ?>

                                <!-- Image Upload -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Upload Image</label>
                                    <input type="file" name="<?php echo e(isset($editItem) ? 'image' : 'image[]'); ?>"
                                        class="form-control" <?php echo e(isset($editItem) ? '' : 'multiple'); ?>>
                                </div>

                                <!-- GROUP -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Select Group</label>

                                    <div class="d-flex gap-2">
                                        <select name="group_name" id="groupSelect" class="form-control">
                                            <option value="">-- Select Group --</option>
                                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <option value="<?php echo e($group); ?>"
                                                <?php echo e((isset($editItem) && $editItem->group_name == $group) ? 'selected' : ''); ?>>
                                                <?php echo e($group); ?>

                                            </option>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </select>

                                        <button type="button" class="btn btn-outline-primary" onclick="toggleNewGroup()">
                                            + New
                                        </button>
                                    </div>
                                </div>

                                <!-- NEW GROUP -->
                                <div class="mb-3" id="newGroupBox" style="display:none;">
                                    <label class="form-label fw-semibold">Create New Group</label>
                                    <div class="d-flex gap-2">
                                        <input type="text" id="newGroupInput" name="new_group"
                                            class="form-control" placeholder="Enter group name">
                                        <button type="button" class="btn btn-success" onclick="addGroup()">Add</button>
                                    </div>
                                </div>

                                <!-- Preview -->
                                <?php if(isset($editItem)): ?>
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Current Image</label><br>
                                    <img src="<?php echo e(asset('storage/app/public/' . $editItem->image)); ?>"
                                        class="img-thumbnail rounded" width="150">
                                </div>
                                <?php endif; ?>

                                <!-- Description -->
                                <div class="mb-3">
                                    <label class="form-label fw-semibold">Description</label>
                                    <textarea name="description" class="form-control" rows="3"><?php echo e($editItem->description ?? ''); ?></textarea>
                                </div>

                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary">
                                        <?php echo e(isset($editItem) ? 'Update' : 'Save'); ?>

                                    </button>

                                    <?php if(isset($editItem)): ?>
                                    <a href="<?php echo e(route('admin.listgallery')); ?>" class="btn btn-outline-secondary">
                                        Cancel
                                    </a>
                                    <?php endif; ?>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- ================= GALLERY ================= -->

                    <?php $__empty_1 = true; $__currentLoopData = $gallery; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $groupName => $images): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>

                    <!-- 🔥 EACH GROUP HAS ITS OWN ROW -->
                    <div class="mb-4">

                        <!-- TITLE -->
                        <h5 class="mb-3 text-primary">
                            <?php echo e($groupName ? $groupName : 'Ungrouped'); ?>

                        </h5>

                        <!-- IMAGES -->
                        <div class="row g-3">

                            <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">

                                <div class="card h-100 border-0 shadow-sm">

                                    <img src="<?php echo e(asset('storage/app/public/' . $img->image)); ?>"
                                        class="card-img-top" style="height:140px; object-fit:cover;">

                                    <div class="card-body p-2 text-center">

                                        <small class="text-muted d-block mb-2 text-truncate">
                                            <?php echo e($img->description ?? 'No description'); ?>

                                        </small>

                                        <div class="d-flex justify-content-center gap-2">

                                            <a href="<?php echo e(route('admin.editgallery', $img->id)); ?>"
                                                class="btn btn-sm btn-outline-primary">
                                                <i class="fa fa-edit"></i>
                                            </a>

                                            <form action="<?php echo e(route('admin.deletegallery', $img->id)); ?>" method="POST"
                                                onsubmit="return confirm('Delete this image?')">
                                                <?php echo csrf_field(); ?>
                                                <?php echo method_field('DELETE'); ?>

                                                <button class="btn btn-sm btn-outline-danger">
                                                    <i class="fa fa-trash"></i>
                                                </button>
                                            </form>

                                        </div>

                                    </div>

                                </div>

                            </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                        </div>
                    </div>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                    <div class="text-center">
                        No gallery images found
                    </div>
                    <?php endif; ?>

                </div>
            </div>
        </div>
    </div>
</main>

<script>
    function toggleNewGroup() {
        let box = document.getElementById('newGroupBox');
        box.style.display = (box.style.display === 'none') ? 'block' : 'none';
    }

    function addGroup() {
        let input = document.getElementById('newGroupInput');
        let select = document.getElementById('groupSelect');

        let value = input.value.trim();

        if (!value) {
            alert('Enter group name');
            return;
        }

        // ❗ Prevent duplicate
        let exists = Array.from(select.options).some(opt => opt.value === value);
        if (exists) {
            alert('Group already exists');
            select.value = value;
            return;
        }

        let option = document.createElement('option');
        option.value = value;
        option.text = value;
        option.selected = true;

        select.appendChild(option);

        document.getElementById('newGroupBox').style.display = 'none';
        input.value = '';
    }
</script>
<?php echo $__env->make('layouts.partials.admin.theme', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/course/gallery.blade.php ENDPATH**/ ?>