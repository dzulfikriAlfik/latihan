<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1><?= ucfirst($menu); ?></h1>
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
                           <th>No.</th>
                           <th>Item Name</th>
                           <th>Type</th>
                           <th>Detail</th>
                           <th>Supplier Name</th>
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
                              <td width="5%"><?= $no++; ?>.</td>
                              <td><?= getnama($stock['item_id'], 'p_item', 'item_id', 'name'); ?></td>
                              <td><?= $stock['type']; ?></td>
                              <td><?= $stock['detail']; ?></td>
                              <td><?= getnama($stock['supplier_id'], 'supplier', 'supplier_id', 'name'); ?></td>
                              <td><?= $stock['qty']; ?></td>
                              <td><?= $stock['date']; ?></td>
                              <td width="160px" class="text-center">
                                 <a href="<?= base_url('stock/in_edit/' . $stock['stock_id']); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> Edit</a>&nbsp;
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