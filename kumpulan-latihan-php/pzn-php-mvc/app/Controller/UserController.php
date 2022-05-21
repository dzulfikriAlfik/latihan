<?php

namespace ProgrammerZamanNow\BelajarPhpMvc\Controller;

use ProgrammerZamanNow\BelajarPhpMvc\App\View;

class UserController
{
   function login(): void
   {
      $model = [
         "title"   => "Belajar PHP MVC",
         "content" => "Anda harus login terlebih dahulu"
      ];

      // render view
      View::render("login", $model);
   }
}
