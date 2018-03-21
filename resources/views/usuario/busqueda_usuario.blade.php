@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.success')
@include('alerts.request')
@include('moto.modal')

<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_mot" class="form-control selectpicker" id="id_mot" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        @foreach($buscar_usuario as $user)
		        <option value="{{$user->id}}">{{$user->nombre_user}} {{$user->apellido}} - {{$user->telefono}} - {{$user->nombre_emp}} - {{$user->email}}</option>
		        @endforeach
		    </select>
		</div>

<br><br><br>
		<table class="table table-striped table-bordered table-condensed table-hover">
			<thead>
					<th><center>NOMBRE</center></th>
					<th><center>APELLIDOS</center></th>
					<th><center>TELEFONO</center></th>
					<th><center>EMAIL</center></th>
					<th><center>EMPRESA</center></th>
					<th><center>OPCION</center></th>
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

		</div>
	</div>
</div>
{!!Html::script('js/usuairo.js')!!}
@endsection
