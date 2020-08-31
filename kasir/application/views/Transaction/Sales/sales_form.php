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
   <form action="" method="post">
      <!-- FIRST CARD -->
      <div class="row">
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="date">Date</label>
                        </div>
                        <div class="col-9">
                           <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d') ?>" required>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="kasir">Kasir</label>
                        </div>
                        <div class="col-9">
                           <input type="text" name="kasir" id="kasir" class="form-control" value="<?= $this->fungsi->user_login()->name ?>" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="customer">Customer</label>
                        </div>
                        <div class="col-9">
                           <select name="customer" id="customer" class="form-control">
                              <option value="Umum">Umum</option>
                              <?php foreach ($row as $customer) : ?>
                                 <option value="<?= $customer->customer_id; ?>"><?= $customer->name; ?></option>
                              <?php endforeach; ?>
                           </select>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="barcode">Barcode</label>
                        </div>
                        <div class="col-9 input-group">
                           <input type="text" name="barcode" id="barcode" class="form-control" required autofocus readonly>
                           <div class="input-group-append">
                              <span class="input-group-sm">
                                 <button type="submit" class="btn btn-dark btn-flat" data-toggle="modal" data-target="#modal-item">
                                    <i class="fas fa-search"></i>
                                 </button>
                              </span>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="qty">Qty</label>
                        </div>
                        <div class="col-9">
                           <input type="text" name="qty" id="qty" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col offset-3">
                           <button class="btn btn-sm btn-primary"><i class="fas fa-shopping-cart"></i> Add</button>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body d-flex flex-column justify-content-between align-items-end">
                  <div class="row">
                     <div class="col text-right">
                        <h5 style="font-size: 1.2rem;">Invoice-<b><?= $invoice; ?></b></h5>
                     </div>
                  </div>
                  <div class="row" style="height: 0;">
                     <h1 style="font-size: 2.7rem;"><b><?= rupiah(10000000); ?></b></h1>
                  </div>
                  <div class="row"></div>
               </div>
            </div>
         </div>
      </div>
      <!-- TABLE -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body table-responsive">
                  <table class="table table-bordered table-striped">
                     <tr>
                        <th>#</th>
                        <th>Barcode</th>
                        <th>Product Item</th>
                        <th>Price</th>
                        <th>Qty</th>
                        <th>Discount Item</th>
                        <th>Total</th>
                        <th>Actions</th>
                     </tr>
                     <tr>
                        <td>1</td>
                        <td>A0001</td>
                        <td>Barang</td>
                        <td>100.000</td>
                        <td>4</td>
                        <td>10%</td>
                        <td>7</td>
                        <td class="text-center"><a href="#" class="btn btn-dark btn-xs">Tombol</a></td>
                     </tr>
                  </table>
               </div>
            </div>
         </div>
      </div>
      <!-- SECONDLAST CARD -->
      <div class="row">
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-5">
                           <label for="total">SubTotal</label>
                        </div>
                        <div class="col-7">
                           <input type="text" name="total" id="total" class="form-control" readonly>
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-5">
                           <label for="discount">Discount</label>
                        </div>
                        <div class="col-7">
                           <input type="text" name="discount" id="discount" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-5">
                           <label for="gtotal">GrandTotal</label>
                        </div>
                        <div class="col-7">
                           <input type="text" name="gtotal" id="gtotal" class="form-control" readonly>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="cash">Cash</label>
                        </div>
                        <div class="col-9">
                           <input type="text" name="cash" id="cash" class="form-control">
                        </div>
                     </div>
                  </div>
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="change">Change</label>
                        </div>
                        <div class="col-9">
                           <input type="text" name="change" id="change" class="form-control">
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-lg-4">
            <div class="card" style="height: 188px;">
               <div class="card-body">
                  <div class="form-group">
                     <div class="row">
                        <div class="col-3">
                           <label for="note">Note</label>
                        </div>
                        <div class="col-9">
                           <textarea name="note" id="note" cols="30" rows="3" class="form-control"></textarea>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <!-- LAST CARD -->
      <div class="row">
         <div class="col-lg-12">
            <div class="card">
               <div class="card-body d-flex flex-column justify-content-center align-items-center">
                  <div class="form-group text-center">
                     <a href="#" class="btn btn-warning btn-flat"><i class="fas fa-undo"></i> Cancel</a>
                     <button type="submit" class="btn btn-success btn-flat"><i class="fas fa-paper-plane"></i> Proccess Payment</button>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </form>
</section>