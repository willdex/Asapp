@extends ('layouts.inicio')
@section ('contenido')
@include('alerts.cargando')
@include('alerts.success')
<H2>REGISTRO DE TARIFAS</H2>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @include('alerts.request')
	{!!Form::open(['route'=>'tarifa.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}	
		@include('tarifa.forms.tarifa')	
	</div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

	<div align="right">
		{!!Form::submit('REGISTRAR',['id'=>'btn_registrar','class'=>'btn btn-primary','onclick'=>'btn_esconder()'])!!}
		<a href="{!!URL::to('tarifa')!!}" class="btn btn-danger">CANCELAR</a>
		<?php //{!!Form::reset('CANCELAR',['class'=>'btn btn-danger'])!!} ?>
	</div>

	{!!Form::close()!!}
	</div>
</div>
   {!!Html::script('js/tarifa.js')!!}
	@endsection