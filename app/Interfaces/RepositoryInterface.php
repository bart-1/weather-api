<?php

namespace App\Interfaces;

interface RepositoryInterface
{
 public function getAll();

 public function create($data);

 public function update($id, $data);

 public function delete($id);

 public function find($id);

 public function findByValue($column, $value);

 public function findFreshestByTwoValues($columnOne, $valueOne, $columnTwo, $valueTwo);

 public function getTimestampByValue($column, $value);

 public function getLastTimestamp();

 public function isFreshModelInCollection($collection);

 public function checkModelStatus($columnOne, $valueOne, $columnTwo, $valueTwo);
}
