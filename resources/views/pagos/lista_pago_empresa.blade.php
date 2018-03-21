@extends('layouts.inicio')
@section('contenido')
@include('alerts.cargando')
    
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12 ">
        <input type="text" id="codigos" placeholder="BUSCAR POR CODIGO" class="form-control" maxlength="5" onkeypress="return bloqueo_de_punto(event)">  
        <input type="hidden" id="sw" value="2">        
    </div>
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <select name="buscar_empresa" class="form-control selectpicker" id="buscar_empresa" data-live-search="true" >
             <option value="0">TODAS LAS EMPRESAS...</option>
                @foreach($lista_empresa as $lis)
                <option value="{{$lis->id}}"> {{$lis->nombre}}</option>
                @endforeach
            </select>      
    </div>       
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="pull-right">
        @foreach($fechas as $fecha)        
            <b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="{{$fecha->fecha_inicio}}">
            <b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="{{$fecha->fecha_fin}}"> 
        @endforeach            
            <button class="btn-sm btn-primary" onclick="CargarPagoEmpresa()"><i class="fa fa-search"></i></button>            
        </div>
    </div>
 



    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>CODIGO</center></th>                
    				<th><center>EMPRESA</center></th>
                    <th><center>FECHA</center></th>
                    <th><center>MONTO</center></th>
    				<th><center>ADMINISTRADOR</center></th>
    			</thead>
    			<tbody align="center" id="body_pago_empresa">
    				
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>

{!!Html::script('js/pagos.js')!!}
@endsection