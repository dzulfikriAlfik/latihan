<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
  public function testCounter()
  {
    $counter = new Counter();

    $counter->increment();
    $counter->increment();
    $counter->increment();
    Assert::assertEquals(3, $counter->getCounter());

    $counter->increment();
    self::assertEquals(4, $counter->getCounter());

    $counter->increment();
    $this->assertEquals(5, $counter->getCounter());
  }

  /**
   * @test
   */
  public function increment()
  {
    $counter = new Counter();

    $counter->increment();
    Assert::assertEquals(1, $counter->getCounter());
  }

  /**
   * @test
   */
  public function decrement() {
    $counter = new Counter();

    $counter->increment();
    $counter->increment();
    $counter->increment();
    $counter->decrement();
    Assert::assertEquals(2, $counter->getCounter());
  }

  /**
   * @test
   */
  public function first() : Counter {
    $counter = new Counter();

    $counter->increment();
    Assert::assertEquals(1, $counter->getCounter());
    return $counter;
  }

  /**
   * @test
   * @depends first
   * test function second bergantung pada hasil test first
   */
  public function second(Counter $counter): Counter {
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
  public function third(Counter $counter) {
    $counter->increment();
    $counter->increment();
    $counter->increment();
    Assert::assertEquals(6, $counter->getCounter());
  }
}
