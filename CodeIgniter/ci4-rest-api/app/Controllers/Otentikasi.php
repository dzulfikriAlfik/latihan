<?php

namespace App\Controllers;

use Config\Services;
use App\Models\ModelOtentikasi;
use CodeIgniter\API\ResponseTrait;

class Otentikasi extends BaseController
{
  use ResponseTrait;

  public function index()
  {
    $validation = Services::validation();
    $rules      = [
      "email" => [
        "rules"  => "required|valid_email",
        "errors" => [
          "required"    => "Email tidak boleh kosong",
          "valid_email" => "Email yand dimasukkan tidak valid"
        ]
      ],
      "password" => [
        "rules"  => "required",
        "errors" => [
          "required"    => "Password tidak boleh kosong"
        ]
      ]
    ];

    $validation->setRules($rules);

    if (!$validation->withRequest($this->request)->run()) {
      return $this->fail($validation->getErrors());
    }

    $model = new ModelOtentikasi();

    $email    = $this->request->getVar("email");
    $password = $this->request->getVar("password");

    $data = $model->getEmail($email);

    if ($data["password"] != md5($password)) {
      return $this->fail("Password tidak sesuai");
    }

    helper("jwt");
    $response = [
      "message"      => "Otentikasi berhasil dilakukan",
      "data"         => $data,
      "access_token" => createJWT($email)
    ];

    return $this->respond($response);
  }
}
