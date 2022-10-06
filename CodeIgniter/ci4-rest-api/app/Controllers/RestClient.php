<?php

namespace App\Controllers;

use Config\Services;

class RestClient extends BaseController
{
  public function index()
  {
    $url = "http://localhost/latihan/CodeIgniter/ci4-rest-api/public/pegawai";

    $data = [
      "nama"  => "Abdulloh",
      "email" => "abdulloh@gmail.coms"
    ];

    helper("restClient");

    $response = accessRestAPI("GET", $url);

    // dd($response);

    foreach ($response as $key) {
      echo "Nama : " . $key->nama . "<br/>";
      echo "Email : " . $key->email . "<br/><br/><br/>";
    }
  }
}
