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
        return [
            "title"       => fake()->sentence(),
            "content"     => fake()->paragraph(),
            "category_id" => Category::all()->random()->id,
            "created_at"  => fake()->dateTimeBetween('-4 years')
        ];
    }
}
