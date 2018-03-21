<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PagarEmpresaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\PagarEmpresa;
use DB;
use App\Http\Requests;
use Hash;
class PagarEmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

	function index(){  
        $buscar_empresa=DB::select("SELECT * FROM empresa");

        $empresa=DB::select("SELECT empresa.*,DATEDIFF(now(),empresa.fecha)as dias,usuario.id as id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador  FROM empresa,usuario WHERE usuario.id=empresa.id_administrador AND DATEDIFF(now(),empresa.fecha)>=30 ORDER BY dias DESC");
    
        return view("empresa.pago_empresa",compact('buscar_empresa','empresa'));
	}
  

	public function create(){
      return view('empresa.create');	
    }
 
    public function store(PagarEmpresaRequest $request){
        try {
          DB::beginTransaction(); 
            if ($request['monto'] != $request['monto_aux']) {
                      DB::rollback();
                      return redirect('/pago_empresa')->with("message-error","ERROR: LA CANTIDAD DE PAGO ESTA MAL, VERIFIQUE NUEVAMENTE");      
            } else {                
                PagarEmpresa::create([
                    'monto' => $request['monto'],
                    'codigo' => $request['codigo'],
                    'id_usuario' => $request['id_admin'],
                    'id_empresa' => $request['id_empresa'],
                ]);
                $id_pedido=$request->get('id_pedido');
                $monto=$request->get('monto_pag');
                $cont=0;

                while ( $cont < count($id_pedido)) {
                    $pedido = DB::table('pedido')->where('id',$id_pedido[$cont])->update(['monto_empresa_aux'=>0]);
                    $cont=$cont+1;
                }
                $fecha=DB::select("SELECT *,DATE(DATE_ADD(empresa.fecha, INTERVAL 30 DAY))as nueva_fecha from empresa WHERE id=".$request['id_empresa']);
                $estado=DB::select("SELECT empresa.*,DATEDIFF(now(),empresa.fecha)as dias,usuario.id as id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador,(DATEDIFF(now(),empresa.fecha)/40)as verificar FROM empresa,usuario WHERE usuario.id=empresa.id_administrador AND empresa.id=".$request['id_empresa']);
                //$credito = $estado[0]->credito -  $request['monto'];
                if ($estado[0]->verificar < 1) {
                    $pedido = DB::table('empresa')->where('id',$request['id_empresa'])->update(['fecha'=>$fecha[0]->nueva_fecha, 'estado'=>1]);
                } else {
                    if ($estado[0]->verificar < 2) {
                        $pedido = DB::table('empresa')->where('id',$request['id_empresa'])->update(['fecha'=>$fecha[0]->nueva_fecha, 'estado'=>1]);
                    }
                    else{
                        $pedido = DB::table('empresa')->where('id',$request['id_empresa'])->update(['fecha'=>$fecha[0]->nueva_fecha, 'estado'=>2]);
                    }
                }    

               //VERIFICO CUANTA EMPRESAS NO HA  REALIZADO PEDIDOS DURANTE 30 DIAS PARA ODER ACTUALIZAR SU FECHA DE REGISTRO
                $verificar=DB::select("SELECT *,DATEDIFF(NOW(),empresa.fecha) AS dias from empresa WHERE DATEDIFF(NOW(),empresa.fecha)>=30 AND (NOT EXISTS(SELECT *FROM usuario,pedido WHERE pedido.id_usuario=usuario.id AND empresa.id=usuario.id_empresa))");
                $fecha=DB::select("SELECT curdate() as fecha");
                //EN ACA SE ACTUALIZA A LAS EMPRESA Q ESTAN REGISTRADAS PERO NO ISIERON CARRERA DURANTE 30 DIAS SE ACTUALIZA SU FECHA DE REGISTRO               
                for ($i=0; $i < count($verificar) ; $i++) { 
                    $estado_empresa = DB::table('empresa')->where('id',$verificar[$i]->id)->update(['fecha'=>$fecha[0]->fecha]);                
                } 

                DB::commit();
                return redirect('/pago_empresa')->with("message","SE REALIZO EL PAGO CORRECTAMENTE");  
            }                    

        } catch (Exception $e) {
          DB::rollback();
          return redirect('/pago_empresa')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        }      
    }

    public function edit($id){
       $empresa = empresa::find($id);
       return view('empresa.edit',['empresa'=>$empresa]);
    }

    public function update(empresaRequest $request){
        $id=$request->get("id_empresa");
        $empresa=DB::table('empresa')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'ci' => $request['ci'], 'celular' => $request['celular'], 'email' => $request['email'], 'marca' => $request['marca'], 'modelo' => $request['modelo'], 'placa' => $request['placa'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono'], 'referencia' => $request['referencia'], 'codigo' => $request['codigo'], 'credito' => $request['credito'], 'latitud' => $request['latitud'], 'longitud' => $request['longitud'], 'estado' => $request['estado'], 'login' => $request['login'], 'token' => $request['token'], 'imagen' => $request['imagen'], 'color' => $request['color'], ]);
        Session::flash('message','ACTUALIZADO CORRECTAMENTE');
        return Redirect::to('/empresa');
    }
    
    public function destroy($id, Request $request){
        $empresa=empresa::find($id);
        $empresa->delete();
        Session::flash('message','empresa Eliminado Correctamente');
       return Redirect::to('/empresa');
    }


    //MUESTRA LA LISTA DE LOS MONTO Q DEBE PAGAR A LA EMPRESA
    public function cargar_lista_empresa($id){      
        $lista=DB::select("SELECT pedido.*,empresa.id as id_empresa,empresa.fecha as fecha_creacion,DATEDIFF(now(),empresa.fecha)as dias from pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.fecha BETWEEN empresa.fecha AND DATE_FORMAT(DATE_ADD(empresa.fecha, INTERVAL 30 day),'%Y/%m/%d') AND pedido.monto_empresa_aux>0 AND usuario.id_empresa=".$id." ORDER by pedido.fecha");       
        return response($lista);
    }

    //MUESTRA EL MONTO Q LE DEBE PAGAR A LA EMPRESA
    public function cargar_pago_empresa($id){      
        $pago_empresa=DB::select("SELECT SUM(pedido.monto_empresa_aux)as monto_empresa from pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.fecha BETWEEN empresa.fecha AND DATE_FORMAT(DATE_ADD(empresa.fecha, INTERVAL 30 day),'%Y/%m/%d') AND usuario.id_empresa=".$id." ORDER by pedido.fecha");
        return response($pago_empresa);
    }    

    //MUESTRA EL MONTO Q LE DEBE PAGAR A LA EMPRESA
    public function cargar_lista_empresa_paga(){      
        $lista_empresa=DB::select("SELECT empresa.*,DATEDIFF(now(),empresa.fecha)as dias,usuario.id as id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador  FROM empresa,usuario WHERE usuario.id=empresa.id_administrador AND DATEDIFF(now(),empresa.fecha)>=30 ORDER BY dias DESC");
        return response($lista_empresa);
    }   

    //MUESTRA A UNA EMRPESA Q SE SELECCIONO PARA PAGAR
    public function cargar_empresa_paga($id){      
        $pago_empresa=DB::select("SELECT empresa.*,DATEDIFF(now(),empresa.fecha)as dias,usuario.id as id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador  FROM empresa,usuario WHERE usuario.id=empresa.id_administrador AND empresa.id=".$id." ORDER BY dias DESC");
        return response($pago_empresa);
    }  
    
}
