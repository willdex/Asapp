        {!!Html::script('js/jQuery-2.1.4.min.js')!!}
        <?php //{!!Html::style('css/bootstrap-datetimepicker.css')!!}  ESTE CSS ES PA LAS FECHA ?>
        
        {!!Html::style('css/bootstrap.css')!!}
        {!!Html::style('css/font-awesome.css')!!}
        {!!Html::style('css/AdminLTE.css')!!}

        {!!Html::style('css/_all-skins.css')!!}
        {!!Html::style('css/bootstrap-select.min.css')!!}
        {!!Html::style('css/alertify.css')!!}
        {!!Html::style('css/default.css')!!}


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
				<a class="btn btn-success" href="{!!URL::to('administrador/create')!!}">REGISTRAR</a> 
				<a class="btn btn-info" href="{!!URL::to('/')!!}"><i class="fa fa-power-off"></i> INICIAR</a> 
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


        {!!Html::script('js/moment.js')!!}
        {!!Html::script('js/moment-with-locales.min.js')!!}
        {!!Html::script('js/numerosmasdecimal.js')!!}

        {!!Html::script('js/bootstrap.js')!!}
        {!!Html::script('js/bootstrap-select.min.js')!!}
        {!!Html::script('js/alertify.js')!!}

        {!!Html::script('js/app.js')!!}
              
     <?php //   {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}  //ESTE ES EL JS DE LAS FECHAS ?>





