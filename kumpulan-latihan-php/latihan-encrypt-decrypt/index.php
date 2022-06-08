<?php
define('IV_KEY', "UHEFIU0989834R93HFBF8-982R29");

function encrypt_decrypt($action, $string, $key = "")
{
   $output = false;
   $encrypt_method = "AES-256-CBC";

   $secret_key = '4N1';
   if ($key != "") {
      $secret_key = $key;
   }

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

$pointEnc = encrypt_decrypt('e', "Rp.10.000,-", "percobaan");
echo "pointEnc : $pointEnc" . "<br>";
$pointDec = encrypt_decrypt("d", $pointEnc, "percobaan");
echo "pointDec : $pointDec" . "<br>";
