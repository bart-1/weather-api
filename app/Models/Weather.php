<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
 use HasFactory;

 protected $table = 'weather';

 /**
  * The attributes that are mass assignable.
  *
  * @var array<int, string>
  */
 protected $fillable = [
  'city',
  'country',
  'weather',

 ];
}
