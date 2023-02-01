<?php

namespace Tests\Unit;

use App\Http\Controllers\TimestampsFreshnessController;
use App\Jobs\QueryOpenWeatherJob;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Tests\TestCase;

class TimestampsFreshnessTest extends TestCase
{

 public function test_compare_now_time_value_with_sended_time_value_from_accepted_range_gives_true(): void
 {

  $goodTime                                        = '-1 minute';
  $compareTimeController                           = new TimestampsFreshnessController();
  $interval                                        = 70;
  TimestampsFreshnessController::$acceptedInterval = $interval;

  $this->assertTrue($compareTimeController->isFitInAcceptedInterval($goodTime));
 }

 public function test_compare_now_time_value_with_sended_time_value_outside_accepted_range_gives_false(): void
 {
  $badTime                                         = '2023-01-22 17:28:41';
  $compareTimeController                           = new TimestampsFreshnessController();
  $interval                                        = 70;
  TimestampsFreshnessController::$acceptedInterval = $interval;

  $this->assertFalse($compareTimeController->isFitInAcceptedInterval($badTime));
 }

 public function test_modify_accepted_interval_works_if_timstamp_fit()
 {
  $goodTime                                        = '-10 seconds';
  $compareTimeController                           = new TimestampsFreshnessController();
  $interval                                        = 11;
  TimestampsFreshnessController::$acceptedInterval = $interval;
  $model = new Weather();
  $repository = new WeatherRepository($model);
  $job = new QueryOpenWeatherJob('a', 'b', 'c');

  $this->assertTrue($compareTimeController->isFitInAcceptedInterval($goodTime));

 }
 public function test_modify_accepted_interval_works_if_timstamp_not_fit()
 {
  $badTime                                        = '-10 seconds';
  $compareTimeController                           = new TimestampsFreshnessController();
  $interval                                        = 9;
  TimestampsFreshnessController::$acceptedInterval = $interval;
  $model = new Weather();
  $repository = new WeatherRepository($model);
  $job = new QueryOpenWeatherJob('a', 'b', 'c');

  $this->assertFalse($compareTimeController->isFitInAcceptedInterval($badTime));

 }
}
