<?php

use Config\Services;
use App\Models\ModelToken;

function accessRestAPI($method, $url, $data = null)
{
  $client = Services::curlrequest();

  $model = new ModelToken();

  $token = $model->getToken("1");

  $tokenPart = explode(".", $token);

  $payload = $tokenPart[1];

  $decode = base64_decode($payload);

  $json = json_decode($decode);

  $expiredToken = $json->exp;

  $timeNow = time();

  if ($timeNow >= $expiredToken) {
    $url = "http://localhost/latihan/CodeIgniter/ci4-rest-api/public/otentikasi";

    $headers = [
      "form_params" => [
        "email"    => "alfik@gmail.com",
        "password" => "asdfasdf"
      ],
      "http_errors" => false
    ];

    $response = $client->request("POST", $url, $headers)->getBody();

    // echo (json_decode($response)->access_token);

    $newToken = json_decode($response)->access_token;

    $dataNewToken = [
      "id"    => "1",
      "token" => $newToken
    ];

    // dd($dataNewToken);

    $model->save($dataNewToken);
  }

  // echo $token;

  // exit();

  $headers = [
    "form_params" => $data,
    "headers"     => [
      "Authorization" => "Bearer $token"
    ],
    "http_errors" => false
  ];

  $response = $client->request($method, $url, $headers);

  return json_decode($response->getBody());
}
