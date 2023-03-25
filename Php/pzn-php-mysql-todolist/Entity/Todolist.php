<?php


namespace Entity {

   class Todolist
   {
      private int $id;
      private string $todo;

      public function __construct(string $todo = "")
      {
         $this->todo = $todo;
      }

      public function setId(int $id)
      {
         return $this->id = $id;
      }

      public function getId()
      {
         return $this->id;
      }

      public function setTodo(string $todo)
      {
         return $this->todo = $todo;
      }

      public function getTodo(): string
      {
         return $this->todo;
      }
   }
}
