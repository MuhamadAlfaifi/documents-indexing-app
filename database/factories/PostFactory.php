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
        $user = \App\Models\User::get()->shuffle()->random();
        $tag = \App\Models\Tag::get()->shuffle()->random();

        return [
            'title' => fake()->name(),
            'description' => fake()->paragraph(),
            'user_id' => $user->id,
            'tag_id' => $tag->id,
        ];
    }
}
