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
         'title'      => 'Form Tambah Data Komik',
         'validation' => \Config\Services::validation()
      ];
      return view('komik/create', $data);
   }

   public function save()
   {
      // Validasi Input
      if (!$this->validate([
         'judul' => [
            'rules'  => 'required|is_unique[komik.judul]',
            'errors' => [
               'required'  => '{field} harus diisi',
               'is_unique' => '{field} komik sudah ada'
            ]
         ],
         'penulis' => [
            'rules'  => 'required',
            'errors' => [
               'required'  => '{field} harus diisi'
            ]
         ],
         'penerbit' => [
            'rules'  => 'required',
            'errors' => [
               'required'  => '{field} harus diisi',
            ]
         ],
         'sampul' => [
            'rules'  => 'required',
            'errors' => [
               'required'  => '{field} harus diisi'
            ]
         ],
      ])) {
         $validation = \Config\Services::validation();
         return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
      }

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
