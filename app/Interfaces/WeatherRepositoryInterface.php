<?php

namespace App\Interfaces;

interface WeatherRepositoryInterface extends RepositoryInterface
{
 public function findWeather($country, $city);

 public function refreshWeatherData($column, $value, $data);

}
