<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1><?= ucfirst($menu); ?> <small class="text-muted">(Data barang)</small></h1>
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
                  <a href="<?= base_url('item/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add <?= ucfirst($menu); ?></a>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Barcode</th>
                           <th>Product Name</th>
                           <th>Kategori</th>
                           <th>Unit</th>
                           <th>Price</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $categ) : ?>
                           <tr>
                              <td width="5%"><?= $no++; ?>.</td>
                              <td><?= $categ['barcode']; ?></td>
                              <td><?= $categ['name']; ?></td>
                              <td><?= $categ['category_id']; ?></td>
                              <td><?= $categ['unit_id']; ?></td>
                              <td><?= $categ['price']; ?></td>
                              <td width="160px" class="text-center">
                                 <a href="<?= base_url('item/edit/' . $categ['item_id']); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                 <a href="<?= base_url('item/delete/' . $categ['item_id']); ?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
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