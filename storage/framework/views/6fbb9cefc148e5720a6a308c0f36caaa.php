

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <p><?php echo e(__('messages.welcomemy')); ?>, <?php echo e(Auth::user()->name); ?>!</p>

    <h2><?php echo e(__('messages.yourblogs')); ?></h2>

    <div class="mb-3">
        <a href="<?php echo e(route('blogs.create')); ?>" method="get" class="btn btn-primary">
            <?php echo e(__('messages.create_blog')); ?>

        </a>

        <a href="<?php echo e(route('comments.index')); ?>" method="get" class="btn btn-primary">
            <?php echo e(__('messages.list_of_comments')); ?>

        </a>
    </div>

    <div class="my-3">
        <form method="GET" action="<?php echo e(route('dashboard')); ?>">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField"><?php echo e(__('messages.sortby')); ?></label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" <?php echo e(request('sortField') == 'title' ? 'selected' : ''); ?>><?php echo e(__('messages.title')); ?></option>
                        <option value="created_at" <?php echo e(request('sortField') == 'created_at' ? 'selected' : ''); ?>><?php echo e(__('messages.creation_date')); ?>Дата створення</option>
                        <option value="updated_at" <?php echo e(request('sortField') == 'updated_at' ? 'selected' : ''); ?>><?php echo e(__('messages.update_date')); ?>Дата оновлення</option>
                        <option value="publish_date" <?php echo e(request('sortField') == 'publish_date' ? 'selected' : ''); ?>><?php echo e(__('messages.publish_date')); ?>Дата публікації</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sortOrder"><?php echo e(__('messages.direction')); ?></label>
                    <select name="sortOrder" id="sortOrder" class="form-control">
                        <option value="asc" <?php echo e(request('sortOrder') == 'asc' ? 'selected' : ''); ?>><?php echo e(__('messages.ascending')); ?></option>
                        <option value="desc" <?php echo e(request('sortOrder') == 'desc' ? 'selected' : ''); ?>><?php echo e(__('messages.descending')); ?></option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100"><?php echo e(__('messages.sort')); ?></button>
                </div>
            </div>
        </form>
    </div>

    <!--Список блогів -->
    <table class="table">
        <thead>
            <tr>
                <th><?php echo e(__('messages.title')); ?></th>
                <th><?php echo e(__('messages.image')); ?></th>
                <th><?php echo e(__('messages.author')); ?></th>
                <th><?php echo e(__('messages.creation_date')); ?></th>
                <th><?php echo e(__('messages.update_date')); ?></th>
                <th><?php echo e(__('messages.publish_date')); ?></th>
                <th><?php echo e(__('messages.actions')); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><a href="<?php echo e(route('blogs.edit', $blog->id)); ?>"><?php echo e($blog->title); ?></a></td>
                    <td>
                        <?php if($blog->image): ?>
                            <img src="<?php echo e(asset('storage/blog_images/' . $blog->image)); ?>" alt="Зображення" style="width: 100px; height: auto;">
                        <?php else: ?>
                            <span><?php echo e(__('messages.emplyimage')); ?></span>
                        <?php endif; ?>
                    </td>
                    <td><?php echo e($blog->author->name); ?></td>
                    <td><?php echo e($blog->created_at->format('d M, Y')); ?></td>
                    <td><?php echo e($blog->updated_at->format('d M, Y')); ?></td>
                    <td><?php echo e(\Carbon\Carbon::parse($blog->publish_date)->format('d M, Y')); ?></td>
                    <td>
                        <form action="<?php echo e(route('blogs.destroy', $blog->id)); ?>" method="POST" style="display: inline;">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                                &#10006; Delete
                            </button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Пагінація -->
    <div class="pagination d-flex justify-content-center">
        <?php echo e($blogs->links('pagination::bootstrap-4')); ?>

    </div>
    
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/user/dashboard.blade.php ENDPATH**/ ?>