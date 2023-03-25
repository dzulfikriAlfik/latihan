<?php

require_once __DIR__ . "/GetConnection.php";

$connection = getConnection();

$username = "budi";
$password = "rahasia";

$sql = "INSERT INTO admin(username, password) VALUES (:username, :password)";

$preparestmt = $connection->prepare($sql);
$preparestmt->bindParam("username", $username);
$preparestmt->bindParam("password", $password);
$preparestmt->execute();

$connection = null;
