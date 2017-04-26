<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Monta extends Model
{
    public $table='monta',

    $fillable=['Tipo','Codigo_animal_masc','Codigo_animal_fem','Fecha_monta','Fecha_secada','Fecha_palpada','Valor','Estado','Observaciones'];
    public $timestamps= false;

}
