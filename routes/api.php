<?php

use App\Http\Controllers\API\WeatherAPIController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
 */

// Route::get('/weather/index', [ApiWeatherController::class, 'index']);
// Route::get('/weather/timestamp/{country}/{city}', [ApiWeatherController::class, 'timestamp']);
// Route::get('/weather/delete/{id}', [ApiWeatherController::class, 'delete']);
// Route::get('/lasttimestamp', [WeatherAPIController::class, 'getLastTimestamp']);
Route::get('/{country}/{city}', [WeatherAPIController::class, 'manageRequest']);

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//  return $request->user();
// });
