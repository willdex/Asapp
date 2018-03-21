
@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
<br>
	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">ADMINSTRADOR</font>
		</div>

       
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="pull-right">
				<?php //{!!link_to_route('users.show', $title = 'REGISTRAR',  $attributes = ['class'=>'btn btn-success'])!!}									 ?>	
				<a class="btn btn-success" href="{!!URL::to('administradr/create_')!!}">REGISTRAR</a> 
			</div>
		</div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>USUARIO</center></th>
					</thead>
					<tbody align="center" id="body_moto">					
					@foreach($users as $user)
					<tr>
						<td>{{ $user->nombre}}</td>
						<td>{{ $user->apellido}}</td>
						<td>{{ $user->username}}</td>
					</tr>
					@endforeach
					</tbody>
				
				</table>
			{!!$users->render()!!} 
			</div>
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#loading').css("display","none");    
		    $('#body_principal').show();    
		});
	</script>
@endsection





