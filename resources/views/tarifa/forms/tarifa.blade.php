
<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
	<div class="form-group">
			{!!Form::label('distancia','Distancia:')!!}
			{!!Form::text('distancia',null,['class'=>'form-control','placeholder'=>'Ingrese la distancia','maxlength'=>'5', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('monto','Monto:')!!}
			{!!Form::text('monto',null,['class'=>'form-control','placeholder'=>'Ingrese el monto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
	</div>

<?php $verificar=DB::select("SELECT *FROM tarifa LIMIT 1"); 
	if (count($verificar)>=1) { 
	  foreach ($verificar as $key => $value) {  ?>

		<div class="form-group" hidden="">
				{!!Form::label('porcentaje_moto','Porcentaje Moto:')!!}
				{!!Form::text('porcentaje_moto',$value->porcentaje_moto,['class'=>'form-control','placeholder'=>'Ingrese el porcentaje moto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group" hidden="">
				{!!Form::label('costo_fijo_moto','Costo Fijo Moto:')!!}
				{!!Form::text('costo_fijo_moto',$value->costo_fijo_moto,['class'=>'form-control','placeholder'=>'Ingrese el costo fijo moto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group" hidden="">
				{!!Form::label('porcentaje_empresa','Porcentaje Empresa:')!!}
				{!!Form::text('porcentaje_empresa',0,['class'=>'form-control','placeholder'=>'Ingrese el porcentaje empresa','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group" hidden="">
				{!!Form::label('gasto_fijo_empresa','Gasto Fijo Empresa:')!!}
				{!!Form::text('gasto_fijo_empresa',$value->gasto_fijo_empresa,['class'=>'form-control','placeholder'=>'Ingrese el gasto fijo empresa','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group" hidden="">
				{!!Form::label('impuesto','Impuesto:')!!}
				{!!Form::text('impuesto',$value->impuesto,['class'=>'form-control','placeholder'=>'Ingrese el impuesto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>	
	  <?php  } 	
	} else {  ?>

		<div class="form-group">
				{!!Form::label('porcentaje_moto','Porcentaje Moto:')!!}
				{!!Form::text('porcentaje_moto',null,['class'=>'form-control','placeholder'=>'Ingrese el porcentaje moto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group">
				{!!Form::label('costo_fijo_moto','Costo Fijo Moto:')!!}
				{!!Form::text('costo_fijo_moto',null,['class'=>'form-control','placeholder'=>'Ingrese el costo fijo moto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group" hidden="">
				{!!Form::label('porcentaje_empresa','Porcentaje Empresa:')!!}
				{!!Form::text('porcentaje_empresa',0,['class'=>'form-control','placeholder'=>'Ingrese el porcentaje empresa','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group">
				{!!Form::label('gasto_fijo_empresa','Gasto Fijo Empresa:')!!}
				{!!Form::text('gasto_fijo_empresa',null,['class'=>'form-control','placeholder'=>'Ingrese el gasto fijo empresa','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>

		<div class="form-group">
				{!!Form::label('impuesto','Impuesto:')!!}
				{!!Form::text('impuesto',null,['class'=>'form-control','placeholder'=>'Ingrese el impuesto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
		</div>	

	<?php  } ?>	

</div>



