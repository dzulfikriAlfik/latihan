<?php

use App\Models\ModelOtentikasi;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

function getJWT($otentikasiHeader)
{
  if (is_null($otentikasiHeader)) {
    throw new Exception("Otentikasi JWT gagal");
  }

  return explode(" ", $otentikasiHeader)[1];
}

function validateJWT($encodedToken)
{
  $key = getenv("JWT_SECRET_KEY");
  $decodedToken = JWT::decode($encodedToken, new Key($key, "HS256"));
  $modelOtentikasi = new ModelOtentikasi();

  $modelOtentikasi->getEmail($decodedToken->email);
}

function createJWT($email)
{
  $requestTime = time();
  $tokenTime   = getenv("JWT_TIME_TO_LIVE");
  $expiredTime = $requestTime + $tokenTime;
  $payload     = [
    "email" => $email,
    "iat"   => $requestTime,
    "exp"   => $expiredTime
  ];

  return JWT::encode($payload, getenv("JWT_SECRET_KEY"), "HS256");
}
