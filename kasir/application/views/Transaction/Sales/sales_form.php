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

<div class="flash-data" data-pesan="<?= ucfirst($menu); ?>" data-flashdata="<?= $this->session->flashdata('pesan'); ?>"></div>

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
                        <input type="number" name="qty" id="qty" class="form-control">
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
                  <thead>
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
                  </thead>
                  <tbody id="cart_table">
                     <?php $this->view('transaction/sales/cart_data') ?>
                  </tbody>
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

<!-- Modal Add Product Item -->
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

<!-- Modal Edit -->
<div class="modal fade" id="modal-item-edit" tabindex="-1" aria-labelledby="modal-item-editLabel" aria-hidden="true">
   <div class="modal-dialog modal-sm modal-dialog-scrollable">
      <div class="modal-content">
         <div class="modal-header">
            <h5 class="modal-title" id="modal-item-editLabel">Edit Product Item Sales</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
               <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <input type="hidden" id="cartid_item">
            <div class="form-group">
               <label for="product_item">Product Item</label>
               <div class="row">
                  <div class="col-md-5">
                     <input type="text" id="barcode_item" class="form-control" readonly>
                  </div>
                  <div class="col-md-7">
                     <input type="text" id="product_item" class="form-control" readonly>
                  </div>
               </div>
            </div>
            <div class="form-group">
               <label for="price_item">Price Item</label>
               <input type="number" id="price_item" min="0" class="form-control">
            </div>
            <div class="form-group">
               <label for="qty_item">Qty</label>
               <input type="number" id="qty_item" min="1" class="form-control">
            </div>
            <div class="form-group">
               <label for="total_before">Total Before Discount</label>
               <input type="number" id="total_before" class="form-control" readonly>
            </div>
            <div class="form-group">
               <label for="discount_item">Discount Per-Item</label>
               <input type="number" id="discount_item" min="0" class="form-control">
            </div>
            <div class="form-group">
               <label for="total_item">Total After Discount</label>
               <input type="number" id="total_item" min="0" class="form-control" readonly>
            </div>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="edit_cart">Save</button>
         </div>
      </div>
   </div>
</div>

<script>
   function mySwal($title, $text, $icon, $type) {
      Swal.fire({
         title: $title,
         text: $text,
         type: $type,
         icon: $icon,
         showConfirmButton: false,
         timer: 2000,
         footer: '<b>Aplikasi Kasir Penjualan</b>'
      });
   }

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
         mySwal('Product Belum Dipilih', 'Pilih Product Terlebih Dahulu', 'error', 'error');
         $('#barcode').focus();
      } else if (qty == '' && stock > 0) {
         mySwal('Quantity Masih kosong', 'Masukan Jumlah Quantity Product', 'error', 'error');
         $('#barcode').focus();
      } else if (stock < 1) {
         mySwal('Stock Masih Kosong', 'Input Stock di Menu Stock-In', 'error', 'error');
         $('#item_id').val('');
         $('#barcode').val('');
         $('#qty').val('');
         $('#barcode').focus('');
      } else if (qty > stock) {
         mySwal('Stock Tidak Mencukupi', 'Quantity Tidak Boleh Melebihi Stock Tersedia', 'error', 'error');
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
                  $('#cart_table').load('<?= base_url('sales/load_cart_data'); ?>', function() {
                     $('#item_id').val('');
                     $('#barcode').val('');
                     $('#stock').val('');
                     $('#price').val('');
                     $('#qty').val('');
                  })
               } else {
                  mySwal('Gagal Tambah Item Cart', 'Terdapat Error yang tidak diketahui', 'error', 'error');
                  $('#item_id').val('');
                  $('#barcode').val('');
                  $('#qty').val('');
               }
            }
         })
      }
   });
   $(document).on('click', '#del_cart', function() {

      const href = $(this).attr('href');
      const cart_id = $(this).data('cartid');

      Swal.fire({
         title: 'Apakah Anda Yakin?',
         text: 'Data akan dihapus!',
         icon: 'warning',
         showCancelButton: true,
         confirmButtonColor: '#3085d6',
         cancelButtonColor: '#d33',
         confirmButtonText: 'Hapus Data',
         footer: '<b>Aplikasi Kasir Penjualan</b>'
      }).then((result) => {
         if (result.value) {
            $.ajax({
               type: 'POST',
               url: '<?= base_url('sales/cart_delete'); ?>',
               dataType: 'json',
               data: {
                  'cart_id': cart_id
               },
               success: function(result) {
                  if (result.success == true) {
                     $('#cart_table').load('<?= base_url('sales/load_cart_data'); ?>', function() {
                        mySwal('Data Item Cart Berhasil Dihapus', '', 'success', 'success');
                     })
                  } else {
                     mySwal('Gagal Tambah Item Cart', 'Terdapat Error yang tidak diketahui', 'error', 'error');
                  }
               }
            })
         }
      });
   });

   $(document).ready(function() {
      $(document).on('click', '#update_cart', function() {
         $('#cartid_item').val($(this).data('cartid'));
         $('#barcode_item').val($(this).data('barcode'));
         $('#product_item').val($(this).data('product'));
         $('#price_item').val($(this).data('price'));
         $('#qty_item').val($(this).data('qty'));
         $('#total_before').val($(this).data('price') * $(this).data('qty'));
         $('#discount_item').val($(this).data('discount'));
      });
   });

   function count_edit_modal() {
      const price = $('#price_item').val();
      const qty = $('#qty_item').val();
      const discount = $('#discount_item').val();

      total_before = price * qty;
      $('#total_before').val(total_before);

      total = (price - discount) * qty;
      $('#total_item').val(total);
   }

   $(document).on('keyup mouseup', '#price_item, #qty_item, #discount_item', function() {
      count_edit_modal();
   })
</script>