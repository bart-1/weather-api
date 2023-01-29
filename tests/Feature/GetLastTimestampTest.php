<?php

namespace Tests\Feature;

use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class GetLastTimestampTest extends TestCase
{

 use RefreshDatabase;
 /**
  * Test check getLatsTimestamp() method from Repository return proper value
  * @var App\Model\Weather
  * @var App\Repository\WeatherRepository
  * @return void
  */
 public function test_metod_return_last_registred_update_at_timestamp_value_from_data_base()
 {

  $model      = new Weather();
  $repository = new WeatherRepository($model);

  $this->seed('TestsSeeder1');
  sleep(1);
  $this->seed('TestsSeeder2');

  $lastTimestamp      = $repository->getLastTimestamp();
  $knownLastTimestamp = $repository->getTimestampByValue('id', 2);
  echo $lastTimestamp.'-----'.$knownLastTimestamp;

  $this->assertTrue("$lastTimestamp" === "$knownLastTimestamp");
 }

}
