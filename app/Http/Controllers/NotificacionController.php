<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\NotificacionRequest;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Notificacion;
use App\Moto;
use DB;
use App\Http\Requests;

class NotificacionController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

	function index(){
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");        
        return view("notificacion.index",compact('fechas'));
	}
  
  
	public function create(){
      return view('moto.create');	
    }
 
    public function store(NotificacionRequest $request){
    	Notificacion::create([
            'titulo' => $request['titulo'],
            'mensaje' => $request['mensaje'],
            'tipo' => $request['tipo'],
        ]);
        Session::flash('message','ENVIADO CORRECTAMENTE');
        return Redirect::to('/busqueda_motista');
    }

        //MUESTRA UN SOLO MOTISTA ESPESIFICO
    public function Cargar_Notificacion($fecha_inicio, $fecha_fin){      
        $lista=DB::select("SELECT notificacion.id,notificacion.titulo,notificacion.mensaje,DATE_FORMAT(notificacion.fecha, '%d-%m-%Y %h:%i %p')as fecha,notificacion.tipo,notificacion.id_administrador,CONCAT(users.nombre,' ',users.apellido)as administrador FROM notificacion,users WHERE users.id=notificacion.id_administrador and notificacion.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) ORDER BY notificacion.fecha ASC");        
        return response($lista);
    }

}
