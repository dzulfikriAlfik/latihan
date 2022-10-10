<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ConfigurationTest extends TestCase
{
  public function testConfig()
  {
    $firstName = config("contoh.author.first");
    $lastName = config("contoh.author.last");

    self::assertEquals("Dzulfikri", $firstName);
    self::assertEquals("Alkautsari", $lastName);
  }
}
