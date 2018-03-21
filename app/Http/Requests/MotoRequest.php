<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class MotoRequest extends Request
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
            'ci'=>'required|unique:moto',           
            'celular'=>'required|unique:moto',           
            //'email'=>'required',           
            'marca'=>'required',           
            'modelo'=>'required',           
            'placa'=>'required|unique:moto',           
            'direccion'=>'required',           
            //'telefono'=>'required',           
            //'referencia'=>'required',           
            'codigo'=>'required',           
            'credito'=>'required',           
            'latitud'=>'required',           
            'longitud'=>'required',           
            'estado'=>'required',           
            'login'=>'required',           
            //'token'=>'required',           
            'imagen'=>'required',           
            'color'=>'required',           
        ];
    }
}
