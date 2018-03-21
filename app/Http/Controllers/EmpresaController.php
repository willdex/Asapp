<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Empresa;
use App\Usuario;
use App\Direccion;
use App\Notificacion;
use App\Http\Requests;
use App\Http\Requests\EmpresaRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use DB; 


class EmpresaController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

    function index(){
        $buscar_empresa=DB::select("SELECT * FROM empresa");
        $usuario=DB::select("SELECT * FROM usuario LIMIT 1"); //NO HACEN NADA SOLO LO PUESE PORQUE ME SALIA ERROR AL MOMENTO DE CAMBIAR ADMIN
        $admin=DB::select("SELECT * FROM usuario LIMIT 1");  //NO HACEN NADA SOLO LO PUESE PORQUE ME SALIA ERROR AL MOMENTO DE CAMBIAR ADMIN
        //$empresa=DB::table('empresa')->where('deleted_at',NULL)->paginate(20); 
        $empresa=DB::table('empresa as emp')
        ->join('usuario as user','user.id','=','emp.id_administrador')
        ->select('user.id as id_user', 'user.nombre as nombre_user', 'user.apellido', 'user.telefono as telefono_user','user.email', 'user.imagen' ,'emp.id as id_emp','emp.nombre as nombre_emp','emp.telefono as telefono_emp','emp.razon_social','emp.nit','emp.credito','emp.estado')
        ->orderBy('emp.estado')
        ->paginate(20);

       return view('empresa.index',["empresa"=>$empresa],compact('buscar_empresa','usuario','admin'));
	}
  
	public function create(){
        //$buscar_usuario=DB::select("SELECT * FROM Usuario");
        return view('empresa.create');	
    }
    
    public function store(EmpresaRequest $request){ 
    try {
    DB::beginTransaction();     
      $verificar=DB::select("SELECT COUNT(*)as contador from usuario WHERE usuario.telefono=".$request['telefono_administrador']);
        foreach ($verificar as $key => $value) {
          $contador=$value->contador;
        }
        if ($contador==0) {
            //SE REGISTRA  A LA EMPRESA
            $latitud=$request->get('latitud');       
            $longitud=$request->get('longitud');       
                $id_empresa = Empresa::create([
                    'nombre' => $request['nombre_empres'],
                    'direccion' => $request['direccion'],
                    'telefono' => $request['telefono_empres'],
                    'razon_social' => $request['razon_social'],
                    'nit' => $request['nit'],
                    'latitud' => $latitud,//$request['latitud'],
                    'longitud' => $longitud,//$request['longitud'],
                    'id_administrador' => $request['id_administrador'],
                    'credito' => 0,//$request['credito'],            
                ]);

                //REGIDTRO AL USUARIO Q VA A SER ADMINISTRADOR        
                $id_emp=$id_empresa['id'];
                $imagen = $request['imagen'];
                $id_usuario = Usuario::create([
                    'nombre' => $request['nombre_administrador'],
                    'apellido' => $request['apellido_administrador'],
                    'email' => $request['email'],
                    'telefono' => $request['telefono_administrador'],
                    'id_empresa' => $id_emp, //$request['id_empresa'], 
                    'latitud' => $latitud, //$request['latitud'],
                    'longitud' => $longitud, //$request['longitud'],
                    'id_casa' => $request['id_casa'],
                    'id_trabajo' => $request['id_trabajo'],
                    'token' => $request['token'],
                    'imagen' => $imagen,
                ]);

                //ACTUALIZO EMPRESA
                $id_user = $id_usuario['id'];
                $empresa=DB::table('empresa')->where('id', $id_emp)->update(['nombre' => $request['nombre_empres'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono_empres'], 'razon_social' => $request['razon_social'], 'nit' => $request['nit'], 'latitud' => $latitud, 'longitud' => $longitud, 'credito' => 0, 'id_administrador' => $id_user ]);

                //SE REGISTRA LAS DIRECCIONES DE LA EMPRESA Y USUARIO
                $latitud_aux = $request->get('latitud_aux');
                $longitud_aux = $request->get('longitud_aux');
                $nombre_empresa = $request->get('nombre_empresa');
                $detalle = $request->get('detalle');

                $cont=0;

                while ( $cont < count($latitud_aux)) {
                    if ($latitud_aux[$cont] != "") {
                          $direccion=new Direccion;
                          $direccion->nombre=$nombre_empresa[$cont];
                          $direccion->detalle=$detalle[$cont];
                          $direccion->latitud=$latitud_aux[$cont];
                          $direccion->longitud=$longitud_aux[$cont];
                          $direccion->id_empresa=$id_emp;
                          $direccion->id_usuario=$id_user;
                          $direccion->estado=1;
                          $direccion->save();
                    }
                    $cont=$cont+1;
                }
            DB::commit();
            Session::flash('message','CREADO CORRECTAMENTE');
            return Redirect::to('/empresa');          
        } else {
            Session::flash('message-error','YA EXISTE UN USUARIO CON ESE NUMERO DE TELEFONICO');
            return Redirect::to('/empresa'); 
        }   
      } catch (Exception $e) {
          DB::rollback();
          return redirect('/empresa')->with("message-error","ERROR INTENTE NUEVAMENTE");      
      }
    }

    public function edit($id){    		
        $empresa = Empresa::find($id);
        $usuario=DB::select("SELECT * from usuario WHERE usuario.telefono LIKE '________' AND (NOT EXISTS (SELECT *from empresa WHERE usuario.id=empresa.id_administrador)) AND usuario.estado=1 AND usuario.id_empresa=".$id);
        $id_admin=$empresa['id_administrador'];
        $admin=DB::select("SELECT *from usuario WHERE usuario.id=".$id_admin);
        return view('empresa.edit',compact('empresa',$empresa,'usuario',$usuario,'admin',$admin));
    }

    public function update($id, EmpresaRequest $request){
    try {
        DB::beginTransaction();     
        if ($request['telefono_administrador'] == $request['telefono_administrador_aux']) {
            $id_emp=$request->get('id_empresa');       
            $id_user=$request->get('id_administrador'); 
            //SE ACTUALIZA  A LA EMPRESA        
            $empresa=DB::table('empresa')->where('id', $id_emp)->update(['nombre' => $request['nombre_empres'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono_empres'], 'razon_social' => $request['razon_social'], 'nit' => $request['nit'], 'latitud' => 0, 'longitud' => 0, 'credito' => $request['credito'], 'id_administrador' => $id_user ]);

            //SE ACTUALIZA  AL ADMINISTRADOR 
            $usuario=DB::table('usuario')->where('id', $id_user)->update(['nombre' => $request['nombre_administrador'], 'apellido' => $request['apellido_administrador'], 'telefono' => $request['telefono_administrador'], 'email' => $request['email'], 'id_empresa' => $id_emp, 'imagen' => $request['imagen'] ]);

                //SE ACTUALIZA LAS DIRECCIONES DE LA EMPRESA Y USUARIO
                $id_direccion = $request->get('id_direccion');        
                $nombre_empresa = $request->get('nombre_empresa');
                $latitud_aux = $request->get('latitud_aux');
                $longitud_aux = $request->get('longitud_aux');
                $detalle = $request->get('detalle');
                $estado = $request->get('estado');
                $cont=0;

                while ( $cont < count($id_direccion)) {   
                    if ($latitud_aux[$cont] != "") {
                        if ($id_direccion[$cont] == "") {
                            //SE CREA UNA NUEVA DIRECCION
                          $direccion=new Direccion;
                          $direccion->nombre=$nombre_empresa[$cont];
                          $direccion->detalle=$detalle[$cont];
                          $direccion->latitud=$latitud_aux[$cont];
                          $direccion->longitud=$longitud_aux[$cont];
                          $direccion->id_empresa=$id_emp;
                          $direccion->id_usuario=$id_user;
                          $direccion->estado=1;
                          $direccion->save();
                        } else {
                            //SE ACUALIZA LAS DIRECCIONES
                            $direccion=DB::table('direccion')->where('id', $id_direccion[$cont] )->update([ 'nombre' => $nombre_empresa[$cont], 'detalle' => $detalle[$cont], 'latitud' => $latitud_aux[$cont], 'longitud' => $longitud_aux[$cont], 'id_empresa' => $id_emp, 'id_usuario' => $id_user, 'estado' => $estado[$cont] ]);                    
                        }
                    } 
                    $cont=$cont+1;                                 
                }

                DB::commit();
                Session::flash('message','ACTUALIZADO CORRECTAMENTE');
                return Redirect::to('/empresa');           
        } //END DEL IF
        else {
            $verificar=DB::select("SELECT COUNT(*)as contador from usuario WHERE usuario.telefono=".$request['telefono_administrador']);
              foreach ($verificar as $key => $value) {
                  $contador=$value->contador;
              }
            if($contador == 0){
                $id_emp=$request->get('id_empresa');       
                $id_user=$request->get('id_administrador'); 
                //SE ACTUALIZA  A LA EMPRESA        
                $empresa=DB::table('empresa')->where('id', $id_emp)->update(['nombre' => $request['nombre_empres'], 'direccion' => $request['direccion'], 'telefono' => $request['telefono_empres'], 'razon_social' => $request['razon_social'], 'nit' => $request['nit'], 'latitud' => 0, 'longitud' => 0, 'credito' => $request['credito'], 'id_administrador' => $id_user ]);

                //SE ACTUALIZA  AL ADMINISTRADOR 
                $usuario=DB::table('usuario')->where('id', $id_user)->update(['nombre' => $request['nombre_administrador'], 'apellido' => $request['apellido_administrador'], 'telefono' => $request['telefono_administrador'], 'email' => $request['email'], 'id_empresa' => $id_emp, 'imagen' => $request['imagen'] ]);


                    //SE ACTUALIZA LAS DIRECCIONES DE LA EMPRESA Y USUARIO
                    $id_direccion = $request->get('id_direccion');        
                    $nombre_empresa = $request->get('nombre_empresa');
                    $latitud_aux = $request->get('latitud_aux');
                    $longitud_aux = $request->get('longitud_aux');
                    $detalle = $request->get('detalle');
                    $estado = $request->get('estado');
                    $cont=0;

                    while ( $cont < count($id_direccion)) {   
                        if ($latitud_aux[$cont] != "") {
                            if ($id_direccion[$cont] == "") {
                                //SE CREA UNA NUEVA DIRECCION
                              $direccion=new Direccion;
                              $direccion->nombre=$nombre_empresa[$cont];
                              $direccion->detalle=$detalle[$cont];
                              $direccion->latitud=$latitud_aux[$cont];
                              $direccion->longitud=$longitud_aux[$cont];
                              $direccion->id_empresa=$id_emp;
                              $direccion->id_usuario=$id_user;
                              $direccion->estado=1;
                              $direccion->save();
                            } else {
                                //SE ACUALIZA LAS DIRECCIONES
                                $direccion=DB::table('direccion')->where('id', $id_direccion[$cont] )->update([ 'nombre' => $nombre_empresa[$cont], 'detalle' => $detalle[$cont], 'latitud' => $latitud_aux[$cont], 'longitud' => $longitud_aux[$cont], 'id_empresa' => $id_emp, 'id_usuario' => $id_user, 'estado' => $estado[$cont] ]);                    
                            }
                        } 
                        $cont=$cont+1;                                 
                    }

                    DB::commit();
                    Session::flash('message','ACTUALIZADO CORRECTAMENTE');
                    return Redirect::to('/empresa');
            }
            else{
              Session::flash('message-error','YA EXISTE UN USUARIO CON ESE NUMERO DE TELEFONO');
              return Redirect::to('/empresa');
            }          
        } //END DEL ELSE     
    } //END del TRY
    catch (Exception $e) {
        DB::rollback();
        return redirect('/empresa')->with("message-error","ERROR INTENTE NUEVAMENTE"); 
    }
  }
    

////////////////////////////////////////////////////////////////////////////////
//////////////////HISTORIAL DE CARRERAS DE LAS EMPRESAS/////////////////////////
////////////////////////////////////////////////////////////////////////////////

    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA
    public function show($id){
      $pedidos = DB::select("SELECT empresa.*,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador,usuario.imagen FROM empresa ,usuario WHERE empresa.id_administrador=usuario.id AND empresa.id=".$id);
      $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");      
      $usuario=DB::select("SELECT *from usuario limit 1");//SOLO LO PUSE PORQ ME GENERA ERROR SI NO LO PONGO
      $admin=DB::select("SELECT *from usuario limit 1");//SOLO LO PUSE PORQ ME GENERA ERROR SI NO LO PONGO
       return view('empresa.historial_pedidos_empresa',compact('pedidos','usuario','admin','fechas'));
    }

    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA
    public function historial_pedido_empresa($id, $fecha_inicio, $fecha_fin){
        $empresa = DB::select("SELECT p.*,date_format(p.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(HOUR(p.fecha),':',MINUTE(p.fecha),':',SECOND(p.fecha))as 'hora',CONCAT(u.nombre,' ',u.apellido)as 'nombre_usuario',CONCAT(m.nombre,' ',m.apellido)as 'nombre_motista',m.celular,m.marca,m.placa,m.estado as 'estado_moto',(select d.nombre from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'nombre_direccion',(select d.detalle from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'detalle_direccion',(select sum(monto) from carrera ca where ca.id_pedido=p.id)as 'monto_total' from pedido p,moto m,usuario u where EXISTS(select * from carrera ca where ca.id_pedido=p.id) and p.id_moto=m.id and p.estado=2 and p.id_usuario=u.id and u.id_empresa=".$id." AND p.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) order by p.id DESC");
       return response($empresa);
    }

    public function historial_empresa_detalle($id_pedido){
        $detalle=DB::select("SELECT * FROM carrera WHERE id_pedido=".$id_pedido);
        return response($detalle);
    }


    public function destroy($id, Request $request){
        $empresa=Empresa::find($id);
        $empresa->delete();
        Session::flash('message','empresa Eliminado Correctamente');
       return Redirect::to('/empresa');
    }
    
    public function cargar_empresa($id){
        $empresa=DB::select("SELECT empresa.id as id_empresa,empresa.nombre,empresa.razon_social,empresa.telefono,empresa.nit,empresa.estado,(SELECT IFNULL(SUM(monto_empresa_aux),0) FROM pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.monto_empresa_aux>0 AND empresa.id=".$id.")as credito,empresa.id_administrador,CONCAT(usuario.nombre,' ',usuario.apellido)as administrador, usuario.imagen, usuario.token from empresa,usuario where usuario.id=empresa.id_administrador AND empresa.id=".$id);
        return response($empresa);
    }   

    public function busqueda_empresa(){
        $buscar_empresa=DB::select("SELECT *FROM empresa");
        return view("empresa.busqueda_empresa",compact('buscar_empresa'));
    }

    public function cargar_direccion($id_emp, $id_user){
        $buscar_direccion=DB::select("SELECT *from direccion WHERE direccion.estado=1 AND direccion.id_empresa=".$id_emp." AND direccion.id_usuario=".$id_user);
        return response($buscar_direccion);
    }

    function notificacion_empresa(Request $request){
        $mPushNotification = getPush("ASAPP",$request['detalle'],null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_not'] != "0") && ($request['token_not'] != "") ) {     
            array_push($tokens, $request['token_not']);                            
        }            
        send($tokens,$mPushNotification);   

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => $request['detalle'],
            'tipo' => 3,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','ENVIADO CORRECTAMENTE');
        return Redirect::to('/empresa');     
    }

  //BLOQUEO DE LA EMPRESA
    function Bloquear_Empresa(Request $request){
        $mPushNotification=getPush("ASAPP","La cuenta de su empresa ha sido bloqueada. Contáctese con los administradores de ASAPP",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_bloq'] != "0") && ($request['token_bloq'] != "") ) {     
            array_push($tokens, $request['token_bloq']);                            
        }            
        send($tokens,$mPushNotification);   

        $emp = Empresa::find($request['id_empresa_bloq']);
        $emp->fill([ 'estado' => 2 ]);
        $emp->save();

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "La cuenta de su empresa cuenta ha sido bloqueada. Contáctese con los administradores de ASAPP",
            'tipo' => 3,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','BLOQUEADO CORRECTAMENTE');
        return Redirect::to('empresa');          
    }

    function Desbloquear_Empresa(Request $request){
        $mPushNotification = getPush("ASAPP","La cuenta de su empresa cuenta ha sido desbloqueada.",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_desbloq'] != "0") && ($request['token_desbloq'] != "") ) {     
            array_push($tokens, $request['token_desbloq']);                            
        }            
        send($tokens,$mPushNotification);   

        $emp = Empresa::find($request['id_empresa_desbloq']);
        $emp->fill([ 'estado' => 1 ]);
        $emp->save();

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "La cuenta de su empresa cuenta ha sido desbloqueada.",
            'tipo' => 3,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','DESBLOQUEADO CORRECTAMENTE');
        return Redirect::to('empresa');     
    }   

}

