<?php

namespace App\Http\Controllers;

class TimestampsFreshnessController
{

 public static $acceptedInterval;
 /**
  * compare sended value of timestamp to now timestamp and check is fit in interval
  * @param string $time time you need to check
  * @var int static $interval parameter, need to be define
  * @return bool
  */
 public function isFitInAcceptedInterval($time)
 {
  if (strtotime('now') - strtotime($time) < self::$acceptedInterval) {
   return true;
  } else {
   return false;
  }
 }

 public function calculateExpiredTimeFromNow($time)
 {
  return strtotime('now') - strtotime($time);
 }
}
