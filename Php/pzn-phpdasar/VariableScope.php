<?php

$name = "Ucup"; // global scope

function sayHello()
{
    global $name; // global keyword
    echo "Hello $name " . PHP_EOL;
    echo "Hello {$GLOBALS["name"]}" . PHP_EOL;
}

sayHello();
