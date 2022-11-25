<?php

if (isset($_POST['submit']) && $_POST['g-recaptcha-response'] != "") {
   include "db_config.php";
   $secret = '6LdhOtMgAAAAAH3jEF0f-eLVBmwYZRPi08-RmroM';
   $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
   $responseData = json_decode($verifyResponse);

   if ($responseData->success == false) {
      var_dump($responseData);
      echo "The captcha is wrong!";
   } else {
      //first validate then insert in db
      // $name = $_POST['name'];
      // $email = $_POST['email'];
      // $pass = $_POST['password'];
      // mysqli_query($conn, "INSERT INTO signup(name, email, password) VALUES('$name', '$email', md5('$pass'))");
      echo "Your registration has been successfully done!";
   }
} else {
   echo "you should fill the captcha";
}
