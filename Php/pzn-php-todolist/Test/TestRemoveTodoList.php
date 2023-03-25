<?php

require_once "../Model/TodoList.php";
require_once "../Businesslogic/ShowTodoList.php";
require_once "../Businesslogic/AddTodoList.php";
require_once "../Businesslogic/RemoveTodoList.php";

addTodoList("Dzul");
addTodoList("Fikri");
addTodoList("Alkautsari");
showTodoList();
removeTodoList(2);
showTodoList();
