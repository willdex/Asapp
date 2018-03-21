
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('usuario.modal_carrera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
        
            <?php foreach($usuario as $user): ?>
    		<button class="btn-sm btn-primary" onclick="BuscarHistorialUsuario(<?php echo e($user->id); ?>)"><i class="fa fa-search"></i></button>
            <input type="hidden" id="id_usuario" value="<?php echo e($user->id); ?>">                  		
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <a class="btn btn-danger" href="<?php echo URL::to('usuario'); ?>">VOLVER</a> </div>    
        <div class="pull-right">
            <img id="logo" src="<?php echo e($user->imagen); ?>" width="100px" height="100px" class="img-circle">
        </div>    	
        <div class="pull-right">
            <b>Usuario: </b><font size="4"><?php echo e($user->nombre); ?> <?php echo e($user->apellido); ?></font> <br>
            <b>Empresa: </b><font size="4"><?php echo e($user->empresa); ?></font>    
    	</div>
        <?php endforeach; ?>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>MOTISTA</center></th>                   
    				<th><center>DIRECCION</center></th>    				
                    <th><center>FECHA</center></th>
    				<th><center>PUNTUACION</center></th>
                    <th><center>MONTO</center></th>
    				<th><center>OPCION</center></th>
    			</thead>
    			<tbody align="center" id="body_historial">
    				
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>

<?php echo Html::script('js/historial_usuario.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>