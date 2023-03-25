<?php

// $mahasiswa = [
//    [
//       "nama" => "Dzulfikri",
//       "npm" => "14.14.1.0110",
//       "email" => "latihan.programming.alfik@gmail.com"
//    ],
//    [
//       "nama" => "Dzulfikri",
//       "npm" => "14.14.1.0110",
//       "email" => "latihan.programming.alfik@gmail.com"
//    ],
//    [
//       "nama" => "Dzulfikri",
//       "npm" => "14.14.1.0110",
//       "email" => "latihan.programming.alfik@gmail.com"
//    ]
// ];

$dbh = new PDO('mysql:host=localhost;dbname=phpdasar', 'root', '');
$db = $dbh->prepare('SELECT * FROM mahasiswa ');
$db->execute();

$mahasiswa = $db->fetchAll(PDO::FETCH_ASSOC);

$data = json_encode($mahasiswa);
echo $data;
