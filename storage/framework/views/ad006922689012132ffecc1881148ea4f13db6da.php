
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	
	<div class="row">	

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">NOTIFICACION</font> </div>
    	<div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
    		<button class="btn-sm btn-primary" onclick="Buscar_Notificacion()"><i class="fa fa-search"></i></button> 
    	</div>
	</div>


		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

			<div class="table-responsive" style="overflow-x:inherit">	
       
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>TITULO</center></th>
						<th><center>MENSAJE</center></th>
						<th><center>FECHA</center></th>
						<th><center>ADMINISTRADOR</center></th>				
						<th><center>TIPO</center></th>				
					</thead>

					<tbody align="center" id="body_notificacion">					
					</tbody>				
				</table>

			</div>
		</div>

		<a class="scrollup"><img src="<?php echo e(asset('images/arriba.png')); ?>" width="50" height="50" style="position:fixed; bottom:10px; right:2%;"></a>	
	</div>
   <?php echo Html::script('js/notificacion.js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>