<?php

namespace BelajarLoginManagement\Controller;

use BelajarLoginManagement\App\View;
use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;
use BelajarLoginManagement\Service\SessionService;

class HomeController
{
  private SessionService $sessionService;

  public function __construct()
  {
    $connection = Database::getConnection();
    $sessionRepository = new SessionRepository($connection);
    $userRepository = new UserRepository($connection);
    $this->sessionService = new SessionService($sessionRepository, $userRepository);
  }


  function index():void {
    $user = $this->sessionService->current();

    if ($user == null) {
      View::render("Home/index", [
        "title" => "PHP Login Management"
      ]);
    } else {
      View::render("Home/dashboard", [
        "title" => "Dashboard",
        "user" => [
          "name" => $user->name
        ]
      ]);
    }
  }
}