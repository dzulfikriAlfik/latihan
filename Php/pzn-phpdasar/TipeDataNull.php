<?php

$name = "ucup";
$name = null;

$age = null;

echo "name : ";
echo $name;
echo "\n";

echo "age : ";
echo $age;
echo "\n";

echo "Is name null ? ";
var_dump(is_null($name));
echo "\n";

# menghapus variabel
$contoh = "ucup";
unset($contoh);

$contoh = "surucup";
$contoh = null;

var_dump(isset($contoh));