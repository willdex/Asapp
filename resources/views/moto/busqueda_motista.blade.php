@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="buscar_moto_unico" class="form-control selectpicker" id="buscar_moto_unico" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        @foreach($buscar_moto as $mot)
		        <option value="{{$mot->id}}">{{$mot->nombre}} {{$mot->apellido}} - {{$mot->ci}} - {{$mot->placa}}</option>
		        @endforeach
		    </select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="pull-right">
		     	<select class="form-control" id="buscar_mot" name="buscar_mot">
		     		<option value="0">OPCIONES DE BUSQUEDA</option>
		     		<option value="1">ACTIVOS</option>
		     		<option value="2">INACTIVOS</option>
		     		<option value="3">TODOS</option>
		     		<option value="4">CARRERA</option>
		     	</select>
			</div>		
		</div>	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="pull-right" id="btn_not" hidden="">		
				<button type="button" class="btn btn-primary" onclick="Mostrar_Textos()"><i class="fa fa-check-circle" aria-hidden="true"></i> ENVIAR NOTIFICAION</button>	
			</div>		
		</div>
	</div>

<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<div class="table-responsive" style="overflow-x:inherit">	

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	    <style type="text/css">
	    #mapa { height: 500px; }
	    </style>
		<div id="mapa" style="width: 600px; height: 500px;"></div>

	</div>

	<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
{{Form::open(array('url' => 'notificacion_busqueda_motista'))}}  
		<div id="notificacion" hidden="">
			<input type="hidden" name="titulo_msn" id="titulo_msn" class="form-control" value="ASAPP"> 
			<textarea id="detalle_msn" name="detalle_msn" class="form-control" rows="5" placeholder="Ingrese el mensaje..."></textarea><br>
			<div class="pull-right">
				{!!Form::submit('ENVIAR',['class'=>'btn-sm btn-primary','id'=>'btn_notificacion','onclick'=>'btn_esconder()'])!!}
				
				<input type="button" value="CANCELAR" onclick="Esconder_Textos()" class="btn-sm btn-danger">								
			</div>		
		</div>
		<br>
		<br>
			<input type="button" id="btn_sel_todos" hidden="" value="SELECCIONAR TODOS" onclick="Seleccionar_Todos()" class="btn-sm btn-warning">								
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
						<th><center>MOTISTA</center></th>
						<th><center>CI</center></th>
						<th><center>PLACA</center></th>
						<th><center>MODELO</center></th>
						<th><center>COLOR</center></th>
						<th><center>CELULAR</center></th>
				</thead>

				<tbody align="center" id="body_bus_moto">
					<tr>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
						<td></td>
					</tr>
				</tbody>
				</table>
{!!Form::close()!!}
	</div>

		</div>
	</div>
</div>


{!!Html::script('js/busqueda_moto.js')!!}
 <?php //{!!Html::script('js/GoogleMaps.js')!!}  ?>

<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ">
</script>

@endsection
