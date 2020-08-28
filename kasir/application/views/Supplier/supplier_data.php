<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Supplier</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url('dashboard'); ?>">Dashboard</a></li>
               <li class="breadcrumb-item active">Supplier</li>
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
                  <a href="<?= base_url('supplier/add'); ?>" class="btn btn-info btn-sm"><i class="fas fa-plus"></i> Add Supplier</a>
               </div>
               <!-- /.card-header -->
               <div class="card-body">
                  <table id="example1" class="table table-bordered table-striped">
                     <thead>
                        <tr>
                           <th>No.</th>
                           <th>Name</th>
                           <th>Telepon</th>
                           <th>Address</th>
                           <th>Description</th>
                           <th>Actions</th>
                        </tr>
                     </thead>
                     <tbody>
                        <?php
                        $no = 1;
                        foreach ($row as $supp) : ?>
                           <tr>
                              <td><?= $no++; ?>.</td>
                              <td><?= $supp['name']; ?></td>
                              <td><?= $supp['phone']; ?></td>
                              <td><?= $supp['address']; ?></td>
                              <td><?= $supp['description'] ?></td>
                              <td width="160px" class="text-center">
                                 <a href="<?= base_url('supplier/edit/' . $supp['supplier_id']); ?>" class="btn btn-warning btn-xs"><i class="fas fa-edit"></i> Edit</a>&nbsp;
                                 <!-- <a href="<?= base_url('supplier/delete/' . $supp['supplier_id']); ?>" onclick="return confirm('Yakin Hapus Data?')" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a> -->
                                 <a href="#modalDelete" data-toggle="modal" class="btn btn-danger btn-xs"><i class="fas fa-trash"></i> Hapus</a>
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

<div class="modal fade" id="modalDelete" tabindex="-1" aria-labelledby="modalDeleteLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modalDeleteLabel">Hapus Supplier?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-footer">
            <form id="formDelete" method="post" action="<?= base_url('supplier/delete/' . $supp['supplier_id']); ?>">
               <button type="button" class="btn btn-secondary" data-dismiss="modal">Tidak</button>
               <button type="submit" class="btn btn-primary">Ya</button>
            </form>
         </div>
      </div>
   </div>
</div>