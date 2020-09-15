<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <h2>Contact Us</h2>
         <?php foreach ($alamats as $alamat) : ?>
            <ul>
               <li><?= $alamat['tipe']; ?></li>
               <li><?= $alamat['alamat']; ?></li>
               <li><?= $alamat['kota']; ?></li>
            </ul>
         <?php endforeach; ?>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>