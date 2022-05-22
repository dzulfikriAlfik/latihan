<?php

namespace Programmerzamannow\UnitTest;

use PHPUnit\Framework\TestCase;

class CounterTest extends TestCase
{
   public function testCounter()
   {
      $counter = new Counter();
      $counter->increment();
      $counter->increment();
      $counter->increment();
      echo "Counter : " . $counter->getCounter();
   }

   public function testOther()
   {
      echo "Other Test";
   }
}
