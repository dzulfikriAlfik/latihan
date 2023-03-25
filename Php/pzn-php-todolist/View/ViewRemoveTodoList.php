<?php

/**
 * menampilkan view hapus todo di list
 * 
 */

require_once __DIR__ . "/../Helper/Input.php";
require_once __DIR__ . "/../Model/TodoList.php";
require_once __DIR__ . "/../Businesslogic/RemoveTodoList.php";

function viewRemoveTodoList()
{
   echo "Menghapus Todo" . PHP_EOL;

   $pilihan = (int) input("Pilih nomor (x untuk batal)");

   if ($pilihan == "x") {
      echo "Batal menghapus Todo" . PHP_EOL;
   } else {
      $success = removeTodoList($pilihan);

      if ($success) {
         echo "Data Todo nomor $pilihan berhasil dihapus" . PHP_EOL;
      } else {
         echo "Data Todo nomor $pilihan gagal dihapus" . PHP_EOL;
      }
   }
}
