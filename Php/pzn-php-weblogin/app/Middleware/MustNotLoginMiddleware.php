<?php

namespace BelajarLoginManagement\Middleware;

use BelajarLoginManagement\App\View;
use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;
use BelajarLoginManagement\Service\SessionService;

class MustNotLoginMiddleware implements Middleware
{
  private SessionService $sessionService;

  public function __construct()
  {
    $userRepository = new UserRepository(Database::getConnection());
    $sessionRepository = new SessionRepository(Database::getConnection());
    $this->sessionService = new SessionService($sessionRepository ,$userRepository);
  }

  function before(): void
  {
    $user = $this->sessionService->current();
    if($user != null) {
      View::redirect("/");
    }

  }
}