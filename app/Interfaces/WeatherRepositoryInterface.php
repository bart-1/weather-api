<?php

namespace App\Interfaces;

interface WeatherRepositoryInterface
{
 public function findWeatherByCityName($city);

 public function refreshWeatherData($column, $value, $data);

}
