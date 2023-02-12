<?php

namespace Tests\Feature;

use App\Http\Controllers\TimestampsFreshnessController;
use App\Models\Weather;
use App\Repositories\WeatherRepository;
use Database\Seeders\TestWarszawaPlSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
// use PHPUnit\Framework\TestCase; => this gives error 'Call to a member function connection() on null'
use Tests\TestCase;

class CheckModelStatusTest extends TestCase
{
 use RefreshDatabase;

 /**
  * Test method checkModelStatus() - return string 'null'
  * @var App\Model\Weather
  * @var App\Repository\WeatherRepository
  * @return void
  */

 public function test_for_unknown_model_is_returned_string_with_content_null()
 {

 $columnOne = 'country';
$valueOne  = 'pl';
$columnTwo = 'city';
$valueTwo  = 'warszawa';

  $weather    = new Weather();
  $repository = new WeatherRepository($weather);

  $query = $repository->checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo);
  echo $query . ' ';
  $this->assertTrue($query === 'null');
 }
 public function test_for_city_with_wrong_country_is_retuned_string_with_content_null()
 {
$this->seed(TestWarszawaPlSeeder::class);

 $columnOne = 'country';
$valueOne  = 'en';
$columnTwo = 'city';
$valueTwo  = 'warszawa';

  $weather    = new Weather();
  $repository = new WeatherRepository($weather);

  $query = $repository->checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo);
  echo $query . ' ';
  $this->assertTrue($query === 'null');
 }

/**
 * Test method checkModelStatus() - return string 'ok'
 * @var App\Model\Weather
 * @var App\Repository\WeatherRepository
 * @return void
 */

 public function test_for_known_proper_and_fresh_model_is_returned_string_with_content_ok()
 {

  $this->seed(TestWarszawaPlSeeder::class);

  $columnOne                                        = 'country';
  $valueOne                                         = 'pl';
  $columnTwo                                        = 'city';
  $valueTwo                                         = 'warszawa';
  TimestampsFreshnessController::$acceptedInterval = 60;
  $weather                                       = new Weather();
  $repository                                    = new WeatherRepository($weather);
  $query                                         = $repository->checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo);

  echo $query . ' ';
  $this->assertTrue($query === 'ok');

 }

 /**
  * Test method checkModelStatus()  - return string 'unfresh'
  * @var App\Model\Weather
  * @var App\Repository\WeatherRepository
  * @return void
  */

 public function test_for_known_and_old_model_from_query_returned_description_is_string_with_content_unfresh()
 {
  $this->seed(TestWarszawaPlSeeder::class);

 $columnOne = 'country';
$valueOne  = 'pl';
$columnTwo = 'city';
$valueTwo  = 'warszawa';

  TimestampsFreshnessController::$acceptedInterval = 60;
  $weather                                       = new Weather();
  $repository                                    = new WeatherRepository($weather);
  sleep(61);
  $query = $repository->checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo);

  echo $query . ' ';

  $this->assertTrue($query === 'unfresh');

 }
}
