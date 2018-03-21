
<!--//////////////////////////////////-->
<!--MODAL DE VER PERFILDEL MOTISTA-->
<!--//////////////////////////////////-->
<div class="modal fade" id="ModalMoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>PERFIL DEL MOTISTA</b></h3>
      </div>

      <div class="modal-body">
  <?php echo Form::open(['route'=>['moto.update','null'],'method'=>'PUT','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;', 'onsubmit'=>'javascript: return Actualizar_Motista()' ]); ?>   

        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
            
            <div class="form-group">
                <?php echo Form::label('Nombre','Nombre:'); ?>

                <?php echo Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el nombre']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('apellido','Apellido:'); ?>

                <?php echo Form::text('apellido',null,['id'=>'apellido','class'=>'form-control','placeholder'=>'Ingrese el apellido']); ?>

            </div>

            <div class="form-group">
                <?php echo Form::label('ci','CI:'); ?>

                <?php echo Form::text('ci',null,['id'=>'ci','class'=>'form-control','placeholder'=>'Ingrese el CI','maxlength'=>'12']); ?>

            </div>
         
        </div>


        <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" align="center">
            <input type="hidden" name="id_moto" id="id_moto">
            <!--img src="" id="foto"-->
            <?php echo Form::label('Seleccione Una Foto:'); ?> <br>
            <img id="logo" src="" title="Cargar Imagen" onclick="cargarImagen(this, 1)" style="cursor: pointer;" class="img-circle"><br>
            <input type="hidden" name="imagen" id="imagen" class="img-circle">
        </div>
