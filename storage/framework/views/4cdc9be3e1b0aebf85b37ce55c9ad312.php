<?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
    <?php
        $padding = 14 + ($depth * 24);
        $bgColor = $depth % 2 === 0 ? '#fff' : '#fafbfc';
    ?>

    <!-- Category Item -->
    <div class="dropdown-category-item-course" data-category-id="<?php echo e($category->id); ?>" data-depth="<?php echo e($depth); ?>"
        style="padding:14px 16px; padding-left:<?php echo e($padding); ?>px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                display:flex; justify-content:space-between; align-items:center;
                transition: all 0.2s ease; font-weight:500; color:#1f2937; background:<?php echo e($bgColor); ?>;">
        <span style="display:flex; align-items:center; flex:1;">
            <?php if($depth === 0): ?>
                <i class="fa-solid fa-folder" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>
            <?php else: ?>
                <i class="fa-solid fa-tag" style="margin-right:8px; color:#25D366; font-size:11px;"></i>
            <?php endif; ?>
            <span style="font-size:<?php echo e($depth > 0 ? '13px' : '14px'); ?>;"><?php echo e($category->name); ?></span>
        </span>
        <?php if($category->children->count() > 0): ?>
        <i class="fa-solid fa-chevron-right" style="font-size:11px; color:#d1d5db; transition: transform 0.2s ease; margin-left:8px;"></i>
        <?php endif; ?>
    </div>

    <!-- Recursive Child Categories -->
    <?php if($category->children->count() > 0): ?>
        <?php echo $__env->make('course.partials.category-tree', ['categories' => $category->children, 'depth' => $depth + 1], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>
    <?php endif; ?>
<?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/course/partials/category-tree.blade.php ENDPATH**/ ?>