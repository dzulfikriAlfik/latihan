<?php 

require_once "data/Conflict.php";
require_once "data/Helper.php";

use Data\One\conflict as conflict1;
use Data\Two\conflict as conflict2;
use function Helper\heplMe as help;
use const Helper\APPLICATION as APP;

$conflict1 = new Conflict1();
$conflict2 = new Conflict2();

help();

echo APP . PHP_EOL;