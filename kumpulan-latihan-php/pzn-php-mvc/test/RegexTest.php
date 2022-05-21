<?php

namespace ProgrammerZamanNow\BelajarPhpMvc;

use PHPUnit\Framework\TestCase;

use function PHPUnit\Framework\assertTrue;

class RegexTest extends TestCase
{
   public function testRegex()
   {
      //
      $path = "/products/1234/categories/abcde";

      $pattern = "#^/products/([a-zA-Z0-9]*)/categories/([a-zA-Z0-9]*)$#";

      $result = preg_match($pattern, $path, $variables);

      self::assertEquals(1, $result);

      var_dump($variables);

      array_shift($variables);

      var_dump($variables);
   }
}
