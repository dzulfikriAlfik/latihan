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