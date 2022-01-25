<?php

function sumAll(...$values)
{
    $total = 0;

    foreach ($values as $value) {
        $total += $value;
    }
    echo "Total " . implode("+", $values) . " = $total" . PHP_EOL;
}

$values = [3,23,3,2];
sumAll(2,3,4,5);
sumAll(...$values);
