<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Existenciavacunas extends Model
{
    protected $table='existencia_vacunas';

    protected $fillables=[
'Cantidad','Presentacion','Fecha_compra','Valor'

    ];
public $timestamps=false;   
}
