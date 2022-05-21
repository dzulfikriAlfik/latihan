<?php

namespace Dzulfikri\KumpulanLibrary;

class Customer
{
   public function __construct(private string $name)
   {
      //
   }

   public function sayHello(string $name): string
   {
      return "Hello $name, My name is $this->name";
   }
}

// cara upload library ke repository github versi programmerZamanNow
// 1. Buat Repositori nya di github
// 2. ketik "git init" di foldernya
// 3. ketik "git remote add origin git@github.com:dzulfikriAlfik/dzulfikri-library.git"
// 4. tinggal add, commit dan push
