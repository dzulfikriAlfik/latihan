<?php
require_once "../View/ViewAddTodoList.php";
require_once "../Businesslogic/ShowTodoList.php";
require_once "../Businesslogic/AddTodoList.php";

addTodoList("Dzulfikri");
addTodoList("Alkautsari");

viewAddTodoList();

showTodoList();
