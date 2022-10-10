<?php

namespace Tests\Feature;

use App\Data\Foo;
use App\Data\Person;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
  public function testDependencyInjection()
  {
    $foo1 = $this->app->make(Foo::class); // new Foo
    $foo2 = $this->app->make(Foo::class); // new Foo

    self::assertEquals($foo1->foo(), "Foo");
    self::assertEquals($foo2->foo(), "Foo");
    self::assertNotSame($foo1, $foo2);
  }

  public function testBind()
  {
    $this->app->bind(Person::class, function ($app) {
      return new Person("Dzulfikri", "Alkautsari");
    });

    $person1 = $this->app->make(Person::class); // closure() // new Person("Dzulfikri", "Alkautsari")
    $person2 = $this->app->make(Person::class); // closure()

    self::assertEquals($person1->firstName, "Dzulfikri");
    self::assertEquals($person2->lastName, "Alkautsari");
    self::assertNotSame($person1, $person2);
  }

  public function testSingleton()
  {
    $this->app->singleton(Person::class, function ($app) {
      return new Person("Dzulfikri", "Alkautsari");
    });

    $person1 = $this->app->make(Person::class); // closure() // new Person("Dzulfikri", "Alkautsari")
    $person2 = $this->app->make(Person::class); // closure()

    self::assertEquals($person1->firstName, "Dzulfikri");
    self::assertEquals($person2->lastName, "Alkautsari");
    self::assertSame($person1, $person2);
  }

  public function testInstance()
  {
    $person = new Person("Dzulfikri", "Alkautsari");
    $this->instance(Person::class, $person);

    $person1 = $this->app->make(Person::class);
    $person2 = $this->app->make(Person::class);

    self::assertEquals($person1->firstName, "Dzulfikri");
    self::assertEquals($person2->lastName, "Alkautsari");
    self::assertSame($person, $person1);
    self::assertSame($person1, $person2);
  }
}
