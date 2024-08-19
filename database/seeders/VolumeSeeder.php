<?php

namespace Database\Seeders;

use App\Models\Volume;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class VolumeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Volume::factory(10)->create();
    }
}
