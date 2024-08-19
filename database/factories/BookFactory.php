<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title'=> $this->faker->sentence(mt_rand(2, 6)),
            'slug' => $this->faker->slug(),
            'author_id' => mt_rand(1,2),
            'publisher' => "Random House",
            'year' => "2000"
        ];
    }
}
