
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

  if (!$upload) {
    echo "<script>alert('Gagal upload gambar!')</script>";
  } else {
    $barang->tambah($nama_barang, $harga_barang, $stok_barang, $gbr_barang);
    header("location: ?page=dashboard");
  }
  // end upload gambar

}

?>