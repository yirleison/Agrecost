<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Venta_animal extends Model
{
	public $table ='venta_animal';

	public $fillable=[

	'Codigo_animal','Fecha_venta','Valor'

	];

}
