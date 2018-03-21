<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class PorcentajeEmpresaRequest extends Request
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
            'porcentaje_empresa'=>'required',           
            'pago_fijo_empresa'=>'required',                     
            'impuesto'=>'required',                     
        ];
    }
}
