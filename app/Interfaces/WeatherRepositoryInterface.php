<?php

namespace App\Interfaces;

interface WeatherRepositoryInterface extends RepositoryInterface
{
 public function findWeatherByCityName($city);

 public function refreshWeatherData($column, $value, $data);

}
