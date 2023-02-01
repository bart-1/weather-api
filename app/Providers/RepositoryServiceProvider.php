<?php

namespace App\Providers;

use App\Interfaces\RepositoryInterface;
use App\Interfaces\WeatherRepositoryInterface;
use App\Repositories\Repository;
use App\Repositories\WeatherRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
 /**
  * Register services.
  *
  * @return void
  */
 public function register()
 {
  $this->app->bind(WeatherRepositoryInterface::class, WeatherRepository::class);
  $this->app->bind(RepositoryInterface::class, Repository::class);
 }

 /**
  * Bootstrap services.
  *
  * @return void
  */
 public function boot()
 {
  //
 }
}
