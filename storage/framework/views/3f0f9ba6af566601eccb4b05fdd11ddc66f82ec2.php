<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('usuario.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">USUARIO</font>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_usuario" class="form-control selectpicker" id="id_usuario" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        <?php foreach($buscar_usuario as $user): ?>
		        <option value="<?php echo e($user->id); ?>"><?php echo e($user->nombre_user); ?> <?php echo e($user->apellido); ?> - <?php echo e($user->telefono); ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
			<div class="pull-right">
				<a class="btn btn-success" href="<?php echo URL::to('usuario/create'); ?>">REGISTRAR</a> 
			</div>
		</div>
		<br><br>
       
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>TELEFONO</center></th>
						<th><center>EMAIL</center></th>
						<th><center>EMPRESA</center></th>
						<th><center>ESTADO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>

					<tbody align="center" id="body_user">
					<?php foreach($usuario as $user): ?>
					
					<tr>

						<td><?php echo e($user->nombre_user); ?></td>
						<td><?php echo e($user->apellido); ?></td>
						<td><?php echo e($user->telefono); ?></td>
						<td><?php echo e($user->email); ?></td>
						<td><?php echo e($user->nombre_emp); ?></td>
						<?php 
						switch ($user->estado) {
							case 1:						  
								$estado='ACTIVO';
								break;
							case 2:								
								$estado='BLOQUEADO';									 							
							break;	
							case 3:
								$estado='BAJA';								 								 							
							break;														
						}
						?>
						<td><?php echo $estado; ?></td>						
						<td>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalUsuario" onclick="CargarUsuario(<?php echo e($user->id); ?>)">VER MAS</button>
						<?php if ($user->estado != 3): ?>
						<button class="btn btn-info" data-toggle="modal" data-target="#ModalUsuarioNotificacion" onclick="CargarUsuario(<?php echo e($user->id); ?>)">NOTIFICACION</button>							
						<?php endif ?>						
						<?php //{!!link_to_route('usuario.show', $title='CARRERAS', $parameters=$user->id, $attributes = ['class'=>'btn btn-warning'])!!} ?>
						</td>
						</tr>
					<?php endforeach; ?>
					</tbody>

					<tbody align="center" id="body_user_2">
					</tbody>
				</table>

	<div class="pull-left">	<?php echo $usuario->render(); ?>  </div>
	<div class="pull-right">	<button class="btn btn-default" id="mostrar" onclick="ver_todos()"><b>VER TODOS</b></button>  </div>

			</div>
		</div>
	</div>
   <?php echo Html::script('js/usuario.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>