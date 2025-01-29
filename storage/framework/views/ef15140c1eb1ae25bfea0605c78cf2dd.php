<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <h1>Welcome to Our Blog Platform</h1>

    <h2>Список Блог</h2>

    <div class="my-3">
        <form method="GET" action="<?php echo e(route('home')); ?>">
            <div class="row">
                <div class="col-md-4">
                    <label for="sortField">Сортувати за:</label>
                    <select name="sortField" id="sortField" class="form-control">
                        <option value="title" <?php echo e(request('sortField') == 'title' ? 'selected' : ''); ?>>Назва</option>
                        <option value="author_id" <?php echo e(request('sortField') == 'author_id' ? 'selected' : ''); ?>>Автор</option>
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


    <table class="table">
        <thead>
            <tr>
                <th>Title</th>
                <th>Зображення</th>
                <th>Author</th>
                <th>Publish Date</th>
            </tr>
        </thead>
        <tbody>
            <?php $__currentLoopData = $blogs; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td><a href="<?php echo e(route('blogs.show', $blog->id)); ?>"><?php echo e($blog->title); ?></a></td>
                <td>
                    <?php if($blog->image): ?>
                        <img src="<?php echo e(asset('storage/blog_images/' . $blog->image)); ?>" alt="Зображення" style="width: 100px; height: auto;">
                    <?php else: ?>
                        <span>Відсутная зображення</span>
                    <?php endif; ?>
                </td>
                <td><?php echo e($blog->author->name ?? 'Unknown'); ?></td>
                <td><?php echo e(\Carbon\Carbon::parse($blog->publish_date)->format('d M, Y')); ?></td>
            </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </tbody>
    </table>

    <!-- Пагінація -->
    <div class="pagination d-flex justify-content-center">
        <?php echo e($blogs->links('pagination::bootstrap-4')); ?>

    </div>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/welcome.blade.php ENDPATH**/ ?>