<?php

namespace App\Http\Controllers;

use App\Models\Weather;
use App\Repositories\WeatherRepository;
use App\Traits\ApiHarvester;
use App\Traits\ApiUrlBuilder;
use App\Traits\CompareTime;
use Inertia\Inertia;

class StartPageController extends Controller {

 use CompareTime;
 use ApiHarvester;
 use ApiUrlBuilder;

 public $updateDataFromEgzoApiGreenLight = false;
 public $noDataInDB                      = false;
 public $weatherData;

 //check time of last flow from API to DB
 //if is unfresh harvest api and update DB
 // if is fresh do nothging
 //take data from DB

 public function __construct(Weather $weather) {

  $dBTimestamp = $weather->get();

  if ($dBTimestamp === null) {
   $this->noDataInDB = true;

  } else {

   $this->updateDataFromEgzoApiGreenLight = $this->compareTime(\strtotime($dBTimestamp));
  }

 }

 public function index(WeatherRepository $repository) {

  if ($this->updateDataFromEgzoApiGreenLight || $this->noDataInDB) {
   $this->weatherData = $this->apiHarvest($this->buildOpenWeatherApiUrl('metric', 'warsaw'));
   $this->noDataInDB && $repository->create(['weather' => $this->weatherData]);

  } else {
   $this->weatherData = $repository->findByValue('city', 'warsaw');
  }

  return Inertia::render('Start', [
   'weather' => $this->weatherData,
   'status'  => session('status'),

  ]);

 }
}
