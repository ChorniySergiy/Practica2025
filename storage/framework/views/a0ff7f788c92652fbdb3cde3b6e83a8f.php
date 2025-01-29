

<?php $__env->startSection('title', 'Home page'); ?>

<?php $__env->startSection('content'); ?>
    <h2>Редагувати блог</h2>

    <!-- Форма для редагування -->
    <form action="<?php echo e(route('blogs.update', $blog->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <!-- Поле для назви -->
        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
        <label style="margin-bottom: 0.2em" for="title">Назва:</label>
            <input style="border-radius: 36px; border: 2px solid blue; width: 50%; padding: 5px;" 
            type="text" id="title" name="title" value="<?php echo e(old('title', $blog->title)); ?>" required>
            <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span> 
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Поле для змісту -->
        <div style="margin-bottom: 0.5em; display: flex; flex-direction: column;">
            <label style="margin-bottom: 0.2em" for="content">Зміст</label>
            <textarea id="content" name="content" style="width: 50%; height: 100px; border: 2px solid blue; 
        border-radius: 10px; padding: 5px;" required><?php echo e(old('content', $blog->content)); ?></textarea>
            <?php $__errorArgs = ['content'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span> 
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <div style="margin-bottom: 0.5em">
            <label for="image">Зображення:</label>
            <input type="file" name="image" id="image" class="form-control-file" accept="image/*" onchange="previewImage(event)">
            <?php $__errorArgs = ['image'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span> 
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

         <!-- Контейнер для прев'ю вибраного зображення -->
         <div id="image-preview" style="display: flex; align-items: center; gap: 20px; margin-bottom: 0.5em;">
            <?php if(!empty($blog->image) && file_exists(public_path('storage/blog_images/' . $blog->image))): ?>
            <div style="text-align: center;">
                <p>До зміна зображення в Блог</p>
                <img src="<?php echo e(asset('storage/blog_images/' . $blog->image)); ?>" alt="Зображення до" 
                    style="max-width: 500px; height: auto; border-radius: 10px; border: 5px solid red;">
            </div>
            <?php else: ?>
                <div style="text-align: center;">
                    <p style="color: gray;">Немає зображення в Блог</p>
                </div>
            <?php endif; ?>

            <div style="text-align: center;">
                <p>Зміна зображення на нову</p>
                <img id="preview" src="#" alt="Вибране зображення" 
                    style="max-width: 500px; height: auto; border-radius: 10px; border: 5px solid blue; display: none;">
            </div>
        </div>


        <!-- Поле для дати публікації -->
        <div style="margin-bottom: 0.5em">
            <label for="publish_date">Дата публікації</label>
            <input type="date" id="publish_date" name="publish_date" value="<?php echo e(old('publish_date', $blog->publish_date)); ?>" required>
            <label for="publish_date"><?php echo e(old('publish_date', $blog->publish_date)); ?></label>
            <?php $__errorArgs = ['publish_date'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> 
                <span class="text-danger"><?php echo e($message); ?></span> 
            <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
        </div>

        <!-- Кнопка -->
        <button type="submit">Оновити блог</button>
    </form>

    <!-- JavaScript -->
    <script>
        function previewImage(event) {
            let input = event.target;
            let preview = document.getElementById('preview');

            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block'; // Показати зображення
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>




<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/blogs/edit.blade.php ENDPATH**/ ?>