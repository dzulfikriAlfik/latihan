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
   <!-- <form action="" method="post"> -->
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
                        <input type="hidden" id="item_id">
                        <input type="hidden" id="price">
                        <input type="hidden" id="stock">
                        <input type="text" id="barcode" class="form-control" required readonly>
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
                        <button type="button" id="add_cart" class="btn btn-sm btn-primary"><i class="fas fa-cart-plus"></i> Add</button>
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
            <div class="card-body table-responsive p-0">
               <table class="table table-bordered table-striped text-nowrap">
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
   <!-- </form> -->
</section>

<div class="modal fade" id="modal-item" tabindex="-1" aria-labelledby="modal-itemLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modal-itemLabel">Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="card-body table-responsive">
            <table id="example1" class="table table-bordered table-striped">
               <thead>
                  <tr>
                     <th>Barcode</th>
                     <th>Name</th>
                     <th>Unit</th>
                     <th>Price</th>
                     <th>Stock</th>
                     <th>Actions</th>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach ($item as $itm => $data) : ?>
                     <tr>
                        <td class="text-center"><?= $data['barcode']; ?></td>
                        <td><?= $data['name']; ?></td>
                        <td><?= getnama($data['unit_id'], 'p_unit', 'unit_id', 'name'); ?></td>
                        <td class="text-right"><?= rupiah($data['price']); ?></td>
                        <td><?= $data['stock']; ?></td>
                        <td class="text-center">
                           <button class="btn btn-dark btn-xs" id="select" data-id="<?= $data['item_id']; ?>" data-barcode="<?= $data['barcode']; ?>" data-price="<?= $data['price']; ?>" data-stock="<?= $data['stock']; ?>">
                              <i class="fas fa-check"></i> Select
                           </button>
                        </td>
                     </tr>
                  <?php endforeach; ?>
               </tbody>
            </table>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
         </div>
      </div>
   </div>
</div>

<script>
   $(document).ready(function() {
      $(document).on('click', '#select', function() {
         $('#item_id').val($(this).data('id'));
         $('#barcode').val($(this).data('barcode'));
         $('#price').val($(this).data('price'));
         $('#stock').val($(this).data('stock'));
         $('#modal-item').modal('hide');
      });
   });

   $(document).on('click', '#add_cart', function() {
      const item_id = $('#item_id').val();
      const price = $('#price').val();
      const stock = $('#stock').val();
      const qty = $('#qty').val();
      if (item_id == '') {
         Swal.fire({
            title: 'Product Belum Dipilih',
            text: 'Pilih Product Terlebih Dahulu',
            type: 'error',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            footer: '<b>Aplikasi Kasir Penjualan</b>'
         });
         $('#barcode').focus();
      } else if (qty == '') {
         Swal.fire({
            title: 'Quantity Masih kosong',
            text: 'Masukan Jumlah Quantity Product',
            type: 'error',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            footer: '<b>Aplikasi Kasir Penjualan</b>'
         });
         $('#barcode').focus();
      } else if (stock < 1) {
         Swal.fire({
            title: 'Stock Masih Kosong',
            text: 'Input Stock di Menu Stock-In',
            type: 'error',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            footer: '<b>Aplikasi Kasir Penjualan</b>'
         });
         $('#item_id').val();
         $('#barcode').val();
         $('#barcode').focus();
      } else if (qty > stock) {
         Swal.fire({
            title: 'Stock Tidak Mencukupi',
            text: 'Quantity Tidak Boleh Melebihi Stock Tersedia',
            type: 'error',
            icon: 'error',
            showConfirmButton: false,
            timer: 2000,
            footer: '<b>Aplikasi Kasir Penjualan</b>'
         });
         $('#item_id').val();
         $('#barcode').val();
         $('#barcode').focus();
      } else {
         $.ajax({
            type: 'POST',
            url: '<?= base_url('sales/process'); ?>',
            data: {
               'add_cart': true,
               'item_id': item_id,
               'price': price,
               'qty': qty
            },
            dataType: 'json',
            success: function(result) {
               if (result.success == true) {
                  Swal.fire({
                     title: 'Transaction Sale',
                     text: 'Berhasil Tambah Cart ke Database',
                     type: 'success',
                     icon: 'success',
                     showConfirmButton: false,
                     timer: 2000,
                     footer: '<b>Aplikasi Kasir Penjualan</b>'
                  });
               } else {
                  Swal.fire({
                     title: 'Gagal Tambah Item Cart',
                     text: 'Terdapat Error yang tidak diketahui',
                     type: 'error',
                     icon: 'error',
                     showConfirmButton: false,
                     timer: 2000,
                     footer: '<b>Aplikasi Kasir Penjualan</b>'
                  });
               }
            }
         })
      }
   });
</script>