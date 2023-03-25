<?php

namespace BelajarLoginManagement\Service;

use BelajarLoginManagement\Domain\Session;
use BelajarLoginManagement\Domain\User;
use BelajarLoginManagement\Repository\SessionRepository;
use BelajarLoginManagement\Repository\UserRepository;

class SessionService
{
  public static string $COOKIE_NAME = "X-PZN-SESSION";

  private SessionRepository $sessionRepository;
  private UserRepository $userRepository;

  public function __construct(SessionRepository $sessionRepository, UserRepository $userRepository)
  {
    $this->sessionRepository = $sessionRepository;
    $this->userRepository = $userRepository;
  }

  public function create(string $userId):Session
  {
    $session = new Session();
    $session->id = uniqid();
    $session->userId = $userId;

    $this->sessionRepository->save($session);

    $thirtyDayFromNow = time() + (60 * 60 * 24 * 30); # 60 Sec * 60 min * 24 hours * 30 day
    setcookie(self::$COOKIE_NAME, $session->id, $thirtyDayFromNow, "/");

    return $session;
  }

  public function destroy()
  {
    $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
    $this->sessionRepository->deleteById($sessionId);

    setcookie(self::$COOKIE_NAME, "", 1, "/");
  }

  public function current(): ?User
  {
    $sessionId = $_COOKIE[self::$COOKIE_NAME] ?? "";
    $session = $this->sessionRepository->findById($sessionId);

    if($session == null) {
      return null;
    }

    return $this->userRepository->findById($session->userId);
  }
}