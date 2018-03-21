<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UsuarioUpdateRequest extends Request
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
            'nombre'=>'required',           
            'apellido'=>'required',           
            'email'=>'required',           
            'telefono'=>'required',           
            'latitud'=>'required',           
            'longitud'=>'required',           
            //'token'=>'required',           
            'imagen'=>'required',           
            'id_empresa'=>'required',           
            'id_casa'=>'required',           
            'id_trabajo'=>'required',           
        ];
    }
}
