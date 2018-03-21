
<!--MODAL DE VER  TARIFA-->
<div class="modal fade" id="ModalTarifa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 class="modal-title"><b>ACTUALIZAR TARIFA</b></h3>
      </div>

      <div class="modal-body">
  <?php echo Form::open(['route'=>['tarifa.update','null'],'method'=>'PUT','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;']); ?>   
  <input type="hidden" name="id_tarifa" id="id_tarifa">
            <div class="form-group">
                <?php echo Form::label('distancia','Distancia:'); ?>

                <?php echo Form::text('distancia',null,['id'=>'distancia','class'=>'form-control','placeholder'=>'Ingrese la distancia','maxlength'=>'5', 'onkeypress'=>'return bloqueo_de_punto(event)']); ?>

            </div>
            <div class="form-group">
                <?php echo Form::label('monto','Monto:'); ?>

                <?php echo Form::text('monto',null,['id'=>'monto','class'=>'form-control','placeholder'=>'Ingrese el monto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)']); ?>

            </div>
            <div class="form-group" hidden="">
                <?php echo Form::label('porcentaje_moto','Porcentaje Moto:'); ?>

                <?php echo Form::text('porcentaje_moto',null,['id'=>'porcentaje_moto','class'=>'form-control','placeholder'=>'Ingrese el porcentaje moto','maxlength'=>'2', 'onkeypress'=>'return bloqueo_de_punto(event)']); ?>

            </div>

            <div class="form-group" hidden="">
                <?php echo Form::label('costo_fijo_moto','Costo Fijo Moto:'); ?>

                <?php echo Form::text('costo_fijo_moto',null,['id'=>'costo_fijo_moto','class'=>'form-control','placeholder'=>'Ingrese el coato fijo moto','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)']); ?>

            </div>

            <div class="form-group" hidden="">
                <?php echo Form::label('porcentaje_empresa','Porcentaje Empresa:'); ?>

                <?php echo Form::text('porcentaje_empresa',null,['id'=>'porcentaje_empresa','class'=>'form-control','placeholder'=>'Ingrese el porcentaje empresa','maxlength'=>'2', 'onkeypress'=>'return bloqueo_de_punto(event)']); ?>

            </div>

            <div class="form-group" hidden="">
                <?php echo Form::label('gasto_fijo_empresa','Gasto Fijo Empresa:'); ?>

                <?php echo Form::text('gasto_fijo_empresa',null,['id'=>'gasto_fijo_empresa','class'=>'form-control','placeholder'=>'Ingrese el gasto fijo empresa','maxlength'=>'4', 'onkeypress'=>'return numerosmasdecimal(event)']); ?>

            </div>

            <div class="form-group" hidden="">
                <?php echo Form::label('impuesto','Impuesto:'); ?>

                <?php echo Form::text('impuesto',null,['id'=>'impuesto','class'=>'form-control','placeholder'=>'Ingrese el impuesto','maxlength'=>'2', 'onkeypress'=>'return bloqueo_de_punto(event)']); ?>

            </div>            
      </div>

    <div class="modal-footer">
        <?php echo Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_actualizar','onclick'=>'btn_esconder()']); ?>

        <?php echo Form::close(); ?>

        <!--button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacion">NOTIFICACION</button-->
        <button data-dismiss="modal"  class="btn btn-danger">SALIR</button>
    </div>
  </div>

    </div>
  </div>




<!--MODAL ELIMINAR TARIFA-->
<div class="modal fade" id="ModalEliminarTarifa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-xs" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 class="modal-title"><b>TARIFA</b></h3>
      </div>

      <div class="modal-body">
  <?php echo Form::open(['route'=>['tarifa.destroy','null'],'method'=>'DELETE']); ?>  
        <h2 align="center">¿ DESEA ELIMINAR ESTA TARIFA ?</h2> 
          <input type="hidden" name="id_tarifa_eli" id="id_tarifa_eli">

      </div>

    <div class="modal-footer">
        <?php echo Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_eliminar','onclick'=>'btn_esconder()']); ?>

        <?php echo Form::close(); ?>

        <!--button class="btn btn-info" data-toggle="modal" data-target="#ModalNotificacion">NOTIFICACION</button-->
        <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
    </div>
  </div>

    </div>
  </div>