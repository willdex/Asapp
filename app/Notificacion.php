<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{	

 protected $table = 'notificacion';
 protected $fillable = ['titulo','mensaje','id_administrador','tipo'];

 //protected $dates = ['deleted_at'];
}
