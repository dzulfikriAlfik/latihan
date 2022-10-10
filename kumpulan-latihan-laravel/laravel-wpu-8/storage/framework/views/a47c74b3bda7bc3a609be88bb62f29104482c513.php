<?php $__env->startSection('content'); ?>
   <h2>Halaman Blog</h2>

   <?php $__currentLoopData = $blog_post; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $blog): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
      <h2>
         <a href="/posts/<?php echo e($blog->id); ?>"><?php echo e($blog->title); ?></a>
      </h2>
      <p><?php echo e($blog->body); ?></p>
   <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\xampp\htdocs\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/blog.blade.php ENDPATH**/ ?>