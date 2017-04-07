<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class promedioAnimal extends Model
{
	protected $table='Promedio_animal';


	protected $fillable=[

	'Codigo','Codigo_animal','Fecha','Cantidad_leche'

	];

	public $timestamps=false;
}
