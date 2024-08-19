<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Borrow>
 */
class BorrowFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'volume_id'=> mt_rand(1,4),
            'user_id'=> mt_rand(1,4),
            'status' => array('Approved','Cancelled','Rejected','Finished','Pending')[mt_rand(0,4)],
            'borrow_date' => Carbon::today()->subDays(rand(0, 365)),
            'return_date' => Carbon::today()->subDays(rand(0, 365))
        ];
    }
}
