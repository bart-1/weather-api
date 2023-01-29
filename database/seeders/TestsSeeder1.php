<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class TestsSeeder1 extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
  Weather::create([
   'weather' => 'test1',
   'city'    => 'test1',
   'country' => 'test1',
  ]);

 }
}
