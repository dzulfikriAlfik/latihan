<?php

/**
 * menampilkan todo di list
 * 
 */

function showTodoList()
{
   global $todoList;
   echo "To Do List" . PHP_EOL;

   foreach ($todoList as $number => $value) {
      echo "$number. $value" . PHP_EOL;
   }
}
