<?php $__env->startSection('content'); ?>
   <div class="container mt-4">
      <div class="row">
         <div class="col-lg-8">
            <h2><?php echo e($post->title); ?></h2>

            <a href="/dashboard/posts" class="btn btn-success btn-sm"><span data-feather="arrow-left"></span> Back to all my post</a>
            <a href="/dashboard/posts/<?php echo e($post->slug); ?>/edit" class="btn btn-warning btn-sm"><span data-feather="edit"></span> Edit</a>
            <form action="/dashboard/posts/<?php echo e($post->slug); ?>" class="d-inline" method="post">
               <?php echo method_field('delete'); ?>
               <?php echo csrf_field(); ?>
               <button class="btn btn-danger btn-sm border-0" onclick="return confirm('Yakin hapus data ini?')"><span data-feather="x-circle"></span> Delete</button>
            </form>

            <?php if($post->image): ?>
               <div style="max-height: 350px; overflow: hidden">
                  <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid d-block mt-3" />
               </div>
            <?php else: ?>
               <img src="<?php echo e(asset('storage/post-images/no-post-image.png')); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid mt-3" />
               
            <?php endif; ?>

            <article class="my-3">
               <?php echo $post->body; ?>

            </article>
         </div>
      </div>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\xampp\htdocs\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/dashboard/posts/show.blade.php ENDPATH**/ ?>