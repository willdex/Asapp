
<!--MODAL DE ENVIAR NOTIFICACIONES-->
<div class="modal fade" id="ModalNotificacionEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>ENVIAR NOTIFICAION</b></h3>
      </div>

      <div class="modal-body">
    <?php echo e(Form::open(array('url' => 'notificacion_empresa'))); ?>       
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
              <input type="hidden" name="token_not" id="token_not">
              <div class="form-group">
                  <?php echo Form::label('detalle','Mensaje:'); ?>

                  <?php echo Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'5','placeholder'=>'Ingrese el mensaje']); ?>

              </div>  
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
          <b>Empresa:</b> <font id="empresa_not" size="3"></font> <br>
          <b>Telefono:</b> <font id="telefono_not" size="3"></font> <br>
          <b>NIT:</b> <font id="nit_not" size="3"></font> <br>
          <b>Administrador:</b> <font id="administrador_not" size="3"></font> 
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12" align="center">
            <input type="hidden" name="id_empresa_not" id="id_empresa_not">
            <input type="hidden" name="id_administrador_not" id="id_administrador_not">            
            <img id="logo_not" src="" class="img-circle"/>      
<br><br>
      </div>
  </div>

  <div class="modal-footer">
      <?php echo Form::submit('ENVIAR',['class'=>'btn btn-primary','id'=>'btn_notificacion','onclick'=>'btn_esconder()']); ?>

      <?php echo Form::close(); ?>

          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
  </div>
    </div>
  </div>
</div>



<!--MODAL DE CAMBIO DE ADMINISTRADOR-->
<div class="modal fade" id="ModalCambiarAdministrador" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>CAMBIAR ADMINISTRADOR</b></h3>
      </div>

      <div class="modal-body">
<?php echo e(Form::open(array('url' => 'actualizar_usuario'))); ?>  

        <select name="id_admin" class="form-control selectpicker" id="id_admin" data-live-search="true" >
         <option value="">BUSCAR...                                   </option>
            <?php foreach($usuario as $user): ?>
            <option value="<?php echo e($user->id); ?>"><?php echo e($user->nombre); ?> <?php echo e($user->apellido); ?> - <?php echo e($user->telefono); ?></option>
            <?php endforeach; ?>
        </select> <br>
          <center>
            <?php foreach($admin as $adm): ?>          
            <input type="hidden" name="telefono_cam" id="telefono_cam" value="*<?php echo e($adm->telefono); ?>">          
            <input type="hidden" name="id_empresa_cam" id="id_empresa_cam" value="">
            <input type="hidden" name="id_administrador_cam" id="id_administrador_cam" value="<?php echo e($adm->id); ?>"> 
            <?php endforeach; ?>                      
            <img id="logo_cam" src="" class="img-circle"/>         
        </center>
  </div>

  <div class="modal-footer">

      <?php echo Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_cambiar','onclick'=>'ucultar_boton()']); ?>

      <?php echo Form::close(); ?>

          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger" hidden="">CANCELAR</button>
  </div>
    </div>
  </div>
</div>


<!--//////////////////////////////////-->
<!--MODAL DETALLE DE LAS CARRERAR-->
<!--//////////////////////////////////-->

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
      </div>

  <div class="modal-footer">
      <button data-dismiss="modal"  class="btn btn-danger">SALIR</button>
  </div>
    </div>
  </div>
</div>
