
@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
@include('alerts.request')
	<div class="row">
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<H2>REGISTRO DE ADMINISTRADORES</H2>	    
    {{Form::open(array('url' => 'crear_administrador','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'))}}  
			@include('users.forms.usr')		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}
			<a href="{!!URL::to('administradr')!!}" class="btn btn-danger">CANCELAR</a>
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
@endsection
