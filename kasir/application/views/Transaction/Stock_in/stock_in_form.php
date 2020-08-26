<section class="content-header">
   <div class="container-fluid">
      <div class="row mb-2">
         <div class="col-sm-6">
            <h1>Add Stock In</h1>
         </div>
         <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
               <li class="breadcrumb-item"><a href="<?= base_url('stock/in'); ?>"><?= ucfirst($menu); ?></a></li>
               <li class="breadcrumb-item active">Add Stock In</li>
            </ol>
         </div>
      </div>
   </div>
</section>

<!-- Main content -->
<section class="content">
   <div class="row">
      <div class="col-12">
         <div class="card">
            <div class="card-header">
               <a href="<?= base_url('stock/in'); ?>" class="btn btn-warning btn-sm"><i class="fas fa-undo"></i> Back</a>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
               <form action="<?= base_url('stock/process'); ?>" method="post">
                  <div class="row d-flex justify-content-center">
                     <div class="col-md-5 mx-auto">
                        <input type="hidden" name="stock_id" value="<?= $row->stock_id; ?>">
                        <input type="hidden" name="item_id" value="<?= $row->item_id; ?>">
                        <div class="form-group">
                           <label for="date">Date <span class="text-red">*</span></label>
                           <input type="date" name="date" id="date" class="form-control" value="<?= $row->date; ?>" required>
                        </div>
                        <label for="barcode">Barcode <span class="text-red">*</span></label>
                        <div class="input-group mb-3">
                           <input type="text" name="barcode" id="barcode" class="form-control" required autofocus>
                           <div class="input-group-append">
                              <span class="input-group-sm">
                                 <button type="submit" class="btn btn-info btn-flat" data-toggle="modal" data-target="#modal-item">
                                    <i class="fas fa-search"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="item_name">Item Name <span class="text-red">*</span></label>
                           <input type="text" name="item_name" id="item_name" class="form-control" placeholder="Item Name" readonly>
                        </div>
                        <div class="form-group">
                           <div class="row">
                              <div class="col-md-8">
                                 <label for="unit_name">Unit Name</label>
                                 <input type="text" name="unit_name" id="unit_name" value="-" class="form-control" readonly>
                              </div>
                              <div class="col-md-4">
                                 <label for="Stock">Initial Stock</label>
                                 <input type="text" name="Stock" id="stock" value="-" class="form-control" readonly>
                              </div>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="detail">Detail <span class="text-red">*</span></label>
                           <input type="text" name="detail" id="detail" class="form-control" placeholder="Kulakan / Tambahan / Lainnya" required>
                        </div>
                        <div class="form-group">
                           <label for="supplier">Supplier <span class="text-red">*</span></label>
                           <select name="supplier" id="supplier" class="form-control">
                              <option value="">-- Pilih Supplier --</option>

                           </select>
                        </div>
                        <div class="form-group">
                           <label for="qty">Quantity <span class="text-red">*</span></label>
                           <input type="number" name="qty" id="qty" class="form-control" placeholder="Quantity" required>
                        </div>

                        <!-- Button -->
                        <div class="form-group text-center">
                           <button type="submit" name="<?= $page; ?>" class="btn btn-success btn-flat"><i class="fas fa-paper-plane"></i> Save</button>
                           <button type="reset" class="btn btn-dark btn-flat"><i class="fas fa-backward"></i> Reset</button>
                        </div>
                     </div>
                  </div>
               </form>
            </div>
            <!-- /.card-body -->
         </div>
         <!-- /.card -->
      </div>
   </div>
</section>