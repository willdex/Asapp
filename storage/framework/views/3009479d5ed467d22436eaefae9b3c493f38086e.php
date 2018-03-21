

<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
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
				<?php //{!!link_to_route('users.show', $title = 'REGISTRAR',  $attributes = ['class'=>'btn btn-success'])!!}									 ?>	
				<a class="btn btn-success" href="<?php echo URL::to('administradr/create_'); ?>">REGISTRAR</a> 
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
	<script type="text/javascript">
		$(document).ready(function(){
		    $('#loading').css("display","none");    
		    $('#body_principal').show();    
		});
	</script>
<?php $__env->stopSection(); ?>






<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>