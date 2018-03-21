<?php

namespace App;
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
//use Illuminate\Database\Eloquent\Model;

class Direccion extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;	

 protected $table = 'direccion';

 protected $fillable = ['nombre','detalle','latitud','longitud','id_empresa','id_usuario','estado'];

 //protected $dates = ['deleted_at'];
}
