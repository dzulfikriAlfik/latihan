<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Daftar Users</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
               <li class="breadcrumb-item active">User</li>
            </ol>
         </div>
      </div>
   </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <a href="<?= base_url('user/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-user-plus"></i> Tambah Data</a>
               <div class="card-tools">
                  <div class="input-group input-group-sm" style="width: 150px;">
                     <input type="text" name="table_search" class="form-control float-right" placeholder="Search">

                     <div class="input-group-append">
                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                     </div>
                  </div>
               </div>
            </div>
            <!-- /.card-header -->
            <div class="card-body table-responsive p-0" style="height: 300px;">
               <table class="table table-head-fixed text-nowrap table-hover">
                  <thead>
                     <tr>
                        <th>#</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Level</th>
                        <th>Actions</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $no = 1;
                     foreach ($row as $user) : ?>
                        <tr>
                           <td><?= $no++; ?>.</td>
                           <td><?= $user['username']; ?></td>
                           <td><?= $user['name']; ?></td>
                           <td><?= $user['address']; ?></td>
                           <td><?= $user['level'] == 1 ? "Admin" : "Kasir"; ?></td>
                           <td>
                              <a href="<?= base_url('user/edit/') . $user['user_id']; ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                              <a href="<?= base_url('user/hapus/') . $user['user_id']; ?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
                           </td>
                        </tr>
                     <?php endforeach; ?>
                  </tbody>
               </table>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>

</section>