<?php

require_once __DIR__ . '/vendor/autoload.php';

use DzulfikriLibrary\Test;
use DzulfikriLibrary\Data\People;

echo "Hello World Composer! <br>";

$people = new People("Dzulfikri");

echo $people->sayHello("Alkautsari");
