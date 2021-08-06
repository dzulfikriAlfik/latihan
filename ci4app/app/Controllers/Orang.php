<?php

namespace App\Controllers;

use App\Models\OrangModel;
use CodeIgniter\Exceptions;
use Exception;

class Orang extends BaseController
{

   protected $orangModel;
   public function __construct()
   {
      // model
      $this->orangModel = new orangModel();
   }

   public function index()
   {
      $currentPage = $this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1;

      $keyword = $this->request->getVar('cari');
      if ($keyword != null) {
         $orang = $this->orangModel->search($keyword);
      } else {
         $orang = $this->orangModel;
      }

      $data = [
         'title' => 'Daftar Orang',
         // 'orang' => $this->orangModel->findAll()
         'orang'       => $orang->paginate(10, 'orang'),
         'pager'       => $orang->pager,
         'currentPage' => 1 + (10 * ($currentPage - 1))
      ];

      return view('orang/index', $data);
   }
}
