<?php

require_once __DIR__ . "/GetConnection.php";

$connection = getConnection();

$sql = "SELECT * FROM customers";

$stmt = $connection->query($sql);

$customers = $stmt->fetchAll();
var_dump($customers);

$connection = null;
