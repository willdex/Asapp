
<?php $__env->startSection('contenido'); ?>
<?php echo $__env->make('empresa.modal', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php echo $__env->make('alerts.cargando', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

<div class="row">
	<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">		
    <?php echo $__env->make('alerts.request', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>
	<?php echo Form::model($empresa,['route'=>['empresa.update',$empresa->id],'method'=>'PUT', 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;']); ?>


<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
<H2>ACTUALIZAR EMPRESA</H2>    

    <div class="form-group">
        <?php echo Form::label('nombre_administrador','Nombre Administrador:'); ?>

        <?php echo Form::text('nombre_administrador',null,['id'=>'nombre_administrador','class'=>'form-control ','placeholder'=>'Ingrese el nombre']); ?>

    </div>
    <div class="form-group">
        <?php echo Form::label('apellido_administrador','Apellidos:'); ?>

        <?php echo Form::text('apellido_administrador',null,['id'=>'apellido_administrador','class'=>'form-control','placeholder'=>'Ingrese los apellidos']); ?>

    </div>

    <div class="form-group">
        <?php echo Form::label('telefono_administrador','Teléfono Del Adiministrador:'); ?>

        <?php echo Form::text('telefono_administrador',null,['id'=>'telefono_administrador','class'=>'form-control','placeholder'=>'Ingrese el telefono del administrador','onkeypress'=>'return bloqueo_de_punto(event)','maxlength'=>'8']); ?>

        <input type="hidden" name="telefono_administrador_aux" id="telefono_administrador_aux">
    </div>

    <div class="form-group">
        <?php echo Form::label('email','Email:'); ?>

        <?php echo Form::email('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingrese el email']); ?>

    </div>

		<input type="hidden" name="id_empresa" id="id_empresa" value="<?php echo e($empresa->id); ?>">
       <?php /* <input type="text" name="latitud" id="latitud" value="0">
        <input type="text" name="longitud" id="longitud" value="0">*/ ?>
        <input type="hidden" name="id_casa" id="id_casa" value="0">
        <input type="hidden" name="id_trabajo" id="id_trabajo" value="0">
        <input type="hidden" name="token" id="token" value="0">


		<div class="form-group">
			<?php echo Form::label('nombre_empres','Nombre Empresa:'); ?>

			<?php echo Form::text('nombre_empres',$empresa->nombre,['id'=>'nombre_empres','class'=>'form-control','placeholder'=>'Ingrese el nombre de la empresa']); ?>

		</div>

		<div class="form-group" hidden="">
			<?php echo Form::label('direccion','Direccion:'); ?>

			<?php echo Form::text('direccion',null,['class'=>'form-control','placeholder'=>'Ingrese la direccion']); ?>

		</div>

		<div class="form-group">
			<?php echo Form::label('telefono_empres','Telefono De La Empresa:'); ?>

			<?php echo Form::text('telefono_empres',$empresa->telefono,['class'=>'form-control','placeholder'=>'Ingrese el numero de la empresa','onkeypress'=>'return bloqueo_de_punto(event)','maxlength'=>'15']); ?>

		</div>

		<div class="form-group">
			<?php echo Form::label('razon_social','Razon Social:'); ?>

			<?php echo Form::text('razon_social',null,['class'=>'form-control','placeholder'=>'Ingrese razon_social']); ?>

		</div>

		<div class="form-group">
			<?php echo Form::label('nit','NIT:'); ?>

			<?php echo Form::text('nit',null,['class'=>'form-control','placeholder'=>'Ingrese el nit']); ?>

		</div>

	    <div class="form-group">
	        <?php echo Form::label('estado','Empresa:'); ?>

	        <?php echo Form::select('estado',array('1'=>'ACTIVO','2'=>'BLOQUEADO'),null,array('id'=>'estado','class'=>'form-control','disabled')); ?>

	    </div>

		<div class="form-group" hidden="">
			<?php echo Form::label('latitud','Latitud:'); ?>

			<?php echo Form::text('latitud',0,['class'=>'form-control','placeholder'=>'Ingrese la latitud']); ?>

		</div>

		<div class="form-group" hidden="">
			<?php echo Form::label('longitud','Longitud:'); ?>

			<?php echo Form::text('longitud',0,['class'=>'form-control','placeholder'=>'Ingrese la longitud']); ?>

		</div>	

		<div class="form-group" hidden="">
			<?php echo Form::label('credito','Credito:'); ?>

			<?php echo Form::text('credito',null,['class'=>'form-control','placeholder'=>'Ingrese el credito']); ?>

		</div>
		<input type="hidden" name="id_administrador" id="id_administrador" value="<?php echo e($empresa->id_administrador); ?>">

</div>

<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12" align="center">
<br><br><br>
<?php echo Form::label('foto Del Administrador:'); ?> <br>
            <img id="logo" src="" onclick="cargarImagen(this, 1)" style="cursor: pointer" title="Cambiar Imagen" class="img-circle" /><br>
            <input type="hidden" name="imagen" id="imagen"><br><br>
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
	<div id="map" style="width: 600px; height: 550px;"></div>
	<div class="pull-right">
	   <button id="btn_ver" type="button" class="btn-sm btn-info" hidden="" onclick="lista_direccion()">VER TODOS</button>	
	   <button id="bt_add" type="button" class="btn-sm btn-success" onclick="nuevo()"><i class="fa fa-plus-square" aria-hidden="true"></i></button>
	</div>
<!--input type="text" name="coords" id="coords"-->


<?php /* <input type="text" name="latitud_aux" id="latitud_aux">
<input type="text" name="longitud_aux" id="longitud_aux">
*/?>

        <table class="table table-striped table-bordered table-condensed table-hover">
          <thead>
            <th><center>NOMBRE</center></th>
            <th><center>DIRECCION</center></th>
            <th><center>OPCION</th>           
          </thead>

          <tbody align="center" id="lista">
          </tbody>
      
        </table>
         <!--font size="2" id="nueva_lista_titulo" hidden=""><b>NUEVO NOMBRE</b></font-->

		<table class="table table-striped table-bordered table-condensed table-hover">
				<thead id="nueva_head" hidden="">
		            <th><center>NUEVO NOMBRE</center></th>
		            <th><center>NUEVA DIRECCION</center></th>
		            <th><center>OPCION</th>  					
				</thead>
			   <tbody align="center" id="nueva_lista">
		       </tbody>
		</table>
	<?php //{!!Html::script('js/localizacion.js')!!} ?>

</div>




	</div>
 

    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">	
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-right">			
			<a href="<?php echo URL::to('empresa'); ?>" class="btn btn-danger">CANCELAR</a>
		</div>	
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-right">			
			<?php echo Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_actualizar','onclick'=>'btn_esconder()']); ?>						
		</div>	
		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">			
	   		<button type="button" data-toggle="modal" data-target="#ModalCambiarAdministrador" class="btn btn-info">CAMBIAR ADMINISTRADOR</button>			
		</div>			
		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-right">			
	   		<a id="ruta" class="btn btn-warning">CARRERAS</a>		   		
		</div>
	<?php echo Form::close(); ?>


		<div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right" id="div_desbloq">
			<?php echo e(Form::open(array('url' => 'Desbloquear_Empresa'))); ?>  
			<input type="hidden" name="id_empresa_desbloq" id="id_empresa_desbloq">
			<input type="hidden" name="id_usuario_desbloq" id="id_usuario_desbloq">
			<input type="hidden" name="token_desbloq" id="token_desbloq">    
			<button type="submit" id="btn_desbloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#58ACFA;color:white">DESBLOQUEAR</button> 
			<?php echo Form::close(); ?>

		</div>

		<div class="col-lg-1 col-md-1 col-sm-1 col-xs-12 pull-right" id="div_bloq">
			<?php echo e(Form::open(array('url' => 'Bloquear_Empresa'))); ?>  
			<input type="hidden" name="id_empresa_bloq" id="id_empresa_bloq">
			<input type="hidden" name="id_usuario_bloq" id="id_usuario_bloq">
			<input type="hidden" name="token_bloq" id="token_bloq">    
			<button type="submit" id="btn_bloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#F7819F;color:white">BLOQUEAR</button> 
			<?php echo Form::close(); ?>

		</div>

	</div>		
</div>
<?php echo Html::script('js/empresa_update.js'); ?>


<?php //{!!Html::script('js/GoogleMaps.js')!!} ?>
<script async defer
  src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ">
</script>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.inicio', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>