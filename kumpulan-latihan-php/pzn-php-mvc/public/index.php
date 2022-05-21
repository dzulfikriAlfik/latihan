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
// 2. ubah 127.0.0.1 localhost -> menjadi -> 127.0.0.1 dzulfikri.alfik atau apapun
