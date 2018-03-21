<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\TarifaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Tarifa;
use DB;
use App\Http\Requests;

class TarifaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

	function index(){
        $tarifa=Tarifa::where('estado','1')->ORDERBY('distancia','ASC')->paginate(20);
       return view('tarifa.index',["tarifa"=>$tarifa]);
	}

	public function create(){
      return view('tarifa.create');	
    }
 
    public function store(TarifaRequest $request){
    	Tarifa::create([
            'distancia' => $request['distancia'],
            'monto' => $request['monto'],
            'porcentaje_moto' => $request['porcentaje_moto'],
            'costo_fijo_moto' => $request['costo_fijo_moto'],
            'porcentaje_empresa' => $request['porcentaje_empresa'],
            'gasto_fijo_empresa' => $request['gasto_fijo_empresa'],
            'impuesto' => $request['impuesto'],
        ]);
        Session::flash('message','CREADO CORRECTAMENTE');
        return Redirect::to('/tarifa');
    }

    public function edit($id){
       $tarifa = Tarifa::find($id);
       return view('tarifa.edit',['tarifa'=>$tarifa]);
    }

    public function update(TarifaRequest $request){
        $id=$request->get("id_tarifa");
        $Tarifa=DB::table('tarifa')->where('id', $id)->update(['distancia' => $request['distancia'], 'monto' => $request['monto'], 'porcentaje_moto' => $request['porcentaje_moto'], 'costo_fijo_moto' => $request['costo_fijo_moto'], 'porcentaje_empresa' => $request['porcentaje_empresa'], 'gasto_fijo_empresa' => $request['gasto_fijo_empresa'], 'impuesto' => $request['impuesto']]);
        Session::flash('message','ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('/tarifa');
    }
    
    public function destroy(Request $request){
        $id=$request->get("id_tarifa_eli");
        $Tarifa=DB::table('tarifa')->where('id', $id)->update(['estado' => 0]);        
        Session::flash('message','ELIMINADO CORRECTAMENTE');
       return Redirect::to('/tarifa');
    }

    //CARGAR PARA PODER ACTUALIZAR EN LA PARTE DEL MODAL
    public function cargar_tarifa($id){
        $Tarifa=DB::select("SELECT *from tarifa where id=".$id);
        return response($Tarifa);
    }

    //PARA BUSCAR UN MOTISTA ESPECIFICO
    public function busqueda_motista(){
        $buscar_Tarifa=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM Tarifa");        
        return view("Tarifa.busqueda_motista",compact('buscar_Tarifa'));
    }

    public function actualizar_tarifa(Request $request){        
        $Tarifa=DB::table('tarifa')->where('estado', 1)->update(['porcentaje_moto' => $request['porcentaje_moto'], 'costo_fijo_moto' => $request['costo_fijo_moto'], 'porcentaje_empresa' => $request['porcentaje_empresa'], 'gasto_fijo_empresa' => $request['gasto_fijo_empresa'], 'impuesto' => $request['impuesto']]);
        Session::flash('message','ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('/tarifa');
    }


}
