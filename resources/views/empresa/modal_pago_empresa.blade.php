<!--//////////////////////////////////-->
<!--MODAL PAGO DE EMPRESA-->
<!--//////////////////////////////////-->

<div class="modal fade" id="ModalPagoEmpresa" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" data-backdrop="static">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header" style="background: #3c8dbc; color: white">
          <h3 class="modal-title"><b>PAGO DE LA EMPRESA</b></h3>
      </div>

      <div class="modal-body">
  {!!Form::open(['route'=>['pago_empresa.store','null'],'method'=>'POST','onKeypress'=>'if(event.keyCode == 13) event.returnValue = false;'])!!}   

  <?php //{!!Form::open(array('url'=>'actualizar_pago_motista','method'=>'GET'))!!} //ESTA ES LA FORMA DE MANDAR A UNA FINCION MEDIANTE LOS FORM OPEN?>
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
        <label>CODIGO</label> <br>
        <?php $codigo=DB::select("SELECT count(*)as contador from pago_empresa"); 
        $codigo=$codigo[0]->contador+1;
        echo "<font size=6>".$codigo."</font>";?>   
        <input type="hidden" name="codigo" id="codigo" value="{{$codigo}}"><br>
        <input type="hidden" name="id_empresa" id="id_empresa">
  </div>
<input type="hidden" name="id_admin" id="id_admin" value="{{Auth::user()->id}}">
        
  <div class="col-lg-3 col-md-3 col-sm-3 col-xs-12" align="center">
        <label>MONTO A PAGAR</label><br>
        <font size="6" id="monto_pagar"></font> <font size="4"> Bs.</font> <br>
        <input type="hidden" name="monto_aux" id="monto_aux">         
  </div>

  <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
        <div class="form-group">
            {!!Form::label('monto','MONTO TOTAL:')!!} 
            {!!Form::text('monto',null,['id'=>'monto','class'=>'form-control','maxlength'=>'6','placeholder'=>'Ingrese el monto total', 'onkeypress'=>'return numerosmasdecimal(event)'])!!}
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
      {!!Form::submit('ACEPTAR',['class'=>'btn btn-primary','id'=>'btn_pagar','onclick'=>'ocultar()'])!!}
      {!!Form::close()!!}
          <!--button class="btn btn-primary"  onclick="crearalimento()" id="btnregistrar">REGISTRAR</button-->
      <button data-dismiss="modal"  class="btn btn-danger">CANCELAR</button>
  </div>
    </div>
  </div>
</div>
