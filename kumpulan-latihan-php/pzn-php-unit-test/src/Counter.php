<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Util\Test;

class Counter
{
  private int $counter = 0;

  public function increment(): void
  {
    $this->counter++;
  }

  public function decrement(): void
  {
    $this->counter--;
  }

  public function getCounter(): int
  {
    return $this->counter;
  }
}