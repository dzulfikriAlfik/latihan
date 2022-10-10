<?php $__env->startSection('content'); ?>
   <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
      <h1 class="h2">Welcome back <?php echo e(auth()->user()->name); ?></h1>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\wamp64\www\latihan\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/dashboard/index.blade.php ENDPATH**/ ?>