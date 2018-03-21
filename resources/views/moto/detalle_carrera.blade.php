@extends('layouts.inicio')
@section('contenido')
<?php $contador=1; ?>    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
    		<button class="btn-sm btn-danger">VOVLER</button>      		
    	</div>
	</div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
				<table class="table table-striped table-bordered table-condensed table-hover">
					<tbody align="center" id="body_moto">					
					@foreach($detalle as $det)
					<tr>
						<td>{{$contador}}</td>
						<td>{{ $det->fecha_inicio}}</td>
						<td>{{ $det->monto}}</td>
					</tr>
					<tr>
						<td colspan="3"><img src="{{$det->ruta}}" class="img-responsive"></td>
					</tr>	
					<?php $contador++; ?>				
					@endforeach
					</tbody>

					<tbody align="center" id="body_moto_2">
					</tbody>					
				</table>
    	</div>
	</div>	
</div>

{!!Html::script('js/moto.js')!!}
@endsection