<?php

namespace Repository {

   use Entity\Todolist;

   interface TodolistRepository
   {
      function save(Todolist $todolist): void;

      function remove(int $number): bool;

      function findAll(): array;
   }

   class TodolistRepositoryImpl implements TodolistRepository
   {

      public array $todolist = [];
      private \PDO $connection;

      public function __construct(\PDO $connection)
      {
         $this->connection = $connection;
      }

      /* ---------------------------------- Save ---------------------------------- */
      function save(Todolist $todolist): void
      {
         // $number = sizeof($this->todolist) + 1;
         // $this->todolist[$number] = $todolist;
         $sql = "INSERT INTO todolist(todo) VALUES (?)";
         $statement = $this->connection->prepare($sql);
         $statement->execute([$todolist->getTodo()]);
      }

      /* --------------------------------- Remove --------------------------------- */
      function remove(int $number): bool
      {
         // if ($number > sizeof($this->todolist)) {
         //    echo "nomor yang anda masukkan melebihi record" . PHP_EOL;
         //    return false;
         // }

         // for ($i = $number; $i < sizeof($this->todolist); $i++) {
         //    $this->todolist[$i] = $this->todolist[$i + 1];
         // }
         // unset($this->todolist[$i]);
         // return true;

         $sql = "SELECT id FROM todolist WHERE id = ?";
         $statement = $this->connection->prepare($sql);
         $statement->execute([$number]);

         if ($statement->fetch()) {
            // todolist ada di record
            $sql = "DELETE FROM todolist WHERE id = ?";
            $statement = $this->connection->prepare($sql);
            $statement->execute([$number]);
            return true;
         } else {
            // todolist tidak ada
            return false;
         }
      }

      /* -------------------------------- Find All -------------------------------- */
      function findAll(): array
      {
         // return $this->todolist;
         $sql = "SELECT id, todo FROM todolist";
         $statement = $this->connection->prepare($sql);
         $statement->execute();

         $result = [];

         foreach ($statement as $row) {
            $todolist = new Todolist();
            $todolist->setId($row["id"]);
            $todolist->setTodo($row["todo"]);

            $result[] = $todolist;
         }

         return $result;
      }
   }
}
