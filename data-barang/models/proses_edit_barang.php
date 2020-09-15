<?php

ob_start();
require_once('../config/+koneksi.php');
require_once('database.php');
include "m_barang.php";

$connection = new Database($host, $user, $pass, $database);
$barang = new Barang($connection);

$id_barang = $_POST['id_barang'];
$nama_barang = $connection->conn->real_escape_string($_POST['nama_barang']);
$harga_barang = $connection->conn->real_escape_string($_POST['harga_barang']);
$stok_barang = $connection->conn->real_escape_string($_POST['stok_barang']);

$pict = $_FILES['gbr_barang']['name'];
// upload gambar
$extensi = explode(".", $_FILES['gbr_barang']['name']);
$gbr_barang = "brg-" . round(microtime(true)) . "." . end($extensi);
$sumber = $_FILES['gbr_barang']['tmp_name'];
$upload = move_uploaded_file($sumber, "assets/img/barang/" . $gbr_barang);

if ($pict == '') {
  $barang->edit("UPDATE tb_barang SET nama_barang = '$nama_barang', harga_barang = '$harga_barang', stok_barang = '$stok_barang' WHERE id_barang = '$id_barang' ");
  echo "<script>window.location='?page=barang';</script>";
} else {
  $gbr_awal = $barang->tampil($id_barang)->fetch_object()->gbr_barang;
  unlink("../assets/img/barang/" . $gbr_awal);

  $upload = move_uploaded_file($sumber, "../assets/img/barang/" . $gbr_barang);
  if ($upload) {
    $barang->edit("UPDATE tb_barang SET nama_barang = '$nama_barang', harga_barang = '$harga_barang', stok_barang = '$stok_barang', gbr_barang = '$gbr_barang' WHERE id_barang = '$id_barang' ");
    echo "<script>window.location='?page=barang';</script>";
  } else {
    echo "<script>alert('Gagal upload gambar!')</script>";
  }
}
