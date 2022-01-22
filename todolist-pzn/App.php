<?php

require_once __DIR__ . "/Model/TodoList.php";
require_once __DIR__ . "/Businesslogic/ShowTodoList.php";
require_once __DIR__ . "/Businesslogic/AddTodoList.php";
require_once __DIR__ . "/Businesslogic/RemoveTodoList.php";
require_once __DIR__ . "/View/ViewShowTodoList.php";
require_once __DIR__ . "/View/ViewAddTodoList.php";
require_once __DIR__ . "/View/ViewRemoveTodoList.php";
require_once __DIR__ . "/Helper/Input.php";

echo "Aplikasi To Do List" . PHP_EOL;

viewShowTodoList();
