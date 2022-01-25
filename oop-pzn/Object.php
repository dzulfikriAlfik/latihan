<?php

require_once "data/Person.php";

$person = new Persons();

class Car
{
   private $brand;

   public function input(string $info): string
   {
      echo "$info : ";
      $result = fgets(STDIN);
      return trim($result);
   }

   public function setCarBrand()
   {
      $this->brand = $this->input("Masukkan nama brand");
   }

   public function getCarBrand()
   {
      return $this->brand;
   }
}

$toyota = new Car();
$toyota->setCarBrand();
echo "Nama brand nya adalah " . $toyota->getCarBrand() . PHP_EOL;
