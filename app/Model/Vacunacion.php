<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Vacunacion extends Model
{
    protected $table='vacunacion';

    protected $fillable=[
        'Nombre','Tipo','Periodicidad','Dosis','Tipo_administracion','Stock'
    ];
    
}
