<?php $__env->startSection('content'); ?>
   <div class="d-flex justify-content-between flex-md-nowrap align-items-center border-bottom mb-3 flex-wrap pt-3 pb-2">
      <h1 class="h2">My Posts</h1>
   </div>
   <div class="table-responsive col-lg-10">
      <a href="/dashboard/posts/create" class="btn btn-primary btn-sm mb-3">Tambah data</a>
      <?php if(session()->has('success')): ?>
         <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
         </div>
      <?php endif; ?>
      <table class="table-striped table-sm table">
         <thead>
            <tr>
               <th scope="col">#</th>
               <th scope="col">Title</th>
               <th scope="col">Category</th>
               <th scope="col">Action</th>
            </tr>
         </thead>
         <tbody>
            <?php $__currentLoopData = $posts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
               <tr>
                  <td><?php echo e($loop->iteration); ?></td>
                  <td><?php echo e($post->title); ?></td>
                  <td><?php echo e($post->category->name); ?></td>
                  <td>
                     <a href="/dashboard/posts/<?php echo e($post->slug); ?>" class="badge bg-info"><span data-feather="eye"></span></a>
                     <a href="/dashboard/posts/<?php echo e($post->slug); ?>/edit" class="badge bg-warning"><span data-feather="edit"></span></a>
                     <form action="/dashboard/posts/<?php echo e($post->slug); ?>" class="d-inline" method="post">
                        <?php echo method_field('delete'); ?>
                        <?php echo csrf_field(); ?>
                        <button class="badge bg-danger border-0" onclick="return confirm('Yakin hapus data ini?')"><span data-feather="x-circle"></span></button>
                     </form>
                  </td>
               </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
         </tbody>
      </table>
   </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Programming\wamp64\www\latihan\kumpulan-latihan-laravel\laravel-wpu-8\resources\views/dashboard/posts/index.blade.php ENDPATH**/ ?>