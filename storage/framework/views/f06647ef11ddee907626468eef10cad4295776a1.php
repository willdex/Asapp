	<div class="form-group">
		<?php echo Form::label('nombre','NOMBRE:'); ?>

		<?php echo Form::text('nombre',null,['class'=>'form-control','placeholder'=>'Ingrese su Nombre']); ?>

	</div>

	<div class="form-group">
		<?php echo Form::label('apellido','APELLIDO:'); ?>

		<?php echo Form::text('apellido',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre su Apellido']); ?>

	</div>	

	<div class="form-group">
		<?php echo Form::label('username','USUARIO:'); ?>

		<?php echo Form::text('username',null,['class'=>'form-control','placeholder'=>'Ingrese el Nombre de Usuario']); ?>

	</div>
	<div class="form-group">
		<?php echo Form::label('password','CONTRASEÑA:'); ?>

		<?php echo Form::text('password',null,['class'=>'form-control','placeholder'=>'Ingrese La Contraseña']); ?>

	</div>