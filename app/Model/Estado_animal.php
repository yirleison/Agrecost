<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado_animal extends Model
{
	protected $table='estado_animal';

	protected $fillable=[
	'Nombre'
	];

	public $timestamps=false;
}
