<?php

namespace BelajarLoginManagement\Service;

use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Domain\User;
use BelajarLoginManagement\Exception\ValidationException;
use BelajarLoginManagement\Model\UserLoginRequest;
use BelajarLoginManagement\Model\UserPasswordUpdateRequest;
use BelajarLoginManagement\Model\UserProfileUpdateRequest;
use BelajarLoginManagement\Model\UserRegisterRequest;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;
use PHPUnit\Framework\TestCase;

class UserServiceTest extends TestCase
{
  private UserService $userService;
  private UserRepository $userRepository;
  private SessionRepository $sessionRepository;

  protected function setUp(): void
  {
    $connection = Database::getConnection();
    $this->userRepository = new UserRepository($connection);
    $this->userService = new UserService($this->userRepository);

    $this->sessionRepository = new SessionRepository($connection);

    $this->sessionRepository->deleteAll();
    $this->userRepository->deleteAll();
  }

  public function testRegisterSuccess()
  {
    $request = new UserRegisterRequest();
    $request->id = "1";
    $request->name = "Dzulfikri";
    $request->password = "rahasia";

    $response = $this->userService->register($request);

    self::assertEquals($request->id, $response->user->id);
    self::assertEquals($request->name, $response->user->name);
    self::assertNotEquals($request->password, $response->user->password);
    self::assertTrue(password_verify($request->password, $response->user->password));
  }

  public function testRegisterFailed()
  {
    $this->expectException(ValidationException::class);

    $request = new UserRegisterRequest();
    $request->id = "";
    $request->name = "";
    $request->password = "";

    $this->userService->register($request);
  }

  public function testRegisterDuplicate()
  {
    $user = new User();
    $user->id = "1";
    $user->name = "Dzulfikri";
    $user->password = "rahasia";

    $this->userRepository->save($user);

    $this->expectException(ValidationException::class);

    $request = new UserRegisterRequest();
    $request->id = "1";
    $request->name = "Dzulfikri";
    $request->password = "rahasia";

    $this->userService->register($request);
  }

  public function testLoginNotFound()
  {
    $this->expectException(ValidationException::class);

    $request = new UserLoginRequest();
    $request->id = "eko";
    $request->password = "rahasia";

    $this->userService->login($request);
  }

  public function testLoginWrongPassword()
  {
    $user = new User();
    $user->id = "eko";
    $user->name = "Eko";
    $user->password = password_hash("salah", PASSWORD_BCRYPT);

    $this->expectException(ValidationException::class);

    $request = new UserLoginRequest();
    $request->id = "eko";
    $request->password = "rahasia";

    $this->userService->login($request);
  }

  public function testLoginSuccess()
  {
    $user = new User();
    $user->id = "eko";
    $user->name = "Eko";
    $user->password = password_hash("rahasia", PASSWORD_BCRYPT);

    $this->expectException(ValidationException::class);

    $request = new UserLoginRequest();
    $request->id = "eko";
    $request->password = "rahasia";

    $response = $this->userService->login($request);

    self::assertEquals($request->id, $response->user->id);
    self::assertTrue(password_verify($request->password, $response->user->password));
  }

  public function testUpdateSuccess()
  {
    $user = new User();
    $user->id = "dzulfikri";
    $user->name = "Eko";
    $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
    $this->userRepository->save($user);

    $request = new UserProfileUpdateRequest();
    $request->id = "dzulfikri";
    $request->name = "Dzulfikri";

    $this->userService->updateProfile($request);

    $result = $this->userRepository->findById($user->id);

    self::assertEquals($request->name, $result->name);
  }

  public function testUpdateValidationError()
  {
    $this->expectException(ValidationException::class);

    $request = new UserProfileUpdateRequest();
    $request->id = "";
    $request->name = "";

    $this->userService->updateProfile($request);
  }

  public function testUpdateNotFound()
  {
    $this->expectException(ValidationException::class);

    $request = new UserProfileUpdateRequest();
    $request->id = "notfound";
    $request->name = "notfound";

    $this->userService->updateProfile($request);
  }

  public function testUpdatePasswordSuccess()
  {
    $user = new User();
    $user->id = "dzulfikri";
    $user->name = "Dzulfikri";
    $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
    $this->userRepository->save($user);

    $request = new UserPasswordUpdateRequest();
    $request->id = "dzulfikri";
    $request->oldPassword = "rahasia";
    $request->newPassword = "tidakrahasia";

    $this->userService->updatePassword($request);

    $result = $this->userRepository->findById($user->id);

    self::assertTrue(password_verify($request->newPassword, $result->password));
  }

  public function testUpdatePasswordValidationError()
  {
    $this->expectException(ValidationException::class);

    $request = new UserPasswordUpdateRequest();
    $request->id = "dzulfikri";
    $request->oldPassword = "";
    $request->newPassword = "";

    $this->userService->updatePassword($request);
  }

  public function testUpdatePasswordWrongOldPassword()
  {
    $this->expectException(ValidationException::class);

    $user = new User();
    $user->id = "dzulfikri";
    $user->name = "Dzulfikri";
    $user->password = password_hash("rahasia", PASSWORD_BCRYPT);
    $this->userRepository->save($user);

    $request = new UserPasswordUpdateRequest();
    $request->id = "dzulfikri";
    $request->oldPassword = "salah";
    $request->newPassword = "tidakrahasia";

    $this->userService->updatePassword($request);
  }

  public function testUpdatePasswordNotFound()
  {
    $this->expectException(ValidationException::class);

    $request = new UserPasswordUpdateRequest();
    $request->id = "tidakada";
    $request->oldPassword = "salah";
    $request->newPassword = "tidakrahasia";

    $this->userService->updatePassword($request);
  }
}