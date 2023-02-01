<?php

namespace App\Jobs;

use App\Http\Controllers\SourceAPI\FrequencyModelUpdateController;
use App\Http\Controllers\SourceAPI\OpenWeatherSourceAPIController;
use App\Interfaces\WeatherRepositoryInterface;
use App\Models\Weather;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class QueryOpenWeatherJob implements ShouldQueue
{
 use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

 public $result;
 public $city;
 public $country;
 public $action;
 public static $errors;

 /**
  * Create a new job instance.
  *
  * @return void
  */
 public function __construct($country, $city, $action)
 {
  $this->city    = $city;
  $this->country = $country;
  $this->action  = $action;
 }

 /**
  * Execute the job.
  *
  * @return void
  */
 public function handle(OpenWeatherSourceAPIController $api, WeatherRepositoryInterface $repository, Weather $weather)
 {

  $this->frequencyKeeper($weather);

  $url     = $api->createOpenWeatherApiUrl($this->country, $this->city);
  $weather = $api->apiHarvest($url);

  if ($weather["cod"] !== 200) {
   $this->handleErrors($weather);
   return '';
  }

  if ($this->action === 'null') {
   $repository->create(['city' => $this->city, 'country' => $this->country, 'weather' => json_encode($weather)]);
  } else if ($this->action === 'unfresh') {

   $repository->refreshWeatherData('city', $this->city, ['city' => $this->city, 'country' => $this->country, 'weather' => json_encode($weather)]);
  }

 }

 private function handleErrors($data)
 {
  switch ($data["cod"]) {
   case "401":self::$errors = "Invalid api key";
    break;
   case "404":self::$errors = "City and/or country not found";
    break;
   case "500":self::$errors = "Sorry, we have server problems";
    break;
   default:self::$errors = "Unknown error";
  }
 }

 private function frequencyKeeper($weather)
 {
  $frequencyKeeper = new FrequencyModelUpdateController($weather);
  $frequencyKeeper->realizeWithFrequency();
 }

}
