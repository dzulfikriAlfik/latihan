<?php

echo "Masukkan string untuk check palindrom : ";
$string = trim(fgets(STDIN));

$arr = str_split($string);

$first = 0;
$last = count($arr) - 1;

$loop = true;

while ($loop) {
   if ($arr[$first] == $arr[$last]) {
      $loop = true;
      echo "arr[$first] : $arr[$first], arr[$last] : $arr[$last]" . PHP_EOL;
      $first++;
      $last--;
      if ($first >= $last) {
         if (count($arr) % 2 != 0) {
            echo "arr[$first] : $arr[$first]" . PHP_EOL;
         }
         echo "yes! '$string' is a palindrom" . PHP_EOL;
         $loop = false;
      }
   } else {
      echo "arr[$first] : $arr[$first], arr[$last] : $arr[$last]" . PHP_EOL;
      echo "nope! '$string' isn't a palindrom" . PHP_EOL;
      $loop = false;
   }
}
