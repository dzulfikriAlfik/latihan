<?php
require_once('../config/+koneksi.php');
require_once('../models/database.php');
include('../models/m_barang.php');

$connection = new Database($host, $user, $pass, $database);
$barang = new Barang($connection);

$fileName = "excel_barang-(" . date('d-m-Y') . ").xls";

header("Content-Disposition: attachment; filename=$fileName");
header("Content-Type: application/vnd.ms-excel ");

?>

<table border="1px">
  <tr>
    <th>No.</th>
    <th>Nama Barang</th>
    <th>Harga Barang</th>
    <th>Stok Barang</th>
  </tr>
  <?php
  $no = 1;
  $tampil = $barang->tampil();
  while ($data = $tampil->fetch_object()) {
    echo "<tr>";
    echo "<td align=center>" . $no++ . "</td>";
    echo "<td>" . $data->nama_barang . "</td>";
    echo "<td>" . $data->harga_barang . "</td>";
    echo "<td>" . $data->stok_barang . "</td>";
    echo "</tr>";
  }
  ?>
</table>