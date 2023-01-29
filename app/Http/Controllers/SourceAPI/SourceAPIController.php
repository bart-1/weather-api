<?php

namespace App\Http\Controllers\SourceAPI;

class SourceAPIController
{

 public $apiInRange    = false;
 protected $apiRawData = null;

 public function prepareUrl($urlParts)
 {

  $url = '';

  foreach ($urlParts as $element) {
   $url = $url . $element;
  }
  return $url;
 }

 public function testConnection($url)
 {

  if (get_headers($url)) {
   $this->apiInRange = true;
   return true;
  } else {
   $this->apiInRange = false;
   return false;}
 }

 public function apiHarvest($url)
 {

  if ($this->testConnection($url)) {
   $conn = curl_init();
   curl_setopt($conn, CURLOPT_URL, $url);
   curl_setopt($conn, CURLOPT_HEADER, false);
   curl_setopt($conn, CURLOPT_RETURNTRANSFER, 1);
   $data             = curl_exec($conn);
   $this->apiRawData = $data;
//    $errors           = \curl_errno($conn);
   curl_close($conn);

   return $this->getJsonDecoded($data);

  } else {
   return 'Sorry, API server problem, check later';
  }

 }

 public function getJsonDecoded($data)
 {
  return json_decode($data, true);

 }

}
