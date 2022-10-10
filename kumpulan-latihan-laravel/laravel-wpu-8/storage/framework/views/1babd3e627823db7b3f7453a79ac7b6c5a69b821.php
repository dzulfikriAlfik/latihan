<?php $__env->startSection('content'); ?>
   <div class="container">
      <div class="row justify-content-center">
         <div class="col-md-8">
            <h1 class="text-center">Halaman Single Post</h1>
            <h2><?php echo e($post->title); ?></h2>
            <p>By <a href="/posts?author=<?php echo e($post->author->username); ?>" class="text-decoration-none"><?php echo e($post->author->name); ?></a> in <a href="/posts?category=<?php echo e($post->category->slug); ?>"
                  class="text-decoration-none"><?php echo e($post->category->name); ?></a></p>

            <?php if($post->image): ?>
               <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid d-block mt-3" />
            <?php else: ?>
               <img src="<?php echo e(asset('storage/post-images/no-post-image.png')); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid mt-3" />
               
            <?php endif; ?>

            <article class="my-3">
               <?php echo $post->body; ?>

            </article>
            <a href="/posts" class="text-decoration-none d-block mb-5">Back to blog</a>
         </div>
      </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\wamp64\www\latihan\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/post.blade.php ENDPATH**/ ?>