<?=$this->extend('templates/index');?>

<?=$this->section('content');?>

<h1 class="h3 mb-4 text-gray-800">User Detail</h1>

<div class="row">
   <div class="col-lg-8">
      <div class="card mb-3" style="max-width: 540px;">
         <div class="row no-gutters">
            <div class="col-md-4">
               <img class="img-thumbnail" src="<?=base_url('img/' . $user->user_image);?>" alt="<?=$user->username;?>">
            </div>
            <div class="col-md-8">
               <div class="card-body">
                  <ul class="list-group list-group-flush">
                     <li class="list-group-item">
                        <h4><?=$user->username;?></h4>
                     </li>
                     <?php if ($user->fullname): ?>
                     <li class="list-group-item"><?=$user->fullname;?></li>
                     <?php endif;?>
                     <li class="list-group-item"><?=$user->email;?></li>
                     <li class="list-group-item">
                        <span class="badge badge-<?=$user->name == 'admin' ? 'success' : 'warning';?>"><?=$user->name;?></span>
                     </li>
                     <li class="list-group-item">
                        <a href="<?=base_url('admin');?>" class="card-link">&laquo; back to user list</a>
                     </li>
                  </ul>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<?=$this->endSection();?>