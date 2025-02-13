<!doctype html>
<html lang="<?php echo e(app()->getLocale()); ?>">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" 
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $__env->yieldContent('title', 'Laravel Auth'); ?></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
  </head>
  <body>

  <nav class="navbar navbar-expand-lg bg-primary" data-bs-theme="dark">
    <div class="container-fluid">
      <?php if(Route::has('login')): ?>
        <?php if(auth()->guard()->check()): ?>
          <a class="navbar-brand" href="<?php echo e(route('dashboard')); ?>">Logo (<?php echo e(auth()->user()->name); ?>)</a>
        <?php else: ?>
          <a class="navbar-brand" href="<?php echo e(route('home')); ?>">Logo</a>
        <?php endif; ?>
      <?php endif; ?>

      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" href="<?php echo e(route('home')); ?>"><?php echo e(__('messages.home')); ?></a>
          </li>

          <?php if(Route::has('login')): ?>
            <?php if(auth()->guard()->check()): ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('messages.dashboard')); ?></a></li>
              <li class="nav-item">
                <form method="POST" action="<?php echo e(route('logout')); ?>">
                  <?php echo csrf_field(); ?>
                  <button type="submit" class="nav-link btn btn-link"><?php echo e(__('messages.logout')); ?></button>
                </form>
              </li>
            <?php else: ?>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(route('register')); ?>"><?php echo e(__('messages.register')); ?></a></li>
              <li class="nav-item"><a class="nav-link" href="<?php echo e(route('login')); ?>"><?php echo e(__('messages.login')); ?></a></li>
            <?php endif; ?>
          <?php endif; ?>
        </ul>

        <!-- Перемикач мови -->
        <ul class="navbar-nav mb-2 mb-lg-0 langs">
          <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                  🌐 <?php echo e(strtoupper(app()->getLocale())); ?> <!-- Відображення поточної мови -->
              </a>
              <ul class="dropdown-menu" aria-labelledby="languageDropdown">
                  <li><a class="dropdown-item" href="<?php echo e(route('switchLang', ['locale' => 'en'])); ?>">🇬🇧 English</a></li>
                  <li><a class="dropdown-item" href="<?php echo e(route('switchLang', ['locale' => 'uk'])); ?>">🇺🇦 Українська</a></li>
              </ul>
          </li>
      </ul>

        <!--
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="languageDropdown" role="button" data-bs-toggle="dropdown">
                <?php echo e(__('messages.language')); ?>

            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="<?php echo e(route('switchLang', ['locale' => 'en'])); ?>">🇬🇧 English</a></li>
                <li><a class="dropdown-item" href="<?php echo e(route('switchLang', ['locale' => 'uk'])); ?>">🇺🇦 Українська</a></li>
            </ul>
        </li>
        -->
      </div>
    </div>
  </nav>

  <main class="main my-3">
    <div class="container">
      <?php echo $__env->yieldContent('content'); ?>
    </div>
  </main>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  </body>
</html>
<?php /**PATH C:\OSPanel\home\lv-project-blog\resources\views/layouts/main.blade.php ENDPATH**/ ?>