<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class animal_corral extends Model
{
	protected $table='Corral_animal';

	protected $fillable=[

	'Codigo_corral','Codigo_animal','Fecha'
	];

	public $timestamps=false;
}
