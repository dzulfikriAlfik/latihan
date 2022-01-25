<?php 

require_once "data/Programmer.php";

$company = new Company();
$company->programmer = new Programmer("Eko");
var_dump($company);

$company->programmer = new BackendProgrammer("Kurniawan");
var_dump($company);

$company->programmer = new FrontendProgrammer("Khannedy");
var_dump($company);

sayHelloProgrammer(new Programmer("Eko"));
sayHelloProgrammer(new BackendProgrammer("Kurniawan"));
sayHelloProgrammer(new FrontendProgrammer("Khannedy"));