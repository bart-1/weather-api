<?php

namespace App\Interfaces;

interface RepositoryInterface
{
 public function getAll();

 public function create($data);

 public function update($id, $data);

 public function delete($id);

 public function deleteByColumnValue($column, $value);

 public function find($id);

 public function findByValue($column, $value);

 public function getIDByValue($column, $value);

 public function checkIfExistByValue($column, $value);

 public function findFreshestByValue($column, $value);

 public function getTimestampByValue($column, $value);

 public function getLastTimestamp();

 public function checkIfModelFreshByValue($column, $value);

 public function checkModelStatus($column, $value);
}
