<?php
namespace BelajarLoginManagement\App {
  function header(string $value)
  {
    echo $value;
  }
}

namespace BelajarLoginManagement\Service {
  function setcookie(string $name, string $value)
  {
    echo "$name: $value";
  }
}