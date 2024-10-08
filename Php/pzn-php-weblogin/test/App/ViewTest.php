<?php

namespace BelajarLoginManagement\Config;

use PHPUnit\Framework\TestCase;
use BelajarLoginManagement\App\View;

class ViewTest extends TestCase
{

  public function testRender()
  {
    View::render("Home/index", [
      "title" => "PHP Login Management"
    ]);

    $this->expectOutputRegex("[PHP Login Management]");
    $this->expectOutputRegex("[html]");
    $this->expectOutputRegex("[body]");
    $this->expectOutputRegex("[Login Management]");
    $this->expectOutputRegex("[Login]");
    $this->expectOutputRegex("[Register]");
  }

}
