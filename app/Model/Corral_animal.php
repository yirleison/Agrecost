<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Corral_animal extends Model
{
	protected $table='corral_animal';

	protected $fillable=[

	'Codigo_corral','Codigo_animal','Fecha'
	];

	public $timestamps=false;
}
