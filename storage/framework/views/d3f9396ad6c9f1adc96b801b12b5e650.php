<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        // Create indentation with &nbsp; entities and dashes
        $indent = str_repeat('&nbsp;&nbsp;&nbsp;', $depth);
        $prefix = $depth > 0 ? str_repeat('—&nbsp;', $depth) : '';
    ?>

    <option value="<?php echo e($category->id); ?>" data-depth="<?php echo e($depth); ?>">
        <?php echo $indent . $prefix; ?><?php echo e($category->name); ?>

    </option>

    
    <?php if($category->children->count() > 0): ?>
        <?php echo $__env->make('course.partials.category-select-tree', [
            'categories' => $category->children,
            'depth' => $depth + 1
        ], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/course/partials/category-select-tree.blade.php ENDPATH**/ ?>