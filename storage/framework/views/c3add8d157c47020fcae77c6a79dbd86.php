

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Login page</h1>

    <form action="<?php echo e(route('login.auth')); ?>" method="post">
    <?php echo csrf_field(); ?>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input name="email" type="email"
            class="form-control" id="email" placeholder="Email">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input name="password" type="password"
            class="form-control"
            id="password" placeholder="Password">
        </div>

        <div class="mb-3 form-check">
            <input name="remember" class="form-check-input" 
            type="checkbox" id="remember">
            <label class="form-check-label" for="remember">
                Remember me
            </label>
        </div>

        <button type="submit" class="btn btn-primary">Login</button>
        
        <a href="<?php echo e(route('password.request')); ?>" class="ms-2">Forgot password</a>

    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/user/login.blade.php ENDPATH**/ ?>