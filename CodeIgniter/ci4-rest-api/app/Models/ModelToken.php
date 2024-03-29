<?php

namespace App\Models;

use CodeIgniter\Model;

class ModelToken extends Model
{
  protected $table = "token";
  protected $primaryKey = "id";
  protected $allowedFields = ["id", "token"];

  public function getToken($id)
  {
    $builder = $this->table("token");

    $data = $builder->where("id", $id)->first();

    return $data["token"];
  }
}
