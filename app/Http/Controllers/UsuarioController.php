<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\UsuarioRequest;
use App\Http\Requests\UsuarioUpdateRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Usuario;
use App\Empresa;
use App\Direccion;
use App\Notificacion;
use DB;
use App\Http\Requests;

class UsuarioController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

    function index(){      
        $buscar_usuario=DB::select("SELECT usuario.id,usuario.nombre as nombre_user,usuario.apellido,usuario.telefono,usuario.email,empresa.nombre as nombre_emp,usuario.latitud,usuario.longitud,usuario.id_casa,usuario.id_trabajo,usuario.token,usuario.imagen from usuario,empresa WHERE usuario.id_empresa=empresa.id");  
        $id_empresa=Empresa::lists('nombre','id');        
        $empresa = DB::select("SELECT *from empresa");  
        $usuario=DB::table('usuario as user')
        ->join('empresa as emp','user.id_empresa','=','emp.id')
        ->select('user.id','user.nombre as nombre_user','user.apellido','user.telefono','user.email','emp.nombre as nombre_emp','user.estado')
        //->where('user.estado','!=','2')
        ->orderBy('emp.nombre','asc','user.nombre')
        ->paginate(30);
       return view('usuario.index',compact('usuario','empresa','id_empresa', 'buscar_usuario'));
    }
  
  
    public function create(){
        $empresa = Empresa::where('estado',1)->orderby('nombre')->lists('nombre','id');
        //$empresa = DB::select("SELECT ('')as id,('Seleccione Una Empresa')as nombre UNION SELECT empresa.id,empresa.nombre from empresa");  
        return view('usuario.create',compact('empresa'));   
    }
    
    public function store(UsuarioRequest $request){
    try {
    DB::beginTransaction();
      $verificar=DB::select("SELECT COUNT(*)as contador from usuario WHERE usuario.telefono=".$request['telefono']);
        foreach ($verificar as $key => $value) {
          $contador=$value->contador;
        }
        if ($contador==0) {
          $imagen = $request['imagen'];
          /*$gestor = fopen($imagen, "r");
          $contenido = fread($gestor, filesize($imagen));
          $contenido = base64_encode($contenido);
          fclose($gestor);*/
          $id_usuario = Usuario::create([
              'nombre' => $request['nombre'],
              'apellido' => $request['apellido'],
              'email' => $request['email'],
              'telefono' => $request['telefono'],
              'id_empresa' => $request['id_empresa'], 
              'latitud' => $request['latitud'],
              'longitud' => $request['longitud'],
              'id_casa' => $request['id_casa'],
              'id_trabajo' => $request['id_trabajo'],
              'token' => $request['token'],
              'imagen' => $imagen, //$contenido, //ESTO ES MEDIANTE EL FOPEN
          ]);

         /* //SE REGISTRA LAS DIRECCIONES DE LA EMPRESA Y USUARIO
          $id_user = $id_usuario['id'];        
          $latitud_aux = $request->get('latitud_aux');
          $longitud_aux = $request->get('longitud_aux');
          $nombre_empresa = $request->get('nombre_empresa');
          $detalle = $request->get('detalle');

          $cont=0;

          while ( $cont < count($latitud_aux)) {
            $direccion=new Direccion;
            $direccion->nombre=$nombre_empresa[$cont];
            $direccion->detalle=$detalle[$cont];
            $direccion->latitud=$latitud_aux[$cont];
            $direccion->longitud=$longitud_aux[$cont];
            $direccion->id_empresa=$request['id_empresa'];
            $direccion->id_usuario=$id_user;
            $direccion->save();
            $cont=$cont+1;
          }*/
          DB::commit();          
          Session::flash('message','CREADO CORRECTAMENTE');
          return Redirect::to('/usuario');           
        } else {
          Session::flash('message-error','YA EXISTE UN USUARIO CON ESE NUMERO DE TELEFONICO');
          return Redirect::to('/usuario'); 
        }     
    } catch (Exception $e) {
          DB::rollback();
          return redirect('/usuario')->with("message-error","ERROR INTENTE NUEVAMENTE");      
        }        
    }

    public function edit($id){
       $Usuario = Usuario::find($id);
       return view('Usuario.edit',['Usuario'=>$Usuario]);
    }

    public function update(UsuarioUpdateRequest $request){
      if ($request['telefono'] == $request['telefono_aux']) {
          $id = $request['id_user'];
          $usuario=DB::table('usuario')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'telefono' => $request['telefono'], 'id_empresa' => $request['id_empresa'],'email' => $request['email'], 'imagen' => $request['imagen'] ]);

          Session::flash('message','ACTUALIZADO CORRECTAMENTE');
          return Redirect::to('/usuario');          
        } else {
            $verificar=DB::select("SELECT COUNT(*)as contador from usuario WHERE usuario.telefono=".$request['telefono']);
              foreach ($verificar as $key => $value) {
                  $contador=$value->contador;
              }
            if($contador == 0){
              $id = $request['id_user'];
              $usuario=DB::table('usuario')->where('id', $id)->update(['nombre' => $request['nombre'], 'apellido' => $request['apellido'], 'telefono' => $request['telefono'], 'id_empresa' => $request['id_empresa'],'email' => $request['email'], 'imagen' => $request['imagen'] ]);

              Session::flash('message','ACTUALIZADO CORRECTAMENTE');
              return Redirect::to('/usuario');
            }
            else{
              Session::flash('message-error','YA EXISTE UN USUARIO CON ESE NUMERO DE TELEFONICO');
              return Redirect::to('/usuario');
            }          
        }      
    }
    

    public function actualizar_usuario(Request $request){
      try {
      DB::beginTransaction();         
        $id = $request['id_administrador_cam'];//ACTUALIZO AL ANTIGUA ADMINISTRADOR COLOCANDO UN * EN SU NUMERO Y YA NO PUEDE INGRESAR A LA APP
        $usuario=DB::table('usuario')->where('id', $id)->update(['telefono' => $request['telefono_cam'], 'estado' => 3]);

        $id_empresa = $request['id_empresa_cam'];
        $empresa=DB::table('empresa')->where('id', $id_empresa)->update(['id_administrador' => $request['id_admin']]);

        DB::commit();
        Session::flash('message','ADMINISTRADOR CAMBIADO CORRECTAMENTE');
        return Redirect::to('/empresa');

      } catch (Exception $e) {
          DB::rollback();
          return redirect('/empresa')->with("message-error","ERROR INTENTE NUEVAMENTE");      
      }
    }
    
    public function cargar_usuario($id){
        $usuario=DB::select("SELECT usuario.*,empresa.id as id_empresa, empresa.nombre as nombre_emp from usuario,empresa where usuario.id_empresa=empresa.id and usuario.id=".$id);
        return response($usuario);
    }

    public function buscar_usuario($id){
        $usuario=DB::select("SELECT usuario.id,usuario.nombre as nombre_user,usuario.apellido,usuario.telefono,usuario.email,empresa.nombre as nombre_emp,usuario.latitud,usuario.longitud,usuario.id_casa,usuario.id_trabajo,usuario.token,usuario.imagen,usuario.estado from usuario,empresa WHERE usuario.id_empresa=empresa.id and usuario.id=".$id);
        return response($usuario);
    }    

    public function busqueda_usuario(){
        $buscar_usuario=DB::select("SELECT usuario.id,usuario.nombre as nombre_user,usuario.apellido,usuario.telefono,usuario.email,empresa.nombre as nombre_emp,usuario.latitud,usuario.longitud,usuario.id_casa,usuario.id_trabajo,usuario.token,usuario.imagen from usuario,empresa WHERE usuario.id_empresa=empresa.id");
        return view("usuario.busqueda_usuario",compact('buscar_usuario'));
    }

