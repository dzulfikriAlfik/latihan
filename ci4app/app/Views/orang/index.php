<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <div class="d-flex justify-content-between my-3">
            <h2 class="mb-2">Daftar Orang</h2>
            <div class="col-6">
               <form action="" method="POST" class="d-flex justify-content-between align-self-center">
                  <div class="input-group mb-3">
                     <input type="text" class="form-control" placeholder="Masukan keyword pencarian..." name="cari">
                     <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
                     </div>
                     <a href="" class="btn btn-sm btn-warning ml-3">Refresh</a>
                  </div>
               </form>
            </div>
         </div>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Aksi</th>
               </tr>
            </thead>
            <tbody>
               <?php foreach ($orang as $value) : ?>
                  <tr>
                     <th scope="row" class="text-center"><?= $currentPage++; ?></th>
                     <td><?= $value['nama']; ?></td>
                     <td><?= $value['alamat']; ?></td>
                     <td>
                        <a href="#" class="btn btn-sm btn-success">Detail</a>
                     </td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
         <?= $pager->links('orang', 'orang_pagination') ?>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>