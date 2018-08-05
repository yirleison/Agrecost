<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Raza extends Model
{
    public $table='raza';

    protected $fillable=['nombre'];
    public $timestamps=false;
}
