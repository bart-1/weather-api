<?php
namespace App\Http\Controllers\SourceAPI;


class OpenWeatherSourceAPIController extends SourceAPIController
{

 private $apiKey;
 public function __construct()
 {
  $this->apiKey = env('API_KEY', '');

 }

/**
 *It creates URL for OpenWeather API. Use ApiKey that needs to be created on https://openweathermap.org account and copied to .env file (as 'API_KEY=')
 *
 * @param str $country name of country
 * @param str $city name of city
 * @param str $units default is 'metric'; read more on https://openweathermap.org/current#data
 * @return str URL

 */

 public function createOpenWeatherApiUrl($country, $city, $units = 'metric')
 {
  $mainUrl = "https://api.openweathermap.org/data/2.5/weather?q=";

  return $this->prepareUrl([$mainUrl, $city, ',', $country, '&units=', $units, '&APPID=', $this->apiKey]);
 }
}
