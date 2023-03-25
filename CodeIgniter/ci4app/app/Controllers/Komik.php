<?php

namespace App\Controllers;

use App\Models\KomikModel;

class Komik extends BaseController
{

    protected $komikModel;

    public function __construct()
    {
        $this->komikModel = new KomikModel();
    }

    public function index()
    {
        // $komik = $this->komikModel->findAll();
        $komik = $this->komikModel->getKomik();
        $data = [
            'title' => 'Daftar Komik',
            'komik' => $komik,
        ];
        return view('komik/index', $data);
    }

    public function detail($slug)
    {
        $komik = $this->komikModel->getKomik($slug);
        $data = [
            'title' => "Detail Komik",
            'komik' => $komik,
        ];
        // cek jika komik tidak ada di database
        if (empty($data['komik'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Judul Komik ' . $slug . ' Tidak ditemukan');
        }
        return view('komik/detail', $data);
    }

    public function create()
    {
        $data = [
            'title' => 'Form Tambah Data Komik',
            'validation' => \Config\Services::validation(),
        ];
        return view('komik/create', $data);
    }

    public function save()
    {
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => 'required|is_unique[komik.judul]',
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} sudah terdaftar',
                ],
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'uploaded[sampul]|max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'uploaded' => 'Tidak ada gambar yang dipilih!',
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB',
                    'is_image' => 'Upload hanya gambar!',
                    'mime_in' => 'Ekstensi yang diperbolehkan (jpg/jpeg/png)',
                ],
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/create')->withInput()->with('validation', $validation);
            return redirect()->to('/komik/create')->withInput();
        }

        // ambil gambar
        $fileSampul = $this->request->getFile('sampul');
        // pindahkan file ke folder img
        $fileSampul->move('img');
        // mendapatkan sama file yang diupload
        $namaSampul = $fileSampul->getName();

        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);
        $this->komikModel->save([
            'judul' => $judul,
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil ditambahkan');

        return redirect()->to('/komik');
    }

    public function delete($id)
    {
        // cari gambar berdasarkan id
        $komik = $this->komikModel->find($id);
        // hapus gambar di folder
        unlink('img/' . $komik['sampul']);

        $this->komikModel->delete($id);
        session()->setFlashdata('pesan', 'Data berhasil dihapus');
        return redirect()->to('/komik');
    }

    public function edit($slug)
    {
        $data = [
            'title' => 'Form Ubah Data Komik',
            'validation' => \Config\Services::validation(),
            'komik' => $this->komikModel->getKomik($slug),
        ];
        return view('komik/edit', $data);
    }

    public function update($id)
    {
        // cek duplikasi judul
        $komikLama = $this->komikModel->getKomik($this->request->getVar('slug'));
        if ($komikLama['judul'] == $this->request->getVar('judul')) {
            $rules = 'required';
        } else {
            $rules = 'required|is_unique[komik.judul]';
        }
        // validasi input
        if (!$this->validate([
            'judul' => [
                'rules' => $rules,
                'errors' => [
                    'required' => '{field} komik harus diisi',
                    'is_unique' => '{field} sudah terdaftar',
                ],
            ],
            'penulis' => 'required',
            'penerbit' => 'required',
            'sampul' => [
                'rules' => 'max_size[sampul,1024]|is_image[sampul]|mime_in[sampul,image/jpg,image/jpeg,image/png]',
                'errors' => [
                    'max_size' => 'Gambar tidak boleh lebih dari 1MB',
                    'is_image' => 'Upload hanya gambar!',
                    'mime_in' => 'Ekstensi yang diperbolehkan (jpg/jpeg/png)',
                ],
            ],
        ])) {
            // $validation = \Config\Services::validation();
            // return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput()->with('validation', $validation);
            return redirect()->to('/komik/edit/' . $this->request->getVar('slug'))->withInput();
        }
        $fileSampul = $this->request->getFile('sampul');
        // cek apakah gambar di ubah
        if ($fileSampul->getError() == 4) {
            $namaSampul = $this->request->getVar('sampulLama');
        } else {
            $fileSampul->move('img');
            // mendapatkan sama file yang diupload
            $namaSampul = $fileSampul->getName();
            // hapus sampul lama di folder
            unlink('img/' . $this->request->getVar('sampulLama'));
        }
        $judul = $this->request->getVar('judul');
        $slug = url_title($judul, '-', true);
        $this->komikModel->save([
            'id' => $id,
            'judul' => $judul,
            'slug' => $slug,
            'penulis' => $this->request->getVar('penulis'),
            'penerbit' => $this->request->getVar('penerbit'),
            'sampul' => $namaSampul,
        ]);

        session()->setFlashdata('pesan', 'Data berhasil diubah');

        return redirect()->to('/komik');
    }
}