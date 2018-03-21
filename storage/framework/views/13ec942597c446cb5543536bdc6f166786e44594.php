
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('moto.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<div class="row" >	

		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">MOTO</font>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_mot" class="form-control selectpicker" id="id_mot" data-live-search="true" >
		     <option value="">  BUSCAR...                                </option>
		        <?php foreach($buscar_moto as $mot): ?>
		        <option value="<?php echo e($mot->id); ?>"><?php echo e($mot->nombre); ?> <?php echo e($mot->apellido); ?> - <?php echo e($mot->ci); ?> - <?php echo e($mot->placa); ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>

       
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<div class="pull-right">
				<a class="btn btn-success" href="<?php echo URL::to('moto/create'); ?>">REGISTRAR</a> 
			</div>
		</div>

				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>CI</center></th>
						<th><center>MARCA & MODELO</center></th>
						<th><center>PLACA</center></th>
						<th><center>AÑO</center></th>
						<th><center>COLOR</center></th>
						<th><center>CELULAR</center></th>
						<th><center>CREDITO</center></th>
						<th><center>ESTADO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>

					<tbody align="center" id="body_moto">					
					<?php foreach($moto as $mot): ?>
					<?php /*if ($mot->estado == 2) {
						echo "<tr style='background:#F5A9A9'>";						
					}else{ 
						echo "<tr>";						
					 } */?>
					<tr>
						<td><?php echo e($mot->nombre); ?></td>
						<td><?php echo e($mot->apellido); ?></td>
						<td><?php echo e($mot->ci); ?></td>
						<td><?php echo e($mot->marca); ?></td>
						<td><?php echo e($mot->placa); ?></td>
						<td><?php echo e($mot->modelo); ?></td>
						<td><?php echo e($mot->color); ?></td>
						<td><?php echo e($mot->celular); ?></td>	
						<td><?php echo e($mot->credito); ?> Bs.</td>	

					<?php if ($mot->estado == 0) {
						echo "<td>INACTIVO</td>";
					 }else{  
					 	if ($mot->estado == 1) {
							echo "<td>ACTIVO</td>";
						 } else {
						 	if ($mot->estado == 2) {
								echo "<td>CARRERA</td>";						 		
						 	} else {
								echo "<td>BLOQUEADO</td>";						 		
						 	}
						 	
						 }
					 } ?>

						<td>
						<button class="btn btn-primary" data-toggle="modal" data-target="#ModalMoto" onclick="CargarMoto(<?php echo e($mot->id); ?>)">VER MAS</button>
						<button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacion" onclick="CargarMoto(<?php echo e($mot->id); ?>)">NOTIFICACION</button>
						<?php /*{!!link_to_route('moto.show', $title = 'CARRERAS', $parameters = $mot->id, $attributes = ['class'=>'btn btn-warning'])!!}
						<button class="btn-sm btn-danger" data-toggle="modal" data-target="#ModalBloquearMoto" onclick="CargarMoto({{$mot->id}})">BLOQUEAR</button>				*/ ?>
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>

					<tbody align="center" id="body_moto_2">
					</tbody>					
				</table>



	<div class="pull-left">	<?php echo $moto->render(); ?>  </div>
	<div class="pull-right">	<button class="btn btn-default" id="mostrar" onclick="ver_todos()"><b>VER TODOS</b></button>  </div>
			</div>
		</div>
	</div>

   <?php echo Html::script('js/moto.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>