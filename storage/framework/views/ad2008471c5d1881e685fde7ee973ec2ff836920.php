<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ASAPP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->    
    <?php echo Html::style('css/bootstrap.css'); ?>

    <!-- Font Awesome -->
   
    <!-- Theme style -->
   <?php echo Html::style('css/AdminLTE.css'); ?>

    <link rel="apple-touch-icon" href="<?php echo e(asset('images/cargar.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('images/cargar.png')); ?>">
  </head>
  <body class="hold-transition login-page">

    <div class="login-box">
      <?php echo $__env->make('alerts.errors', array_except(get_defined_vars(), array('__data', '__path')))->render(); ?>

      <div class="login-logo">      
        <b>ASAPP</b> <br>
        <img src='<?php echo e(asset('images/cargar.png')); ?>' width="100px" height="100px" class="img-circle">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese Sus Datos</p>
       <?php echo Form::open(['route'=>'login.store', 'method'=>'POST']); ?>

       <input type="hidden" name="_token" value="<?php echo e(csrf_token()); ?>" id="token">
          <div class="form-group has-feedback">
            <?php echo Form::text('username',null,['class'=>'form-control','placeholder'=>'Usuario']); ?>

            <i class="fa fa-user form-control-feedback"></i>
          </div>
          <div class="form-group has-feedback">
           
           <?php echo Form::password('password',['class'=>'form-control','placeholder'=>'Constraseña']); ?>

           <i class="fa fa-key form-control-feedback"></i>
            
          </div>
          <div class="row">
           
            <div class="col-xs-4 pull-right">
                <?php echo Form::submit('Ingresar',['id'=>'btn_ingresar','class'=>'btn btn-primary btn-block btn-flat','onclick'=>'ocultar()']); ?>

            </div><!-- /.col -->
          </div>
       
       <?php echo Form::close(); ?>

      
        
      
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  <?php echo Html::script('js/jquery.js'); ?>

  <?php echo Html::script('js/bootstrap.js'); ?>

         
  <?php echo Html::script('js/login.js'); ?>

  </body>
</html>
