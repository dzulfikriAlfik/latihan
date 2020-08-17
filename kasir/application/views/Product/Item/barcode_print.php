<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Barcode Product - <?= $row->barcode; ?></title>
</head>

<body style="text-align:center">
   <p>Barcode - <?= $row->barcode; ?></p>
   <?php
   $generator = new Picqer\Barcode\BarcodeGeneratorPNG();
   echo '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($row->barcode, $generator::TYPE_CODE_128)) .'" style="width:200px">';
   ?>
</body>

</html>