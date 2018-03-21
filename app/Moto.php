<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Moto extends Model
{
 protected $table = 'moto';



 protected $fillable = ['nombre','apellido','ci','celular','email','marca','modelo','placa','direccion','telefono','referencia','codigo','credito','latitud','longitud','estado','login','token','imagen','color'];

//protected $dates = ['deleted_at'];
}
