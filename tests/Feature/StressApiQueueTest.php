<?php

namespace Tests\Feature;

use Tests\TestCase;

class StressApiQueueTest extends TestCase
{
 /**
  * A basic feature test example.
  *
  * @return void
  */
 public function test_query_api_with_frequency_sixty_one_per_minutes_make_app_denied_service()
 {
  for ($i = 1; $i <= 60; $i++) {

   $this->get('/api/weather/pl/warszawa');
  }
  $response = $this->get('/api/weather/pl/warszawa');

  $response->assertStatus(429);
 }
}
