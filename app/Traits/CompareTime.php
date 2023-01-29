<?php

namespace App\Traits;

trait CompareTime {

    /**
     * compare sended value of timestamp to now timestamp and check is fit in interval
     * @param mixed $time time you need to check
     * @param int $interval optional parameter, default is 60 seconds
     * @return bool
     */
 public function compareTime($time, $interval=60) {
  if (strtotime('now') - strtotime($time) > $interval) {
   return false;
  } else {
   return true;
  }
 }}
