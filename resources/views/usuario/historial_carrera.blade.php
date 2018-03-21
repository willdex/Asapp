@extends('layouts.inicio')
@include('alerts.cargando')
@section('contenido')
@include('usuario.modal_carrera')
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
        @foreach($fechas as $fecha)
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="{{$fecha->fecha_inicio}}">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="{{$fecha->fecha_fin}}"> 
        @endforeach
        
            @foreach($usuario as $user)
    		<button class="btn-sm btn-primary" onclick="BuscarHistorialUsuario({{$user->id}})"><i class="fa fa-search"></i></button>
            <input type="hidden" id="id_usuario" value="{{$user->id}}">                  		
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <a class="btn btn-danger" href="{!!URL::to('usuario')!!}">VOLVER</a> </div>    
        <div class="pull-right">
            <img id="logo" src="{{$user->imagen}}" width="100px" height="100px" class="img-circle">
        </div>    	
        <div class="pull-right">
            <b>Usuario: </b><font size="4">{{$user->nombre}} {{$user->apellido}}</font> <br>
            <b>Empresa: </b><font size="4">{{$user->empresa}}</font>    
    	</div>
        @endforeach
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>MOTISTA</center></th>                   
    				<th><center>DIRECCION</center></th>    				
                    <th><center>FECHA</center></th>
    				<th><center>PUNTUACION</center></th>
                    <th><center>MONTO</center></th>
    				<th><center>OPCION</center></th>
    			</thead>
    			<tbody align="center" id="body_historial">
    				
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>

{!!Html::script('js/historial_usuario.js')!!}
@endsection