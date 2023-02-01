<?php

namespace Tests\Feature;

use App\Http\Controllers\TimestampsFreshnessController;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Database\Seeders\TestWarszawaPlSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CheckModelFreshByValueTest extends TestCase
{

  use RefreshDatabase;
 /**
  * A basic unit test example.
  *
  * @return void
  */
 public function test_check_model_status_method_returns_true()
 {

  $this->seed(TestWarszawaPlSeeder::class);
  TimestampsFreshnessController::$acceptedInterval = 20;
  $weather                                       = new Weather();
  $repository                                    = new WeatherRepository($weather);
  $test                                          = $repository->checkIfModelFreshByValue('city', 'warszawa');
  $this->assertTrue($test);
 }
}
