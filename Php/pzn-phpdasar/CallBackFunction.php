<?php

function sayHello(string $name, callable $filter)
{
    $finalName = call_user_func($filter, $name);
    echo "Hello $finalName" . PHP_EOL;
}

sayHello("Ucup", "strtoupper");
sayHello("Ucup", "strtolower");

sayHello("Otong", function ($name): string {
    return strtoupper($name);
});

sayHello("Mario", fn ($name) => strtoupper($name));
