<?php

$name = "Ucup Surucup";

echo "Name : " . $name . PHP_EOL;
echo "Value : " . 100 . PHP_EOL;

$valueString = (string) 100;
var_dump($valueString);

$valueInt = (int) "234";
var_dump($valueInt);

$valueFloat = (float) "23.01";
var_dump($valueFloat);

$name = "Ucup";

echo $name[0] . PHP_EOL;
echo $name[1] . PHP_EOL;
echo $name[2] . PHP_EOL;
echo $name[3] . PHP_EOL;

// parsing variable
echo "Hello $name , Selamat Belajar" . PHP_EOL;

// curly brace
$var = "Otong";
echo "this is {$var}s" . PHP_EOL;
