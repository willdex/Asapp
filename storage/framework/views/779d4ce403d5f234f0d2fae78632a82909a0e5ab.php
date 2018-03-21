<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<div class="row">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
    <?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::open(['route'=>'empresa.store', 'method'=>'POST' , 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;']); ?>	
		<?php echo $__env->make('empresa.forms.empresa', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?> 		
	</div>

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
		<div align="right">
			<?php echo Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()']); ?>

			<a href="<?php echo URL::to('empresa'); ?>" class="btn btn-danger">CANCELAR</a>
		</div>
	</div>
	
	<?php echo Form::close(); ?>

</div>
	<?php echo Html::script('js/localizacion.js'); ?>

    <?php //{!!Html::script('js/GoogleMapsInitMap.js')!!} ?>

    <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ&callback=initMap">
    </script>
	<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>