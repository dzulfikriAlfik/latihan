<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
  private Counter $counter;

  public function setUp(): void
  {
    $this->counter = new Counter();
    echo "Membuat Counter" . PHP_EOL;
  }

  public function testIncrement()
  {
    self::assertEquals(0, $this->counter->getCounter());
    self::markTestIncomplete("Todo : do counter again");
  }

  public function testIncrementSkip()
  {
    self::markTestSkipped("Masih ada error, di skip dulu guys");

    self::assertEquals(0, $this->counter->getCounter());
    self::markTestIncomplete("Todo : do counter again");
  }

  public function testCounter()
  {
    $this->counter->increment();
    $this->counter->increment();
    $this->counter->increment();
    Assert::assertEquals(3, $this->counter->getCounter());

    $this->counter->increment();
    self::assertEquals(4, $this->counter->getCounter());

    $this->counter->increment();
    $this->assertEquals(5, $this->counter->getCounter());
  }

  /**
   * @test
   */
  public function increment()
  {
    $this->counter->increment();
    Assert::assertEquals(1, $this->counter->getCounter());
  }

  /**
   * @test
   */
  public function decrement()
  {
    $this->counter->increment();
    $this->counter->increment();
    $this->counter->increment();
    $this->counter->decrement();
    Assert::assertEquals(2, $this->counter->getCounter());
  }

  /**
   * @test
   */
  public function first(): Counter
  {
    $this->counter->increment();
    Assert::assertEquals(1, $this->counter->getCounter());
    return $this->counter;
  }

  /**
   * @test
   * @depends first
   * test function second bergantung pada hasil test first
   */
  public function second(Counter $counter): Counter
  {
    $counter->increment();
    $counter->increment();
    Assert::assertEquals(3, $counter->getCounter());
    return $counter;
  }

  /**
   * @test
   * @depends second
   * test function third bergantung pada hasil test second
   * idealnya walaupun fitur depends ini ada tapi disarankan untuk tidak digunakan
   * karena unit test yang baik adalah unit test yang independen
   */
  public function third(Counter $counter)
  {
    $counter->increment();
    $counter->increment();
    $counter->increment();
    Assert::assertEquals(6, $counter->getCounter());
  }

  protected function tearDown(): void
  {
    echo "Tear Down" . PHP_EOL;
  }

  /**
   * @after
   */
  protected function after(): void
  {
    echo "After" . PHP_EOL;
  }

  /**
   * @requires PHP >= 8
   * @requires OSFAMILY Windows
   */
  public function testOnlyWindows()
  {
    self::assertTrue(true, "Only In Windows");
  }
}
