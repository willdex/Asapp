<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class EmpresaRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
        //USUARIO
            'nombre_administrador'=>'required',
            'apellido_administrador'=>'required',
            'telefono_administrador'=>'required',
            'email'=>'required',
            'imagen'=>'required',

        //EMPRESA
            'nombre_empres'=>'required',
            //'direccion'=>'required',
            'telefono_empres'=>'required',
            'razon_social'=>'required',
            'nit'=>'required',
            //'latitud'=>'required',
            //'longitud'=>'required',
            //'credito'=>'required',
            'id_administrador'=>'required',            
        ];
    }
}
