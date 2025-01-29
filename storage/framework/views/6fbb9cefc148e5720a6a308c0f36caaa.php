

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <p>Welcome, <?php echo e(Auth::user()->name); ?>!</p>

    <h2>Ваш Блоги</h2>

    <div class="mb-3">
        <a href="<?php echo e(route('blogs.create')); ?>" method="get" class="btn btn-primary">
            Створити нові Блог
        </a>

        <a href="<?php echo e(route('comments.index')); ?>" method="get" class="btn btn-primary">
            Список коментарів
        </a>
    </div>

    <div class="my-3">
        <form method="GET" action="<?php echo e(route('dashboard')); ?>">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">Сортувати за:</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" <?php echo e(request('sortField') == 'title' ? 'selected' : ''); ?>>Назва</option>
                        <option value="created_at" <?php echo e(request('sortField') == 'created_at' ? 'selected' : ''); ?>>Дата створення</option>
                        <option value="updated_at" <?php echo e(request('sortField') == 'updated_at' ? 'selected' : ''); ?>>Дата оновлення</option>
                        <option value="publish_date" <?php echo e(request('sortField') == 'publish_date' ? 'selected' : ''); ?>>Дата публікації</option>
                    </select>
                </div>

                <div class="col-md-4">
                    <label for="sortOrder">Напрямок:</label>
                    <select name="sortOrder" id="sortOrder" class="form-control">
                        <option value="asc" <?php echo e(request('sortOrder') == 'asc' ? 'selected' : ''); ?>>За зростанням</option>
                        <option value="desc" <?php echo e(request('sortOrder') == 'desc' ? 'selected' : ''); ?>>За спаданням</option>
                    </select>
                </div>

                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">Сортувати</button>
                </div>
            </div>
        </form>
    </div>

    <!--Список блогів -->
    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Зображення</th>
                <th>Author</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Publish Date</th>
                <th>Actions</th>
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
                            <span>Відсутная зображення</span>
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