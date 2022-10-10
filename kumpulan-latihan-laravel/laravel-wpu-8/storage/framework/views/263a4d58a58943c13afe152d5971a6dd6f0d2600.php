<?php $__env->startSection('content'); ?>
   <h1 class="mb-3 text-center"><?php echo e($subMenu ? $subMenu : 'All Posts'); ?></h1>

   <div class="row justify-content-center mb-3">
      <div class="col-md-6">
         <form action="/posts">
            <?php if(request('category')): ?>
               <input type="hidden" name="category" value="<?php echo e(request('category')); ?>">
            <?php endif; ?>
            <?php if(request('author')): ?>
               <input type="hidden" name="author" value="<?php echo e(request('author')); ?>">
            <?php endif; ?>
            <div class="input-group mb-3">
               <input type="text" class="form-control" id="inputSearch" placeholder="Search..." name="search" value="<?php echo e(request('search')); ?>">
               <button class="btn btn-dark" type="submit">Search</button>
            </div>
         </form>
      </div>
   </div>

   <?php if($posts->count()): ?>
      <div class="card d-flex mb-5">
         <?php if($posts[0]->image): ?>
            <img src="<?php echo e(asset('storage/' . $posts[0]->image)); ?>" alt="<?php echo e($posts[0]->category->name); ?>" class="img-fluid d-block justify-content-center" width="200" />
         <?php else: ?>
            <img src="<?php echo e(asset('storage/post-images/no-post-image.png')); ?>" alt="<?php echo e($posts[0]->category->name); ?>" class="img-fluid" />
            
         <?php endif; ?>
         <div class="card-body text-center">
            <h3 class="card-title"><a href="/posts/<?php echo e($posts[0]->slug); ?>" class="text-decoration-none text-dark"><?php echo e($posts[0]->title); ?></a></h3>
            <p>
               <small>By <a href="/posts?author=<?php echo e($posts[0]->author->username); ?>" class="text-decoration-none"><?php echo e($posts[0]->author->name); ?></a> in <a href="/posts?category=<?php echo e($posts[0]->category->slug); ?>"
                     class="text-decoration-none"><?php echo e($posts[0]->category->name); ?></a> <?php echo e($posts[0]->created_at->diffForHumans()); ?>

               </small>
            </p>
            <p class="card-text"><?php echo e($posts[0]->excerpt); ?></p>

            <a href="/posts/<?php echo e($posts[0]->slug); ?>" class="text-decoration-none btn btn-primary">Read more</a>
         </div>
      </div>

      <div class="container">
         <div class="row mb-3">
            <?php $__currentLoopData = $posts->skip(1); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <div class="col-md-4 p-2">
                  <div class="card" style="width: 18rem;">
                     <a href="/posts?category=<?php echo e($post->category->slug); ?>" class="text-decoration-none text-white">
                        <div class="position-absolute px-3 py-2 text-white" style="background-color: rgba(0, 0, 0, .7)"><?php echo e($post->category->name); ?></div>
                     </a>
                     <?php if($post->image): ?>
                        <img src="<?php echo e(asset('storage/' . $post->image)); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid d-block mt-3" />
                     <?php else: ?>
                        <img src="<?php echo e(asset('storage/post-images/no-post-image.png')); ?>" alt="<?php echo e($post->category->name); ?>" class="img-fluid mt-3" />
                        
                     <?php endif; ?>
                     <div class="card-body">
                        <h5 class="card-title"><a href="/posts/<?php echo e($post->slug); ?>" class="text-decoration-none"><?php echo e($post->title); ?></a></h5>
                        <p>
                           <small>By <a href="/posts?author=<?php echo e($post->author->username); ?>" class="text-decoration-none"><?php echo e($post->author->name); ?></a> <?php echo e($post->created_at->diffForHumans()); ?>

                           </small>
                        </p>
                        <p class="card-text"><?php echo e($post->excerpt); ?></p>
                        <a href="/posts/<?php echo e($post->slug); ?>" class="text-decoration-none btn btn-primary">Read more</a>
                     </div>
                  </div>
               </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </div>
      </div>
   <?php else: ?>
      <p class="fs-4 text-center">No post found.</p>
   <?php endif; ?>

   <div class="d-flex justify-content-center" style="margin-bottom: 100px"><?php echo e($posts->links()); ?></div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\xampp\htdocs\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/posts.blade.php ENDPATH**/ ?>