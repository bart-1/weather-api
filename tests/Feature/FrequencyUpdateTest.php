<?php

namespace Tests\Feature;

use App\Http\Controllers\SourceAPI\FrequencyModelUpdateController;
use App\Models\Weather;
use Database\Seeders\TestWarszawaPlSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FrequencyUpdateTest extends TestCase
{

 use RefreshDatabase;
 /**
  * A basic feature test example.
  *
  * @return void
  */
 public function test_frequency_update_controller_stops_services_for_correct_period_of_time_seted_in_frequency_static_variable()
 {
  $model               = new Weather();
  $frequenceController = new FrequencyModelUpdateController($model);
  $frequency           = 3;

  FrequencyModelUpdateController::$frequency = $frequency;
  $this->seed(TestWarszawaPlSeeder::class);
  $startTime = strtotime('now');
  $frequenceController->realizeWithFrequency();
  $endTime = strtotime('now');

  echo $endTime - $startTime . 's have passed';
  $this->assertTrue($endTime - $startTime === $frequency);
 }
}
