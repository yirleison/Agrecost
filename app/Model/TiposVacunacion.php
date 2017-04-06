<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class TiposVacunacion extends Model
{
    protected $table='tipo_vacuna';

    protected $fillable=[

'Nombre'

    ];

    public $timestamps=false;
}
