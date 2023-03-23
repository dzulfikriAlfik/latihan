<?php

namespace ProgrammerZamanNow\BelajarPhpMvc\Controller;

use ProgrammerZamanNow\BelajarPhpMvc\App\View;

class HomeController
{
   function index(): void
   {
      $model = [
         "title"   => "Belajar PHP MVC",
         "content" => "Hi, Dzulfikri! Selamat Belajar PHP MVC dari Programmer Zaman Now"
      ];
      // echo "HomeController.index()";

      // render view
      View::render("Home/index", $model);
   }

   function hello(): void
   {
      echo "HomeController.hello()";
   }

   function world(): void
   {
      echo "HomeController.world()";
   }

   function login(): void
   {
      $request = [
         "username" => $_POST['username'],
         "password" => $_POST['password'],
      ];

      $user = [
         //
      ];

      $response = [
         "message" => "Login Sukses"
      ];
      // Kirimkan respose ke view

   }
}