////////////////////////////////////////////////////////////////////////////////
//////////////////HISTORIAL DE CARRERAS DE LOS USUAIROS/////////////////////////
////////////////////////////////////////////////////////////////////////////////

    //MUESTRA LA PLANTILLA DE HISTORIAL DE CARRERA
    public function show($id){
       $usuario=DB::select("SELECT usuario.*,empresa.nombre as empresa FROM usuario,empresa WHERE usuario.id_empresa=empresa.id AND usuario.id=".$id);
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");       
       //$usuario = Usuario::find($id);
       return view('usuario.historial_carrera',compact('usuario','fechas'));
    }    

    public function historial_carrera_usuario($id, $fecha_inicio, $fecha_fin){
      $lista=DB::select("SELECT p.*,date_format(p.fecha,'%d-%m-%Y %h:%i %p')as fecha_pedido,CONCAT(HOUR(p.fecha),':',MINUTE(p.fecha),':',SECOND(p.fecha))as 'hora',CONCAT(m.nombre,' ',m.apellido) as motista,m.celular,m.marca,m.placa,m.estado as 'estado_moto',(select d.nombre from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'nombre_direccion',(select d.detalle from direccion d,usuario usu where d.latitud=p.latitud and d.longitud=p.longitud and d.id_empresa=usu.id_empresa and usu.id=p.id_usuario limit 1)as 'detalle_direccion',(select sum(monto) from carrera ca where ca.id_pedido=p.id)as 'monto_total' from pedido p,moto m where EXISTS(select * from carrera ca where ca.id_pedido=p.id) and p.id_moto=m.id and p.estado=2 and p.id_usuario=".$id." AND p.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."',INTERVAL -1 DAY) order by p.fecha");
      return response($lista);
    }    


//NOTIFICACION USUARIO
    function notificacion_usuario(Request $request){

        $mPushNotification = getPush("ASAPP",$request['detalle'],null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_not'] != "0") && ($request['token_not'] != "") ) {     
            array_push($tokens, $request['token_not']);                            
        }            
        send($tokens,$mPushNotification);  

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => $request['detalle'],
            'tipo' => 2,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','ENVIADO CORRECTAMENTE');
        return Redirect::to('/usuario');                
    }
    
  //BLOQUEO DEL USUARIO
    function Bloquear_Usuario(Request $request){
      $verificar=DB::select("SELECT *from empresa WHERE empresa.id_administrador=".$request['id_usuario_bloq']);
      if (count($verificar)==0) {
        $mPushNotification = getPush("ASAPP","Su cuenta ha sido bloqueada. Contáctese con los administradores de ASAPP",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_bloq'] != "0") && ($request['token_bloq'] != "") ) {     
            array_push($tokens, $request['token_bloq']);                            
        }            
        send($tokens,$mPushNotification);   

        $user = Usuario::find($request['id_usuario_bloq']);
        $user->fill([ 'estado' => 2 ]);
        $user->save();

        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "Su cuenta ha sido bloqueada. Contáctese con los administradores de ASAPP",
            'tipo' => 2,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','BLOQUEADO CORRECTAMENTE');
        return Redirect::to('usuario');          
      } else {
        Session::flash('message-error','NO SE PUEDE BLOQUEAR A ESTE USUARIO, PORQUE ES ADMINISTRADOR DE UNA EMPRESA');
        return Redirect::to('usuario');         
      }
    }

    function Desbloquear_Usuario(Request $request){
        $mPushNotification = getPush("ASAPP","Su cuenta ha sido desbloqueada.",null,"","","","","","20");        
        $tokens = array(); 
        if ( ($request['token_desbloq'] != "0") && ($request['token_desbloq'] != "") ) {     
            array_push($tokens, $request['token_desbloq']);                            
        }            
        send($tokens,$mPushNotification);   

        $user = Usuario::find($request['id_usuario_desbloq']);
        $user->fill([ 'estado' => 1 ]);
        $user->save();


        Notificacion::create([
            'titulo' => "ASAPP",
            'mensaje' => "Su cuenta ha sido desbloqueada.",
            'tipo' => 2,
            'id_administrador' => $request->user()->id,
        ]);

        Session::flash('message','DESBLOQUEADO CORRECTAMENTE');
        return Redirect::to('usuario');     
    }    
}
