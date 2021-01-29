<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <div class="d-flex justify-content-between">
            <h2>Form Tambah Data Komik</h2>
            <div>
               <a href="" class="btn btn-sm btn-warning align-self-center">Refresh</a>
               <a href="/komik" class="btn btn-sm btn-primary align-self-center">Back</a>
            </div>
         </div>
      </div>
   </div>
   <div class="row my-5">
      <div class="col-8">
         <form action="/komik/save" method="POST">
            <?= csrf_field(); ?>
            <div class="form-group row">
               <label for="judul" class="col-sm-2 col-form-label">Judul</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" placeholder="Masukan Judul Komik" name="judul" autofocus value="<?= old('judul'); ?>">
                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <?= $validation->getError('judul'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" placeholder="Masukan Nama Penulis" name="penulis" value="<?= old('penulis'); ?>">
                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <?= $validation->getError('penulis'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" placeholder="Masukan Nama penerbit" name="penerbit" value="<?= old('penerbit'); ?>">
                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <?= $validation->getError('penerbit'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" placeholder="Masukan Nama sampul" name="sampul" value="<?= old('sampul'); ?>">
                  <div id="validationServer03Feedback" class="invalid-feedback">
                     <?= $validation->getError('sampul'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row mt-4">
               <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Tambah Data</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>