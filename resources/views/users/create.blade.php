        {!!Html::script('js/jQuery-2.1.4.min.js')!!}
        <?php //{!!Html::style('css/bootstrap-datetimepicker.css')!!}  ESTE CSS ES PA LAS FECHA ?>
        
        {!!Html::style('css/bootstrap.css')!!}
        {!!Html::style('css/font-awesome.css')!!}
        {!!Html::style('css/AdminLTE.css')!!}

        {!!Html::style('css/_all-skins.css')!!}
        {!!Html::style('css/bootstrap-select.min.css')!!}
        {!!Html::style('css/alertify.css')!!}
        {!!Html::style('css/default.css')!!}
        {!!Html::style('css/cargando.css')!!}

@include('alerts.success')
@include('alerts.cargando')
@include('alerts.request')

	<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<H1>REGISTRO DE ADMINISTRADORES</H1>	    
		{!!Form::open(['route'=>'administrador.store', 'method'=>'POST' ,'onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}	
			@include('users.forms.usr')		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}
			<a href="{!!URL::to('administrador')!!}" class="btn btn-danger">CANCELAR</a>
		</div>

		{!!Form::close()!!}
		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#loading').css("display","none");    
		    $('#body_principal').show();    
		});
	</script>

        {!!Html::script('js/moment.js')!!}
        {!!Html::script('js/moment-with-locales.min.js')!!}
        {!!Html::script('js/numerosmasdecimal.js')!!}

        {!!Html::script('js/bootstrap.js')!!}
        {!!Html::script('js/bootstrap-select.min.js')!!}
        {!!Html::script('js/alertify.js')!!}

        {!!Html::script('js/app.js')!!}
              
     <?php //   {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}  //ESTE ES EL JS DE LAS FECHAS ?>
