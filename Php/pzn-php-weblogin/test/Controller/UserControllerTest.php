<?php

namespace BelajarLoginManagement\Controller {
  require_once __DIR__ . "/../Helper/helper.php";

  use BelajarLoginManagement\Config\Database;
  use BelajarLoginManagement\Domain\Session;
  use BelajarLoginManagement\Domain\User;
  use BelajarLoginManagement\Repository\SessionRepository;
  use BelajarLoginManagement\Repository\UserRepository;
  use BelajarLoginManagement\Service\SessionService;
  use PHPUnit\Framework\TestCase;

  class UserControllerTest extends TestCase
  {
    private UserController $userController;
    private UserRepository $userRepository;
    private SessionRepository $sessionRepository;

    protected function setUp(): void
    {
      $this->userController = new UserController();
      $this->userRepository = new UserRepository(Database::getConnection());
      $this->sessionRepository = new SessionRepository(Database::getConnection());

      $this->sessionRepository->deleteAll();
      $this->userRepository->deleteAll();

      putenv("mode=test");
    }

    public function testRegister()
    {
      $this->userController->register();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Name]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Register new user]");
    }

    public function testPostRegisterSuccess()
    {
      $_POST['id'] = "eko";
      $_POST['name'] = "Eko";
      $_POST['password'] = "rahasia";

      $this->userController->postRegister();

      $this->expectOutputRegex("[Location: /users/login]");
    }

    public function testPostRegisterValidationError()
    {
      $_POST['id'] = "";
      $_POST['name'] = "";
      $_POST['password'] = "";

      $this->userController->postRegister();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Name]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id, Name, Password cannot be blank]");
    }

    public function testPostRegisterDuplicate()
    {
      $user = new User();
      $user->id = "eko";
      $user->name = "Eko";
      $user->password = "rahasia";

      $this->userRepository->save($user);

      $_POST['id'] = "eko";
      $_POST['name'] = "Eko";
      $_POST['password'] = "rahasia";

      $this->userController->postRegister();

      $this->expectOutputRegex("[Register]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Name]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[User already exist]");
    }

    public function testLogin()
    {
      $this->userController->login();

      $this->expectOutputRegex("[Login]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Login user]");
    }

    public function testLoginSuccess()
    {
      $user = new User();
      $user->id = "eko";
      $user->name = "Eko";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);

      $this->userRepository->save($user);

      $_POST['id'] = "eko";
      $_POST['password'] = "rahasia";

      $this->userController->postLogin();

      $this->expectOutputRegex("[Location: /]");
      $this->expectOutputRegex("[X-PZN-SESSION: ]");
    }

    public function testLoginValidationError()
    {
      $_POST['id'] = "";
      $_POST['password'] = "";

      $this->userController->postLogin();

      $this->expectOutputRegex("[Login]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id, Password cannot be blank]");
    }

    public function testLoginUserNotFound()
    {
      $_POST['id'] = "notfound";
      $_POST['password'] = "notfound";

      $this->userController->postLogin();

      $this->expectOutputRegex("[Login]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id or Password is wrong]");
    }

    public function testLoginWrongPassword()
    {
      $user = new User();
      $user->id = "eko";
      $user->name = "Eko";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);

      $this->userRepository->save($user);

      $_POST['id'] = "eko";
      $_POST['password'] = "salah";

      $this->userController->postLogin();

      $this->expectOutputRegex("[Login]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id or Password is wrong]");
    }

    public function testLogout() {
      $user = new User();
      $user->id = "eko";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $this->userController->logout();

      $this->expectOutputRegex("[X-PZN-SESSION: ]");
      $this->expectOutputRegex("[Location: /]");
    }

    public function testUpdateProfile() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $this->userController->updateProfile();

      $this->expectOutputRegex("[Profile]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[Dzulfikri]");
      $this->expectOutputRegex("[Name]");
    }

    public function testPostUpdateProfileSuccess() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $_POST['name'] = "Dzulfikri";
      $this->userController->postUpdateProfile();

      $this->expectOutputRegex("[Location: /]");

      $result = $this->userRepository->findById("dzulfikri");
      self::assertEquals("Dzulfikri", $result->name);
    }

    public function testPostUpdateProfileValidationError() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $_POST['name'] = "";
      $this->userController->postUpdateProfile();

      $this->expectOutputRegex("[Profile]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[dzulfikri]");
      $this->expectOutputRegex("[Name]");
      $this->expectOutputRegex("[Id, Name cannot be blank]");
    }

    public function testUpdatePassword() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $this->userController->updatePassword();

      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[dzulfikri]");

    }

    public function testPostUpdatePasswordSuccess() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $_POST['oldPassword'] = 'rahasia';
      $_POST['newPassword'] = 'passwordbaru';

      $this->userController->postUpdatePassword();

      $this->expectOutputRegex('[Location: /]');

      $result = $this->userRepository->findById($user->id);
      self::assertTrue(password_verify("passwordbaru", $result->password));
    }

    public function testPostUpdatePasswordValidationError() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $_POST['oldPassword'] = '';
      $_POST['newPassword'] = '';

      $this->userController->postUpdatePassword();

      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[dzulfikri]");
      $this->expectOutputRegex("[Id, Old Password, New Password cannot be blank]");
    }

    public function testPostUpdatePasswordSWrongOldPassword() {
      $user = new User();
      $user->id = "dzulfikri";
      $user->name = "Dzulfikri";
      $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
      $this->userRepository->save($user);

      $session = new Session();
      $session->id = uniqid();
      $session->userId = $user->id;
      $this->sessionRepository->save($session);

      $_COOKIE[SessionService::$COOKIE_NAME] = $session->id;

      $_POST['oldPassword'] = 'salah';
      $_POST['newPassword'] = 'passwordbaru';

      $this->userController->postUpdatePassword();

      $this->expectOutputRegex("[Password]");
      $this->expectOutputRegex("[Id]");
      $this->expectOutputRegex("[dzulfikri]");
      $this->expectOutputRegex("[Old password is wrong]");
    }
  }
}
