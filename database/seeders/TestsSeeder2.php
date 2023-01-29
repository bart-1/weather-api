<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class TestsSeeder2 extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  Weather::create([
   'weather' => 'test2',
   'city'    => 'test2',
   'country' => 'test2',
  ]);

 }
}
