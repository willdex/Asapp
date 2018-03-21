        <?php echo Html::script('js/jQuery-2.1.4.min.js'); ?>

        <?php //{!!Html::style('css/bootstrap-datetimepicker.css')!!}  ESTE CSS ES PA LAS FECHA ?>
        
        <?php echo Html::style('css/bootstrap.css'); ?>

        <?php echo Html::style('css/font-awesome.css'); ?>

        <?php echo Html::style('css/AdminLTE.css'); ?>


        <?php echo Html::style('css/_all-skins.css'); ?>

        <?php echo Html::style('css/bootstrap-select.min.css'); ?>

        <?php echo Html::style('css/alertify.css'); ?>

        <?php echo Html::style('css/default.css'); ?>

        <?php echo Html::style('css/cargando.css'); ?>


<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

	<div class="row">
	<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12"></div>
	    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
		<H1>REGISTRO DE ADMINISTRADORES</H1>	    
		<?php echo Form::open(['route'=>'administrador.store', 'method'=>'POST' ,'onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;']); ?>	
			<?php echo $__env->make('users.forms.usr', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>		
		<div align="right">
			<?php echo Form::submit('REGISTRAR',['class'=>'btn btn-primary','id'=>'btn_registrar','onclick'=>'btn_esconder()']); ?>

			<a href="<?php echo URL::to('administrador'); ?>" class="btn btn-danger">CANCELAR</a>
		</div>

		<?php echo Form::close(); ?>

		</div>
	</div>
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#loading').css("display","none");    
		    $('#body_principal').show();    
		});
	</script>

        <?php echo Html::script('js/moment.js'); ?>

        <?php echo Html::script('js/moment-with-locales.min.js'); ?>

        <?php echo Html::script('js/numerosmasdecimal.js'); ?>


        <?php echo Html::script('js/bootstrap.js'); ?>

        <?php echo Html::script('js/bootstrap-select.min.js'); ?>

        <?php echo Html::script('js/alertify.js'); ?>


        <?php echo Html::script('js/app.js'); ?>

              
     <?php //   {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}  //ESTE ES EL JS DE LAS FECHAS ?>
