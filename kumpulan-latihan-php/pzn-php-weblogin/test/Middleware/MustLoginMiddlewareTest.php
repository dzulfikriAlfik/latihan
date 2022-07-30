<?php

namespace BelajarLoginManagement\Middleware {
  require_once __DIR__ . "/../Helper/helper.php";

  use BelajarLoginManagement\Config\Database;
  use BelajarLoginManagement\Domain\Session;
  use BelajarLoginManagement\Domain\User;
  use BelajarLoginManagement\Repository\SessionRepository;
  use BelajarLoginManagement\Repository\UserRepository;
  use BelajarLoginManagement\Service\SessionService;
  use PHPUnit\Framework\TestCase;

  class MustLoginMiddlewareTest extends TestCase
  {
    private MustLoginMiddleware $middleware;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

    protected function setUp(): void {
      $this->middleware = new MustLoginMiddleware();
      $this->userRepository = new UserRepository(Database::getConnection());
      $this->sessionRepository = new SessionRepository(Database::getConnection());

      $this->sessionRepository->deleteAll();
      $this->userRepository->deleteAll();


      putenv("mode=test");
    }

    public function testBeforeGuest() {
      $this->middleware->before();

      $this->expectOutputRegex("[Location: /users/login]");
    }

    public function testBeforeLoginUser() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = "rahasia";
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $this->middleware->before();

      $this->expectOutputString("");
    }
  }
}
