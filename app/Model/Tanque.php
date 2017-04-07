<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
  protected $table = 'tanque';

  protected $fillabe = [
    'Cantidad',
    'Capacidad',
    'Estado'
  ];

  public $timestamps = false;
}
