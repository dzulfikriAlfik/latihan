<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1><?= ucfirst($menu); ?><small class="text-small"> (Pembelian)</small></h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
               <li class="breadcrumb-item active"><?= ucfirst($menu); ?></li>
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
   <div class="container-fluid">
      <div class="row">
         <div class="col-12">
            <div class="card">
               <div class="card-header">
                  <a href="<?= base_url('stock/in/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add <?= ucfirst($menu); ?></a>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>Barcode</th>
                           <th>Product Item</th>
                           <th>Qty</th>
                           <th>Date</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $data => $stock) : ?>
                           <tr>
                              <td class="text-center" style="width: 15%;"><?= $stock['barcode'] ?></td>
                              <td><?= $stock['item_name'] ?></td>
                              <td class="text-center" style="width: 8%;"><?= $stock['qty']; ?></td>
                              <td class="text-center"><?= indo_date($stock['date']); ?></td>
                              <td width="160px" class="text-center">
                                 <a href="<?= base_url('stock/in/detail/' . $stock['stock_id']); ?>" class="btn btn-info btn-xs"><i class="fas fa-eye"></i> Detail</a>&nbsp;
                                 <a href="<?= base_url('stock/in/delete/' . $stock['stock_id'] . '/' . $stock['item_id']); ?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
                              </td>
                           </tr>
                        <?php endforeach; ?>
                     </tbody>
                  </table>
               </div>
            </div>
         </div>
      </div>
   </div>
</section>