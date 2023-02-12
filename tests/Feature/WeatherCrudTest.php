<?php

namespace Tests\Feature;

use App\Models\Weather;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WeatherCrudTest extends TestCase
{

  use RefreshDatabase;

  /**
   * Test check is possible to create new model
   * @var App\Model\Weather
   * @return void
   */
  public function test_create_weather_model_is_possible()
  {
    $weather = Weather::factory()->create();
    $this->assertModelExists($weather);

  }

  /**
   * Test check is possible to read created model
   * @var App\Model\Weather
   * @return void
   */

  public function test_read_created_weather_model_is_possible()
  {
    $weather  = Weather::factory()->create();
    $city     = \strtolower(\str_replace(' ', '', $weather->city));
    $response = $this->get("/weather-api/pl/" . $city);
    $response->assertDontSeeText('City and/or country not found');

  }
  public function test_query_city_with_wrong_country_code_returns_error_string()
  {
    $weather  = Weather::factory()->create();
    $city     = \strtolower(\str_replace(' ', '', $weather->city));
    $response = $this->get("/weather-api/en/" . $city);
    $response->assertSeeText('City and/or country not found');

  }
}
