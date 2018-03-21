<?php

namespace App;
/*	//LO Q ESTA COMENTADO ES PORQE NO ESTOY UTILIZANDO EL DELETED_AT DE LARAVEL
use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;*/
use Illuminate\Database\Eloquent\Model;

class Usuario extends Model //implements AuthenticatableContract,
                                  //  AuthorizableContract,
                                 //   CanResetPasswordContract
{
//use Authenticatable, Authorizable, CanResetPassword, SoftDeletes;	

 protected $table = 'usuario';



 protected $fillable = ['nombre','apellido','email','id_empresa','id_trabajo','telefono','latitud','longitud','token','imagen','id_casa','estado'];

 //protected $dates = ['deleted_at'];
}
