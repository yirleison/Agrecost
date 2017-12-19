<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Estado extends Model
{
    public $table='estado_animal';

    protected $fillable=['Nombre'];
    public $timestamps=false;
}
