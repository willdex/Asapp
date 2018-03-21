@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
@include('moto.modal')
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive" style="overflow-x:inherit">	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">PAGO MOTISTA</font>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_motista" class="form-control selectpicker" id="id_motista" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        @foreach($buscar_moto as $mot)
		        <option value="{{$mot->id}}">{{$mot->nombre}} {{$mot->apellido}} - {{$mot->ci}} - {{$mot->placa}} - {{$mot->celular}}</option>
		        @endforeach
		    </select>
		</div>
		
		<br><br>
			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>CI</center></th>
						<th><center>PLACA</center></th>
						<th><center>MODELO</center></th>
						<th><center>COLOR</center></th>
						<th><center>CELULAR</center></th>
						<th><center>CREDITO</center></th>
						<th><center>FOTO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>

					<tbody align="center" id="body_moto">
					</tbody>

				</table>

		</div>
	</div>
</div>
{!!Html::script('js/moto.js')!!}
@endsection
