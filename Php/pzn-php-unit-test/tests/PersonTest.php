<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\TestCase;
use Exception;

class PersonTest extends TestCase
{
  private Person $person;

  public function setUp(): void
  {

  }

  /**
   * @before
   * anotasi ini sama seperti menjalankan function setUp milik TestCase::class
   * dan akan selalu dijalankan sebelum testnya dieksekusi
   */
  public function createPerson()
  {
    $this->person = new Person("Eko");
  }

  public function testSuccess()
  {
    self::assertEquals("Hello Budi my name is Eko", $this->person->sayHello("Budi"));
  }

  public function testException()
  {
    $this->expectException(Exception::class);
    $this->person->sayHello(null);
  }

  /**
   * expecetOutputString untuk test hasil output string
   */
  public function testOutput()
  {
    $this->expectOutputString("Goodbye Budi" . PHP_EOL);
    $this->person->sayGoodbye("Budi");
  }

}