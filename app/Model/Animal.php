<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Animal extends Model
{
    //Nombre de la tabla que vamos a utilizar para el modelo
    Public $table= 'animal';
    //Nombre de la clave primario de la tabla
    //Protected $primaryKey= 'Id';
    //Nombres de todos los campos de la tabla tal cual estan en la base de datos omitiendo el ID
    Protected $fillable=['Marcado','Nombre','Fecha_nacimiento','Sexo','Peso','Codigo_raza','Codigo_estado'];
    //
    public $timestamps=false;
}
