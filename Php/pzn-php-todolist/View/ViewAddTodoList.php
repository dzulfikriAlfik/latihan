<?php

/**
 * menampilkan view add todo di list
 * 
 */

require_once __DIR__ . "/../Helper/Input.php";
require_once __DIR__ . "/../Model/TodoList.php";
require_once __DIR__ . "/../Businesslogic/AddTodoList.php";

function viewAddTodoList()
{
   echo "Menambah Todo" . PHP_EOL;

   $todo = input("Todo (x untuk batal)");

   if ($todo == "x") {
      // batal input
      echo "Batal menambah Todo";
   } else {
      addTodoList($todo);
   }
}
