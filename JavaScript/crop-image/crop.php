<?php
require 'vendor/autoload.php';

use Intervention\Image\ImageManagerStatic as Image;

if (isset($_POST['submit'])) {

   if (isset($_FILES['image']['name']) && !empty($_FILES['image']['name'])) {

      if (!file_exists('images')) {
         mkdir('images', 0755);
      }

      $filename = $_FILES['image']['name'];
      $filepath = 'images/' . $filename;
      move_uploaded_file($_FILES['image']['tmp_name'], $filepath);

      if (!file_exists('images/crop')) {
         mkdir('images/crop', 0755);
      }

      // crop image
      $img = Image::make($filepath);
      $croppath = 'images/crop/' . $filename;
      $width = $_POST['w'];
      $height = $_POST['h'];
      $x1 = $_POST['x1'];
      $y1 = $_POST['y1'];
      // echo "<script>console.log('Width : ' + $width)</script>";
      // echo "<script>console.log('Height : ' + $height)</script>";
      // echo "<script>console.log('X1 : ' + $x1)</script>";
      // echo "<script>console.log('Y1 : ' + $y1)</script>";
      // $img->resizeCanvas(1280, 720, 'center', false, 'ff00ff');
      $img->crop($width, $height, $x1, $y1);
      $img->save($croppath);

      echo "<img src='" . $croppath . "' />";
   }
}
