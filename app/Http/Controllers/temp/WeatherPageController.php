<?php

namespace App\Http\Controllers;

use App\Traits\ApiUrlBuilder;
use Inertia\Inertia;

class WeatherPageController extends Controller {

 use ApiUrlBuilder;

 protected $createGreenLight = false;
 protected $updateGreenLight = false;



 public function index() {

  return Inertia::render('Weather', [
   'city' => 'Warsaw',

  ]);
 }

}
