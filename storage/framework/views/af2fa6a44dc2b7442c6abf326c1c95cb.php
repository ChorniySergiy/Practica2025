

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <?php if($blog): ?>
        <h1><?php echo e($blog->title); ?></h1>
        
        <p><strong>Автор:</strong> <?php echo e($blog->author->name); ?></p> 

        <p><strong>Дата створення:</strong> 
        <?php echo e($blog->created_at->format('d M, Y')); ?></p> 
        
        <p><strong>Дата випуск:</strong> 
        <?php echo e(\Carbon\Carbon::parse($blog->publish_date)->format('d M, Y')); ?></p> 
        
        <div class="blog-item" style="display: flex; margin-bottom: 20px;">
            <?php if($blog->image): ?>
                <!-- Якщо зображення є -->
                <div class="blog-image" style="margin-right: 20px;">
                    <img src="<?php echo e(asset('storage/blog_images/' . $blog->image)); ?>" alt="Зображення" style="width: 150px; height: auto;">
                </div>
                <div class="blog-content">
                    <h3 style="text-align:center">Контент:</h3>
                    <p><?php echo e($blog->content); ?></p>
                </div>
            <?php else: ?>
                <div class="blog-content" style="flex: 1;">
                    <h3 style="text-align:center">Контент:</h3>
                    <p><?php echo e($blog->content); ?></p>
                </div>
            <?php endif; ?>
        </div>


    <?php else: ?>
        <p>Blog not found.</p>
    <?php endif; ?>

    <form action="<?php echo e(url()->previous()); ?>" method="get">
        <button type="submit" class="btn btn-primary">Back to Blogs</button>
    </form>

    <h3><center>Коментар</center></h3>

    <?php if($blog->comments->isEmpty()): ?>
    <p>Пока немає комент. Ви може буди першій комент в ці блог</p>
    <?php endif; ?>
    <?php $__currentLoopData = $blog->comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="comment">
        <p><strong><?php echo e($comment->user->name ?? "Anonymous"); ?></strong>: <?php echo e($comment->content); ?></p>

            <p><small><?php echo e($comment->created_at->format('d M, Y H:i')); ?></small></p>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

    <form action="<?php echo e(route('comments.store', $blog->id)); ?>" method="POST">
        <?php echo csrf_field(); ?>
        <input type="hidden" name="blog_id" value="<?php echo e($blog->id); ?>">

        <div class="form-group">
            <label for="name">Твій Ім'я:</label>
            <input type="text" name="name" id="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Твій Email:</label>
            <input type="email" name="email" id="email" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="content">Комент:</label>
            <textarea name="content" id="content" class="form-control" rows="3" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Відправить комент</button>
    </form>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/blogs/show.blade.php ENDPATH**/ ?>