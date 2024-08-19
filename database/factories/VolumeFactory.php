<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Volume>
 */
class VolumeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        
        return [
            'book_id'=> mt_rand(1,6),
            'format' => array('E-book','Paperback','Soft Cover','Hardcover','Audiobook')[mt_rand(0,4)],
            'edition' => mt_rand(1,10),
            'state' => array('Fair','Very Good','Good','New','Poor')[mt_rand(0,4)],
        ];
    }
}
