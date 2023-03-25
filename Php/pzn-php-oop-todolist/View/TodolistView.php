<?php

namespace View {

   use Service\TodolistService;
   use Helper\InputHelper;

   class TodolistView
   {

      private TodolistService $todolistService;

      public function __construct(TodolistService $todolistService)
      {
         $this->todolistService = $todolistService;
      }

      function showTodolist(): void
      {
         while (true) {
            $this->todolistService->showTodolist();

            echo "Menu Todo List" . PHP_EOL;
            echo "1. Tambah Todo" . PHP_EOL;
            echo "2. Hapus Todo" . PHP_EOL;
            echo "x. Keluar" . PHP_EOL;

            $pilihan = InputHelper::input("Pilih");
            if ($pilihan == "1") {
               $this->addTodolist();
            } else if ($pilihan == "2") {
               $this->removeTodolist();
            } else if ($pilihan == "x") {
               // Keluar
               break;
            } else {
               echo "Pilih hanya salah satu dari menu diatas!" . PHP_EOL;
            }
         }
         echo "Sampai jumpa lagi" . PHP_EOL;
      }

      function addTodolist(): void
      {
         echo "Menambah Todo" . PHP_EOL;

         $todo = InputHelper::input("Todo (x untuk batal)");

         if ($todo == "x") {
            // batal input
            echo "Batal menambah Todo";
         } else {
            $this->todolistService->addTodolist($todo);
         }
      }

      function removeTodolist(): void
      {
         echo "Menghapus Todo" . PHP_EOL;

         $pilihan = InputHelper::input("Pilih nomor (x untuk batal)");

         if ($pilihan == "x") {
            echo "Batal menghapus Todo" . PHP_EOL;
         } else {
            $this->todolistService->removeTodolist($pilihan);
         }
      }
   }
}
