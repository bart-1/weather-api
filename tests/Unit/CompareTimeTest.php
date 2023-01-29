<?php

namespace Tests\Unit;

use App\Http\Traits\Comparable;
use Tests\TestCase;

class CompareTimeTest extends TestCase
{

 use Comparable;

 public function test_compare_now_time_value_with_sended_time_value_from_accepted_range_gives_true(): void
 {

  $goodTime = '-1 minute';

  $this->assertTrue($this->compareTime($goodTime, 70));
 }

 public function test_compare_now_time_value_with_sended_time_value_outside_accepted_range_gives_false(): void
 {
  $badTime = '2023-01-22 17:28:41';

  $this->assertFalse($this->compareTime($badTime, 70));
 }
}
