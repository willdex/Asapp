
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('moto.modal_carrera', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
    		<button class="btn-sm btn-primary" onclick="BuscarHistorial(<?php echo e($moto->id); ?>)"><i class="fa fa-search"></i></button> 
            <input type="hidden" name="id_motista" id="id_motista" value="<?php echo e($moto->id); ?>">     		
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <a class="btn btn-danger" href="<?php echo URL::to('moto'); ?>">VOLVER</a> </div>    
        <div class="pull-right"> <img id="logo" src="<?php echo e($moto->imagen); ?>" width="100px" height="100px" class="img-circle"> </div>        
    	<div class="pull-right">
            <b>Motista: </b><font size="4"><?php echo e($moto->nombre); ?> <?php echo e($moto->apellido); ?></font> <br>
            <select id="opcion" class="form-control">
                <option value="0">COMPLETADOS</option>
                <option value="1">CANCELADOS</option>
            </select>
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover" id="tabla_completado">
    			<thead>
                    <th><center>USUARIO</center></th>                   
                    <th><center>CELULAR</center></th>                   
    				<th><center>EMPRESA</center></th>
    				<th><center>DIRECCION</center></th>    				
                    <th><center>FECHA</center></th>
    				<th><center>PUNTUACION</center></th>
                    <th><center>MONTO</center></th>
    				<th><center>OPCION</center></th>
    			</thead>
    			<tbody align="center" id="body_historial">
    				
    			</tbody>
    		</table>

            <table class="table table-striped table-bordered table-condensed table-hover" id="tabla_cancelado">
                <thead>
                    <th><center>USUARIO</center></th>                   
                    <th><center>CELULAR</center></th>                   
                    <th><center>EMPRESA</center></th>
                    <th><center>TELEFONO EMPRESA</center></th>                 
                    <th><center>FECHA</center></th>
                </thead>
                <tbody align="center" id="body_historial_cancelado">
                    
                </tbody>
            </table>            
    	</div>
	</div>	
</div>

<?php echo Html::script('js/historial_moto.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>