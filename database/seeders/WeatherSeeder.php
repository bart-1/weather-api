<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Weather;
use Illuminate\Database\Seeder;

class WeatherSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

Weather::create([
    'weather' => 'Test User',
    'city' => 'warsaw',
]);
    }
}
