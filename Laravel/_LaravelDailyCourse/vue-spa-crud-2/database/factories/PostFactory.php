<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $categories = Category::pluck('id')->toArray();

        return [
            "title"       => $this->faker->text(10, 15),
            "content"     => $this->faker->realText(rand(500, 1000)),
            "category_id" => $categories[array_rand($categories)]
        ];
    }
}
