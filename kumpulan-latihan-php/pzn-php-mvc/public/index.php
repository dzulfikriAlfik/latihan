<?php

// Contoh script untuk merender view
// $path = "/index";

// if (isset($_SERVER['PATH_INFO'])) {
//    $path = $_SERVER['PATH_INFO'];
// }

// $fullpath = __DIR__ . '/../app/View' . $path . '.php';

// if (!file_exists($fullpath)) $fullpath = __DIR__ . '/../app/View/not-found.php';
// require $fullpath;


// Code untuk menjalankan fungsi router
require_once __DIR__ . '/../vendor/autoload.php';

use ProgrammerZamanNow\BelajarPhpMvc\App\Router;
use ProgrammerZamanNow\BelajarPhpMvc\Controller\HomeController;
use ProgrammerZamanNow\BelajarPhpMvc\Controller\ProductController;
use ProgrammerZamanNow\BelajarPhpMvc\Controller\UserController;
use ProgrammerZamanNow\BelajarPhpMvc\Middleware\AuthMiddleware;

Router::add('GET', '/', HomeController::class, 'index');
Router::add('GET', '/hello', HomeController::class, 'hello', [AuthMiddleware::class]);
Router::add('GET', '/world', HomeController::class, 'world', [AuthMiddleware::class]);
Router::add('GET', '/login', UserController::class, 'login');
Router::add('GET', '/products/([0-9]*)/categories/([a-zA-Z]*)', ProductController::class, 'categories');

Router::run();

// Cara menjalanan local domain di windows
// 1. buka C:\Windows\System32\Drivers\etc\hosts
// 2. ubah 127.0.0.1 localhost -> menjadi -> 127.0.0.1 php-mvc.alfik atau apapun
// 3. untuk menjalankan servernya panggil dengan php -S 127.0.0.1:8080
// 4. cari file httpd.conf lalu cari keyword Include conf/extra/httpd-vhosts.conf dan matikan komentarnya
// 5. cari file httpd-vhosts.conf dan ubah isinya menjadi seperti dibawah ini
// <VirtualHost *:80>
//   ServerAdmin admin@php-mvc.alfik
//   DocumentRoot "C:\Programming\wamp64\www\latihan\kumpulan-latihan-php\pzn-php-mvc\public"
//   ServerName php-mvc.alfik
//   ErrorLog "logs/php-mvc.alfik.error_log"
//   CustomLog "logs/php-mvc.alfik-acces_log" common
// </VirtualHost>
// 6. jalankan xamp/wampnya (tidak perlu perintah php -S 127.0.0.1:8080 lagi)
