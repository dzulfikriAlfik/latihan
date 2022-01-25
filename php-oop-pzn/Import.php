<?php 

require_once "data/Conflict.php";
require_once "data/Helper.php";

use Data\One\conflict;
use function Helper\heplMe;
use const Helper\APPLICATION;

$conflict1 = new Conflict();
$conflict2 = new Data\Two\Conflict();

heplMe();

echo APPLICATION . PHP_EOL;