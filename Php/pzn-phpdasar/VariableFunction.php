<?php 

function foo(){
    echo "foo" . PHP_EOL;
}

function bar(){
    echo "bar" . PHP_EOL;
}

$functionDipanggil = "foo";
$functionDipanggil();

$functionDipanggil = "bar";
$functionDipanggil();

function sayHello(string $name, $filter){
    $finalName = $filter($name);

    echo "Hello $finalName" . PHP_EOL;
}

sayHello("Ucup", "strtoupper");