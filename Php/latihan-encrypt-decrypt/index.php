<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Encrypt decrypt string</title>
</head>

<body>
   <h2>Encrypt Decrypt string</h2>
   <form action="" method="post">
      <label for="encrypt">Input string
         <input type="text" id="encrypt" name="encrypt">
      </label>
      <br />
      <br />
      <label for="key">Input key
         <input type="text" id="key" name="key">
      </label>
      <br />
      <br />
      <label for="type">Input type
         <select name="type" id="type">
            <option value="e">Encrypt</option>
            <option value="d">Decrypt</option>
         </select>
      </label>
      <br />
      <br />
      <button type="submit" name="submit">Kirim</button>
   </form>
</body>

</html>

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

if (isset($_POST["submit"])) {
   $key    = $_POST["key"];
   $string = $_POST["encrypt"];
   $type   = $_POST["type"];

   if ($type == "e") {
      echo "String : $string <br/>";
      echo "Key : $key <br/>";
      echo "Encrypted : " . encrypt_decrypt("e", $string, $key) . "<br/>";
   } else {
      echo "String : $string <br/>";
      echo "Key : $key <br/>";
      echo "Decrypted : " . encrypt_decrypt("d", $string, $key) . "<br/>";
   }
}

?>