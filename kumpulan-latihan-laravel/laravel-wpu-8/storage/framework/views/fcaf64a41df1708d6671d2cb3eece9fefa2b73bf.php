<?php $__env->startSection('content'); ?>
   <h1 class="mb-5"><?php echo e($subMenu); ?></h1>

   <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <h2>
         <a href="/posts/<?php echo e($post->slug); ?>" class="text-decoration-none"><?php echo e($post->title); ?></a>
      </h2>
      <p><?php echo e($post->excerpt); ?></p>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
   <a href="/categories" class="text-decoration-none">Back to Categories</a>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\xampp\htdocs\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/category.blade.php ENDPATH**/ ?>