<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Usuarios extends Model
{
    protected $table = 'users';

    protected $fillable = ['id','name','email','password','rol_id'];

  public $timestamps=false;
}
