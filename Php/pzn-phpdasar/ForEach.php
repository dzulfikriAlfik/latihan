<?php

$names = ["Ucup", "Surucup", "Siregar"];

echo "Tanpa For Each" . PHP_EOL;
for ($i = 0; $i < count($names); $i++) {
    echo "Data ke $i = $names[$i]" . PHP_EOL;
}

echo "Dengan For Each" . PHP_EOL;
foreach ($names as $name) {
    echo "Hello : $name" . PHP_EOL;
}

foreach ($names as $index => $name) {
    echo "Hello : $index = $name" . PHP_EOL;
}

$person = [
    "first_name" => "Ucup",
    "middle_name" => "Surucup",
    "last_name" => "Siregar"
];

foreach ($person as $key => $value) {
    echo "Data $key = $value" . PHP_EOL;
}
