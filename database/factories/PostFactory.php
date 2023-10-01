<?php

namespace Database\Factories;

use App\Services\HijriCalculator;
use Illuminate\Support\Facades\App;
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
        $hijri = App::make(HijriCalculator::class);

        $hijri->setDay(fake()->numberBetween(10, 30));
        $hijri->setMonth(fake()->numberBetween(1, 12));
        $hijri->setYear(fake()->numberBetween(1430, 1445));

        return [
            'title' => fake()->name(),
            'no' => fake()->numberBetween(1000000, 9999999),
            'topic' => fake()->name(),
            'hijri_day' => $hijri->getDay(),
            'hijri_month' => $hijri->getMonth(),
            'hijri_year' => $hijri->getYear(),
            'doc_date' => $hijri->asCarbon(),
        ];
    }
}
