<?php

require_once "../Model/TodoList.php";
require_once "../Businesslogic/AddTodoList.php";
require_once "../Businesslogic/ShowTodoList.php";
require_once "../View/ViewRemoveTodoList.php";

addTodoList("Dzulfikri");
addTodoList("Alkautsari");
addTodoList("Programmer");

showTodoList();

viewRemoveTodoList();
showTodoList();
