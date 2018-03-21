
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('empresa.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="pull-left"> <font size="6">HISTORIAL DE CARRERAS</font> </div>
    	<div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
    		<b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
    		<b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
    <?php foreach($pedidos as $ped): ?>
    		<button class="btn-sm btn-primary" onclick="BuscarHistorialEmpresa(<?php echo e($ped->id); ?>)"><i class="fa fa-search"></i></button>
            <input type="hidden" id="id_empresa" value="<?php echo e($ped->id); ?>">      		
    	</div>
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">    
        <?php $ruta='empresa/'.$ped->id.'/edit' ?>
        <div class="pull-left"> <a class="btn btn-danger" href="<?php echo URL::to($ruta); ?>">VOLVER</a> </div> 
        <div class="pull-right">
            <img id="logo" src="<?php echo e($ped->imagen); ?>" width="100px" height="100px" class="img-circle">
        </div>   
        <div class="pull-right">
        <b>Empresa: </b><font size="4"><?php echo e($ped->nombre); ?></font> <br>
        <b>Adminstrador: </b><font size="4"><?php echo e($ped->administrador); ?></font> <br>
    <?php endforeach; ?>
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>USUARIO</center></th>                   
    				<th><center>DIRECCION</center></th>
    				<th><center>MOTISTA</center></th>    				
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
<?php echo Html::script('js/historial_empresa.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>