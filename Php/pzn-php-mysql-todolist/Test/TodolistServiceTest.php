<?php

require_once __DIR__ . "/../Config/Database.php";
require_once __DIR__ . "/../Entity/Todolist.php";
require_once __DIR__ . "/../Repository/TodolistRepository.php";
require_once __DIR__ . "/../Service/TodolistService.php";

use Config\Database;
use Entity\Todolist;
use Repository\TodolistRepositoryImpl;
use Service\TodolistServiceImpl;

function testShowTodolist(): void
{
   $connection = Database::getConnection();
   $todolistRepository = new TodolistRepositoryImpl($connection);
   $todolistService = new TodolistServiceImpl($todolistRepository);

   // $todolistService->addTodolist("Belajar PHP Dasar");
   // $todolistService->addTodolist("Belajar PHP OOP");
   // $todolistService->addTodolist("Belajar PHP Database");

   $todolistService->showTodolist();
}

function testAddTodolist(): void
{
   $connection = Database::getConnection();
   $todolistRepository = new TodolistRepositoryImpl($connection);

   $todolistService = new TodolistServiceImpl($todolistRepository);
   $todolistService->addTodolist("Belajar PHP Dasar");
   $todolistService->addTodolist("Belajar PHP OOP");
   $todolistService->addTodolist("Belajar PHP Database");

   // $todolistService->showTodolist();
}

function testRemoveTodolist(): void
{
   $connection = Database::getConnection();
   $todolistRepository = new TodolistRepositoryImpl($connection);

   $todolistService = new TodolistServiceImpl($todolistRepository);

   $todolistService->removeTodolist(5) . PHP_EOL;
   $todolistService->removeTodolist(3) . PHP_EOL;
   $todolistService->removeTodolist(2) . PHP_EOL;
   $todolistService->removeTodolist(1) . PHP_EOL;
}

testShowTodolist();
// testAddTodolist();
// testRemoveTodolist();
