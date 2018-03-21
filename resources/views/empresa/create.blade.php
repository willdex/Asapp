@extends('layouts.inicio')
@section('contenido')
@include('alerts.cargando')
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    @include('alerts.request')
	{!!Form::open(['route'=>'empresa.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}	
		@include('empresa.forms.empresa') 		
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
		<div align="right">
			{!!Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()'])!!}
			<a href="{!!URL::to('empresa')!!}" class="btn btn-danger">CANCELAR</a>
		</div>
	</div>
	
	{!!Form::close()!!}
</div>
	{!!Html::script('js/localizacion.js')!!}
    <?php //{!!Html::script('js/GoogleMapsInitMap.js')!!} ?>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ&callback=initMap">
    </script>
	@endsection