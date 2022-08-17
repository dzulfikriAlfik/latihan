<?php
define('IV_KEY', "UHEFIU0989834R93HFBF8-982R29");

function encrypt_decrypt($action, $string, $key = "")
{
   $output = false;
   $encrypt_method = "AES-256-CBC";

   $secret_key = $key;

   $secret_iv = IV_KEY;
   // hash
   $key = hash('sha256', $secret_key);

   // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
   $iv = substr(hash('sha256', $secret_iv), 0, 16);
   if ($action == 'e') {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
   } else if ($action == 'd') {
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
   }
   return $output;
}

$user_id = "624c045485047";
$user_point = "cHBIemZnd2dBcVZRZ1RXQVZPZ1Zpdz09";
$user_saldo = "500000";
$user_point_dec = encrypt_decrypt("e", $user_saldo, $user_id);
echo "user_point_enc : $user_point_dec" . "<br>";
$user_point_dec = encrypt_decrypt("d", $user_point, $user_id);
echo "user_point_dec : $user_point_dec" . "<br>";
