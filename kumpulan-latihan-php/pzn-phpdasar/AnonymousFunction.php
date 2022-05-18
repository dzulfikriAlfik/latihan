<?php

$sayHello = function (string $name) {
    echo "Hello $name" . PHP_EOL;
};

$sayHello("Ucup");
$sayHello("Otong");

function sayGoodBye(string $name, $filter)
{
    $finalName = $filter($name);
    echo "Good Bye $finalName" . PHP_EOL;
}

sayGoodBye("Ucup", function (string $name) {
    return strtoupper($name);
});

$filterFunction = function (string $name){
    return strtoupper($name);
};

sayGoodBye("otong surotong", $filterFunction);

$firstName = "Ucup";
$lastName = "Surucup";
$sayHelloUcup = function() use($firstName, $lastName){
    echo "Hello $firstName $lastName" . PHP_EOL;
};

$sayHelloUcup();
