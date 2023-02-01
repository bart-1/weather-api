<?php

namespace App\Http\Controllers\SourceAPI;

use App\Http\Controllers\Controller;
use App\Http\Controllers\TimestampsFreshnessController;
use App\Repositories\Repository;

class FrequencyModelUpdateController extends Controller
{

 public $repository;
 public $timeCompare;
 public static $frequency;
 public function __construct($model)
 {
  $this->repository  = new Repository($model);
  $this->timeCompare = new TimestampsFreshnessController();

 }

 public function checkLastModelTimestamp()
 {
  return $this->repository->getLastTimestamp();
 }

 public function setFrequency($frequency)
 {
  self::$frequency = $frequency;
 }

 public function realizeWithFrequency()
 {
  $lastTimestamp  = $this->checkLastModelTimestamp();
  $timeDifference = $this->timeCompare->calculateExpiredTimeFromNow($lastTimestamp);
  if ($timeDifference < self::$frequency) {
   $sleepValue = self::$frequency - $timeDifference;
   sleep($sleepValue);
  }
 }
}
