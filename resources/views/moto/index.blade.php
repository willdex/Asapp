@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
@include('moto.modal')
	
	<div class="row" >	

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">MOTO</font>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_mot" class="form-control selectpicker" id="id_mot" data-live-search="true" >
		     <option value="">  BUSCAR...                                </option>
		        @foreach($buscar_moto as $mot)
		        <option value="{{$mot->id}}">{{$mot->nombre}} {{$mot->apellido}} - {{$mot->ci}} - {{$mot->placa}}</option>
		        @endforeach
		    </select>
		</div>

       
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="pull-right">
				<a class="btn btn-success" href="{!!URL::to('moto/create')!!}">REGISTRAR</a> 
			</div>
		</div>

				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>CI</center></th>
						<th><center>MARCA & MODELO</center></th>
						<th><center>PLACA</center></th>
						<th><center>AÑO</center></th>
						<th><center>COLOR</center></th>
						<th><center>CELULAR</center></th>
						<th><center>CREDITO</center></th>
						<th><center>ESTADO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>

					<tbody align="center" id="body_moto">					
					@foreach($moto as $mot)
					<?php /*if ($mot->estado == 2) {
						echo "<tr style='background:#F5A9A9'>";						
					}else{ 
						echo "<tr>";						
					 } */?>
					<tr>
						<td>{{ $mot->nombre}}</td>
						<td>{{ $mot->apellido}}</td>
						<td>{{ $mot->ci}}</td>
						<td>{{ $mot->marca}}</td>
						<td>{{ $mot->placa}}</td>
						<td>{{ $mot->modelo}}</td>
						<td>{{ $mot->color}}</td>
						<td>{{ $mot->celular}}</td>	
						<td>{{ $mot->credito}} Bs.</td>	

					<?php if ($mot->estado == 0) {
						echo "<td>INACTIVO</td>";
					 }else{  
					 	if ($mot->estado == 1) {
							echo "<td>ACTIVO</td>";
						 } else {
						 	if ($mot->estado == 2) {
								echo "<td>CARRERA</td>";						 		
						 	} else {
								echo "<td>BLOQUEADO</td>";						 		
						 	}
						 	
						 }
					 } ?>

						<td>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalMoto" onclick="CargarMoto({{$mot->id}})">VER MAS</button>
						<button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacion" onclick="CargarMoto({{$mot->id}})">NOTIFICACION</button>
						<?php /*{!!link_to_route('moto.show', $title = 'CARRERAS', $parameters = $mot->id, $attributes = ['class'=>'btn btn-warning'])!!}
						<button class="btn-sm btn-danger" data-toggle="modal" data-target="#ModalBloquearMoto" onclick="CargarMoto({{$mot->id}})">BLOQUEAR</button>				*/ ?>
						</td>
					</tr>
					@endforeach
					</tbody>

					<tbody align="center" id="body_moto_2">
					</tbody>					
				</table>



	<div class="pull-left">	{!!$moto->render()!!}  </div>
	<div class="pull-right">	<button class="btn btn-default" id="mostrar" onclick="ver_todos()"><b>VER TODOS</b></button>  </div>
			</div>
		</div>
	</div>

   {!!Html::script('js/moto.js')!!}
@endsection
