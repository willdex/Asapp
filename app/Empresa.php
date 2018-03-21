<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Database\Eloquent\SoftDeletes;
//use Illuminate\Database\Eloquent\Model;

class Empresa extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
use Authenticatable, Authorizable, CanResetPassword,SoftDeletes;	
 
 protected $table = 'empresa';

 protected $fillable = ['nombre','direccion', 'telefono','razon_social','nit','latitud','longitud','credito','id_administrador','estado'];
 //protected $dates = ['deleted_at'];
}









