<?php

$data = [
    "action" => "Create"
];

$action = $data["action"] ?? "Nothing";

echo $action . PHP_EOL;


// tanpa null coalescing operator
// if (isset($data["action"])) {
//     $action = $data["action"];
// } else {
//     $action = "Nothing";
// }