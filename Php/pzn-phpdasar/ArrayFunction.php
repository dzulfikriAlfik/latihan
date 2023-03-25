<?php 

$data = [1,2,3,4,5];

$mapFunction = fn(int $value) => $value * 123;

$result = array_map($mapFunction, $data);
var_dump($result);

rsort($data);
var_dump($data);
var_dump(array_values($data));

$person = [
    "fist_name" => "Ucup",
    "last_name" => "Surucup"
];
var_dump(array_keys($person));