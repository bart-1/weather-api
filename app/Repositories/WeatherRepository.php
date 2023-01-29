<?php

namespace App\Repositories;

use App\Interfaces\RepositoryInterface;
use App\Interfaces\WeatherRepositoryInterface;
use App\Models\Weather;
use App\Repositories\Repository;

class WeatherRepository extends Repository implements WeatherRepositoryInterface, RepositoryInterface
{

 public function __construct(Weather $weather)
 {
  $this->model = $weather;
 }

 public function findWeatherByCityName($city)
 {
  return $this->findFreshestByValue('city', $city);
 }

 public function refreshWeatherData($column, $value, $data)
 {
  $id = $this->findByValue($column, $value)->value('id');
  $this->update($id, $data);
  return 'updated';
 }

}
