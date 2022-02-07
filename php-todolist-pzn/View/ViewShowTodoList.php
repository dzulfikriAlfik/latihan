<?php

/**
 * menampilkan view todo di list
 * 
 */

require_once __DIR__ . "/../Model/TodoList.php";
require_once __DIR__ . "/../Businesslogic/ShowTodoList.php";
require_once __DIR__ . "/../Helper/Input.php";
require_once __DIR__ . "/ViewAddTodoList.php";
require_once __DIR__ . "/ViewRemoveTodoList.php";

function viewShowTodoList()
{
   while (true) {
      showTodoList();

      echo <<<MENU
      Menu Todo List
      1. Tambah Todo
      2. Hapus Todo
      x. Keluar

   MENU;

      $pilihan = input("Pilih");
      if ($pilihan == "1") {
         viewAddTodoList();
      } else if ($pilihan == "2") {
         viewRemoveTodoList();
      } else if ($pilihan == "x") {
         // Keluar
         break;
      } else {
         echo "Pilih hanya salah satu dari menu diatas!" . PHP_EOL;
      }
   }
   echo "Sampai jumpa lagi" . PHP_EOL;
}
