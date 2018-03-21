<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div class="form-group">
			{!!Form::label('nombre','Nombre:')!!}
			{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese el nombre'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('apellido','Apellidos:')!!}
			{!!Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingrese los apellidos'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('ci','CI:')!!}
			{!!Form::text('ci',null,['class'=>'form-control','placeholder'=>'Ingrese su CI','maxlength'=>'12'])!!}
	</div>	
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" align="center">
	{!!Form::label('Seleccione Una Foto:')!!} <br>
   <img id="logo" src="{{asset('images/usuario.jpg')}}" title="Cargar Imagen" style="cursor:pointer" onclick="cargarImagen(this,1)" class="img-circle"><br>
	{!!Form::hidden('imagen','data:image/jpeg;base64,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',['id'=>'imagen','class'=>'form-control'])!!}
	<!--input type="file" name="imagen" id="imagen">
        <br />
        <output id="list"></output>
         
        <script>
              function archivo(evt) {
                  var files = evt.target.files; // FileList object
             
                  // Obtenemos la imagen del campo "file".
                  for (var i = 0, f; f = files[i]; i++) {
                    //Solo admitimos imágenes.
                    if (!f.type.match('image.*')) {
                        continue;
                    }
             
                    var reader = new FileReader();
             
                    reader.onload = (function(theFile) {
                        return function(e) {
                          // Insertamos la imagen
                         document.getElementById("list").innerHTML = ['<img class="thumb" src="', e.target.result,'" title="', escape(theFile.name), '"/>'].join('');
                        };
                    })(f);
             
                    reader.readAsDataURL(f);
                  }
              }
             
              document.getElementById('imagen').addEventListener('change', archivo, false);
      </script-->
</div>

<br><br><br><br><br><br><br><br><br><br><br><br>
	<div class="form-group">
			{!!Form::label('celular','Celular:')!!}
			{!!Form::text('celular',null,['class'=>'form-control','placeholder'=>'Ingrese su celular','maxlength'=>'8', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('email','Email:')!!}
			{!!Form::text('email',null,['class'=>'form-control','placeholder'=>'Ingrese su email'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('marca','Marca y Modelo:')!!}
			{!!Form::text('marca',null,['class'=>'form-control','placeholder'=>'Ingrese la marca y el modelo'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('modelo','Año:')!!}
			{!!Form::text('modelo',null,['class'=>'form-control','placeholder'=>'Ingrese el año','maxlength'=>'4', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('placa','Placa:')!!}
			{!!Form::text('placa',null,['class'=>'form-control','placeholder'=>'Ingrese la placa','maxlength'=>'10'])!!}
	</div>

	<div class="form-group">
			{!!Form::label('color','Color:')!!}
			{!!Form::text('color',null,['class'=>'form-control','placeholder'=>'Ingrese el color'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('direccion','Dirección:')!!}
			{!!Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la direccion'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('telefono','Teléfono:')!!}
			{!!Form::text('telefono',null,['class'=>'form-control','placeholder'=>'Ingrese el telefono','maxlength'=>'15', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('referencia','Referencia:')!!}
			{!!Form::text('referencia',null,['class'=>'form-control','placeholder'=>'Ingrese la referencia'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('codigo','PIN:')!!}
			{!!Form::text('codigo',null,['class'=>'form-control','placeholder'=>'Ingrese el PIN', 'maxlength'=>'4', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>	

	<div class="form-group" hidden="">
			{!!Form::label('credito','Crédito:')!!}
			{!!Form::text('credito',0,['class'=>'form-control','placeholder'=>'Ingrese el credito','maxlength'=>'2', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
	</div>	

	<div class="form-group" hidden="">
			{!!Form::label('estado','Estado:')!!}
            {!!Form::select('estado', array('0' => 'INACTIVO', '1' => 'ACTIVO', '2' => 'BLOQUEADO'),null,array('id'=>'estado','class'=>'form-control'))!!}
	</div>	

	<div class="form-group" hidden="">
			{!!Form::label('login','Login:')!!}
            {!!Form::select('login', array('0' => 'DESCONECTADO', '1' => 'CONECTADO'),null,array('id'=>'login','class'=>'form-control'))!!}                
	</div>		

<input type="hidden" name="latitud" id="latitud" value="0">
<input type="hidden" name="longitud" id="longitud" value="0">
<input type="hidden" name="estado" id="estado" value="0">
<input type="hidden" name="login" id="login" value="0">
<input type="hidden" name="token" id="token" value="0">
<?php /*
	<div class="form-group">
			{!!Form::label('latitud','Latitud:')!!}
			{!!Form::text('latitud',null,['class'=>'form-control','placeholder'=>'Ingrese la latitud'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('longitud','Longitud:')!!}
			{!!Form::text('longitud',null,['class'=>'form-control','placeholder'=>'Ingrese la longitud'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('estado','Estado:')!!}
			{!!Form::text('estado',null,['class'=>'form-control','placeholder'=>'Ingrese el estado'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('login','Login:')!!}
			{!!Form::text('login',null,['class'=>'form-control','placeholder'=>'Ingrese el login'])!!}
	</div>	

	<div class="form-group">
			{!!Form::label('token','Token:')!!}
			{!!Form::text('token',null,['class'=>'form-control','placeholder'=>'Ingrese el token'])!!}
	</div>	
*/ ?>


