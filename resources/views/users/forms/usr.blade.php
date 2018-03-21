	<div class="form-group">
		{!!Form::label('nombre','NOMBRE:')!!}
		{!!Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese su Nombre'])!!}
	</div>

	<div class="form-group">
		{!!Form::label('apellido','APELLIDO:')!!}
		{!!Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre su Apellido'])!!}
	</div>	

	<div class="form-group">
		{!!Form::label('username','USUARIO:')!!}
		{!!Form::text('username',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre de Usuario'])!!}
	</div>
	<div class="form-group">
		{!!Form::label('password','CONTRASEÑA:')!!}
		{!!Form::text('password',null,['class'=>'form-control','placeholder'=>'Ingrese La Contraseña'])!!}
	</div>