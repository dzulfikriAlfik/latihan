<?php

namespace BelajarLoginManagement\App;

use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Controller\HomeController;
use BelajarLoginManagement\Domain\Session;
use BelajarLoginManagement\Domain\User;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;
use BelajarLoginManagement\Service\SessionService;
use PhpParser\Node\Expr\New_;
use PHPUnit\Framework\TestCase;

class HomeControllerTest extends TestCase
{
  private HomeController $homeController;
  private UserRepository $userRepository;
  private SessionRepository $sessionRepository;

  protected function setUp(): void {
    $this->homeController = new HomeController();
    $this->sessionRepository = new SessionRepository(Database::getConnection());
    $this->userRepository = new UserRepository(Database::getConnection());

    $this->sessionRepository->deleteAll();
    $this->userRepository->deleteAll();

  }

  public function testGuest(){
    $this->homeController->index();

    $this->expectOutputRegex("[Login Management]");
  }

  public function testUserLogin(){
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

    $this->homeController->index();

    $this->expectOutputRegex("[Hello Dzulfikri]");
  }
}