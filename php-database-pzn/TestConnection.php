<?php

$host = "localhost";
$port = 3306;
$database = "belajar_php_database";
$username = "root";
$password = "";

try {
   $connection = new PDO("mysql:host=$host:$port; dbname=$database", $username, $password);
   echo "Sukses terkoneksi ke database" . PHP_EOL;

   // menutup koneksi
   $connection = null;
   /* menutup koneksi itu sangat penting! biasanya setiap DBMS memiliki batas maksimal koneksi database misalnya 151 koneksi, jika tidak di tutup ketika setiap user melakukan koneksi maka limit tersebut akan terpenuhi dan koneksi diatas maksimalnya akan tertolak */
} catch (PDOException $exception) {
   echo "Error! koneksi ke database gagal : " . $exception->getMessage() . PHP_EOL;
}
