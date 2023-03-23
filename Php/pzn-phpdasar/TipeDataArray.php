<?php

$values = array(10,20,90, 98.29);
var_dump($values);

$names = ["ucup", "surucup", "mario"];
var_dump($names);

var_dump($names[1]);
$names[1] = "doni";

unset($names[1]);
$names[] = "tono";
$names[] = "otong";
var_dump($names);
var_dump(count($names));

#array menjadi map
$ucup = array(
    "id" => "ucup",
    "name" => "ucup surucup",
    "age" => 29
);
var_dump($ucup);
var_dump($ucup["name"]);

$budi = [
    "id" => "budi",
    "name" => "budi subudi",
    "age" => 23,
    "address" => [
        "city" => "bogor",
        "country" => "indonesia"
    ]
];
var_dump($budi);
var_dump($budi["address"]["city"]);