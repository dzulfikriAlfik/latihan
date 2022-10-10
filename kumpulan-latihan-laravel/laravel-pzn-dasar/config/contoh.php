<?php

use Illuminate\Support\Env;

return [
  "author" => [
    "first" => env("NAME_FIRST", "Dzulfikri"),
    "last"  => Env::get("NAME_LAST", "Alkautsari")
  ],
  "email" => "dzulfikri.alkautsari@gmail.com",
  "web"   => "https://rumahwebsiteku.com"
];
