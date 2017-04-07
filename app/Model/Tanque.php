<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Tanque extends Model
{
    protected $table = 'tanque';

    protected $fillable = ['Cantidad','Capacidad','Estado'];

  public $timestamps=false;
}
