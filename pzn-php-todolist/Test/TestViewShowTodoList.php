<?php
require_once "../View/ViewShowTodoList.php";
require_once "../Businesslogic/AddTodoList.php";

addTodoList("Belajar PHP Dasar");
addTodoList("Belajar PHP OOP");
addTodoList("Belajar PHP Database");

viewShowTodoList();
