<?php

namespace ProgrammerZamanNow\BelajarPhpMvc\Controller;

class ProductController
{
   //
   function categories(string $productId, string $categoryId): void
   {
      if ($productId == "54321") {
         $productId = "Sepatu";
      } else {
         $productId = "Kasur";
      }
      echo "Product: $productId, Category: $categoryId";
   }
}
