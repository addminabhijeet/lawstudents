<?php $__env->startSection('content'); ?>
<!--===== WELCOME STARTS =======-->
<div class="welcome-inner-section-area"
    style="background-image: url(/img/bacground/inner-bg.png); background-position: center; background-repeat: no-repeat; background-size: cover;">
    <img src="/img/elements/elementor40.png" alt="" class="elementor40 keyframe3 d-lg-block d-none">
    <div class="container">
        <div class="row">
            <div class="col-lg-3 m-auto">
                <div class="welcome-inner-header text-center">
                    <h1>Client</h1>
                    <a href="">Home <span><i class="fa-light fa-angle-right"></i></span>Client</a>
                    <img src="/img/elements/elementor20.png" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
<!--===== WELCOME ENDS =======-->

<!--===== BLOG STARTS =======-->
<div class="contact1-section-area sp1">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="contact-auhtor-area contact2">
                    <div class="row align-items-center">
                        <div class="col-lg-6">
                            <div class="contact-submit-area">
                                <h3>Join Our Client Network</h3>
                                <p>We respond within 30 minutes during business hours to guide you better</p>
                                <form action="<?php echo e(route('frontend.contactstore')); ?>" method="POST">
                                    <?php echo csrf_field(); ?>
                                    <div class="row">
                                        <!-- First Name -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="first_name" id="first_name" placeholder="First Name" required>
                                            </div>
                                        </div>

                                        <!-- Last Name -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="last_name" id="last_name" placeholder="Last Name" required>
                                            </div>
                                        </div>

                                        <!-- Phone Number -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="text" name="phone" id="phone" placeholder="Phone Number" pattern="[0-9]{10}" maxlength="10" required>
                                            </div>
                                        </div>

                                        <!-- Email Address -->
                                        <div class="col-lg-6">
                                            <div class="contact-inner">
                                                <input type="email" name="email" id="email" placeholder="Email Address" required>
                                            </div>
                                        </div>

                                        <!-- Interested Course / Service Type -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <input type="text" name="service_type" id="service_type" placeholder="Interested Course (Criminal / Corporate / Traffic Law)" required>
                                            </div>
                                        </div>

                                        <!-- Message / Queries -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <textarea name="message" id="message" placeholder="Tell us about your learning goals or queries" cols="30" rows="10" required></textarea>
                                            </div>
                                        </div>

                                        <!-- Submit Button -->
                                        <div class="col-lg-12">
                                            <div class="contact-inner">
                                                <button type="submit">
                                                    Join Our Client
                                                    <i class="fa-light fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="contact-content-area">
                                <h2>Our Esteemed Client & Learners</h2>
                                <p>
                                    At Law Students, we take pride in serving a diverse client including aspiring
                                    lawyers,
                                    law students, working professionals, and legal enthusiasts. Our courses are trusted
                                    by individuals
                                    who aim to build a strong foundation in legal studies and advance their careers in
                                    law.
                                </p>
                                <p>
                                    Our client includes students preparing for judiciary exams, professionals
                                    enhancing their legal
                                    expertise, and individuals seeking practical knowledge in criminal, corporate, and
                                    traffic law.
                                    We are committed to delivering high-quality education and real-world insights to
                                    every learner.
                                </p>

                                <!-- Grid Wrapper -->
                                <div style="display:grid; grid-template-columns:repeat(3,1fr); gap:10px;">
                                    <?php $__currentLoopData = $clienteles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $clientele): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if(is_array(json_decode($clientele->pdfs))): ?>
                                    <?php $__currentLoopData = json_decode($clientele->pdfs); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pdf): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(asset('storage/app/public/' . $pdf)); ?>" class="welcome-btn3"
                                        target="_blank">
                                        <?php echo e($clientele->description); ?><i class="fa-light fa-arrow-right"></i>
                                    </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                    <a href="<?php echo e(asset('storage/app/public/' . $clientele->pdfs)); ?>"
                                        class="welcome-btn3" target="_blank">
                                        <?php echo e($clientele->description); ?><i class="fa-light fa-arrow-right"></i>
                                    </a>
                                    <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.landing', ['title' => 'Law Students'], array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /home/u792878158/domains/law.norloxsolutionscrm.com/public_html/resources/views/clientele/clientele.blade.php ENDPATH**/ ?>