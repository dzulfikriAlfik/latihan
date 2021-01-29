<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <div class="d-flex justify-content-between">
            <h2>Detail Komik <?= $komik['judul']; ?></h2>
            <a href="/komik" class="btn btn-sm btn-primary mb-3">Back</a>
         </div>
         <div class="card mt-3" style="max-width: 540px;">
            <div class="row no-gutters">
               <div class="col-md-4">
                  <img src="/img/<?= $komik['sampul']; ?>" class="sampul-detail" alt="Cover <?= $komik['judul']; ?>">
               </div>
               <div class="col-md-8">
                  <div class="card-body">
                     <h5 class="card-title"><?= $komik['judul']; ?></h5>
                     <p class="card-text"><b>Penulis : </b><?= $komik['penulis']; ?></p>
                     <p class="card-text"><small class="text-muted"><b>Penerbit : </b><?= $komik['penerbit']; ?></small></p>

                     <a href="" class="btn btn-sm btn-warning">Edit</a>
                     <a href="" class="btn btn-sm btn-danger">Delete</a>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>