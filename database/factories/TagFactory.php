<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Services\Colors;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $colors = new Colors;

        return [
            'name' => fake()->company(),
            'description' => fake()->paragraph(),
            'color' => $colors->load()->getRandomColor(),
        ];
    }
}
