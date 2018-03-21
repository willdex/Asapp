@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
<H1>REGISTRO DE MOTISTA</H1>

<div class="row">
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    @include('alerts.request')
	{!!Form::open(['route'=>'moto.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data', 'onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}	
		@include('moto.forms.moto')		
	<div align="right">
		{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}
		<a href="{!!URL::to('moto')!!}" class="btn btn-danger">CANCELAR</a>
		<?php //{!!Form::reset('CANCELAR',['class'=>'btn btn-danger'])!!} ?>
	</div>

	{!!Form::close()!!}
	</div>
</div>
   {!!Html::script('js/moto.js')!!}
	@endsection