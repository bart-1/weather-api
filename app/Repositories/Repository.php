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
 public function deleteByColumnValue($column, $value)
 {
  $id = $this->getIDByValue($column, $value);
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

 public function findFreshestByValue($column, $value)
 {
  return $this->model->where($column, $value)->orderByRaw('(updated_at - created_at) DESC')->first();
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

/**
 *Check status of record from query. If doesn't exist return 'null', if updatet_at is old,
 * return 'unfresh'
 *@param str $column name of column where it looking for a value
 *@param mix $value
 * @return str null || unfresh || ok
 */
 public function checkModelStatus($column, $value)
 {

  switch (true) {
   case $this->checkIfExistByValue($column, $value) === false:
    return 'null';
    break;
   case $this->checkIfModelFreshByValue($column, $value) === false:
    return 'unfresh';
    break;
   default:
    return 'ok';
    break;
  }

 }

}
