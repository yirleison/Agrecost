<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Movimiento extends Model
{
  protected $table = "movimiento";

    protected $fillable = [
      'Tipo_movimiento',
      'Cantidad',
      'Valor',
      'Fecha'
    ];
  public $timestamps = false;
}
