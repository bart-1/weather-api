<?php

namespace App\Http\Controllers;

use App\Repositories\WeatherRepository;
use App\Traits\ApiHarvester;
use App\Traits\ApiUrlBuilder;
use App\Traits\CompareTime;

class ApiWeatherController extends Controller
{

 use ApiUrlBuilder;
 use CompareTime;
 use ApiHarvester;

 protected $repository;
 protected $apiUrl;
 protected $responseData;
 private $freshAPIData;

 public function __construct(WeatherRepository $repository)
 {
  $this->repository = $repository;

 }

 public function index()
 {
  return $this->repository->getAll();
 }

 public function show($country, $city)
 {

  $isCityInDB = $this->repository->findFreshestByValue('city', $city);
  if (!$isCityInDB) {
   $this->repository->create(['weather' => 'ini', 'city' => $city]);
  }

  $this->apiUrl    = $this->buildOpenWeatherApiUrl($city, $country);
  $cityDBTimestamp = $this->repository->getTimestampByValue('city', $city);

  if ($this->compareTime($cityDBTimestamp)) {

   $this->responseData = $this->repository->findFreshestByValue('city', $city) ?? 'no data about ' . $city;
  } else {
   $apiData = $this->apiHarvest($this->apiUrl);
   $this->repository->refreshWeatherData('city', $city, ['weather' => $apiData]);
   $this->responseData = $this->repository->findFreshestByValue('city', $city) ?? 'no data about ' . $city;
  }

  return $this->responseData;

 }

 public function timestamp($city)
 {
  return $this->repository->getTimestampByValue('city', $city) ?? 'no timestamp';
 }
 public function delete($id)
 {
  return $this->repository->delete($id);
 }
}
