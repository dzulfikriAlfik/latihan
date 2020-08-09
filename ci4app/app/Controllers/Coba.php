<?php

namespace App\Controllers;

class Coba extends BaseController
{

   public function index()
   {
      echo 'Ini adalah Coba::index';
   }

   public function about($nama = '', $umur = 0)
   {
      echo 'Ini adalah Coba::about';
      echo "<br>halo nama saya $nama, saya berumur $umur";
   }

   //--------------------------------------------------------------------

}
