<?php

namespace App\Controllers;

class Pages extends BaseController
{
   public function index()
   {
      $data = [
         'title' => 'Home'
      ];
      return view('pages/home', $data);
   }

   //--------------------------------------------------------------------

   public function about()
   {
      $data = [
         'title' => 'About',
         'array' => ['satu', 'dua', 'tiga']
      ];
      return view('pages/about', $data);
   }

   public function contact()
   {
      $data = [
         'title' => 'Contact Us',
         'alamat' => [
            [
               'tipe'   => 'rumah',
               'alamat' => 'Jl. ABC No.123',
               'kota'   => 'Bandung'
            ],
            [
               'tipe'   => 'Hotel',
               'alamat' => 'Jl. CBA No.321',
               'kota'   => 'Majalengka'
            ],
         ]
      ];
      return view('pages/contact', $data);
   }
}
