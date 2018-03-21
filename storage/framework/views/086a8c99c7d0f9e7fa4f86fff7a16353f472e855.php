
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <font size="6">GASTOS</font> 
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
        <div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
            <b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
            <b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
            <button class="btn-sm btn-primary" onclick="CargarGastos()"><i class="fa fa-search"></i></button>    
            <input type="hidden" id="sw" value="3">                           
        </div>
    </div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">      
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>EMPRESA</center></th>                
                    <th><center>MOTO</center></th>
    				<th><center>MONTO TOTAL</center></th>
    			</thead>
    			<tbody align="center" id="body_lista_gastos">
               <?php /* @foreach($gastos_empresa as $emp)
                    <td style="font-size:30px; background: #E6F8E0">{{$emp->monto_empresa}} Bs.</td>
                @endforeach
                @foreach($gastos_moto as $mot)
                    <td style="font-size:30px; background: #E0F2F7">{{$mot->monto_moto}} Bs.</td>
                @endforeach 
                    <td style="font-size:30px; color: red; background: #FBEFEF">{{$emp->monto_empresa - $mot->monto_moto}} Bs.</td>
                */ ?>
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>

<?php echo Html::script('js/reportes.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>