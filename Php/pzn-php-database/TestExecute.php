<?php

require_once __DIR__ . "/GetConnection.php";

$connection = getConnection();

$sql = "INSERT INTO customers(id, name, email) VALUES ('alfik', 'Alfik', 'alfik@gmail.com')";

$connection->exec($sql);

$connection = null;
