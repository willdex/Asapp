<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests;
use DB;
class ReportesController extends Controller
{

    public function __construct(Request $request) {
        $this->middleware('auth');
        $this->middleware('admin');
        $this->middleware('auth', ['only' => 'admin']);
    }

    function reporte_gastos(){
        //$gastos_empresa=DB::select("SELECT IFNULL(SUM(pedido.monto_empresa_aux),0)as monto_empresa from pedido WHERE pedido.monto_empresa_aux>0");
        //$gastos_moto=DB::select("SELECT IFNULL(SUM(pedido.monto_motista_aux),0)as monto_moto from pedido WHERE pedido.monto_motista_aux>0");
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");
        return view("reportes.reporte_gastos",compact('fechas'));//'gastos_empresa','gastos_moto',
    }
    function lista_de_gastos($fecha_inicio, $fecha_fin){
        $result=DB::select("SELECT IFNULL(SUM(pedido.monto_empresa_aux),0)as monto_empresa, IFNULL(SUM(pedido.monto_motista_aux),0)as monto_moto,(IFNULL(SUM(pedido.monto_empresa_aux),0) - IFNULL(SUM(pedido.monto_motista_aux),0))as monto_total from pedido WHERE pedido.fecha BETWEEN '".$fecha_inicio."' AND  DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY)");
        return response($result);
    }

//MOTISTA CON MAS PEDIDOS
    function reporte_motista_com_mas_pedidos(){
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");
        return view("reportes.reporte_motista_pedidos",compact('fechas'));
    }
    function lista_motista_com_mas_pedidos($fecha_inicio,$fecha_fin){
        $moto=DB::select("SELECT pedido.id_moto,concat(moto.nombre,' ',moto.apellido)as motista,COUNT(*)as pedidos,IFNULL(SUM(pedido.monto_motista),0)as monto_motista from pedido,moto WHERE pedido.id_moto=moto.id AND pedido.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY) AND pedido.estado=2 GROUP BY pedido.id_moto ORDER BY pedidos DESC LIMIT 10");
        return response($moto);
    }


//EMPRESA CON MAS PEDIDOS
    function reporte_empresa_com_mas_pedidos(){
       $fechas = DB::select("SELECT DATE_SUB(curdate(), INTERVAL + 29 DAY) as fecha_inicio, curdate() as fecha_fin");
        return view("reportes.reporte_empresa_pedidos",compact('fechas'));
    }
    function lista_empresa_com_mas_pedidos($fecha_inicio,$fecha_fin){
        $empresa=DB::select("SELECT empresa.nombre,COUNT(*)as pedidos,IFNULL(SUM(pedido.monto_empresa),0)as monto_empresa from pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.fecha BETWEEN '".$fecha_inicio."' AND DATE_SUB('".$fecha_fin."', INTERVAL -1 DAY)  AND pedido.estado=2  GROUP BY empresa.id ORDER BY pedidos DESC LIMIT 10");
        return response($empresa);
    }

/*
   function libro_diario(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
           $gestion=DB::select('SELECT id,nombre_gestion,fecha_inicio FROM gestion where estado=1');
        return view('reportes.libro_diario', compact('id_empresa','gestion'));
    }
   function sumas_saldos(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
           $gestion=DB::select('SELECT id,nombre_gestion,fecha_inicio FROM gestion where estado=1');
        return view('reportes.sumas_saldos', compact('id_empresa','gestion'));
    }
    function estado_resultado(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
           $gestion=DB::select('SELECT id,nombre_gestion,fecha_inicio FROM gestion where estado=1');
        return view('reportes.estado_resultado', compact('id_empresa','gestion'));
    }
    
     function libro_mayor(Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        $resultado = DB::select('SELECT DISTINCT asiento.nro_asiento as numero,asiento.fecha, asiento.glosa,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber '
                . 'fROM cuenta,detalle,asiento,users,empresa  '
                . 'WHERE asiento.id_usuario=users.id and empresa.id=users.id_empresa and  cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id  ORDER BY asiento.fecha,asiento.nro_asiento,asiento.glosa');
                   $gestion=DB::select('SELECT id,nombre_gestion,fecha_inicio FROM gestion where estado=1');

        return view('reportes.libro_mayor', compact('id_empresa','gestion'));
    }
    //retorna los reportes
    
       function reporte_libro_mayor($fecha1,$fecha2,Request $request) {
               $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);

        $libro_mayor = array();
        $resultado = DB::select('select *from cuenta where cuenta.utilizable=1 and cuenta.id_empresa='.$id_empresa[0]->id.' ORDER BY cuenta.codigo ');
        
        $count = 0;
        foreach ($resultado as $key => $value) {
            $verificar=DB::select('SELECT asiento.nro_asiento as numero,asiento.fecha,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento WHERE cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and cuenta.id=' . $value->id . ' and asiento.fecha BETWEEN "' . $fecha1 . '" AND "' . $fecha2 . '" ORDER BY asiento.fecha');
            if (count($verificar)!=0) {
                $libro_mayor[$count] = $verificar;
             $count++;
            }
            
        }
      
        return response()->json($libro_mayor);
    }
     function reporte_libro_diario($fecha1, $fecha2, Request $request) {
        $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
        $resultado = DB::select('SELECT DISTINCT asiento.nro_asiento as numero,asiento.fecha, asiento.glosa,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento,users,empresa  '
                        . 'WHERE asiento.id_usuario=users.id and empresa.id=users.id_empresa and  cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and empresa.id=' . $id_empresa[0]->id . ' and asiento.fecha BETWEEN "' . $fecha1 . '" AND "' . $fecha2 . '" ORDER BY asiento.fecha,asiento.nro_asiento,asiento.glosa');
        
        return response()->json($resultado);
    }
         function reporte_estado_resultado($fecha1, $fecha2, Request $request) {
       $id_empresa = DB::select("SELECT empresa.id ,nombre FROM empresa, users WHERE users.id_empresa=empresa.id and users.id=" . $request->user()->id);
       $gasto=DB::select('SELECT left(codigo,1) as codigo FROM `cuenta` where nombre LIKE  "gasto_"');
       $ingreso=DB::select('SELECT left(codigo,1) as codigo FROM `cuenta` where nombre LIKE  "ingreso_"');
        $estado_resultado = array();
        $resultado = DB::select('select *from cuenta where left(cuenta.codigo,1)='.$gasto[0]->codigo.' or left(cuenta.codigo,1)='.$ingreso[0]->codigo.' and cuenta.utilizable=1 and cuenta.id_empresa='.$id_empresa[0]->id.' ORDER BY cuenta.codigo ');
        
        $count = 0;
        foreach ($resultado as $key => $value) {
            $verificar=DB::select('SELECT asiento.nro_asiento as numero,asiento.fecha,cuenta.codigo, cuenta.nombre,detalle.debe, detalle.haber fROM cuenta,detalle,asiento WHERE cuenta.id=detalle.id_cuenta and detalle.id_asiento=asiento.id and cuenta.id=' . $value->id . ' and asiento.fecha BETWEEN "' . $fecha1 . '" AND "' . $fecha2 . '" ORDER BY asiento.fecha');
            if (count($verificar)!=0) {
                $estado_resultado[$count] = $verificar;
             $count++;
        }
        
            }
            return response()->json($estado_resultado);
    }*/

}

