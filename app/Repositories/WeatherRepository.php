<?php

namespace App\Repositories;

use App\Interfaces\WeatherRepositoryInterface;
use App\Models\Weather;
use App\Repositories\Repository;

class WeatherRepository extends Repository implements WeatherRepositoryInterface
{

  public function __construct(Weather $weather)
  {
      $this->model = $weather;
      parent::__construct($weather);
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
