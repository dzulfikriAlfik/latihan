<?php 

$matches = [];
$result = (bool)preg_match_all("/eko|awan|edy/i", "Eko Kurniawan Khannedy", $matches);
var_dump($result);
var_dump($matches);

$result = preg_replace("/anjing|bangsat/i", "***", "dasar lu anjing dan bangsat!");
var_dump($result);

$result = preg_split("/[\s,-]/", "Eko Kurniawan Khannedy,Programmer,Zaman-Now");
var_dump($result);