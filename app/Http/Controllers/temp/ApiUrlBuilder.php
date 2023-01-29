<?php

namespace App\Traits;

trait ApiUrlBuilder {

    /**
     * Build URL for OpenWeather API
     * !!! API-KEY in .env is needed
     *@param str $city city name
     *@param str $units default 'metric'
     *@return str url for OpenWeather API
     */

 public function buildOpenWeatherApiUrl($city, $country, $units='metric'):string {
  $mainUrl = "https://api.openweathermap.org/data/2.5/weather?";
  $apiKey  = env('API_KEY', '');

  return $mainUrl.'q='.$city.','.$country.'&units='.$units.'&APPID='.$apiKey;
 }
}

