<?= $this->extend('layout/template'); ?>

<?= $this->section('content'); ?>
<div class="container">
   <div class="row">
      <div class="col">
         <div class="d-flex justify-content-between">
            <h2>Form Ubah Data Komik</h2>
            <div>
               <a href="" class="btn btn-sm btn-warning align-self-center">Refresh</a>
               <a href="/komik/<?= $komik['slug']; ?>" class="btn btn-sm btn-primary align-self-center">Back</a>
            </div>
         </div>
      </div>
   </div>
   <div class="row my-5">
      <div class="col-8">
         <form action="/komik/update/<?= $komik['id']; ?>" method="POST" enctype="multipart/form-data">
            <?= csrf_field(); ?>
            <input type="hidden" name="slug" value="<?= $komik['slug']; ?>">
            <input type="hidden" name="sampulLama" value="<?= $komik['sampul']; ?>">
            <div class="form-group row">
               <label for="judul" class="col-sm-2 col-form-label">Judul</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('judul')) ? 'is-invalid' : ''; ?>" id="judul" placeholder="Masukan Judul Komik" name="judul" value="<?= (old('judul')) ? old('judul') : $komik['judul']; ?>">
                  <div id="judul" class="invalid-feedback">
                     <?= $validation->getError('judul'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="penulis" class="col-sm-2 col-form-label">Penulis</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('penulis')) ? 'is-invalid' : ''; ?>" id="penulis" placeholder="Masukan Nama Penulis" name="penulis" value="<?= (old('penulis')) ? old('penulis') : $komik['penulis']; ?>">
                  <div id="penulis" class="invalid-feedback">
                     <?= $validation->getError('penulis'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="penerbit" class="col-sm-2 col-form-label">Penerbit</label>
               <div class="col-sm-10">
                  <input type="text" class="form-control <?= ($validation->hasError('penerbit')) ? 'is-invalid' : ''; ?>" id="penerbit" placeholder="Masukan Nama penerbit" name="penerbit" value="<?= (old('penerbit')) ? old('penerbit') : $komik['penerbit']; ?>">
                  <div id="penerbit" class="invalid-feedback">
                     <?= $validation->getError('penerbit'); ?>
                  </div>
               </div>
            </div>
            <div class="form-group row">
               <label for="sampul" class="col-sm-2 col-form-label">Sampul</label>
               <div class="col-sm-2">
                  <img src="/img/<?= $komik['sampul']; ?>" class="img-thumbnail img-preview" alt="Cover Image">
               </div>
               <div class="col-sm-8">
                  <div class="custom-file">
                     <input type="file" class="custom-file-input <?= ($validation->hasError('sampul')) ? 'is-invalid' : ''; ?>" id="sampul" name="sampul" onchange="previewImg()">
                     <label class="custom-file-label" for="sampul"><?= $komik['sampul']; ?></label>
                     <div id="sampul" class="invalid-feedback">
                        <?= $validation->getError('sampul'); ?>
                     </div>
                  </div>
               </div>
            </div>
            <div class="form-group row mt-4">
               <div class="col-sm-10">
                  <button type="submit" class="btn btn-primary">Ubah Data</button>
               </div>
            </div>
         </form>
      </div>
   </div>
</div>
<?= $this->endSection(); ?>