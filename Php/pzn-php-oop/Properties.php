<?php 

require_once "data/Person.php";

$person = new Person("Eko", "Subang");
$person->name = "Eko";
$person->address = "Subang";

echo "Name : $person->name" . PHP_EOL;
echo "Address : $person->address" . PHP_EOL;
echo "Country : $person->country" . PHP_EOL;

$person2 = new Person("Budi", null);
$person2->name = "Budi";
$person2->address = null;

var_dump($person2);

?>