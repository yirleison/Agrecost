<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Existencia_leche extends Model
{
  protected $table = 'existencia_leche';

  protected $fillabe = [
    'Codigo_tanque',
    'Codigo_movimiento',
    'Cantidad'
  ];

  public $timestamps = false;
}
