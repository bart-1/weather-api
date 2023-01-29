<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;

class APIController extends Controller
{
 protected $repository;

 public function __construct($repository)
 {
  $this->repository = $repository;
 }

 public function index()
 {
  $this->repository->getAll();
 }

 public function show($column, $value)
 {
  return $this->repository->findByValue($column, $value);
 }

 public function delete($column, $value)
 {
  $this->repository->deleteByValue($column, $value);
 }

}
