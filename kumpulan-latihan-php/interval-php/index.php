<?php
function setInterval($f, $milliseconds)
{
   $seconds = (int) $milliseconds / 1000;
   while (true) {
      $f();
      sleep($seconds);
   }
}
$a = 1;
$b = 2;

setInterval(function () use ($a, $b) {
   echo 'a=' . $a . '; $b=' . $b . "\n";
}, 1000);
