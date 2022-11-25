<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class EnvironmentTest extends TestCase
{
  public function testGetEnv()
  {
    $nama = env("NAMA_SAYA", "Dzulfikri Alkautsari");

    self::assertEquals("Dzulfikri Alkautsari", $nama);
  }
}
