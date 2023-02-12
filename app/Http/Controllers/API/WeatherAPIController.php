<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\SourceAPI\FrequencyModelUpdateController;
use App\Http\Controllers\SourceAPI\OpenWeatherSourceAPIController as OpenWeatherAPI;
use App\Http\Controllers\TimestampsFreshnessController;
use App\Interfaces\WeatherRepositoryInterface;
use App\Jobs\QueryOpenWeatherJob as QueryJob;

class WeatherAPIController extends APIController
{

 public $repository;
 protected $api;

//

 public function __construct(WeatherRepositoryInterface $repository, OpenWeatherAPI $api)
 {
  $this->repository                                = $repository;
  $this->api                                       = $api;
  FrequencyModelUpdateController::$frequency       = 1;
  TimestampsFreshnessController::$acceptedInterval = 60;
 }

 /**
  * Method prepares response for API query about weather by city. Calls checkModelStatus metod and checks:
  * Is data in DB? If data exists- is it fresh? And decides about create model or update a model
  * or no action if model exists and is fresh. Finally returns model in response.
  *
  * @var App\Repository\WeatherRepository
  * @var queryDB
  * @return response
  */

 public function manageRequest($country, $city)
 {
  $modelCheck = $this->repository->checkModelStatus('country',$country, 'city', $city);

  switch ($modelCheck) {
   case 'null':
    return $this->prepareData($country, $city, $modelCheck, true);
    break;
   case 'unfresh':
    return $this->prepareData($country, $city, $modelCheck, true);
    break;
   case 'ok':
    return $this->prepareData($country, $city, $modelCheck, false);
    break;

   case 'error':
    return $modelCheck;
    break;
   default:
    return $modelCheck;
    break;

  }

 }

 private function prepareData($country, $city, $modelCheck, $job = true)
 {
  if ($job) {
   QueryJob::dispatchSync($country, $city, $modelCheck);
   $query = $this->queryDB($country, $city);

  } else {
   $query = $this->queryDB($country, $city);
  }

  if ($query == null) {
   return QueryJob::$errors;

  } else {
   return $query;
  }

 }

 private function queryDB($country, $city)
 {
  return $this->repository->findWeather($country, $city);
 }

 public function getLastTimestamp()
 {
  return $this->repository->getLastTimestamp();
 }

}
