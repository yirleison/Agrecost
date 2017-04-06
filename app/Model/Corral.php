<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corral extends Model
{
  protected $table = 'corrales';

  protected $fillable = [
    'Tipo',
    'Capacidad',
    'Estado',
  ];

  public $timestamps = false;
}
