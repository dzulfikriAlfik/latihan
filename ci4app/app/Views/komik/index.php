<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <div class="d-flex justify-content-between my-3">
            <h2 class="mb-2">Daftar Komik</h2>
            <div>
               <a href="" class="btn btn-sm btn-warning">Refresh</a>
               <a href="/komik/create" class="btn btn-sm btn-primary align-self-center">Tambah Data Komik</a>
            </div>
         </div>
         <?php if (session()->getFlashdata('pesan')) : ?>
            <div class="alert alert-success alert-dismissible fade show" role="alert">
               <strong>Hooray!</strong> <?= session()->getFlashdata('pesan'); ?>
               <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
               </button>
            </div>
         <?php endif; ?>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Sampul</th>
                  <th scope="col">Judul</th>
                  <th scope="col">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               foreach ($komik as $value) : ?>
                  <tr>
                     <th scope="row" class="text-center"><?= $no++; ?></th>
                     <td>
                        <img src="img/<?= $value['sampul']; ?>" alt="Cover <?= $value['judul']; ?>" class="sampul">
                     </td>
                     <td><?= $value['judul']; ?></td>
                     <td>
                        <a href="/komik/detail/<?= $value['slug']; ?>" class="btn btn-sm btn-success">Detail</a>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>