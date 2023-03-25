<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelPegawai extends Model
{
  protected $table = "pegawai";
  protected $primaryKey = "id";
  protected $allowedFields = ["nama", "email"];

  protected $validationRules = [
    "nama"  => "required",
    "email" => "required|valid_email"
  ];

  protected $validationMessages = [
    "nama" => [
      "required" => "Nama harus diisi"
    ],
    "email" => [
      "required"    => "Email harus diisi",
      "valid_email" => "Email yang dimasukkan tidak valid"
    ]
  ];
}
