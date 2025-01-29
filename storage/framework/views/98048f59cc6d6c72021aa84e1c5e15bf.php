

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Всі список коментарія</h2>

    <div class="mb-3">
        <a href="<?php echo e(route('blogs.comments', 'new')); ?>" class="btn btn-primary <?php echo e($sort === 'new' ? 'active' : ''); ?>">
            Нові комент
        </a>
        <a href="<?php echo e(route('blogs.comments', 'old')); ?>" class="btn btn-secondary <?php echo e($sort === 'old' ? 'active' : ''); ?>">
            Старі комент
        </a>
    </div>

    <?php if($comments->isEmpty()): ?>
        <p>Немає коментарів у базі даних.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Ім'я</th>
                    <th>Коментар</th>
                    <th>Дата створення</th>
                    <th>До блогу</th>
                    <th>Дії</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $comments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $comment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td><?php echo e($comment->name); ?></td>
                        <td><?php echo e($comment->content); ?></td>
                        <td><?php echo e($comment->created_at->format('d.m.Y H:i')); ?></td>
                        <td>
                            <a href="<?php echo e(route('blogs.show', $comment->blog->id)); ?>">
                                <?php echo e($comment->blog->title); ?>

                            </a>
                        </td>
                        <td>
                            <!-- Дії: видалення або редагування -->
                            <form action="<?php echo e(route('comments.destroy', $comment->id)); ?>" method="POST">
                                <?php echo csrf_field(); ?>
                                <?php echo method_field('DELETE'); ?>
                                <button type="submit" class="btn btn-danger btn-sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    <?php endif; ?>
</div> 
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/blogs/comments.blade.php ENDPATH**/ ?>