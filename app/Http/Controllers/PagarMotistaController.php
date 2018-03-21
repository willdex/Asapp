<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagarMotistaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\PagarMotista;
use DB;
use App\Http\Requests;
use Hash;
class PagarMotistaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

	function index(){
        $buscar_moto=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");        
        $pago=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");        
        return view("moto.pago_motista",compact('pago','buscar_moto'));
	}
  
	public function create(){
      return view('moto.create');	
    }
 
    public function store(PagarMotistaRequest $request){
        try {
          DB::beginTransaction(); 
            if ($request['monto'] > $request['monto_aux']) {
                      DB::rollback();
                      return redirect('/pago_motista')->with("message-error","ERROR: LA CANTIDAD DE PAGO ESTA MAL, VERIFIQUE NUEVAMENTE");      
            } else {                
                PagarMotista::create([
                    'monto' => $request['monto'],
                    'codigo' => $request['codigo_fac'],
                    'id_usuario' => $request['id_admin'],
                    'id_moto' => $request['id_moto_fac'],
                ]);

                $id=$request->get("id_moto_pag");
                $credito=$request['monto_aux'] - $request['monto'];
                $moto=DB::table('moto')->where('id', $id)->update(['credito' => $credito ]);                
                /*$monto_aux = $request['monto'];
                $id_carrera=$request->get('id_carrera');
                $monto=$request->get('monto_pag');
                $cont=0;

                while ( $cont < count($id_carrera)) {
                    if ($monto_aux > $monto[$cont]) {
                        $carrera = DB::table('pedido')->where('id',$id_carrera[$cont])->update(['monto_motista_aux'=>0]);
                        $monto_aux=$monto_aux - $monto[$cont];
                        $cont=$cont+1;
                    } else {
                        $monto_sobrante = $monto[$cont] - $monto_aux;                        
                        $carrera = DB::table('pedido')->where('id',$id_carrera[$cont])->update(['monto_motista_aux'=>$monto_sobrante]);
                        break;
                    }            
                }*/
                DB::commit();
                return redirect('/pago_motista')->with("message","SE REALIZO EL PAGO CORRECTAMENTE");  
            }                    

        } catch (Exception $e) {
          DB::rollback();
          return redirect('/pago_motista')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        }      
    }

    public function edit($id){
       $moto = Moto::find($id);
       return view('moto.edit',['moto'=>$moto]);
    }

    public function update(MotoRequest $request){
        $id=$request->get("id_moto");
        $moto=DB::table('moto')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'ci' => $request['ci'], 'celular' => $request['celular'], 'email' => $request['email'], 'marca' => $request['marca'], 'modelo' => $request['modelo'], 'placa' => $request['placa'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono'], 'referencia' => $request['referencia'], 'codigo' => $request['codigo'], 'credito' => $request['credito'], 'latitud' => $request['latitud'], 'longitud' => $request['longitud'], 'estado' => $request['estado'], 'login' => $request['login'], 'token' => $request['token'], 'imagen' => $request['imagen'], 'color' => $request['color'], ]);
        Session::flash('message','ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('/moto');
    }
    
    public function destroy($id, Request $request){
        $Moto=Moto::find($id);
        $Moto->delete();
        Session::flash('message','Moto Eliminado Correctamente');
       return Redirect::to('/Moto');
    }
}
