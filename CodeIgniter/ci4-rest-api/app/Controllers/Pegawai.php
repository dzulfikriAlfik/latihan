<?php

namespace App\Controllers;

use CodeIgniter\API\ResponseTrait;
use App\Models\ModelPegawai;

class Pegawai extends BaseController
{
  use ResponseTrait;
  public $model;

  public function __construct()
  {
    $this->model = new ModelPegawai();
  }

  public function index()
  {
    $data = $this->model->orderBy("nama", "ASC")->findAll();

    return $this->respond($data, 200);
  }

  public function show($id = null)
  {
    $data = $this->model->where("id", $id)->findAll();

    if ($data) {
      return $this->respond($data, 200);
    } else {
      return $this->failNotFound("Data tidak ditemukan untuk id : $id");
    }
  }

  public function create()
  {
    // $data = [
    //   "nama"  => $this->request->getVar("nama"),
    //   "email" => $this->request->getVar("email")
    // ];

    $data = $this->request->getPost();

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      "status"  => 201,
      "error"   => false,
      "message" => "Berhasil menambahkan data pegawai",
      "data"    => $data
    ];

    return $this->respond($response);
  }

  public function update($id = null)
  {
    $data = $this->request->getRawInput();
    $data["id"] = $id;

    $isExist = $this->model->where("id", $id)->findAll();

    if (!$isExist) {
      return $this->failNotFound("Data tidak ditemukan");
    }

    if (!$this->model->save($data)) {
      return $this->fail($this->model->errors());
    }

    $response = [
      "status"  => 200,
      "error"   => false,
      "message" => [
        "success" => "Data pegawai dengan id $id berhasil diupdate"
      ]
    ];

    return $this->respond($response);
  }

  public function delete($id = null)
  {
    $data = $this->model->where("id", $id)->findAll();

    if (!$data) {
      return $this->failNotFound("Data tidak ditemukan");
    } else {
      $this->model->delete($id);

      $response = [
        "status"  => 200,
        "error"   => false,
        "message" => [
          "success" => "Data dengan id $id berhasil dihapus"
        ]
      ];

      return $this->respondDeleted($response);
    }
  }
}
