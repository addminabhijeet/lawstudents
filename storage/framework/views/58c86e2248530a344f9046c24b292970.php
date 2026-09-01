<?php $__env->startSection('content'); ?>

<style>
    .pdf-protected-viewer {
        position: relative;
        height: 600px;
        overflow: auto;
        background: #f4f6f9;
    }

    .pdf-protected-viewer {
        user-select: none;
    }

    #pdfContainer {
        user-select: none;
        -webkit-user-select: none;
    }

    #pdfCanvas {
        display: block;
        margin: auto;
    }

    #watermark {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%) rotate(-30deg);
        font-size: 38px;
        opacity: 0.15;
        pointer-events: none;
        white-space: nowrap;
        text-align: center;
    }
</style>
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

                <!-- FILTER AND SEARCH CONTAINER -->
                <div style="background:linear-gradient(135deg, #f9fafb 0%, #ffffff 100%); padding:30px 25px; border-radius:12px;
                            margin-bottom:35px; box-shadow: 0 2px 8px rgba(0,0,0,0.04); border:1px solid #e5e7eb;">

                    <!-- HEADER -->
                    <div style="text-align:center; margin-bottom:20px;">
                        <h3 style="font-size:18px; font-weight:700; color:#1f2937; margin:0 0 8px 0;">
                            <i class="fa-solid fa-sliders" style="margin-right:8px; color:#128C7E;"></i>Find Free Notes
                        </h3>
                        <p style="font-size:13px; color:#6b7280; margin:0;">Filter by category or search by keywords</p>
                    </div>

                    <!-- FILTER AND SEARCH ROW -->
                    <div style="display:grid; grid-template-columns:1fr 1fr; gap:20px; margin-bottom:15px;">

                        <!-- CATEGORY DROPDOWN FILTER -->
                        <div class="category-filter-wrapper" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-filter" style="margin-right:6px;"></i>Notes Category
                            </label>
                            <div style="position:relative;">
                                <button type="button" id="categoryDropdownBtn"
                                    style="width:100%; padding:14px 16px; background:#fff; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; font-weight:600; text-align:left; cursor:pointer;
                                            display:flex; justify-content:space-between; align-items:center;
                                            transition: all 0.3s ease; color:#1f2937;
                                            box-shadow: 0 1px 3px rgba(0,0,0,0.06);">
                                    <span id="selectedCategory" style="display:flex; align-items:center;">
                                        <i class="fa-solid fa-layer-group" style="margin-right:8px; color:#128C7E; font-size:14px;"></i>
                                        All Categories
                                    </span>
                                    <i class="fa-solid fa-chevron-down" style="font-size:12px; color:#9ca3af; transition: transform 0.3s ease;"></i>
                                </button>

                                <!-- DROPDOWN MENU -->
                                <div id="categoryDropdownMenu"
                                    style="position:absolute; top:100%; left:0; right:0; background:#fff; border:2px solid #e5e7eb;
                                            border-radius:10px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); max-height:0; overflow:hidden;
                                            z-index:1000; transition: max-height 0.3s ease, box-shadow 0.3s ease; margin-top:8px;">

                                    <div style="max-height:380px; overflow-y:auto;">
                                        <!-- All Categories Option -->
                                        <div class="dropdown-item-copy" data-category-id="all"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    font-weight:600; color:#128C7E; background:linear-gradient(135deg, #f0fdf4 0%, #f9fafb 100%);
                                                    transition: all 0.2s ease;">
                                            <i class="fa-solid fa-list" style="margin-right:8px;"></i>All Notes
                                        </div>

                                        <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <!-- Parent Category -->
                                        <div class="dropdown-parent-copy" data-category-id="<?php echo e($category->id); ?>"
                                            style="padding:14px 16px; cursor:pointer; border-bottom:1px solid #f3f4f6;
                                                    display:flex; justify-content:space-between; align-items:center;
                                                    transition: all 0.2s ease; font-weight:500; color:#1f2937;">
                                            <span>
                                                <i class="fa-solid fa-folder" style="margin-right:8px; color:#128C7E;"></i>
                                                <?php echo e($category->name); ?>

                                            </span>
                                        </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- SEARCH CONTAINER -->
                        <div class="search-container" style="position:relative;">
                            <label style="display:block; font-size:12px; font-weight:700; color:#374151; margin-bottom:8px; text-transform:uppercase; letter-spacing:0.5px;">
                                <i class="fa-solid fa-magnifying-glass" style="margin-right:6px;"></i>Quick Search
                            </label>
                            <div style="position:relative;">
                                <input type="text" id="copySearch" class="form-control"
                                    placeholder="Search Free Notes..." onkeyup="searchCopys(this.value)"
                                    style="padding:14px 16px 14px 16px; padding-right:40px; border:2px solid #e5e7eb; border-radius:10px;
                                            font-size:14px; box-shadow: 0 1px 3px rgba(0,0,0,0.06); transition: all 0.3s ease;"
                                    onfocus="this.style.borderColor='#128C7E'; this.style.boxShadow='0 0 0 3px rgba(18,140,126,0.1)';"
                                    onblur="this.style.borderColor='#e5e7eb'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.06)';">
                                <i class="fa-solid fa-search" style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                                                      color:#9ca3af; pointer-events:none; font-size:14px;"></i>

                                <div id="copySuggestions"
                                    style="border:2px solid #e5e7eb; border-top:0; max-height:250px; overflow:auto; display:none;
                                            position:absolute; top:100%; left:0; right:0; background:#fff;
                                            border-radius:0 0 10px 10px; z-index:999; box-shadow: 0 10px 25px rgba(0,0,0,0.1); margin-top:-2px;">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- RESPONSIVE MOBILE LAYOUT -->
                    <style>
                        @media (max-width: 768px) {
                            .filter-search-grid {
                                grid-template-columns: 1fr !important;
                            }
                        }
                    </style>
                </div>

                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <!-- CATEGORY -->
                <div class="copy-category" data-category-id="<?php echo e($category->id); ?>" style="margin-bottom:15px; border:1px solid #ddd; border-radius:10px; overflow:hidden;">
                    <div onclick="toggleAccordion('copyCat<?php echo e($category->id); ?>')"
                        style="cursor:pointer; padding:15px; background:#fff; font-weight:600;">
                        <?php echo e($category->name); ?>

                    </div>

                    <div id="copyCat<?php echo e($category->id); ?>" class="accordion-content" style="max-height:1000px;">
                        <?php $__currentLoopData = $category->subcategories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $sub): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <!-- SUBCATEGORY -->
                        <div style="margin:10px; border:1px dashed #ccc; border-radius:6px; overflow:hidden;">
                            <div onclick="toggleAccordion('copySub<?php echo e($sub->id); ?>')"
                                style="cursor:pointer; padding:10px; background:#f5f5f5;">
                                <?php echo e($sub->name); ?>

                            </div>

                            <div id="copySub<?php echo e($sub->id); ?>" class="accordion-content" style="padding:10px; max-height:1000px;">
                                <?php $__currentLoopData = $sub->copys; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $copy): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div data-copy-id="<?php echo e($copy->id); ?>" style="margin-bottom:10px; padding:10px; border:1px solid #eee; border-radius:6px;">
                                    <div style="font-weight:600;">
                                        <?php echo e($copy->description); ?>

                                    </div>
                                    <?php $__currentLoopData = $copy->pdfs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div style="margin-top:5px; display:flex; justify-content:space-between; align-items:center;">
                                        <span style="font-size:12px;">PDF <?php echo e($index + 1); ?></span>
                                        <div>
                                            <?php if(auth()->check()): ?>
                                            <a href="<?php echo e(route('frontend.viewnoteWatermarked', [$copy->id, $index])); ?>" target="_blank" style="font-size:12px; color:green;">View PDF</a>
                                            <span style="margin:0 5px;">|</span>
                                            <a href="<?php echo e(route('frontend.viewnote', [$copy->id, $index])); ?>" style="font-size:12px; color:blue;">Download</a>
                                            <?php else: ?>
                                            <a href="<?php echo e(route('google.login')); ?>" style="font-size:12px; color:green;">View PDF</a>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
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
    </div>
