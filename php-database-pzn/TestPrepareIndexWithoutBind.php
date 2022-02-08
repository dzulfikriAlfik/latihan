<?php

require_once __DIR__ . "/GetConnection.php";

$connection = getConnection();

// Rentan SQL Injection 
// $username = "admin'; #";
// $password = "admin";
// $sql = "SELECT * FROM admin WHERE username = '$username' AND password = '$password'";
// echo $sql . PHP_EOL;
// $stmt = $connection->query($sql);

// lebih aman
// $username = $connection->quote("admin");
// $password = $connection->quote("admin");
// $sql = "SELECT * FROM admin WHERE username = $username AND password = $password";

// cara yang paling aman (dengan menggunakan PREPARE)
$username = "alfik";
$password = "admin";
// kata kunci param bisa diganti dengan nomor index dengan memberikan keyword "?" lalu di saat pemanggilan bindParam tinggal masukkan nomor indexnya
$sql = "SELECT * FROM admin WHERE username = ? AND password = ?";
$preparestmt = $connection->prepare($sql);
$preparestmt->execute([$username, $password]);

$success = false;
$find_user = null;
foreach ($preparestmt as $row) {
   // Sukses
   $success = true;
   $find_user = $row["username"];
   $pass = $row["password"];
}

if ($success) {
   echo "Sukses Login : " . $find_user . PHP_EOL;
} else {
   echo "Gagal Login" . PHP_EOL;
}

$connection = null;
