<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Produccion_corral extends Model
{
	protected $table='produccion_corral';

	protected $fillable=[

	'Codigo_corral','Codigo_movimiento','Jornada'

	];

	public $timestamps=false;
}
