@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
@include('empresa.modal_pago_empresa')

<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive" style="overflow-x:inherit">	

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		<font size="6">PAGO EMPRESA</font>
	</div>

	<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	    <select name="buscar_empresa" class="form-control selectpicker" id="buscar_empresa" data-live-search="true" >
	     <option value="">BUSCAR...                                   </option>
	        @foreach($buscar_empresa as $emp)
	        <option value="{{$emp->id}}">{{$emp->nombre}} - {{$emp->telefono}} - {{$emp->nit}}</option>
	        @endforeach
	    </select>
	</div>
		<br><br>
   			
			<table class="table table-striped table-bordered table-condensed table-hover">
				<thead>
					<th><center>EMPRESA</center></th>
					<th><center>TELEFONO</center></th>
					<th><center>RAZON SOCIAL</center></th>
					<th><center>NIT</center></th>
					<th><center>ADMINISTRADOR</center></th>
					<th><center>COBRAR</center></th>
					<th><center>OPCION</center></th>					
				</thead>

				<tbody align="center" id="body_empresa">
				</tbody>
				
				<?php /*<tbody align="center" id="body_empresa">					
				@foreach($empresa as $emp)
				<?php if ($emp->dias >= 40) {
					echo "<tr style='background:#F5A9A9'>";					
				} else {
					echo "<tr style='background:#F2F5A9'>";																		
				}
				   ?>
					<td>{{ $emp->nombre}}</td>
					<td>{{ $emp->telefono}}</td>
					<td>{{ $emp->razon_social}}</td>
					<td>{{ $emp->nit}}</td>
					<td>{{ $emp->credito}}</td>
					<td>{{ $emp->administrador}} </td>						
					<td>
					<button class="btn btn-success" data-toggle="modal" data-target="#ModalPagoEmpresa" onclick="CargarPagoEmpresa({{$emp->id}})">PAGAR</button>						
					<button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacionEmpresa" onclick="CargarEmpresa({{$emp->id}})">NOTIFICACION</button>
					</td>
				</tr>
				@endforeach
				</tbody>	*/ ?>						
					
			</table>

			<div class="pull-right">	
				<button class="btn btn-default" id="mostrar" onclick="CargarListaEmpresa()"><b>VER TODOS</b></button>  
			</div>			
		</div>
	</div>
</div>
   {!!Html::script('js/pago_empresa.js')!!}

@endsection
