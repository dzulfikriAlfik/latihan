<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ServiceContainerTest extends TestCase
{
  public function testDependency()
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

  public function testDependencyInjection()
  {
    $this->app->singleton(Foo::class, function ($app) {
      return new Foo();
    });
    $this->app->singleton(Bar::class, function ($app) {
      return new Bar($app->make(Foo::class));
    });

    $foo = $this->app->make(Foo::class);
    $bar1 = $this->app->make(Bar::class);
    $bar2 = $this->app->make(Bar::class);

    self::assertSame($foo, $bar1->foo);
    self::assertSame($bar1, $bar2);
  }

  public function testInterfaceToClass()
  {
    $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

    $helloService = $this->app->make(HelloService::class);

    self::assertEquals("Hello Dzulfikri", $helloService->hello("Dzulfikri"));
  }
}
