<?php 

require_once "helper/MathHelper.php";

use Helper\MathHelper;

MathHelper::$name = "Eko Kurniawan";
echo MathHelper::$name . PHP_EOL;

$result = MathHelper::sum(10, 10, 10, 10, 10);
echo "Result : $result" . PHP_EOL;