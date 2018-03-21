@extends('layouts.inicio')
@section('contenido')
@include('alerts.success')
@include('alerts.cargando')

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<H1>REGISTRO DE USUARIO</H1>    
	@include('alerts.request')
	{!!Form::open(['route'=>'usuario.store', 'method'=>'POST', 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}
		@include('usuario.forms.usr')
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">		
	<div align="right">
		{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}		
		<a href="{!!URL::to('usuario')!!}" class="btn btn-danger">CANCELAR</a>
	</div>		
	{!!Form::close()!!}
    </div>
</div>
{!!Html::script('js/usuario.js')!!}
@endsection