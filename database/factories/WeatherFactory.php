<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Weather>
 */
class WeatherFactory extends Factory
{
 /**
  * Define the model's default state.
  *
  * @return array<string, mixed>
  */
 public function definition()
 {
  return [
   'city'    => $this->faker->city(),
   'country' => $this->faker->country(),
   'weather' => $this->faker->sentence(),
  ];
 }
}
