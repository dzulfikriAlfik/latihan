<?php

namespace App\Controllers;

use App\Models\KomikModel;
use CodeIgniter\Exceptions;
use Exception;

class Komik extends BaseController
{

   protected $komikModel;
   public function __construct()
   {
      // model
      $this->komikModel = new KomikModel();
   }

   public function index()
   {

      $data = [
         'title' => 'Daftar Komik',
         'komik' => $this->komikModel->getKomik()
      ];

      return view('komik/index', $data);
   }

   public function detail($slug)
   {
      $data = [
         'title' => 'Detail Komik',
         'komik' => $this->komikModel->getKomik($slug)
      ];

      // Jika Komik tidak ada di table
      if (empty($data['komik'])) {
         throw new Exceptions\PageNotFoundException("Judul Komik $slug tidak ditemukan");
      }

      return view('komik/detail', $data);
   }

   public function create()
   {
      $data = [
         'title' => 'Form Tambah Data Komik'
      ];
      return view('komik/create', $data);
   }

   public function save()
   {
      $slug = url_title($this->request->getVar('judul'), '-', true);
      $this->komikModel->save([
         'judul'    => $this->request->getVar('judul'),
         'slug'     => $slug,
         'penulis'  => $this->request->getVar('penulis'),
         'penerbit' => $this->request->getVar('penerbit'),
         'sampul'   => $this->request->getVar('sampul')
      ]);

      session()->setFlashdata('pesan', 'Data Komik Berhasil ditambahkan');
      return redirect()->to('/komik');
   }
}
