<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>ASAPP</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">





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




    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="apple-touch-icon" href="<?php echo e(asset('images/cargar.png')); ?>">
    <link rel="shortcut icon" href="<?php echo e(asset('images/cargar.png')); ?>">

  </head>
  <body class="hold-transition skin-blue sidebar-mini">

    <div class="wrapper" id="body_principal">

      <header class="main-header">
        <!-- Logo -->
        <a href="http://www.grayhatcorp.com" target="_blank" class="logo">
          <!-- mini logo for sidebar mini 50x50 pixels -->
          <span class="logo-mini">Asapp</span>
          <!-- logo for regular state and mobile devices -->
          <span class="logo-lg"><b>ASAPP</b></span>
        </a>

        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top" role="navigation">
          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Navegación</span>
          </a>
          <!-- Navbar Right Menu -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <!--small class="bg-yellow">Admin:</small-->
                  <span><?php echo e(Auth::user()->nombre); ?> <?php echo e(Auth::user()->apellido); ?></span>                                   
                </a>   
                <?php /*<ul class="dropdown-menu">
                  <!-- User image -->
                  <li class="user-header">                    
                    <p>
                      www.grayhatcorp.com Desarrollando Software
                      <small>Administador</small>
                    </p>
                  </li>
                  
                  <!-- Menu Footer-->
                  <li class="user-footer">
                    
                    <div class="pull-right">

                      <a href="#" class="btn btn-default btn-flat">Cerrar</a>
                    </div>
                  </li>
                </ul>*/ ?>
              </li>
              
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="<?php echo URL::to('logout'); ?>"> <i class="fa fa-power-off"></i> SALIR</a>   
              </li>

            </ul>
          </div>

        </nav>
      </header>
      <!-- Left side column. contains the logo and sidebar -->
      <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
                    
          <!-- sidebar menu: : style can be found in sidebar.less -->
          <ul class="sidebar-menu">
            <!--li class="header"></li-->

            <li class="treeview">
              <a href="#">
                <i class="fa fa-dollar"></i>
                <span>COBROS</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo URL::to('pago_motista'); ?>"><i class="fa fa-bicycle"></i> Motistas</a></li>
                <li><a href="<?php echo URL::to('pago_empresa'); ?>"><i class="fa fa-building"></i> Empresas</a></li>
                <li><a href="<?php echo URL::to('tarifa'); ?>"><i class="fa fa-money"></i> Tarifa</a></li>
                <li><a href="<?php echo URL::to('lista_pago_empresa'); ?>"><i class="fa fa-money"></i>Historial cobro empresa</a></li>
                <li><a href="<?php echo URL::to('lista_pago_moto'); ?>"><i class="fa fa-money"></i>Historial cobro motista</a></li>
              </ul>
            </li> 

            <li class="treeview">
              <a href="<?php echo URL::to('moto'); ?>">
                <i class="fa fa-bicycle" aria-hidden="true"></i>
                <span>MOTOS</span>
              </a>
            </li>

            <li class="treeview">
              <a href="<?php echo URL::to('usuario'); ?>">
                <i class="fa fa-users" aria-hidden="true"></i>
                <span>USUARIOS</span>
              </a>
            </li>          

            <li class="treeview">
              <a href="<?php echo URL::to('empresa'); ?>">
                <i class="fa fa-building" aria-hidden="true"></i>
                <span>EMPRESAS</span>
              </a>
            </li> 

            <li class="treeview">
              <a href="<?php echo URL::to('busqueda_motista'); ?>">
                <i class="fa fa-search" aria-hidden="true"></i>
                <span>BUSQUEDAS</span>
              </a>
            </li>   

            <li class="treeview">
              <a href="<?php echo URL::to('notificacion'); ?>">
                <i class="fa fa-check-circle" aria-hidden="true"></i>
                <span>NOTIFICACIONES</span>
              </a>
            </li>   

            <li class="treeview">
              <a href="#">
                <i class="fa fa-align-left"></i>
                <span>REPORTES</span>
                 <i class="fa fa-angle-left pull-right"></i>
              </a>
              <ul class="treeview-menu">
                <li><a href="<?php echo URL::to('reporte_gastos'); ?>"><i class="fa fa-money"></i>Gastos</a></li>
                <li><a href="<?php echo URL::to('reporte_motista_com_mas_pedidos'); ?>"><i class="fa fa-bicycle"></i>Motista con mas pedido</a></li>
                <li><a href="<?php echo URL::to('reporte_empresa_com_mas_pedidos'); ?>"><i class="fa fa-building"></i>Empresa con mas pedido</a></li>
              </ul>
            </li>                        

            <li class="treeview">
              <a href="<?php echo URL::to('administradr'); ?>">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>ADMINISTRADOR</span>
              </a>
            </li> 
                       
             <!--li>
              <a href="#">
                <i class="fa fa-plus-square"></i> <span>Ayuda</span>
                <small class="label pull-right bg-red">PDF</small>
              </a>
            </li>
            <li>
              <a href="#">
                <i class="fa fa-info-circle"></i> <span>Acerca De...</span>
                <small class="label pull-right bg-yellow">IT</small>
              </a>
            </li-->
                        
          </ul>
        </section>
        <!-- /.sidebar -->
      </aside>





       <!--Contenido-->
      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        
        <!-- Main content -->
        <section class="content">          
          <div class="row">

            <div class="col-md-12">
              <div class="box">
                <!--div class="box-header with-border">
                  <h3 class="box-title">Sistema de Ventas</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div-->
                <!-- /.box-header -->
                <div class="box-body">
                    <div class="row">
                        <div class="col-md-12">
                                  <!--Contenido-->
                                    <?php echo $__env->yieldContent('contenido'); ?>   
                                                               
                                  <!--Fin Contenido-->
                           </div>
                            
                    </div><!-- /.row -->
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div><!-- /.col -->
          </div><!-- /.row -->

        </section><!-- /.content -->
      </div><!-- /.content-wrapper -->
      <!--Fin-Contenido-->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>A</b>SAPP
        </div>
        <strong>Copyright &copy; <a href="http://www.grayhatcorp.com" target="_blank" style="color:#880D5F ">GrayHatCorp</a>.</strong> All rights reserved.
      </footer>
  </div>
  
<?php /*<div>
  @include('alerts.cargando')
</div>*/ ?>

        <?php echo Html::script('js/moment.js'); ?>

        <?php echo Html::script('js/moment-with-locales.min.js'); ?>

        <?php echo Html::script('js/numerosmasdecimal.js'); ?>


        <?php echo Html::script('js/bootstrap.js'); ?>

        <?php echo Html::script('js/bootstrap-select.min.js'); ?>

        <?php echo Html::script('js/alertify.js'); ?>


        <?php echo Html::script('js/app.js'); ?>

              
     <?php //   {!!Html::script('js/bootstrap-datetimepicker.min.js')!!}  //ESTE ES EL JS DE LAS FECHAS ?>

  </body>
</html>
