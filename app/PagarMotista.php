<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PagarMotista extends Model
{
 protected $table = 'pago_motista';



 protected $fillable = ['monto','id_usuario','id_moto','codigo'];

//protected $dates = ['deleted_at'];
}
