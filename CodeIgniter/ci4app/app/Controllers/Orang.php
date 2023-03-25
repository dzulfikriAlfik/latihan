<?php

namespace App\Controllers;

use App\Models\OrangModel;

class Orang extends BaseController
{

    protected $orangModel;

    public function __construct()
    {
        $this->orangModel = new OrangModel();
    }

    public function index()
    {
        // $orang = $this->orangModel->findAll();
        $page = ($this->request->getVar('page_orang') ? $this->request->getVar('page_orang') : 1);

        $keyword = $this->request->getVar('keyword');
        if ($keyword) {
            $orang = $this->orangModel->search($keyword);
        } else {
            $orang = $this->orangModel;
        }
        $data = [
            'title' => 'Daftar orang',
            'orang' => $orang->paginate(10, 'orang'),
            'pager' => $this->orangModel->pager,
            'page' => 1 + (10 * ($page - 1)),
        ];
        return view('orang/index', $data);
    }
}