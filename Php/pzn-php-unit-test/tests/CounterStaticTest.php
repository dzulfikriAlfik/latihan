<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\TestCase;

class CounterStaticTest extends TestCase
{

  public static Counter $counter;

  public static function setUpBeforeClass(): void
  {
    self::$counter = new Counter();
    echo "Unit test dimulai" . PHP_EOL;
  }

  public function testFirst()
  {
    self::$counter->increment();
    self::assertEquals(1, self::$counter->getCounter());
    echo "Unit testFirst()" . PHP_EOL;
  }

  public function testSecond()
  {
    self::$counter->increment();
    self::assertEquals(2, self::$counter->getCounter());
    echo "Unit testSecond()" . PHP_EOL;
  }

  public static function tearDownAfterClass(): void
  {
    echo "Unit test selesai" . PHP_EOL;
  }
}