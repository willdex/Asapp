@extends('layouts.inicio')
@section('contenido')
@include('alerts.cargando')
@include('empresa.modal')
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
        @foreach($fechas as $fecha)
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="{{$fecha->fecha_inicio}}">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="{{$fecha->fecha_fin}}"> 
        @endforeach
    @foreach($pedidos as $ped)
    		<button class="btn-sm btn-primary" onclick="BuscarHistorialEmpresa({{$ped->id}})"><i class="fa fa-search"></i></button>
            <input type="hidden" id="id_empresa" value="{{$ped->id}}">      		
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <?php $ruta='empresa/'.$ped->id.'/edit' ?>
        <div class="pull-left"> <a class="btn btn-danger" href="{!!URL::to($ruta)!!}">VOLVER</a> </div> 
        <div class="pull-right">
            <img id="logo" src="{{$ped->imagen}}" width="100px" height="100px" class="img-circle">
        </div>   
        <div class="pull-right">
        <b>Empresa: </b><font size="4">{{$ped->nombre}}</font> <br>
        <b>Adminstrador: </b><font size="4">{{$ped->administrador}}</font> <br>
    @endforeach
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>USUARIO</center></th>                   
    				<th><center>DIRECCION</center></th>
    				<th><center>MOTISTA</center></th>    				
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
{!!Html::script('js/historial_empresa.js')!!}
@endsection