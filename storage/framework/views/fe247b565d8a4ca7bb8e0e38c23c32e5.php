<?php
    $paddingLeft = $depth * 30;
?>

<tr>
    <td><?php echo e($loop->iteration); ?></td>
    <td>
        <div style="padding-left: <?php echo e($paddingLeft); ?>px; display: flex; align-items: center; gap: 8px;">
            <?php if($category->children->count() > 0): ?>
                <i class="feather-folder" style="color: #128C7E; font-size: 16px;"></i>
            <?php else: ?>
                <i class="feather-tag" style="color: #6b7280; font-size: 14px;"></i>
            <?php endif; ?>
            <span style="font-weight: <?php echo e($depth > 0 ? 'normal' : '600'); ?>;">
                <?php echo e($category->name); ?>

            </span>
            <?php if($category->children->count() > 0): ?>
                <span class="badge bg-info"><?php echo e($category->children->count()); ?> sub</span>
            <?php endif; ?>
        </div>
    </td>
    <td><?php echo e($category->courses->count()); ?></td>
    <td>
        <span class="badge <?php echo e($category->status ? 'bg-success' : 'bg-warning'); ?>">
            <?php echo e($category->status ? 'Active' : 'Inactive'); ?>

        </span>
    </td>
    <td class="text-end">
        <div class="hstack gap-2 justify-content-end">
            <a href="javascript:void(0)" class="btn btn-sm btn-light edit-category"
                data-id="<?php echo e($category->id); ?>">
                <i class="feather-edit"></i>
            </a>
            <a href="javascript:void(0)" class="btn btn-sm btn-danger delete-category"
                data-id="<?php echo e($category->id); ?>">
                <i class="feather-trash-2"></i>
            </a>
        </div>
    </td>
</tr>


<?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php echo $__env->make('course.partials.admin-category-row', [
        'category' => $child,
        'depth' => $depth + 1,
        'loop' => $loop
    ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/course/partials/admin-category-row.blade.php ENDPATH**/ ?>