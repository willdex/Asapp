$(document).ready(function(){
    $("#tabla_cancelado").hide();        
    var id_motista = $("#id_motista").val();
    BuscarHistorial(id_motista); 
});

////////////////////////////////////////////////////////////////////////////////
//////////////////HISTORIAL DE LAS CARRERAS DE LOS MOTISTAS/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
function BuscarHistorial(id_moto){
  var opcion=$('#opcion').val();
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
      alertify.alert("ERROR",'INTRODUSCA LAS 2 FECHAS');
    } else{
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
          alertify.alert("ERROR",'LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN');
        }else{
          $('#loading').css("display","block");   
          if (opcion == 0) {
            var tabladatos=$("#body_historial");            
            $("#tabla_cancelado").hide();      
            $('#body_historial_cancelado').empty();                   
            $("#tabla_completado").show();      
            var route = "../historial_carrera/"+id_moto+"/"+fecha_inicio+"/"+fecha_fin;
            $.get(route, function (res) {
              $('#body_historial').empty();                   
              $(res).each(function (key, value) {    
                if (value.puntuacion==0) {
                  ruta_img='../images/normal.png';
                }else{
                  if (value.puntuacion==1) {
                    ruta_img='../images/me_gusta.png';
                  } else {
                    ruta_img='../images/no_me_gusta.png';
                  }
                }  
                tabladatos.append("<tr align=center ><td>"+value.nombre_usuario+"</td><td>"+value.telefono+"</td><td>"+value.empresa+"</td><td>"+value.nombre_direccion+"</td><td>"+value.fecha_pedido+"</td><td><img src="+ruta_img+" width='25' height='25'></td><td>"+value.monto_motista+"</td>\n\
                  <td><button type='button' class='btn btn-info' data-toggle='modal' data-target='#ModalDetalleCarrera' onclick='CargarDetalleCarrera("+value.id+")'>Ver Mas</button></td></tr>");                                            
              });
                  $('#loading').css("display","none");   
            }); 

          } else {
            var tabladatos=$("#body_historial_cancelado");            
            $("#tabla_completado").hide();      
            $('#body_historial').empty();                   
            $("#tabla_cancelado").show();      
            var route = "../historial_carrera_cancelado/"+id_moto+"/"+fecha_inicio+"/"+fecha_fin;
            $.get(route, function (res) {
              $('#body_historial_cancelado').empty();                   
              $(res).each(function (key, value) {    
              tabladatos.append("<tr align=center ><td>"+value.usuario+"</td><td>"+value.telefono+"</td><td>"+value.nombre+"</td><td>"+value.telefono_empresa+"</td><td>"+value.fecha_pedido+"</td></tr>");                                            
            });
            $('#loading').css("display","none");   
            });             
          }
        }      
    }
}

function CargarDetalleCarrera(id_pedido){
  $('#loading').css("display","block");   
  var contador=1;
  var tabladatos=$("#body_historial_detalle");  
  var route = "../historial_carrera_detalle/"+id_pedido;
  $.get(route, function (res) {
    $('#body_historial_detalle').empty();                   
    $(res).each(function (key, value) {    
      /*tabladatos.append("<tr align=center><td><font size=4><b>"+contador+"</b></font></td><td><font size=4>Fecha: <b>"+value.fecha_pedido+"</b></font></td><td><font size=4>Monto: <b>"+value.monto+" Bs.</b></font></td>\n\
        <td><a class='btn btn-info' href='"+value.ruta+"&key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ' target='_blank'>VER MAPA</a></td></tr>"); */
      tabladatos.append("<tr align=center><td><font size=4><b>"+contador+"</b></font></td><td><font size=4>Fecha: <b>"+value.fecha_pedido+"</b></font></td><td><font size=4>Monto: <b>"+value.monto+" Bs.</b></font></td></tr>\n\
          <tr><td colspan=3><img src='"+value.ruta+"&key=AIzaSyAE5wxnO359aqjF2EWWIs9qqLenJjg-9vQ' class='img-responsive'></td></tr>");
          contador++;      
    });
    $('#loading').css("display","none");   
  });    
}


