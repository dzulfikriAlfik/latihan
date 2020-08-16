<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1><?= ucfirst($page); ?></h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
               <li class="breadcrumb-item"><a href="<?= base_url($menu); ?>"><?= ucfirst($menu); ?></a></li>
               <li class="breadcrumb-item active"><?= ucfirst($page); ?></li>
            </ol>
         </div>
      </div>
      <div class="row">
         <div class="col">
            <?= $this->session->flashdata('pesan'); ?>
         </div>
      </div>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-8 offset-2">
         <div class="card">
            <div class="card-header">
               <a href="<?= base_url('item'); ?>" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body text-center" >
               <?php
               $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
               echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) . '"style="border: 1px solid black; padding:25px">';
               echo "<br>";
               echo $row->barcode;
               ?>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>
</section>