
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('moto.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">	
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
		<div class="table-responsive" style="overflow-x:inherit">	
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">PAGO MOTISTA</font>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
		    <select name="id_motista" class="form-control selectpicker" id="id_motista" data-live-search="true" >
		     <option value="">BUSCAR...                                   </option>
		        <?php foreach($buscar_moto as $mot): ?>
		        <option value="<?php echo e($mot->id); ?>"><?php echo e($mot->nombre); ?> <?php echo e($mot->apellido); ?> - <?php echo e($mot->ci); ?> - <?php echo e($mot->placa); ?> - <?php echo e($mot->celular); ?></option>
		        <?php endforeach; ?>
		    </select>
		</div>
		
		<br><br>
			
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>CI</center></th>
						<th><center>PLACA</center></th>
						<th><center>MODELO</center></th>
						<th><center>COLOR</center></th>
						<th><center>CELULAR</center></th>
						<th><center>CREDITO</center></th>
						<th><center>FOTO</center></th>
						<th><center>OPCION</center></th>
						
					</thead>

					<tbody align="center" id="body_moto">
					</tbody>

				</table>

		</div>
	</div>
</div>
<?php echo Html::script('js/moto.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>