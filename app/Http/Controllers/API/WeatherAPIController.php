<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\APIController;
use App\Http\Controllers\SourceAPI\OpenWeatherSourceAPIController as OpenWeatherAPI;
use App\Interfaces\RepositoryInterface;
use App\Interfaces\WeatherRepositoryInterface;
use App\Jobs\QueryOpenWeatherSourceAPI as QueryAPI;

class WeatherAPIController extends APIController
{

 public $repository;
 public $weatherRepository;
 protected $api;

//

 public function __construct(WeatherRepositoryInterface $weatherRepository, RepositoryInterface $repository, OpenWeatherAPI $api)
 {
  $this->weatherRepository = $weatherRepository;
  $this->repository        = $repository;
  $this->api               = $api;
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
  $modelCheck = $this->repository->checkModelStatus('city', $city);

  switch ($modelCheck) {
   case 'null':
    return $this->prepareData($country, $city, $modelCheck, true);
   case 'unfresh':
    return $this->prepareData($country, $city, $modelCheck, true);
   case 'ok':
    return $this->prepareData($country, $city, $modelCheck, false);

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
   QueryAPI::dispatchSync($country, $city, $modelCheck);
   $query = $this->queryDB($city);

  } else {
   $query = $this->queryDB($city);
  }

  if ($query == null) {
   return QueryAPI::$errors;

  } else {
   return $query;
  }

 }

 private function queryDB($city)
 {
  return $this->weatherRepository->findWeatherByCityName($city);
 }

 public function getLastTimestamp()
 {
  return $this->repository->getLastTimestamp();
 }

}
