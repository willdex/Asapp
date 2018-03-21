
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('empresa.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('empresa.modal_historial', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		
			<div class="table-responsive" style="overflow-x:inherit">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">EMPRESA</font>
		</div>

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_empres" class="form-control selectpicker" id="id_empres" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        <?php foreach($buscar_empresa as $emp): ?>
		        <option value="<?php echo e($emp->id); ?>"><?php echo e($emp->nombre); ?> - <?php echo e($emp->telefono); ?> - <?php echo e($emp->nit); ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>

       
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pull-right">
			<div class="pull-right">
				<a class="btn btn-success" href="<?php echo URL::to('empresa/create'); ?>">REGISTRAR</a> 
			</div>
		</div>

       			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>EMPRESA</center></th>
						<th><center>TELEFONO</center></th>
						<th><center>RAZON SOCIAL</center></th>
						<th><center>NIT</center></th>
						<th><center>COBRAR</center></th>
						<th><center>ADMINISTRADOR</center></th>
						<th><center>ESTADO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>
					
					<tbody align="center" id="body_empresa">					
					<?php foreach($empresa as $emp): ?>
					<?php $credito=DB::select("SELECT IFNULL(SUM(monto_empresa_aux),0)as monto_empresa FROM pedido,usuario,empresa WHERE pedido.id_usuario=usuario.id AND usuario.id_empresa=empresa.id AND pedido.monto_empresa_aux>0 AND empresa.id=".$emp->id_emp); ?>
					<tr>
						<td><?php echo e($emp->nombre_emp); ?></td>
						<td><?php echo e($emp->telefono_emp); ?></td>
						<td><?php echo e($emp->razon_social); ?></td>
						<td><?php echo e($emp->nit); ?></td>
						<td><?php echo e($credito[0]->monto_empresa); ?> Bs.</td>
						<td><?php echo e($emp->nombre_user); ?> <?php echo e($emp->apellido); ?></td>
						<?php 
						switch ($emp->estado) {
							case 1:						  
								$estado='ACTIVO';
								break;
							case 2:								
								$estado='BLOQUEADO';									 							
							break;													
						}
						?>
						<td><?php echo $estado; ?></td>	
						
						<td>
						<?php //<button class="btn btn-primary" data-toggle="modal" data-target="#ModalEmpresa" onclick="CargarEmpresa({{$emp->id}})">VER MAS</button> ?>
						<?php echo link_to_route('empresa.edit', $title = 'VER MAS', $parameters = $emp->id_emp, $attributes = ['class'=>'btn btn-primary']); ?>	
						<button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacionEmpresa" onclick="CargarEmpresa(<?php echo e($emp->id_emp); ?>)">NOTIFICACION</button>
						<?php //{!!link_to_route('empresa.show', $title = 'CARRERAS', $parameters = $emp->id_emp, $attributes = ['class'=>'btn btn-warning'])!!} ?>						
						</td>
					</tr>
					<?php endforeach; ?>
					</tbody>							

					<tbody align="center" id="body_empresa_2">
					</tbody>							
				</table>
	<div class="pull-left">	<?php echo $empresa->render(); ?>  </div>
	<div class="pull-right">	<button class="btn btn-default" id="mostrar" onclick="ver_todos()"><b>VER TODOS</b></button>  </div>			
			</div>
		</div>
	</div>
   <?php echo Html::script('js/empresa.js'); ?>


<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>