<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagarEmpresa extends Model
{
 protected $table = 'pago_empresa';



 protected $fillable = ['monto','id_usuario','id_empresa','codigo'];

//protected $dates = ['deleted_at'];
}
