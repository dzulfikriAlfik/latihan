<?php
require __DIR__ . '/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$log = new Logger("ProgrammerDzulfikri");
$log->pushHandler(new StreamHandler("application.log", Logger::INFO));

for ($i = 1; $i < 11; $i++) {
   $log->info("Hello World!" . $i);
   $log->info("Selamat Belajar Composer");
}