<br><br><br><br><br><br><br><br><br><br><br><br>


        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

            <div class="form-group">
                <?php echo Form::label('celular','Celular:'); ?>

                <?php echo Form::text('celular',null,['id'=>'celular','class'=>'form-control','placeholder'=>'Ingrese el celular','maxlength'=>'8']); ?>

                <input type="hidden" name="celular_aux" id="celular_aux">
            </div>
            <div class="form-group">
                <?php echo Form::label('email','Email:'); ?>

                <?php echo Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingrese el email']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('marca','Marca & Modelo:'); ?>

                <?php echo Form::text('marca',null,['id'=>'marca','class'=>'form-control','placeholder'=>'Ingrese la marca']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('modelo','Año:'); ?>

                <?php echo Form::text('modelo',null,['id'=>'modelo','class'=>'form-control','placeholder'=>'Ingrese el modelo','maxlength'=>'4', 'onkeypress'=>'return bloqueo_de_punto(event)']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('placa','Placa:'); ?>

                <?php echo Form::text('placa',null,['id'=>'placa','class'=>'form-control','placeholder'=>'Ingrese la placa','maxlength'=>'10']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('color','Color:'); ?>

                <?php echo Form::text('color',null,['id'=>'color','class'=>'form-control','placeholder'=>'Ingrese la color']); ?>

            </div>    
            <div class="form-group">
                <?php echo Form::label('direccion','Direccion:'); ?>

                <?php echo Form::text('direccion',null,['id'=>'direccion','class'=>'form-control','placeholder'=>'Ingrese la direccion']); ?>

            </div>   

            <div class="form-group">
                <?php echo Form::label('telefono','Telefono:'); ?>

                <?php echo Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','placeholder'=>'Ingrese el telefono','maxlength'=>'15']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('referencia','Referencia:'); ?>

                <?php echo Form::text('referencia',null,['id'=>'referencia','class'=>'form-control','placeholder'=>'Ingrese la referencia']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('codigo','PIN:'); ?>

                <?php echo Form::text('codigo',null,['id'=>'codigo','class'=>'form-control','placeholder'=>'Ingrese el PIN','maxlength'=>'4']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('credito','Credito:'); ?>

                <?php echo Form::text('credito',null,['id'=>'credito','class'=>'form-control','placeholder'=>'Ingrese el credito','maxlength'=>'2',]); ?>

            </div>
            <div class="form-group" hidden="">
                <?php echo Form::label('latitud','Latitud:'); ?>

                <?php echo Form::text('latitud',null,['id'=>'latitud','class'=>'form-control','placeholder'=>'Ingrese la latitud']); ?>

            </div>
            <div class="form-group" hidden="">
                <?php echo Form::label('longitud','Longitud:'); ?>

                <?php echo Form::text('longitud',null,['id'=>'longitud','class'=>'form-control','placeholder'=>'Ingrese la longitud']); ?>

            </div>    
              <div class="form-group">
                <?php echo Form::label('estado','Estado:'); ?>

                <?php echo Form::select('estado', array('0' => 'INACTIVO', '1' => 'ACTIVO', '2' => 'CARRERA','5' => 'BLOQUEADO'),null,array('id'=>'estado','class'=>'form-control','disabled')); ?>                
            </div>
            <div class="form-group">
                <?php echo Form::label('login','Login:'); ?>

                <?php echo Form::select('login', array('0' => 'DESCONECTADO', '1' => 'CONECTADO'),null,array('id'=>'login','class'=>'form-control','disabled')); ?>                
            </div>
            <div class="form-group" hidden="">
                <?php echo Form::label('token','Token:'); ?>

                <?php echo Form::text('token',null,['id'=>'token','class'=>'form-control','placeholder'=>'Ingrese el token']); ?>

            </div>            
        </div>

  </div>

  <div class="modal-footer">
  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
      <button type="button" data-dismiss="modal"  class="btn btn-danger">SALIR</button>
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
      <?php echo Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_actualizar','onclick'=>'btn_esconder()']); ?>

      <?php echo Form::close(); ?>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right">
      <a id="ruta" class='btn btn-warning' href=''>CARRERAS</a>      
    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right" id="div_desbloq">
    <?php echo e(Form::open(array('url' => 'Desbloquear_Motista'))); ?>  
      <input type="hidden" name="id_moto_desbloq" id="id_moto_desbloq">
      <input type="hidden" name="token_desbloq" id="token_desbloq">    
      <button type="submit" id="btn_desbloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#58ACFA;color:white">DESBLOQUEAR</button> 
    <?php echo Form::close(); ?>

    </div>

    <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right" id="div_bloq">
    <?php echo e(Form::open(array('url' => 'Bloquear_Motista'))); ?>  
      <input type="hidden" name="id_moto_bloq" id="id_moto_bloq">
      <input type="hidden" name="token_bloq" id="token_bloq">    
      <button type="submit" id="btn_bloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#F7819F;color: white">BLOQUEAR</button> 
    <?php echo Form::close(); ?>

    </div>


    </div>

  </div>
    </div>
  </div>
</div>


<!--//////////////////////////////////-->
<!--MODAL DE ENVIAR NOTIFICACIONES-->
<!--//////////////////////////////////-->
<div class="modal fade" id="ModalNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>ENVIAR NOTIFICAION</b></h3>
      </div>

      <div class="modal-body">
    <?php echo e(Form::open(array('url' => 'notificacion_motista'))); ?>  
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
              <input type="hidden" name="token_not" id="token_not">
              
              <div class="form-group">
                  <?php echo Form::label('detalle','Mensaje:'); ?>

                  <?php echo Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'5','placeholder'=>'Ingrese el mensaje']); ?>

              </div>  
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <b>Nombre:</b> <font id="nombre_not" size="3"></font> <br>
          <b>CI:</b> <font id="ci_not" size="3"></font> <br>
          <b>Placa:</b> <font id="placa_not" size="3"></font> <br>
          <b>Modelo:</b> <font id="modelo_not" size="3"></font> <br>
          <b>Color:</b> <font id="color_not" size="3"></font> 
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" align="center">
            <input type="hidden" name="id_moto_not" id="id_moto_not">
            <img id="logo_not" src="" class="img-circle"/>      
      </div>

  </div>

  <div class="modal-footer">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"> <br> 
      <?php echo Form::submit('ENVIAR',['class'=>'btn btn-primary','id'=>'btn_notificacion','onclick'=>'btn_esconder()']); ?>

      <?php echo Form::close(); ?>

          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
    </div>
  </div>
    </div>
  </div>
</div>


<!--//////////////////////////////////-->
<!--MODAL PAGO DE MOTISTA-->
<!--//////////////////////////////////-->
<div class="modal fade" id="ModalPagarMoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
          <h3 class="modal-title"><b>PAGO DEL MOTISTA</b></h3>
      </div>

      <div class="modal-body">
  <?php echo Form::open(['route'=>['pago_motista.store','null'],'method'=>'POST', 'onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;' ]); ?>   

  <?php //{!!Form::open(array('url'=>'actualizar_pago_motista','method'=>'GET'))!!} //ESTA ES LA FORMA DE MANDAR A UNA FINCION MEDIANTE LOS FORM OPEN?>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
  <input type="hidden" name="id_moto_pag" id="id_moto_pag">
        <label>CODIGO</label> <br>
        <?php $codigo=DB::select("SELECT count(*)as contador from pago_motista"); 
        $codigo=$codigo[0]->contador+1;
        echo "<font size=6>".$codigo."</font>";?>   
        <input type="hidden" name="codigo_fac" id="codigo_fac" value="<?php echo e($codigo); ?>"><br>
        <input type="hidden" name="id_moto_fac" id="id_moto_fac">
  </div>
<input type="hidden" name="id_admin" id="id_admin" value="<?php echo e(Auth::user()->id); ?>">
        
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
        <label>MONTO A PAGAR</label><br>
        <font size="6" id="monto_pagar"></font> <font size="4"> Bs.</font> <br>
        <input type="hidden" name="monto_aux" id="monto_aux">         
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            <?php echo Form::label('monto','MONTO TOTAL:'); ?> 
            <?php echo Form::text('monto',null,['id'=>'monto','class'=>'form-control','maxlength'=>'6','placeholder'=>'Ingrese el monto total', 'onkeypress'=>'return numerosmasdecimal(event)']); ?>

        </div> 
  </div>
<table border="1" hidden="">
  <thead>
  <td align="center">ID</td>
  <td align="center">MONTO</td>
  </thead>
  <tbody id="body_pagar">
  </tbody>
</table>

  </div>

  <div class="modal-footer">
      <?php echo Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_pagar','onclick'=>'ocultar()']); ?>

      <?php echo Form::close(); ?>

          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
  </div>
    </div>
  </div>
</div>



<!--//////////////////////////////////-->
<!--MODAL BLOQUEAR MOTIOSTA-->
<!--//////////////////////////////////-->

<?php /*
<div class="modal fade" id="ModalBloquearMoto" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-md" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>BLOQUEAR MOTISTA</b></h3>
      </div>

      <div class="modal-body">
    {{Form::open(array('url' => 'Bloquear_Motista'))}}  
      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" align="center">
            <input type="hidden" name="id_moto_bloq" id="id_moto_bloq">
            <img id="logo_bloq" src="" class="img-circle"/>      
      </div>

      <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
          <b>Nombre:</b> <font id="nombre_bloq" size="3"></font> <br>
          <b>CI:</b> <font id="ci_bloq" size="3"></font> <br>
          <b>Placa:</b> <font id="placa_bloq" size="3"></font> <br>
          <b>Modelo:</b> <font id="modelo_bloq" size="3"></font> <br>
          <b>Color:</b> <font id="color_bloq" size="3"></font> <br>
          <input type="hidden" name="token_bloq" id="token_bloq">
      </div>
  </div>

  <div class="modal-footer">
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12" align="right">
      {!!Form::submit('BLOQUEAR',['class'=>'btn btn-primary','id'=>'btn_bloquear','onclick'=>'btn_esconder()'])!!}
      {!!Form::close()!!}
          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
    </div>      
  </div>
    </div>
  </div>
</div>
*/ ?>


<!--//////////////////////////////////-->
<!--MODAL DETALLE DE LAS CARRERAR-->
<!--//////////////////////////////////-->
<?php /*
<div class="modal fade" id="ModalDetalleCarrera" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
          <h3 class="modal-title"><b>HISTORIAL DE CARRERA</b></h3>
      </div>

      <div class="modal-body">
        <table class="table table-striped table-bordered table-condensed table-hover">
          <tbody align="center" id="body_historial_detalle">
          </tbody>
        </table>
            <script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ">
    </script>
      </div>

  <div class="modal-footer">
      <button data-dismiss="modal"  class="btn btn-danger">SALIR</button>
  </div>
    </div>
  </div>
</div>
*/ ?>