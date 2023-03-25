<?php

namespace ProgrammerZamanNow\Test;

use PHPUnit\Framework\Assert;
use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{

  /**
   * @test
   *
   * tidak direkomendasikan menggunakan assert secara manual ketika ingin mengubah input
   * dan hasil ekspektasinya
   */
  public function sumInputManual()
  {
    Assert::assertEquals(15, Math::sum([1, 2, 3, 4, 5]));
    self::assertEquals(10, Math::sum([5, 5]));
  }

  public function mathSumData(): array
  {
    return [
      [[5, 5], 10],
      [[1, 3], 4],
      [[5, 5, 5], 15],
      [[0, 0], 0],
      [[1, 7], 8],
    ];
  }

  /**
   * @dataProvider mathSumData
   *
   * dengan menggunakan dataProvider kita bisa membuat berbagai kombinasi dan skenario
   * dan hasil testnya akan dijalankan sendiri-sendiri per skenario
   * dibanding dengan di assert secara manual (copy-paste) hasil testnya akan dianggap hanya sekali
   */
  public function testDataProvider(array $values, int $expected)
  {
    self::assertEquals($expected, Math::sum($values));
  }

  /**
   * @testWith  [[5, 5], 10]
   *            [[1, 3], 4]
   *            [[5, 5, 5], 15]
   *            [[0, 0], 0]
   *            [[1, 7], 8]
   *
   * dengan menggunakan anotasi @testWith kita bisa melakukan hal serupa dataProvider
   * tanpa harus membuat function yang me-return array terlebih dahulu.
   * Namun perlu digaris bawahi bahwa cara ini hanya bisa dilakukan terhadap
   * data yang sederhana seperti kasus ini.
   */
  public function testWith(array $values, int $expected)
  {
    self::assertEquals($expected, Math::sum($values));
  }

}
