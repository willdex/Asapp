@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
@include('alerts.errors')
@include('empresa.modal')
@include('empresa.modal_historial')

	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">EMPRESA</font>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_empres" class="form-control selectpicker" id="id_empres" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        @foreach($buscar_empresa as $emp)
		        <option value="{{$emp->id}}">{{$emp->nombre}} - {{$emp->telefono}} - {{$emp->nit}}</option>
		        @endforeach
		    </select>
		</div>

       
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
			<div class="pull-right">
				<a class="btn btn-success" href="{!!URL::to('empresa/create')!!}">REGISTRAR</a> 
			</div>
		</div>

       			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>EMPRESA</center></th>
						<th><center>TELEFONO</center></th>
						<th><center>RAZON SOCIAL</center></th>
						<th><center>NIT</center></th>
						<th><center>COBRAR</center></th>
						<th><center>ADMINISTRADOR</center></th>
						<th><center>ESTADO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>
					
					<tbody align="center" id="body_empresa">					
					@foreach($empresa as $emp)
					<?php $credito=DB::select("SELECT IFNULL(SUM(monto_empresa_aux),0)as monto_empresa FROM pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.monto_empresa_aux>0 AND empresa.id=".$emp->id_emp); ?>
					<tr>
						<td>{{ $emp->nombre_emp}}</td>
						<td>{{ $emp->telefono_emp}}</td>
						<td>{{ $emp->razon_social}}</td>
						<td>{{ $emp->nit}}</td>
						<td>{{$credito[0]->monto_empresa}} Bs.</td>
						<td>{{ $emp->nombre_user}} {{ $emp->apellido}}</td>
						<?php 
						switch ($emp->estado) {
							case 1:						  
								$estado='ACTIVO';
								break;
							case 2:								
								$estado='BLOQUEADO';									 							
							break;													
						}
						?>
						<td><?php echo $estado; ?></td>	
						
						<td>
						<?php //<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEmpresa" onclick="CargarEmpresa({{$emp->id}})">VER MAS</button> ?>
						{!!link_to_route('empresa.edit', $title = 'VER MAS', $parameters = $emp->id_emp, $attributes = ['class'=>'btn btn-primary'])!!}	
						<button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacionEmpresa" onclick="CargarEmpresa({{$emp->id_emp}})">NOTIFICACION</button>
						<?php //{!!link_to_route('empresa.show', $title = 'CARRERAS', $parameters = $emp->id_emp, $attributes = ['class'=>'btn btn-warning'])!!} ?>						
						</td>
					</tr>
					@endforeach
					</tbody>							

					<tbody align="center" id="body_empresa_2">
					</tbody>							
				</table>
	<div class="pull-left">	{!!$empresa->render()!!}  </div>
	<div class="pull-right">	<button class="btn btn-default" id="mostrar" onclick="ver_todos()"><b>VER TODOS</b></button>  </div>			
			</div>
		</div>
	</div>
   {!!Html::script('js/empresa.js')!!}

@endsection
