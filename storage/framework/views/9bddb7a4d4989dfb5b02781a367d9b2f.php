<?php $__env->startSection('content'); ?>
    <!--===== WELCOME STARTS =======-->
    <div class="welcome-inner-section-area"
        style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
        <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 m-auto">
                    <div class="welcome-inner-header text-center">
                        <h1>Free Notes</h1>
                        <a href="">Home <span><i class="fa-light fa-angle-right"></i></span> Free Notes</a>
                        <img src="/img/elements/elementor20.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--===== WELCOME ENDS =======-->

    <!--===== BLOG STARTS =======-->
    <div class="blog1-section-area sp3">
        <div class="container">
            <div class="row">

                <div style="width:100%; max-width:1100px; margin:auto;">

                    <div class="search-container" style="max-width:600px; margin:0 auto 20px;">
                        <input type="text" id="noteSearch" class="form-control"
                            placeholder="Search notes, category, course..." onkeyup="searchNotes(this.value)">

                        <div id="searchSuggestions"
                            style="border:1px solid #ddd; border-top:0; max-height:250px; overflow:auto; display:none;">
                        </div>
                    </div>

                    <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div
                            style="margin-bottom:15px; border:1px solid #e4e6eb; border-radius:10px; overflow:hidden; box-shadow:0 2px 6px rgba(0,0,0,0.05);">

                            <!-- CATEGORY HEADER -->
                            <div onclick="toggleAccordion('cat<?php echo e($category->id); ?>', 'cat-group')" class="cat-group"
                                style="cursor:pointer; padding:18px; background:#ffffff; font-size:18px; font-weight:600; display:flex; justify-content:space-between; align-items:center;">
                                <span><?php echo e($category->name); ?></span>
                                <span
                                    style="background:#25D366; color:#fff; padding:3px 8px; border-radius:20px; font-size:12px;">
                                    <?php echo e($category->courses->sum(fn($c) => $c->notes->count())); ?>

                                </span>
                            </div>

                            <!-- CATEGORY BODY -->
                            <div id="cat<?php echo e($category->id); ?>"
                                style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; background:#fafafa; padding:0 18px;">

                                <?php $__currentLoopData = $category->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="margin:12px 0;">

                                        <!-- COURSE HEADER -->
                                        <div onclick="toggleAccordion('course<?php echo e($course->id); ?>', 'course-group')"
                                            class="course-group"
                                            style="cursor:pointer; padding:12px; background:#f1f3f6; border-radius:6px; display:flex; justify-content:space-between; align-items:center; font-weight:500;">
                                            <span><?php echo e($course->title); ?></span>
                                            <span
                                                style="font-size:12px; background:#dee2e6; padding:2px 7px; border-radius:12px;">
                                                <?php echo e($course->notes->count()); ?>

                                            </span>
                                        </div>

                                        <!-- COURSE BODY -->
                                        <div id="course<?php echo e($course->id); ?>"
                                            style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding-left:10px;">

                                            <?php $__currentLoopData = $course->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div
                                                    style="margin:8px 0; padding:12px; background:#ffffff; border:1px solid #eee; border-radius:6px; display:flex; justify-content:space-between; align-items:center;">

                                                    <div>
                                                        <div style="font-weight:500;"><?php echo e($note->title); ?></div>
                                                        <div style="font-size:12px; color:#777;"><?php echo e($note->formatted_size); ?>

                                                        </div>
                                                    </div>

                                                    <?php if(auth()->check()): ?>
                                                        <a href="<?php echo e(route('frontend.viewnote', $note->id)); ?>"
                                                            style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                            Download
                                                        </a>
                                                    <?php else: ?>
                                                        <a href="<?php echo e(route('google.login')); ?>"
                                                            style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                            Download
                                                        </a>
                                                    <?php endif; ?>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>


                                <!-- SUB-CATEGORIES -->
                                <?php $__currentLoopData = $category->children; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $child): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="margin-top:15px; padding-top:10px; border-top:1px dashed #ddd;">

                                        <div onclick="toggleAccordion('sub<?php echo e($child->id); ?>', 'sub-group')"
                                            class="sub-group"
                                            style="cursor:pointer; padding:12px; background:#e9f5ee; border-radius:6px; display:flex; justify-content:space-between; font-weight:600;">
                                            <span><?php echo e($child->name); ?></span>
                                        </div>

                                        <div id="sub<?php echo e($child->id); ?>"
                                            style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding-left:10px;">

                                            <?php $__currentLoopData = $child->courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $childCourse): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <div style="margin:10px 0;">

                                                    <div onclick="toggleAccordion('childcourse<?php echo e($childCourse->id); ?>', 'childcourse-group')"
                                                        class="childcourse-group"
                                                        style="cursor:pointer; padding:10px; background:#f8f9fa; border-radius:6px; display:flex; justify-content:space-between;">
                                                        <span><?php echo e($childCourse->title); ?></span>
                                                    </div>

                                                    <div id="childcourse<?php echo e($childCourse->id); ?>"
                                                        style="max-height:0; overflow:hidden; transition:max-height 0.4s ease; padding-left:10px;">

                                                        <?php $__currentLoopData = $childCourse->notes; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $note): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                            <div
                                                                style="margin:8px 0; padding:12px; background:#ffffff; border:1px solid #eee; border-radius:6px; display:flex; justify-content:space-between; align-items:center;">

                                                                <div>
                                                                    <div style="font-weight:500;"><?php echo e($note->title); ?></div>
                                                                    <div style="font-size:12px; color:#777;">
                                                                        <?php echo e($note->formatted_size); ?>

                                                                    </div>
                                                                </div>

                                                                <?php if(auth()->check()): ?>
                                                                    <a href="<?php echo e(route('frontend.viewnote', $note->id)); ?>"
                                                                        style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                        Download
                                                                    </a>
                                                                <?php else: ?>
                                                                    <a href="<?php echo e(route('google.login')); ?>"
                                                                        style="background:#25D366; color:#fff; padding:6px 14px; border-radius:20px; text-decoration:none; font-size:12px;">
                                                                        Download
                                                                    </a>
                                                                <?php endif; ?>

                                                            </div>
                                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                                    </div>

                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                                        </div>

                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </div>

                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                </div>


                <script>
                    document.addEventListener("DOMContentLoaded", function() {

                        function openAllAccordions() {

                            const sections = document.querySelectorAll(
                                '[id^="cat"], [id^="course"], [id^="sub"], [id^="childcourse"]'
                            );

                            sections.forEach(function(el) {
                                el.style.maxHeight = "none"; // fully open
                                el.style.overflow = "visible";
                            });

                        }

                        // run after DOM fully renders
                        setTimeout(openAllAccordions, 200);

                    });
                </script>
            </div>

            <div class="col-lg-12 m-auto">
                <div class="pagination-area">
                    <nav aria-label="Page navigation example">
                        <ul class="pagination justify-content-center">

                            
                            <?php if($courses->onFirstPage()): ?>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-regular fa-angle-left"></i></span>
                                </li>
                            <?php else: ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($courses->previousPageUrl()); ?>">
                                        <i class="fa-regular fa-angle-left"></i>
                                    </a>
                                </li>
                            <?php endif; ?>

                            
                            <?php $__currentLoopData = $courses->getUrlRange(1, $courses->lastPage()); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $page => $url): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <li class="page-item <?php echo e($page == $courses->currentPage() ? 'active' : ''); ?>">
                                    <a class="page-link" href="<?php echo e($url); ?>"><?php echo e($page); ?></a>
                                </li>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            
                            <?php if($courses->hasMorePages()): ?>
                                <li class="page-item">
                                    <a class="page-link" href="<?php echo e($courses->nextPageUrl()); ?>">
                                        <i class="fa-regular fa-angle-right"></i>
                                    </a>
                                </li>
                            <?php else: ?>
                                <li class="page-item disabled">
                                    <span class="page-link"><i class="fa-regular fa-angle-right"></i></span>
                                </li>
                            <?php endif; ?>

                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {

            document.querySelectorAll(".pdf-frame").forEach(function(iframe) {

                let fallback = iframe.parentElement.querySelector(".fallback-img");

                // If iframe fails to load within 3 seconds → show fallback
                let timer = setTimeout(function() {
                    iframe.style.display = "none";
                    if (fallback) fallback.style.display = "block";
                }, 3000);

                iframe.onload = function() {
                    clearTimeout(timer);

                    try {
                        let doc = iframe.contentDocument || iframe.contentWindow.document;

                        if (!doc || doc.body.innerHTML.trim() === "") {
                            iframe.style.display = "none";
                            if (fallback) fallback.style.display = "block";
                        }

                    } catch (e) {
                        iframe.style.display = "none";
                        if (fallback) fallback.style.display = "block";
                    }
                };

            });

        });
    </script>
    <!--===== BLOG ENDS =======-->
    <script>
        function searchNotes(query) {
            let suggestionBox = document.getElementById('searchSuggestions');

            if (query.length < 3) {
                suggestionBox.style.display = 'none';
                suggestionBox.innerHTML = '';
                return;
            }

            fetch(`<?php echo e(route('frontend.search')); ?>?q=${encodeURIComponent(query)}`)
                .then(response => response.json())
                .then(data => {

                    if (data.length === 0) {
                        suggestionBox.innerHTML = '<div style="padding:10px;">No results found</div>';
                    } else {
                        suggestionBox.innerHTML = data.map(item => `
                    <div style="padding:10px; border-bottom:1px solid #eee; cursor:pointer;"
                         onclick="openSearchResult(${item.category_id ?? 'null'}, ${item.course_id ?? 'null'}, ${item.note_id ?? 'null'})">

                        <div style="font-weight:600;">${item.title}</div>
                        <div style="font-size:12px; color:#777;">
                            ${item.type}
                        </div>
                    </div>
                `).join('');
                    }

                    suggestionBox.style.display = 'block';
                });
        }

        function openSearchResult(categoryId, courseId, noteId) {

            if (!categoryId) return;

            // Open category accordion
            let categorySection = document.getElementById('cat' + categoryId);

            if (categorySection) {
                categorySection.style.maxHeight = categorySection.scrollHeight + "px";
            }

            if (courseId) {
                let courseSection = document.getElementById('course' + courseId);

                if (courseSection) {
                    courseSection.style.maxHeight = courseSection.scrollHeight + "px";
                }
            }

            if (noteId) {
                let noteElement = document.getElementById('note-' + noteId);

                if (noteElement) {
                    noteElement.scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                    noteElement.style.background = '#fff3cd';

                    setTimeout(() => noteElement.style.background = '', 2000);
                }
            }

            document.getElementById('searchSuggestions').style.display = 'none';
        }
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.landing', ['title' => 'Law Students'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/notes/notes.blade.php ENDPATH**/ ?>