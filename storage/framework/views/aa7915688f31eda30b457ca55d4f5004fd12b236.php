
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
   
<div class="row">

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <font size="6">EMPRESAS CON MAS PEDIDOS</font> 
    </div>
    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 pull-right">
        <div class="pull-right">
        <?php foreach($fechas as $fecha): ?>
            <b>Fecha Inicio:</b> <input type="date" id="fecha_inicio" value="<?php echo e($fecha->fecha_inicio); ?>">
            <b>Fecha Fin:</b> <input type="date" id="fecha_fin" value="<?php echo e($fecha->fecha_fin); ?>"> 
        <?php endforeach; ?>
            <button class="btn-sm btn-primary" onclick="CargarReporteEmpresa()"><i class="fa fa-search"></i></button>    
            <input type="hidden" id="sw" value="2">                           
        </div>
    </div>


    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    	<div class="table-responsive">
    		<table class="table table-striped table-bordered table-condensed table-hover">
    			<thead>
                    <th><center>EMPRESA</center></th>                
                    <th><center>PEDIDOS</center></th>
    				<th><center>MONTO TOTAL</center></th>
    			</thead>
    			<tbody align="center" id="body_lista_empresa">
                <?php /*@foreach($empresa as $emp)
                <tr style="font-size: 17px">
                    <td>{{$emp->nombre}}</td>
                    <td>{{$emp->pedidos}}</td>
                    <td>{{$emp->monto_empresa}} Bs.</td>                    
                </tr>                    
                @endforeach*/ ?>
    			</tbody>
    		</table>
    	</div>
	</div>	
</div>
<?php echo Html::script('js/reportes.js'); ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>