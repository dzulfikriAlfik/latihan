<?php

require_once __DIR__ . '/../vendor/autoload.php';

use BelajarLoginManagement\App\Router;
use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Controller\HomeController;
use BelajarLoginManagement\Controller\UserController;
use BelajarLoginManagement\Middleware\MustLoginMiddleware;
use BelajarLoginManagement\Middleware\MustNotLoginMiddleware;

Database::getConnection("prod");

// Home
Router::add('GET', '/', HomeController::class, 'index', []);

// User
  # Register
Router::add('GET', '/users/register', UserController::class, 'register', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/register', UserController::class, 'postRegister', [MustNotLoginMiddleware::class]);
  # Login
Router::add('GET', '/users/login', UserController::class, 'login', [MustNotLoginMiddleware::class]);
Router::add('POST', '/users/login', UserController::class, 'postLogin', [MustNotLoginMiddleware::class]);
  # Logout
Router::add('GET', '/users/logout', UserController::class, 'logout', [MustLoginMiddleware::class]);
  # Update Profile
Router::add('GET', '/users/profile', UserController::class, 'updateProfile', [MustLoginMiddleware::class]);
Router::add('POST', '/users/profile', UserController::class, 'postUpdateProfile', [MustLoginMiddleware::class]);
  # Update Profile
Router::add('GET', '/users/password', UserController::class, 'updatePassword', [MustLoginMiddleware::class]);
Router::add('POST', '/users/password', UserController::class, 'postUpdatePassword', [MustLoginMiddleware::class]);

Router::run();