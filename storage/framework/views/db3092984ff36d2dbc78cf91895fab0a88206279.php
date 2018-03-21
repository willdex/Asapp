        <?php echo Html::script('js/jQuery-2.1.4.min.js'); ?>

        <?php //{!!Html::style('css/bootstrap-datetimepicker.css')!!}  ESTE CSS ES PA LAS FECHA ?>
        
        <?php echo Html::style('css/bootstrap.css'); ?>

        <?php echo Html::style('css/font-awesome.css'); ?>

        <?php echo Html::style('css/AdminLTE.css'); ?>


        <?php echo Html::style('css/_all-skins.css'); ?>

        <?php echo Html::style('css/bootstrap-select.min.css'); ?>

        <?php echo Html::style('css/alertify.css'); ?>

        <?php echo Html::style('css/default.css'); ?>



<?php echo $__env->make('alerts.success', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<br>
	<div class="row">	
		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
			<div class="table-responsive">	

		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
			<font size="6">ADMINSTRADOR</font>
		</div>

       
		<div class="col-lg-8 col-md-8 col-sm-8 col-xs-12">
			<div class="pull-right">
				<a class="btn btn-success" href="<?php echo URL::to('administrador/create'); ?>">REGISTRAR</a> 
				<a class="btn btn-info" href="<?php echo URL::to('/'); ?>"><i class="fa fa-power-off"></i> INICIAR</a> 
			</div>
		</div>
				<table class="table table-striped table-bordered table-condensed table-hover">
					<thead>
						<th><center>NOMBRE</center></th>
						<th><center>APELLIDOS</center></th>
						<th><center>USUARIO</center></th>
					</thead>
					<tbody align="center" id="body_moto">					
					<?php foreach($users as $user): ?>
					<tr>
						<td><?php echo e($user->nombre); ?></td>
						<td><?php echo e($user->apellido); ?></td>
						<td><?php echo e($user->username); ?></td>
					</tr>
					<?php endforeach; ?>
					</tbody>
				
				</table>
			<?php echo $users->render(); ?> 
			</div>
		</div>
	</div>


        <?php echo Html::script('js/moment.js'); ?>

        <?php echo Html::script('js/moment-with-locales.min.js'); ?>

        <?php echo Html::script('js/numerosmasdecimal.js'); ?>


        <?php echo Html::script('js/bootstrap.js'); ?>

        <?php echo Html::script('js/bootstrap-select.min.js'); ?>

        <?php echo Html::script('js/alertify.js'); ?>


        <?php echo Html::script('js/app.js'); ?>

              
     <?php //   {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}  //ESTE ES EL JS DE LAS FECHAS ?>





