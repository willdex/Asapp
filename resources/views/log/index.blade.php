<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ASAPP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->    
    {!!Html::style('css/bootstrap.css')!!}
    <!-- Font Awesome -->
   
    <!-- Theme style -->
   {!!Html::style('css/AdminLTE.css')!!}
    <link rel="apple-touch-icon" href="{{asset('images/cargar.png')}}">
    <link rel="shortcut icon" href="{{asset('images/cargar.png')}}">
  </head>
  <body class="hold-transition login-page">

    <div class="login-box">
      @include('alerts.errors')

      <div class="login-logo">      
        <b>ASAPP</b> <br>
        <img src='{{asset('images/cargar.png')}}' width="100px" height="100px" class="img-circle">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese Sus Datos</p>
       {!!Form::open(['route'=>'login.store', 'method'=>'POST'])!!}
       <input type="hidden" name="_token" value="{{ csrf_token()}}" id="token">
          <div class="form-group has-feedback">
            {!!Form::text('username',null,['class'=>'form-control','placeholder'=>'Usuario'])!!}
            <i class="fa fa-user form-control-feedback"></i>
          </div>
          <div class="form-group has-feedback">
           
           {!!Form::password('password',['class'=>'form-control','placeholder'=>'Constraseña'])!!}
           <i class="fa fa-key form-control-feedback"></i>
            
          </div>
          <div class="row">
           
            <div class="col-xs-4 pull-right">
                {!!Form::submit('Ingresar',['id'=>'btn_ingresar','class'=>'btn btn-primary btn-block btn-flat','onclick'=>'ocultar()'])!!}
            </div><!-- /.col -->
          </div>
       
       {!!Form::close()!!}
      
        
      
        

      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->

  {!!Html::script('js/jquery.js')!!}
  {!!Html::script('js/bootstrap.js')!!}
         
  {!!Html::script('js/login.js')!!}
  </body>
</html>
