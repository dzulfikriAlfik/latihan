<?php

require_once __DIR__ . "/GetConnection.php";

$connection = getConnection();

$username = "admin";
$password = "admin";
$sql = "SELECT * FROM admin WHERE username = :username AND password = :password";
$preparestmt = $connection->prepare($sql);
$preparestmt->bindParam("username", $username);
$preparestmt->bindParam("password", $password);
$preparestmt->execute();

if ($row = $preparestmt->fetch()) {
   echo "Sukses login : " . $row['username'] . PHP_EOL;
} else {
   echo "Gagal login" . PHP_EOL;
}

$connection = null;
