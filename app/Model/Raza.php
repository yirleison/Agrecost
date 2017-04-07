<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
	protected $table='raza';

	protected $fillable=[
	'Nombre'
	];

	public $timestamps=false;
}
