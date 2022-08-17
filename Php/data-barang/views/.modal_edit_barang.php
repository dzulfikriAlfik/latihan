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