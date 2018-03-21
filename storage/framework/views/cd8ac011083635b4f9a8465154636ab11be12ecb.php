
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
    
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
        <input type="text" id="codigos" placeholder="BUSCAR POR CODIGO" class="form-control" maxlength="5" onkeypress="return bloqueo_de_punto(event)">  
        <input type="hidden" id="sw" value="1">
    </div>

    <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
            <select name="buscar_moto" class="form-control selectpicker" id="buscar_moto" data-live-search="true" >
             <option value="0">TODOS LOS MOTISTAS...</option>
                <?php foreach($lista_moto as $lis): ?>
                <option value="<?php echo e($lis->id); ?>"> <?php echo e($lis->nombre); ?> <?php echo e($lis->apellido); ?> - <?php echo e($lis->celular); ?></option>
                <?php endforeach; ?>
            </select>      
    </div>    
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="pull-right">    
        <?php foreach($fechas as $fecha): ?>
            <b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
            <b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>            
            <button class="btn-sm btn-primary" onclick="CargarPagoMoto()"><i class="fa fa-search"></i></button>            
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>CODIGO</center></th>                
    				<th><center>MOTISTA</center></th>
                    <th><center>FECHA</center></th>
                    <th><center>MONTO</center></th>
    				<th><center>ADMINISTRADOR</center></th>
    			</thead>
    			<tbody align="center" id="body_pago_moto">
    				
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>

<?php echo Html::script('js/pagos.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>