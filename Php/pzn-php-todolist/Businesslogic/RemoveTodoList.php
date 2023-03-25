<?php

/**
 * menghapus todo di list
 * 
 */

function removeTodoList(int $number): bool
{
   global $todoList;

   if ($number > sizeof($todoList)) {
      echo "nomor yang anda masukkan melebihi record" . PHP_EOL;
      return false;
   }

   for ($i = $number; $i < sizeof($todoList); $i++) {
      $todoList[$i] = $todoList[$i + 1];
   }
   unset($todoList[$i]);
   return true;
}
