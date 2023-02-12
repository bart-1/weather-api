<?php

namespace App\Repositories;

use App\Http\Controllers\TimestampsFreshnessController;
use App\Interfaces\RepositoryInterface;

class Repository implements RepositoryInterface
{

 protected $compareTimeController;

 protected $model;

 public function __construct($model)
 {
  $this->compareTimeController = new TimestampsFreshnessController();
  $this->model                 = $model;
 }

 public function getAll()
 {
  return $this->model->all();
 }

 public function create($data)
 {
  $this->model->create($data);
 }

 public function update($id, $data)
 {
  $this->model->where('id', $id)->update($data);
 }

 public function delete($id)
 {
  $this->model->findOrFail($id)->delete();
 }

 public function find($id)
 {
  return $this->model->find($id)->get();
 }

 public function findByValue($column, $value)
 {
  return $this->model->where($column, $value)->get();
 }

 public function getIDByValue($column, $value)
 {
  return $this->model->where($column, $value)->value('id');
 }

 public function checkIfExistByValue($column, $value)
 {
  if ($this->model->where($column, $value)->exists() > 0) {
   return true;
  } else {
   return false;
  }
 }
 public function checkIfExistByTwoValues($columnOne, $valueOne, $columnTwo, $valueTwo)
 {

  $country = $this->model->where($columnOne, $valueOne)->get();

  if ($country->where($columnTwo, $valueTwo)->count() > 0) {
   return true;
  } else {
   return false;
  }
 }

 public function findFreshestByValue($column, $value)
 {
  return $this->model->where($column, $value)->orderByRaw('(updated_at - created_at) DESC')->first();
 }

 public function findFreshestByTwoValues($columnOne, $valueOne, $columnTwo, $valueTwo)
 {
  return $this->model->where($columnOne, $valueOne)->where($columnTwo, $valueTwo)->orderByRaw('(updated_at - created_at) DESC')->first();
 }

 public function getTimestampByValue($column, $value)
 {
  return $this->model->where($column, $value)->value('updated_at');
 }
 public function getLastTimestamp()
 {
  return $this->model->orderBy('updated_at', 'DESC')->value('updated_at');
 }

 public function checkIfModelFreshByValue($column, $value)
 {
  $cityDBTimestamp = $this->model->where($column, $value)->value('updated_at');
  return $this->compareTimeController->isFitInAcceptedInterval($cityDBTimestamp);
 }

 public function isFreshModelInCollection($collection)
 {
  $modelTimestamp = $collection->sortByDesc('updated_at')->first()->value('updated_at');
  return $this->compareTimeController->isFitInAcceptedInterval($modelTimestamp);
 }

 public function checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo)
 {

  $collection = $this->model->where($columnOne, $valueOne)->where($columnTwo, $valueTwo)->get();

  switch (true) {
   case $collection->count() < 1:
    return 'null';
    break;
   case $this->isFreshModelInCollection($collection) === false:
    return 'unfresh';
    break;
   case $collection->count() > 0:
    return 'ok';
    break;
   default:
    return 'null';
    break;
  }

 }

}
