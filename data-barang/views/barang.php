<?php
include "models/m_barang.php";

$barang = new Barang($connection);

if (@$_GET['act'] == '') {

?>

  <div class="row">
    <div class="col-lg-12">
      <h1>Barang<small> Data Barang</small></h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i></a></li>
        <li><a href="#">Barang</a></li>
        <li class="active">Data Barang</li>
      </ol>
    </div>
  </div><!-- /.row -->

  <div class="row">
    <div class="col-lg-12">

      <div class="table-responsive">
        <table class="table table-bordered table-hover table-striped" id="datatables">
          <thead>
            <tr>
              <th class="text-center">No.</th>
              <th>Nama Barang</th>
              <th>Harga Barang</th>
              <th>Stok Barang</th>
              <th>Gambar Barang</th>
              <th>Opsi</th>
            </tr>
          </thead>
          <tbody>
            <!-- php tampil database -->
            <?php
            $no = 1;
            $tampil = $barang->tampil();
            while ($data = $tampil->fetch_object()) : ?>
              <tr>
                <td class="text-center"><?= $no++; ?>.</td>
                <td><?= $data->nama_barang; ?></td>
                <td><?= $data->harga_barang; ?></td>
                <td><?= $data->stok_barang; ?></td>
                <td class="text-center">
                  <img src="assets/img/barang/<?= $data->gbr_barang; ?>" width="70" height="70" alt="">
                </td>
                <td class="text-center">
                  <a href="" id="edit_barang" data-toggle="modal" data-target="#modalEdit" data-id="<?= $data->id_barang; ?>" data-nama="<?= $data->nama_barang; ?>" data-harga="<?= $data->harga_barang; ?>" data-stok="<?= $data->stok_barang; ?>" data-gbr="<?= $data->gbr_barang; ?>">
                    <button class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>
                  </a>
                  <a href="?page=barang&act=del&id=<?= $data->id_barang; ?>" onclick="return confirm('Yakin Hapus Data?'); ">
                    <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
                  </a>
                </td>
              </tr>
            <?php endwhile; ?>
            <!-- end php tampil database -->
          </tbody>
        </table>
      </div>

      <!-- Button trigger modal tambah -->
      <button type="button" id="tambah_barang" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
        <i class="fa fa-plus"></i> Tambah Data Barang
      </button>
      <!-- End Button trigger modal tambah -->
      <!-- Button print excel -->
      <a href="report/export_excel_barang.php" target="_blank">
        <button class="btn btn-default">
          <i class="fa fa-print"></i> Export Excel
        </button>
      </a>
      <!-- End Button print excel -->

      <!-- Include modal tambah dan edit -->
      <?php
      include ".modal_add_barang.php";
      include ".modal_edit_barang.php";
      ?>
      <!-- End Include modal tambah dan edit -->

    </div>
  </div>

<?php

} else if (@$_GET['act'] == 'del') {
  $gbr_awal = $barang->tampil($_GET['id'])->fetch_object()->gbr_barang;
  unlink("assets/img/barang/" . $gbr_awal);

  $barang->hapus($_GET['id']);
  header("Location: ?page=barang");
}

?>