<?php

namespace BelajarLoginManagement\Controller;

use BelajarLoginManagement\App\View;
use BelajarLoginManagement\Config\Database;
use BelajarLoginManagement\Exception\ValidationException;
use BelajarLoginManagement\Model\UserLoginRequest;
use BelajarLoginManagement\Model\UserPasswordUpdateRequest;
use BelajarLoginManagement\Model\UserProfileUpdateRequest;
use BelajarLoginManagement\Model\UserRegisterRequest;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;
use BelajarLoginManagement\Service\SessionService;
use BelajarLoginManagement\Service\UserService;

class UserController
{
  private UserService $userService;
  private SessionService $sessionService;

  public function __construct()
  {
    $connection = Database::getConnection();
    $userRepository = new UserRepository($connection);
    $this->userService = new UserService($userRepository);

    $sessionRepository = new SessionRepository($connection);
    $this->sessionService = new SessionService($sessionRepository, $userRepository);
  }


  public function register()
  {
    View::render("User/register", [
      "title" => "Register new user"
    ]);
  }

  public function postRegister()
  {
    $request = new UserRegisterRequest();
    $request->id = $_POST['id'];
    $request->name = $_POST['name'];
    $request->password = $_POST['password'];

    try {
      $this->userService->register($request);
      # if success redirect to login
      View::redirect("/users/login");
    } catch (ValidationException $exception) {
      View::render("User/register", [
        "title" => "Register new user",
        "error" => $exception->getMessage()
      ]);
    }
  }

  public function login()
  {
    View::render("User/login", [
      "title" => "Login user"
    ]);
  }

  public function postLogin()
  {
    $request = new UserLoginRequest();
    $request->id = $_POST['id'];
    $request->password = $_POST['password'];

    try {
      # if success redirect to login and setcookie
      $response = $this->userService->login($request);
      $this->sessionService->create($response->user->id);
      View::redirect("/");
    } catch (ValidationException $exception) {
      View::render("User/login", [
        "title" => "Login user",
        "error" => $exception->getMessage()
      ]);
    }
  }

  public function logout()
  {
    $this->sessionService->destroy();

    View::redirect("/");
  }

  public function updateProfile()
  {
    $user = $this->sessionService->current();

    View::render("User/profile", [
      "title" => "Update user profile",
      "user" => [
        "id" => $user->id,
        "name" => $user->name
      ]
    ]);
  }

  public function postUpdateProfile()
  {
    $user = $this->sessionService->current();

    $request = new UserProfileUpdateRequest();
    $request->id = $user->id;
    $request->name = $_POST['name'];

    try {
      $this->userService->updateProfile($request);
      View::redirect("/");
    } catch (ValidationException $exception) {
      View::render("User/profile", [
        "title" => "Update user profile",
        "user" => [
          "id" => $user->id,
          "name" => $user->name
        ],
        "error" => $exception->getMessage()
      ]);
    }
  }

  public function updatePassword()
  {
    $user = $this->sessionService->current();

    View::render("User/password", [
      "title" => "Update user password",
      "user" => [
        "id" => $user->id
      ]
    ]);
  }

  public function postUpdatePassword()
  {
    $user = $this->sessionService->current();

    $request = new UserPasswordUpdateRequest();
    $request->id = $user->id;
    $request->oldPassword = $_POST['oldPassword'];
    $request->newPassword = $_POST['newPassword'];

    try {
      $this->userService->updatePassword($request);
      View::redirect("/");
    } catch (ValidationException $exception) {
      View::render("User/password", [
        "title" => "Update user password",
        "user" => [
          "id" => $user->id
        ],
        "error" => $exception->getMessage()
      ]);
    }
  }
}