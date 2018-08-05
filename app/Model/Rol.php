<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Rol extends Model
{
	protected $table='rol';


	protected $fillable=[

	'id','tipo'

	];

	public $timestamps=false;
}