</div>

<style>
    .copy-highlight {
        border: 2px solid #28a745 !important;
        background: #e6ffe6;
    }

    .accordion-content {
        max-height: none !important;
        overflow: visible !important;
        transition: none;
    }

    /* Dropdown Button Hover */
    #categoryDropdownBtn:hover {
        border-color: #d1d5db;
        background: #f9fafb;
        box-shadow: 0 4px 6px rgba(0,0,0,0.08);
    }

    #categoryDropdownBtn.active {
        background: #f3f4f6;
        border-color: #128C7E;
    }

    /* Dropdown Item Styling */
    .dropdown-item-copy:hover,
    .dropdown-parent-copy:hover {
        background: linear-gradient(135deg, #10b981 0%, #059669 100%) !important;
        color: #fff !important;
    }

    .dropdown-item-copy:hover i,
    .dropdown-parent-copy:hover i {
        color: #fff !important;
    }

    /* Search Input Focus */
    #copySearch:focus {
        border-color: #128C7E;
        box-shadow: 0 0 0 3px rgba(18,140,126,0.1);
    }

    /* Suggestions hover */
    #copySuggestions div:hover {
        background: #f0fdf4;
    }
</style>

<script>
    let selectedCopyCategoryId = 'all';

    // Open/Close Dropdown
    document.getElementById('categoryDropdownBtn').addEventListener('click', function() {
        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = menu.style.maxHeight === '0px' || !menu.style.maxHeight ? menu.scrollHeight + 'px' : '0px';
        this.style.background = menu.style.maxHeight !== '0px' ? '#f9f9f9' : '#fff';
    });

    // Handle Category Click
    document.querySelectorAll('.dropdown-parent-copy').forEach(item => {
        item.addEventListener('click', function() {
            const categoryId = this.dataset.categoryId;
            const categoryName = this.querySelector('span').innerText.replace(/[^\w\s-]/g, '').trim();

            selectedCopyCategoryId = categoryId;
            document.getElementById('selectedCategory').innerText = categoryName;

            // Close dropdown
            let menu = document.getElementById('categoryDropdownMenu');
            menu.style.maxHeight = '0px';
            document.getElementById('categoryDropdownBtn').style.background = '#fff';

            // Filter
            filterCopysByCategory(categoryId);
        });
    });

    // Handle "All Categories" Option
    document.querySelector('.dropdown-item-copy[data-category-id="all"]').addEventListener('click', function() {
        selectedCopyCategoryId = 'all';
        document.getElementById('selectedCategory').innerText = 'All Categories';

        let menu = document.getElementById('categoryDropdownMenu');
        menu.style.maxHeight = '0px';
        document.getElementById('categoryDropdownBtn').style.background = '#fff';

        filterCopysByCategory('all');
    });

    // Dropdown Item Hover Effects
    document.querySelectorAll('.dropdown-item-copy, .dropdown-parent-copy').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.background = '#e8f5f3';
        });

        item.addEventListener('mouseleave', function() {
            if (item.classList.contains('dropdown-item-copy')) {
                this.style.background = '#f9f9f9';
            } else {
                this.style.background = '';
            }
        });
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const dropdown = document.querySelector('.category-filter-wrapper');
        if (!dropdown.contains(event.target)) {
            document.getElementById('categoryDropdownMenu').style.maxHeight = '0px';
            document.getElementById('categoryDropdownBtn').style.background = '#fff';
        }
    });

    // Filter copys by category
    function filterCopysByCategory(categoryId) {
        const categoryCards = document.querySelectorAll('.copy-category');

        categoryCards.forEach(card => {
            if (categoryId === 'all') {
                card.style.display = 'block';
            } else {
                const cardCategoryId = card.dataset.categoryId;
                if (cardCategoryId == categoryId) {
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            }
        });
    }

    function toggleAccordion(id) {
        return; // Disabled toggle
    }

    function searchCopys(query) {
        let box = document.getElementById('copySuggestions');
        if (query.length < 3) {
            box.style.display = 'none';
            return;
        }

        fetch(`<?php echo e(route('frontend.copyssearch')); ?>?q=${encodeURIComponent(query)}`)
            .then(res => res.json())
            .then(data => {
                if (!data.length) {
                    box.innerHTML = '<div style="padding:10px;">No results</div>';
                } else {
                    box.innerHTML = data.map(item => `
                        <div style="padding:10px; cursor:pointer;"
                             onclick="openCopySearch(${item.category_id}, ${item.subcategory_id}, ${item.note_id})">
                            ${item.title}
                        </div>
                    `).join('');
                }
                box.style.display = 'block';
            });
    }

    function openCopySearch(catId, subId, copyId) {
        // Hide all categories
        document.querySelectorAll('[id^="copyCat"]').forEach(cat => {
            cat.parentElement.style.display = 'none';
            cat.querySelectorAll('.copy-highlight').forEach(c => c.classList.remove('copy-highlight'));
        });

        // Show only relevant category
        let catContainer = document.getElementById('copyCat' + catId)?.parentElement;
        if (catContainer) catContainer.style.display = 'block';

        // Show only relevant copy
        let sub = document.getElementById('copySub' + subId);
        if (sub) {
            sub.querySelectorAll('[data-copy-id]').forEach(c => c.style.display = 'none');

            let copyDiv = sub.querySelector(`div[data-copy-id='${copyId}']`);
            if (copyDiv) {
                copyDiv.style.display = 'block';
                copyDiv.classList.add('copy-highlight');
                copyDiv.scrollIntoView({
                    behavior: 'smooth',
                    block: 'center'
                });
            }

            sub.style.display = 'block';
            sub.parentElement.style.display = 'block';
        }

        document.getElementById('copySuggestions').style.display = 'none';
    }

    document.addEventListener('click', function(e) {
        let box = document.getElementById('copySuggestions');
        let input = document.getElementById('copySearch');
        if (!box.contains(e.target) && e.target !== input) {
            box.style.display = 'none';
        }
    });
</script>

<div class="modal fade" id="pdfModal" tabindex="-1">
    <div class="modal-dialog modal-xl modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">PDF Viewer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <div class="modal-body p-0">
                <div id="pdfContainer" class="pdf-protected-viewer" style="position:relative;">

                    <div id="watermark">
                        Law Students
                    </div>

                    <canvas id="pdfCanvas"></canvas>

                    <div class="text-center mt-2">
                        <button class="btn btn-sm btn-secondary" onclick="prevPage()">Prev</button>
                        <span id="pageInfo"></span>
                        <button class="btn btn-sm btn-primary" onclick="nextPage()">Next</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/3.11.174/pdf.min.js"></script>
<script>
    let pdfDoc = null;
    let pageNum = 1;
    let totalPages = 0;
    let currentFileUrl = '';

    function openPDF(fileUrl, studentName, studentEmail) {
        currentFileUrl = fileUrl;
        pageNum = 1;

        let modal = new bootstrap.Modal(document.getElementById('pdfModal'));
        modal.show();

        pdfjsLib.getDocument(fileUrl).promise.then(function(pdf) {
            pdfDoc = pdf;
            totalPages = pdf.numPages;
            renderPage(pageNum, studentName, studentEmail);
        });
    }

    function renderPage(num, studentName, studentEmail) {
        pdfDoc.getPage(num).then(function(page) {
            let canvas = document.getElementById('pdfCanvas');
            let ctx = canvas.getContext('2d');
            let container = document.getElementById('pdfContainer');

            let viewport = page.getViewport({
                scale: 1
            });
            let scale = container.clientWidth / viewport.width;
            let scaledViewport = page.getViewport({
                scale: scale
            });

            canvas.height = scaledViewport.height;
            canvas.width = scaledViewport.width;

            page.render({
                canvasContext: ctx,
                viewport: scaledViewport
            }).promise.then(function() {
                // watermark
                let watermarkText = `${studentName} - ${studentEmail} - ${new Date().toLocaleString()}`;
                ctx.font = "28px Arial";
                ctx.fillStyle = "rgba(150,150,150,0.20)";
                ctx.textAlign = "center";
                ctx.save();
                ctx.translate(canvas.width / 2, canvas.height / 2);
                ctx.rotate(-Math.PI / 6);
                for (let y = -canvas.height; y < canvas.height; y += 200) {
                    ctx.fillText(watermarkText, 0, y);
                }
                ctx.restore();
            });
        });

        document.getElementById("pageInfo").innerText = "Page " + num + " / " + totalPages;
    }

    function nextPage() {
        if (pageNum < totalPages) pageNum++, renderPage(pageNum);
    }

    function prevPage() {
        if (pageNum > 1) pageNum--, renderPage(pageNum);
    }

    // clear canvas on modal close
    document.getElementById('pdfModal').addEventListener('hidden.bs.modal', function() {
        let canvas = document.getElementById('pdfCanvas');
        canvas.getContext('2d').clearRect(0, 0, canvas.width, canvas.height);
    });
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.landing', ['title' => 'Free Notes'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/copys/copys.blade.php ENDPATH**/ ?>