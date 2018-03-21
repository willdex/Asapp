<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB;
use App\Http\Requests;

class PagosController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

//////////////////////////////////////////////////////
///////////////PAGOS DE LAS EMPRESAS//////////////////
//////////////////////////////////////////////////////
	function lista_pago_empresa(){
        $lista_empresa=DB::select("SELECT *FROM empresa order by nombre");
        $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");        
        return view('pagos.lista_pago_empresa',compact('lista_empresa','fechas'));
	}
  
    //PARA BUSCAR EL PAGO A TODAS LAS EMPRESAS DADA DOS FECHAS
    public function buscar_pagos_todas_las_empresas($fecha_inicio,$fecha_fin){
        $buscar_Pagos=DB::select("SELECT pago_empresa.*,date_format(pago_empresa.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,empresa.nombre as empresa,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_empresa,empresa,users WHERE empresa.id=pago_empresa.id_empresa AND users.id=pago_empresa.id_usuario AND pago_empresa.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY)  ORDER by codigo");        
        return response($buscar_Pagos);
    }

    //PARA BUSCAR EL PAGO A UNA EMPRESAS DADA DOS FECHAS
    public function buscar_pagos_por_empresas($id,$fecha_inicio,$fecha_fin){
        $buscar_Pagos=DB::select("SELECT pago_empresa.*,date_format(pago_empresa.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,empresa.nombre as empresa,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_empresa,empresa,users WHERE empresa.id=pago_empresa.id_empresa AND users.id=pago_empresa.id_usuario AND pago_empresa.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) AND pago_empresa.id_empresa=".$id."  ORDER by codigo");        
        return response($buscar_Pagos);
    }

    //PARA BUSCAR EL PAGO A UNA EMPRESAS POR CODIGO
    public function buscar_pagos_empresa_codigo($codigo){
        $buscar=DB::select("SELECT pago_empresa.*,date_format(pago_empresa.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,empresa.nombre as empresa,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_empresa,empresa,users WHERE empresa.id=pago_empresa.id_empresa AND users.id=pago_empresa.id_usuario AND pago_empresa.codigo=".$codigo);        
        return response($buscar);
    }





//////////////////////////////////////////////////////
///////////////PAGOS DE LOS MOTISTAS//////////////////
//////////////////////////////////////////////////////
    function lista_pago_moto(){
        $lista_moto=DB::select("SELECT *FROM moto order by nombre");
        $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");                
        return view('pagos.lista_pago_moto',compact('lista_moto','fechas'));
    }
    //PARA BUSCAR EL PAGO A TODAS LAS MOTOS DADA DOS FECHAS
    public function buscar_pagos_todas_las_motos($fecha_inicio,$fecha_fin){
        $buscar_Pagos=DB::select("SELECT pago_motista.*,date_format(pago_motista.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(moto.nombre,' ',moto.apellido)as motista,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_motista,moto,users WHERE moto.id=pago_motista.id_moto AND users.id=pago_motista.id_usuario AND pago_motista.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY)  ORDER by codigo");        
        return response($buscar_Pagos);
    }

    //PARA BUSCAR EL PAGO A UNA MOTO DADA DOS FECHAS
    public function buscar_pagos_por_moto($id,$fecha_inicio,$fecha_fin){
        $buscar_Pagos=DB::select("SELECT pago_motista.*,date_format(pago_motista.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(moto.nombre,' ',moto.apellido)as motista,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_motista,moto,users WHERE moto.id=pago_motista.id_moto AND users.id=pago_motista.id_usuario AND pago_motista.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) AND pago_motista.id_moto=".$id." ORDER by codigo");        
        return response($buscar_Pagos);
    }

    //PARA BUSCAR EL PAGO A UNA MOTO POR CODIGO
    public function buscar_pagos_moto_codigo($codigo){
        $buscar=DB::select("SELECT pago_motista.*,date_format(pago_motista.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(moto.nombre,' ',moto.apellido)as motista,CONCAT(users.nombre,' ',users.apellido)as administrador FROM pago_motista,moto,users WHERE moto.id=pago_motista.id_moto AND users.id=pago_motista.id_usuario AND pago_motista.codigo=".$codigo);        
        return response($buscar);
    }

}
