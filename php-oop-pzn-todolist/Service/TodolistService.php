<?php

namespace Service {

   use Entity\Todolist;
   use Repository\TodolistRepository;

   interface TodolistService
   {
      function showTodolist(): void;

      function addTodolist(string $todo): void;

      function removeTodolist(int $number): void;
   }

   class TodolistServiceImpl implements TodolistService
   {

      private TodolistRepository $todolistRepository;

      public function __construct(TodolistRepository $todolistRepository)
      {
         $this->todolistRepository = $todolistRepository;
      }

      function showTodolist(): void
      {
         echo "Todolist" . PHP_EOL;

         $todolist = $this->todolistRepository->findAll();
         foreach ($todolist as $number => $value) {
            echo "$number. " . $value->getTodo() . PHP_EOL;
         }
      }

      function addTodolist(string $todo): void
      {
         $todolist = new Todolist($todo);
         $this->todolistRepository->save($todolist);
         echo "Sukses menambah Todolist" . PHP_EOL;
      }

      function removeTodolist(int $number): void
      {
         if ($this->todolistRepository->remove($number)) {
            echo "Sukses menghapus todolist no $number" . PHP_EOL;
         } else {
            echo "Gagal menghapus todolist no $number" . PHP_EOL;
         }
      }
   }
}
