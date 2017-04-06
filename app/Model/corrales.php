<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class corrales extends Model
{
	protected $table='Corrales';

	protected $fillable=[

	'Codigo','Tipo','Estado','Capacidad'

	];

	public $timestamps=false;
}
