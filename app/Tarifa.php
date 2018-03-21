<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tarifa extends Model
{
 protected $table = 'tarifa';

 protected $fillable = ['distancia','monto','porcentaje_moto','costo_fijo_moto','porcentaje_empresa','gasto_fijo_empresa','impuesto'];

//protected $dates = ['deleted_at'];
}
