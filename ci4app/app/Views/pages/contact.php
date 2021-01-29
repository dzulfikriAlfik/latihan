<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <h2>Contact Us Page</h2>
         <table class="table table-striped">
            <thead>
               <tr>
                  <th scope="col">#</th>
                  <th scope="col">Tipe</th>
                  <th scope="col">Alamat</th>
                  <th scope="col">Kota</th>
               </tr>
            </thead>
            <tbody>
               <?php
               $no = 1;
               foreach ($alamat as $al) : ?>
                  <tr>
                     <th scope="row"><?= $no++; ?></th>
                     <td><?= $al['tipe']; ?></td>
                     <td><?= $al['alamat']; ?></td>
                     <td><?= $al['kota']; ?></td>
                  </tr>
               <?php endforeach; ?>
            </tbody>
         </table>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>