<?php
include "models/m_barang.php";

$barang = new Barang($connection);

?>

<div class="row">
  <div class="col-lg-12">
    <h1>Barang<small> Data Barang</small></h1>
    <ol class="breadcrumb">
      <li><a href="#"><i class="icon-dashboard"></i>Barang</a></li>
    </ol>
  </div>
</div><!-- /.row -->

<div class="row">
  <div class="col-lg-12">

    <div class="table-responsive">
      <table class="table table-bordered table-hover table-striped">
        <tr>
          <th class="text-center">No.</th>
          <th>Nama Barang</th>
          <th>Harga Barang</th>
          <th>Stok Barang</th>
          <th>Gambar Barang</th>
          <th>Opsi</th>
        </tr>
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
              <button class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Hapus</button>
            </td>
          </tr>
        <?php endwhile; ?>
        <!-- end php tampil database -->
      </table>
    </div>

    <!-- Button trigger modal -->
    <button type="button" id="tambah_barang" class="btn btn-primary" data-toggle="modal" data-target="#modalTambah">
      Tambah Data Barang
    </button>

    <!-- Modal Tambah -->
    <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalTambahLabel">Tambah Data Barang</h4>
          </div>
          <!-- FORM -->
          <form action="" method="post" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="form-group">
                <label for="nama_barang" class="control-label">Nama Barang</label>
                <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
              </div>
              <div class="form-group">
                <label for="harga_barang" class="control-label">Harga Barang</label>
                <input type="number" name="harga_barang" class="form-control" id="harga_barang" min="0" required>
              </div>
              <div class="form-group">
                <label for="stok_barang" class="control-label">Stok Barang</label>
                <input type="number" name="stok_barang" class="form-control" id="stok_barang" min="0" required>
              </div>
              <div class="form-group">
                <label for="gbr_barang" class="control-label">Gambar Barang</label>
                <input type="file" name="gbr_barang" class="form-control" id="gbr_barang" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="reset" class="btn btn-danger">Reset</button>
              <input type="submit" class="btn btn-primary" name="tambah" value="Simpan">
            </div>
          </form>
          <!-- END FORM -->

          <?php
          if (@$_POST['tambah']) {
            $nama_barang = $connection->conn->real_escape_string($_POST['nama_barang']);
            $harga_barang = $connection->conn->real_escape_string($_POST['harga_barang']);
            $stok_barang = $connection->conn->real_escape_string($_POST['stok_barang']);

            // upload gambar
            $extensi = explode(".", $_FILES['gbr_barang']['name']);
            $gbr_barang = "brg-" . round(microtime(true)) . "." . end($extensi);
            $sumber = $_FILES['gbr_barang']['tmp_name'];
            $upload = move_uploaded_file($sumber, "assets/img/barang/" . $gbr_barang);

            if ($upload) {
              $barang->tambah($nama_barang, $harga_barang, $stok_barang, $gbr_barang);
              header("location: ?page=barang");
            } else {
              echo "<script>alert('Gagal upload gambar!')</script>";
            }
            // end upload gambar

          }

          ?>

        </div>
      </div>
    </div>
    <!-- End Modal Tambah -->

    <!-- Modal Edit -->
    <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="modalEditLabel">Edit Data Barang</h4>
          </div>
          <!-- FORM EDIT -->
          <form id="formEdit" enctype="multipart/form-data">
            <div class="modal-body" id="edit-modal">
              <div class="form-group">
                <label for="nama_barang" class="control-label">Nama Barang</label>
                <input type="hidden" id="id_barang" name="id_barang">
                <input type="text" name="nama_barang" class="form-control" id="nama_barang" required>
              </div>
              <div class="form-group">
                <label for="harga_barang" class="control-label">Harga Barang</label>
                <input type="number" name="harga_barang" class="form-control" id="harga_barang" min="0" required>
              </div>
              <div class="form-group">
                <label for="stok_barang" class="control-label">Stok Barang</label>
                <input type="number" name="stok_barang" class="form-control" id="stok_barang" min="0" required>
              </div>
              <div class="form-group">
                <label for="gbr_barang" class="control-label">Gambar Barang</label>
                <div style="margin-bottom: 10px;">
                  <img src="" width="70" height="70" id="editGambar">
                </div>
                <input type="file" name="gbr_barang" class="form-control" id="gbr_barang">
              </div>
            </div>
            <div class="modal-footer">
              <input type="submit" class="btn btn-primary" name="edit" value="Simpan">
            </div>
          </form>
          <!-- END FORM EDIT -->
        </div>
      </div>
    </div>
    <!-- End Modal Edit -->

  </div>
</div>

<script src="assets/js/jquery-1.10.2.js"></script>
<script>
  $(document).on("click", "#edit_barang", function() {
    const idBarang = $(this).data('id');
    const namaBarang = $(this).data('nama');
    const hargaBarang = $(this).data('harga');
    const stokBarang = $(this).data('stok');
    const gbrBarang = $(this).data('gbr');

    $("#edit-modal #id_barang").val(idBarang);
    $("#edit-modal #nama_barang").val(namaBarang);
    $("#edit-modal #harga_barang").val(hargaBarang);
    $("#edit-modal #stok_barang").val(stokBarang);
    $("#edit-modal #editGambar").attr("src", "assets/img/barang/" + gbrBarang);
  });

  $(document).ready(function(e) {
    $("#formEdit").on("submit", (function(e) {
      e.preventDefault();
      $.ajax({
        url: 'models/proses_edit_barang.php',
        type: 'POST',
        data: new FormData(this),
        contentType: false,
        cache: false,
        processData: false,
        success: function(msg) {
          $('.table').html(msg);
        }
      });
    }));
  });
</script>