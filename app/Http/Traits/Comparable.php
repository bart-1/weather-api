<?php

namespace App\Http\Traits;

trait Comparable
{
 /**
  * compare sended value of timestamp to now timestamp and check is fit in interval
  * @param string $time time you need to check
  * @param int $interval optional parameter, default is 60 seconds
  * @return bool
  */
 public function compareTime($time, $interval = 60)
 {

  if (strtotime('now') - strtotime($time) < $interval) {
   return true;
  } else {
   return false;
  }
 }
}
