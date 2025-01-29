

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    
    <div class="alert alert-info" role="alert">
        Thank you for registering! A link to confirm your registration has been sent to your email.
    </div>
    <div>
        Didn't receive the link?
        <form method="post" action="">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn btn-link ps-0">Send link</button>
        </form>
    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/user/verify-email.blade.php ENDPATH**/ ?>