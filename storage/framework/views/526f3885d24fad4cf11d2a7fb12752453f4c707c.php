<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<H2>REGISTRO DE TARIFAS</H2>

<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>'tarifa.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;']); ?>	
		<?php echo $__env->make('tarifa.forms.tarifa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>	
	</div>

    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">

	<div align="right">
		<?php echo Form::submit('REGISTRAR',['id'=>'btn_registrar','class'=>'btn btn-primary','onclick'=>'btn_esconder()']); ?>

		<a href="<?php echo URL::to('tarifa'); ?>" class="btn btn-danger">CANCELAR</a>
		<?php //{!!Form::reset('CANCELAR',['class'=>'btn btn-danger'])!!} ?>
	</div>

	<?php echo Form::close(); ?>

	</div>
</div>
   <?php echo Html::script('js/tarifa.js'); ?>

	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>