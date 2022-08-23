<?php

namespace Database\Factories;

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
    public function definition()
    {
        return [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'hijri_day' => fake()->numberBetween(10, 30),
            'hijri_month' => fake()->numberBetween(1, 12),
            'hijri_year' => fake()->numberBetween(1430, 1444),
        ];
    }
}
