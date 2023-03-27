<?php

namespace App\Controllers;

use App\Models\MovieModel;
use App\Models\GenreModel;

class Dashboard extends BaseController
{

   protected $MovieModel;
   protected $GenreModel;
   // private $db;
   public function __construct()
   {
      // model
      $this->MovieModel = new MovieModel();
      $this->GenreModel = new GenreModel();
   }

   // private function isLoggedIn() 
   // {
   //    if(!session()->get('isLoggedIn')) {
   //       return redirect()->to('/');
   //    }
   // }

   public function index()
   {
      if (!session()->get('isLoggedIn')) {
         return redirect()->to('/');
      }

      $data = [
         'judul' => 'Dashboard',
         'title' => $this->MovieModel->getMovie()
      ];
      helper(['fungsi']);
      return view('dashboard/index', $data);
   }

   public function genreList()
   {
      if (!session()->get('isLoggedIn')) {
         return redirect()->to('/');
      }
      $data = [
         'judul'     => 'Genre List',
         'genreList' => $this->GenreModel->getGenre()
      ];
      return view('dashboard/genreList', $data);
   }
}
