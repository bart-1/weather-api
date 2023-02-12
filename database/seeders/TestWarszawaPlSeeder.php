<?php

namespace Database\Seeders;

use App\Models\Weather;
use Illuminate\Database\Seeder;

class TestWarszawaPlSeeder extends Seeder
{
 /**
  * Run the database seeds.
  *
  * @return void
  */
 public function run()
 {
//   Weather::create([
//    'weather' => 'test_value1',
//    'country' => 'pl',
//    'city'    => 'warsaw',
//   ]);
  Weather::create([
   'weather' => 'test_value2',
   'country' => 'pl',
   'city'    => 'warszawa',
  ]);

 }
}
