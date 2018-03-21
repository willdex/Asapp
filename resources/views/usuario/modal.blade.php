
<!--ACTUALIZAR USUAIRO-->
<div class="modal fade" id="ModalUsuario" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>PERFIL DEL USUARIO</b></h3>
      </div>

      <div class="modal-body">
  {!!Form::open(['route'=>['usuario.update','null'],'method'=>'PUT', 'enctype'=>'multipart/form-data','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}  
<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
    <div class="form-group">
        {!!Form::label('nombre','Nombre:')!!}
        {!!Form::text('nombre',null,['id'=>'nombre','class'=>'form-control','placeholder'=>'Ingrese el nombre'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('apellido','Apellido:')!!}
        {!!Form::text('apellido',null,['id'=>'apellido','class'=>'form-control','placeholder'=>'Ingrese los apellidos'])!!}
    </div>
    <div class="form-group">
        {!!Form::label('telefono','Telefono:')!!}
        {!!Form::text('telefono',null,['id'=>'telefono','class'=>'form-control','maxlength'=>'8','placeholder'=>'Ingrese el telefono', 'onkeypress'=>'return bloqueo_de_punto(event)'])!!}
    </div>
    <input type="hidden" name="telefono_aux" id="telefono_aux">
</div>

<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12" align="center">
    <input type="hidden" name="id_user" id="id_user">
    {!!Form::label('Seleccione Una Foto:')!!} <br>
    <img id="foto" src="" title="Cambiar Imagen" onclick="cargarImagen(this, 1)" style="cursor: pointer;" class="img-circle">
    {!!Form::hidden('imagen',null,['id'=>'imagen','class'=>'form-control','placeholder'=>'Ingrese el imagen'])!!}
</div>
<br><br><br><br><br><br><br><br><br><br><br><br>

    <div class="form-group">
        {!!Form::label('id_empresa','Empresa:')!!}
        {!!Form::select('id_empresa',$id_empresa,null,array('id'=>'id_empresa','class'=>'form-control'))!!}
    </div>
    
    <div class="form-group">
        {!!Form::label('email','Email:')!!}
        {!!Form::text('email',null,['id'=>'email','class'=>'form-control','placeholder'=>'Ingrese el email'])!!}
    </div>

    <div class="form-group">
        {!!Form::label('estado','Empresa:')!!}
        {!!Form::select('estado',array('1'=>'ACTIVO','2'=>'BLOQUEADO','3'=>'BAJA'),null,array('id'=>'estado','class'=>'form-control','disabled'))!!}
    </div>

    <div class="form-group" hidden="">
        {!!Form::label('latitud','Latitud:')!!}
        {!!Form::text('latitud',null,['id'=>'latitud','class'=>'form-control','placeholder'=>'Ingrese la latitud'])!!}
    </div>
    <div class="form-group" hidden="">
        {!!Form::label('longitud','Longitud:')!!}
        {!!Form::text('longitud',null,['id'=>'longitud','class'=>'form-control','placeholder'=>'Ingrese la longitud'])!!}
    </div>
    <div class="form-group" hidden="">
        {!!Form::label('id_casa','ID Casa:')!!}
        {!!Form::text('id_casa',null,['id'=>'id_casa','class'=>'form-control','placeholder'=>'Ingrese el id_casa'])!!}
    </div>
    <div class="form-group" hidden="">
        {!!Form::label('id_trabajo','ID Trabajo:')!!}
        {!!Form::text('id_trabajo',null,['id'=>'id_trabajo','class'=>'form-control','placeholder'=>'Ingrese el id_trabajo'])!!}
    </div>                    

  </div>

    <div class="modal-footer">
      <div class="pull-right">
        <a id="ruta" class='btn btn-warning' href=''>CARRERAS</a>              

      {!!Form::submit('ACTUALIZAR',['class'=>'btn btn-primary','id'=>'btn_actualizar','onclick'=>'btn_esconder()'])!!}
    {!!Form::close()!!}
          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
      </div>
      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right" id="div_desbloq">
      {{Form::open(array('url' => 'Desbloquear_Usuario'))}}  
        <input type="hidden" name="id_usuario_desbloq" id="id_usuario_desbloq">
        <input type="hidden" name="token_desbloq" id="token_desbloq">    
        <button type="submit" id="btn_desbloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#58ACFA;color:white">DESBLOQUEAR</button> 
      {!!Form::close()!!}
      </div>

      <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12 pull-right" id="div_bloq">
      {{Form::open(array('url' => 'Bloquear_Usuario'))}}  
        <input type="hidden" name="id_usuario_bloq" id="id_usuario_bloq">
        <input type="hidden" name="token_bloq" id="token_bloq">    
        <button type="submit" id="btn_bloquear" onclick='btn_esconder()' class="btn btn-default" style="background:#F7819F;color:white">BLOQUEAR</button> 
      {!!Form::close()!!}
      </div>

    </div>
    </div>
  </div>
</div>

<!--//////////////////////////////////-->
<!--MODAL DE ENVIAR NOTIFICACIONES-->
<!--//////////////////////////////////-->
<div class="modal fade" id="ModalUsuarioNotificacion" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
        <h3 id="titulogalpon" class="modal-title"><b>ENVIAR NOTIFICAION</b></h3>
      </div>

      <div class="modal-body">
    {{Form::open(array('url' => 'notificacion_usuario'))}}   
      <div class="col-lg-5 col-md-5 col-sm-5 col-xs-12">
              <input type="hidden" name="token_not" id="token_not">
              <div class="form-group">
                  {!!Form::label('detalle','Mensaje:')!!}
                  {!!Form::textarea('detalle',null,['id'=>'detalle','class'=>'form-control','rows'=>'5','placeholder'=>'Ingrese el mensaje'])!!}
              </div>  
      </div>
      <div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
          <b>Usuario:</b> <font id="nombre_not" size="3"></font> <br>
          <b>Telefono:</b> <font id="telefono_not" size="3"></font> <br>
          <b>Correo:</b> <font id="email_not" size="3"></font> <br>
          <b>Empresa:</b> <font id="empresa_not" size="3"></font> <br>
          <input type="hidden" name="id_usuario_not" id="id_usuario_not">
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
            <img id="logo_not" src="" class="img-circle"/>      
      </div>

  </div>

  <div class="modal-footer"> 
    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><br>
      {!!Form::submit('ENVIAR',['class'=>'btn btn-primary','id'=>'btn_notificacion','onclick'=>'btn_esconder()'])!!}
    {!!Form::close()!!}
          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
    </div>
  </div>
    </div>
  </div>
</div>