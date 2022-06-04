<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class DatabaseSeeder extends Seeder
{
   /**
    * Seed the application's database.
    *
    * @return void
    */
   public function run()
   {
      User::factory(9)->create();

      User::create([
         'name' => 'Dzulfikri Alkautsari',
         'username' => 'alfik',
         'email' => 'alfik@gmail.com',
         'password' => bcrypt('alfik')
      ]);

      // User::create([
      //     'name' => 'Alfik',
      //     'email' => 'alfik@gmail.com',
      //     'password' => bcrypt('12345')
      // ]);

      Category::create([
         'name' => 'Front End Developer',
         'slug' => 'front-end-developer'
      ]);

      Category::create([
         'name' => 'Back End Developer',
         'slug' => 'back-end-developer'
      ]);

      Category::create([
         'name' => 'Android Developer',
         'slug' => 'android-developer'
      ]);

      Category::create([
         'name' => 'Web Design',
         'slug' => 'web-design'
      ]);

      Category::create([
         'name' => 'Personal',
         'slug' => 'personal'
      ]);

      Post::factory(100)->create();

      // Post::create([
      //     'title' => 'Judul Pertama',
      //     'slug' => 'judul-pertama',
      //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla eveniet tempore consequuntur, nemo quae ea modi maxime incidunt id?',
      //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique molestias quis reprehenderit quo, fuga porro nam, ipsam nostrum enim corporis quos consequatur, alias assumenda aliquam modi laborum blanditiis? Quaerat ex quod illo optio, voluptatibus a cum minima minus deleniti veniam ipsum voluptate aut eius, omnis vero eligendi repellat animi assumenda consequatur sunt? Voluptate minima expedita ab soluta harum tenetur blanditiis nostrum dicta veritatis. At dolore asperiores, ipsum culpa iste optio quae dolorum deserunt quod animi minus iusto reiciendis quisquam, pariatur numquam, aliquam voluptatum? Corrupti velit sapiente impedit neque, repellendus expedita autem accusantium eveniet labore, officiis itaque corporis praesentium. Dolorum non tempora deleniti quia, debitis numquam delectus, sit quibusdam id sed voluptatum maiores asperiores molestiae officia eum voluptates inventore rerum blanditiis.',
      //     'category_id' => 1,
      //     'user_id' => 1
      // ]);

      // Post::create([
      //     'title' => 'Judul Kedua',
      //     'slug' => 'judul-kedua',
      //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla eveniet tempore consequuntur, nemo quae ea modi maxime incidunt id?',
      //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique molestias quis reprehenderit quo, fuga porro nam, ipsam nostrum enim corporis quos consequatur, alias assumenda aliquam modi laborum blanditiis? Quaerat ex quod illo optio, voluptatibus a cum minima minus deleniti veniam ipsum voluptate aut eius, omnis vero eligendi repellat animi assumenda consequatur sunt? Voluptate minima expedita ab soluta harum tenetur blanditiis nostrum dicta veritatis. At dolore asperiores, ipsum culpa iste optio quae dolorum deserunt quod animi minus iusto reiciendis quisquam, pariatur numquam, aliquam voluptatum? Corrupti velit sapiente impedit neque, repellendus expedita autem accusantium eveniet labore, officiis itaque corporis praesentium. Dolorum non tempora deleniti quia, debitis numquam delectus, sit quibusdam id sed voluptatum maiores asperiores molestiae officia eum voluptates inventore rerum blanditiis.',
      //     'category_id' => 1,
      //     'user_id' => 1
      // ]);

      // Post::create([
      //     'title' => 'Judul Ketiga',
      //     'slug' => 'judul-ketiga',
      //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla eveniet tempore consequuntur, nemo quae ea modi maxime incidunt id?',
      //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique molestias quis reprehenderit quo, fuga porro nam, ipsam nostrum enim corporis quos consequatur, alias assumenda aliquam modi laborum blanditiis? Quaerat ex quod illo optio, voluptatibus a cum minima minus deleniti veniam ipsum voluptate aut eius, omnis vero eligendi repellat animi assumenda consequatur sunt? Voluptate minima expedita ab soluta harum tenetur blanditiis nostrum dicta veritatis. At dolore asperiores, ipsum culpa iste optio quae dolorum deserunt quod animi minus iusto reiciendis quisquam, pariatur numquam, aliquam voluptatum? Corrupti velit sapiente impedit neque, repellendus expedita autem accusantium eveniet labore, officiis itaque corporis praesentium. Dolorum non tempora deleniti quia, debitis numquam delectus, sit quibusdam id sed voluptatum maiores asperiores molestiae officia eum voluptates inventore rerum blanditiis.',
      //     'category_id' => 2,
      //     'user_id' => 2
      // ]);

      // Post::create([
      //     'title' => 'Judul Keempat',
      //     'slug' => 'judul-keempat',
      //     'excerpt' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Vitae nulla eveniet tempore consequuntur, nemo quae ea modi maxime incidunt id?',
      //     'body' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Similique molestias quis reprehenderit quo, fuga porro nam, ipsam nostrum enim corporis quos consequatur, alias assumenda aliquam modi laborum blanditiis? Quaerat ex quod illo optio, voluptatibus a cum minima minus deleniti veniam ipsum voluptate aut eius, omnis vero eligendi repellat animi assumenda consequatur sunt? Voluptate minima expedita ab soluta harum tenetur blanditiis nostrum dicta veritatis. At dolore asperiores, ipsum culpa iste optio quae dolorum deserunt quod animi minus iusto reiciendis quisquam, pariatur numquam, aliquam voluptatum? Corrupti velit sapiente impedit neque, repellendus expedita autem accusantium eveniet labore, officiis itaque corporis praesentium. Dolorum non tempora deleniti quia, debitis numquam delectus, sit quibusdam id sed voluptatum maiores asperiores molestiae officia eum voluptates inventore rerum blanditiis.',
      //     'category_id' => 2,
      //     'user_id' => 2
      // ]);
   }
}
