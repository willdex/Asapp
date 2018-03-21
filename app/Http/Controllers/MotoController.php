<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\MotoRequest;
use App\Http\Requests\MotoUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Moto;
use App\Notificacion;
use DB;
use App\Http\Requests;

class MotoController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

	function index(){
        $buscar_moto=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");
        $moto=Moto::orderBy("estado","nombre","ASC")->paginate(20);//where("estado","!=","2")->paginate(20);
       return view('moto.index',compact('moto','buscar_moto',$buscar_moto));
	}
  
  
	public function create(){
      return view('moto.create');	
    }
 
    public function store(MotoRequest $request){
      try {
      DB::beginTransaction();
       $verificar=DB::select("SELECT COUNT(*)as contador from moto WHERE moto.celular=".$request['celular']);
        foreach ($verificar as $key => $value) {
          $contador=$value->contador;
        }
        if ($contador==0) {
            $imagen = $request['imagen'];     //SOLO CON ESTO SE GUARDA CUANDO ES MEDIANTE CANVA
            /*$imagen = $request['imagen']; 
            $gestor = fopen($imagen, "r");
            $contenido = fread($gestor, filesize($imagen));
            $contenido = base64_encode($contenido);
            fclose($gestor);*/
            Moto::create([
                'nombre' => $request['nombre'],
                'apellido' => $request['apellido'],
                'ci' => $request['ci'],
                'celular' => $request['celular'],
                'email' => $request['email'],
                'marca' => $request['marca'],
                'modelo' => $request['modelo'],
                'placa' => $request['placa'],
                'direccion' => $request['direccion'],
                'telefono' => $request['telefono'],
                'referencia' => $request['referencia'],
                'codigo' => $request['codigo'],
                'credito' => $request['credito'],
                'latitud' => $request['latitud'],
                'longitud' => $request['longitud'],
                'estado' => $request['estado'],
                'login' => $request['login'],
                'token' => $request['token'],
                'imagen' => $imagen,//$contenido, //$contenido ES MEDIANTE EL FOPEN //$imagen, ESTO ES CUANDO SE GUARDA CON CANVA
                'color' => $request['color'], 
            ]);

              DB::commit();          
            Session::flash('message','CREADO CORRECTAMENTE');
            return Redirect::to('/moto');          
        } else {
            Session::flash('message-error','YA EXISTE UN MOTISTA CON ESE NUMERO DE CELULAR');
            return Redirect::to('/moto'); 
        }     
      }catch (Exception $e) {
          DB::rollback();
          return redirect('/moto')->with("message-error","ERROR INTENTE NUEVAMENTE");      
      }   
    }

    public function edit($id){
       $moto = Moto::find($id);
       return view('moto.edit',['moto'=>$moto]);
    }

    public function update(MotoUpdateRequest $request){
      if ($request['celular'] == $request['celular_aux']) {
            $id=$request->get("id_moto");
            $moto=DB::table('moto')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'ci' => $request['ci'], 'celular' => $request['celular'], 'email' => $request['email'], 'marca' => $request['marca'], 'modelo' => $request['modelo'], 'placa' => $request['placa'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono'], 'referencia' => $request['referencia'], 'codigo' => $request['codigo'], 'credito' => $request['credito'], 'latitud' => $request['latitud'], 'longitud' => $request['longitud'], 'token' => $request['token'], 'imagen' => $request['imagen'], 'color' => $request['color'], ]);
            Session::flash('message','ACTUALIZADO CORRECTAMENTE');
            return Redirect::to('/moto');          
        } else {
            $verificar=DB::select("SELECT COUNT(*)as contador from moto WHERE moto.celular=".$request['celular']);
              foreach ($verificar as $key => $value) {
                  $contador=$value->contador;
              }
            if($contador == 0){
                $id=$request->get("id_moto");
                $moto=DB::table('moto')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'ci' => $request['ci'], 'celular' => $request['celular'], 'email' => $request['email'], 'marca' => $request['marca'], 'modelo' => $request['modelo'], 'placa' => $request['placa'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono'], 'referencia' => $request['referencia'], 'codigo' => $request['codigo'], 'credito' => $request['credito'], 'latitud' => $request['latitud'], 'longitud' => $request['longitud'], 'token' => $request['token'], 'imagen' => $request['imagen'], 'color' => $request['color'], ]);
                Session::flash('message','ACTUALIZADO CORRECTAMENTE');
                return Redirect::to('/moto'); 
            }
            else{
                Session::flash('message-error','YA EXISTE UN MOTISTA CON ESE NUMERO DE CELULAR');
                return Redirect::to('/moto'); 
            }          
        }
    }
    
    public function destroy($id, Request $request){
        $Moto=Moto::find($id);
        $Moto->delete();
        Session::flash('message','Moto Eliminado Correctamente');
       return Redirect::to('/Moto');
    }

    //CARGAR PARA PODER ACTUALIZAR EN LA PARTE DEL MODAL
    public function cargar_moto($id){
        $moto=DB::select("SELECT *from moto where id=".$id);
        return response($moto);
    }

    //PARA BUSCAR UN MOTISTA ESPECIFICO
    public function busqueda_motista(){
        $buscar_moto=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");        
        return view("moto.busqueda_motista",compact('buscar_moto'));
    }

    //PAGO DE LOS MOTISTA
    public function actualizar_pago_motista(Request $request){
        try {
          DB::beginTransaction(); 

            $id_carrera=$request->get('id_carrera');
            $monto=$request->get('monto_pag');
            $cont=0;
             
            while ( $cont < count($id_carrera)) {
                $carrera = DB::table('carrera')->where('id',$id_carrera[$cont])->update(['monto_motista'=>0]);
                $cont=$cont+1;                    
            }
            DB::commit();
            return redirect('/pago_motista')->with("message","SE REALIZO EL PAGO CORRECTAMENTE");              

        } catch (Exception $e) {
          DB::rollback();
          return redirect('/pago_motista')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        }
    }

    //MUESTRA LA LISTA DE LOS MONTO Q DEBE PAGAR AL MOTISTA
    public function cargar_lista_motista($id){      
        $lista=DB::select("SELECT pedido.id,pedido.monto_motista_aux,pedido.fecha from pedido WHERE pedido.monto_motista_aux>0 AND pedido.id_moto=".$id);       
        return response($lista);
    }

    //BUSCAR PAGO DE LOS MOTISTA
    public function pago_motista(){
        $buscar_moto=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");        
        $pago=DB::select("SELECT id,nombre,apellido,ci,placa,modelo,color,celular FROM moto");        
        return view("moto.pago_motista",compact('pago','buscar_moto'));
    }

    //MUESTRA EL MONTO Q LE DEBE PAGAR AL MOTISTA
    public function cargar_pago_motista($id){      
        //$pago_moto=DB::select("SELECT SUM(pedido.monto_motista_aux)as monto_motista from pedido WHERE pedido.monto_motista_aux>0 AND pedido.id_moto=".$id);
        $pago_moto=DB::select("SELECT *from moto WHERE id=".$id);        
        return response($pago_moto);
    }



////////////////////////////////////////////////////////////////////////////////
//////////////////HISTORIAL DE CARRERAS DE LOS MOTISTAS/////////////////////////
////////////////////////////////////////////////////////////////////////////////

    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA
    public function show($id){
       $moto = Moto::find($id);
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");
       return view('moto.historial_carrera',['moto'=>$moto], compact('fechas'));
    }
    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA
    public function historial_carrera($id, $fecha_inicio, $fecha_fin){
        $moto = DB::select("SELECT p.*,date_format(p.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(HOUR(p.fecha),':',MINUTE(p.fecha),':',SECOND(p.fecha))as 'hora',e.nombre as 'empresa',u.telefono,CONCAT(u.nombre,' ',u.apellido)as 'nombre_usuario',(select d.nombre from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'nombre_direccion',(select d.detalle from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'detalle_direccion',(select sum(monto) from carrera ca where ca.id_pedido=p.id)as 'monto_total' from pedido p,usuario u,empresa e where EXISTS(select * from carrera ca where ca.id_pedido=p.id) and p.estado=2 and p.id_usuario=u.id and p.id_moto=".$id." and e.id=u.id_empresa AND p.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) order by p.id DESC");
       return response($moto);
    }

    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA CANCELADOS
    public function historial_carrera_cancelado($id, $fecha_inicio, $fecha_fin){
        $moto = DB::select("SELECT pedido.id,date_format(pedido.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,pedido.distancia,CONCAT(moto.nombre,' ',moto.apellido)as motista,CONCAT(usuario.nombre,' ',usuario.apellido)as usuario,usuario.telefono,empresa.nombre,empresa.telefono as telefono_empresa FROM pedido,moto,usuario,empresa WHERE pedido.id_usuario=usuario.id AND pedido.id_moto=moto.id AND usuario.id_empresa=empresa.id AND pedido.estado=3 AND pedido.id_moto=".$id." AND pedido.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) order by pedido.fecha DESC");
       return response($moto);
    }

    public function historial_carrera_detalle($id_pedido){
        $detalle=DB::select("SELECT *,date_format(carrera.fecha_inicio,'%d-%m-%Y %h:%i %p')as fecha_pedido FROM carrera WHERE id_pedido=".$id_pedido);
        return response($detalle);
    }


////////////////////////////////////////////////////////////////////////////////
//////////////////BUSQUEDA DE LAS MOTOS/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////

    //MUESTRA LOS MOTISTAS ACTIVOS
    public function buscar_activos_moto(){      
        $activos=DB::select("SELECT *from moto WHERE moto.estado=1");        
        return response($activos);
    }

    //MUESTRA LOS MOTISTAS ACTIVOS
    public function buscar_inactivos_moto(){      
        $inactivos=DB::select("SELECT *from moto WHERE moto.estado=0");        
        return response($inactivos);
    }

    //MUESTRA LOS MOTISTAS ACTIVOS
    public function buscar_todas_las_moto(){      
        $todos=DB::select("SELECT * FROM moto");        
        return response($todos);
    }

    //MUESTRA LOS MOTISTAS ACTIVOS
    public function buscar_carrera_moto(){      
        $carrera=DB::select("SELECT * FROM moto WHERE moto.estado=2");        
        return response($carrera);
    }

    //MUESTRA UN SOLO MOTISTA ESPESIFICO
    public function buscar_una_moto($id){      
        $motista=DB::select("SELECT * FROM moto WHERE moto.id=".$id);        
        return response($motista);
    }
    
    //ENVIAR NOTIFICACION A VARIOS MOTOSTA EN BUSQUEDA
    function notificacion_busqueda_motista(Request $request){ 
        $mPushNotification = getPush("ASAPP",$request['detalle_msn'],null,"","","","","","20");        
        $id_moto=$request->get('id_moto_not');
        $token=$request->get('token_not');
        $cont=0;
        $tokens = array(); 
        while ( $cont < count($id_moto)) {
          if ( ($token[$cont] != "0") && ($token[$cont] != "") ) {     
            array_push($tokens, $token[$cont]);                            
          }
            $cont=$cont+1;                    
        }     
        send($tokens,$mPushNotification);        

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => $request['detalle_msn'],
            'tipo' => 1,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','ENVIADO CORRECTAMENTE');
        return Redirect::to('/busqueda_motista');     
    }

    //ENVIAR NOTIFICACION A UN SOLO MOTISTA
    function notificacion_motista(Request $request){  
        $mPushNotification = getPush("ASAPP",$request['detalle'],null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_not'] != "0") && ($request['token_not'] != "") ) {     
            array_push($tokens, $request['token_not']);                            
        }            
        send($tokens,$mPushNotification);   

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => $request['detalle'],
            'tipo' => 1,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','ENVIADO CORRECTAMENTE');
        return Redirect::to('/moto');            
    }

    function Bloquear_Motista(Request $request){
        $mPushNotification = getPush("ASAPP","Su cuenta ha sido bloqueada. Contáctese con los administradores de ASAPP",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_bloq'] != "0") && ($request['token_bloq'] != "") ) {     
            array_push($tokens, $request['token_bloq']);                            
        }            
        send($tokens,$mPushNotification);   

        DB::table('moto')->where('id', $request['id_moto_bloq'])->update(['estado' => 5, 'login' => 0 ]);

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "Su cuenta ha sido bloqueada. Contáctese con los administradores de ASAPP",
            'tipo' => 1,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','BLOQUEADO CORRECTAMENTE');
        return Redirect::to('/moto');     
    }

    function Desbloquear_Motista(Request $request){
        $mPushNotification = getPush("ASAPP","Su cuenta ha sido desbloqueada.",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_desbloq'] != "0") && ($request['token_desbloq'] != "") ) {     
            array_push($tokens, $request['token_desbloq']);                            
        }            
        send($tokens,$mPushNotification);   

        DB::table('moto')->where('id', $request['id_moto_desbloq'])->update(['estado' => 0, 'login' => 0 ]);

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "Su cuenta ha sido desbloqueada.",
            'tipo' => 1,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','DESBLOQUEADO CORRECTAMENTE');
        return Redirect::to('/moto');     
    }

}
