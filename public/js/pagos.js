$(document).ready(function(){
    $('#mostrar').hide();
    if (parseInt($("#sw").val()) == 2) {
      CargarPagoEmpresa();
    } 
    if (parseInt($("#sw").val()) == 1) {
      CargarPagoMoto();
    }         
});

function CargarPagoEmpresa(){
  codigo = $("#codigos").val("");  
  var tabladatos=$("#body_pago_empresa");
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
          var id_empresa = $("#buscar_empresa").val();             
          if (id_empresa == 0) {
            route = "buscar_pagos_todas_las_empresas/"+fecha_inicio+"/"+fecha_fin;
          } else {
            route = "buscar_pagos_por_empresas/"+id_empresa+"/"+fecha_inicio+"/"+fecha_fin;            
          }
          $.get(route, function (res) {
            $('#body_pago_empresa').empty();                   
            $(res).each(function (key, value) {     
              tabladatos.append("<tr align=center ><td>"+value.codigo+"</td><td>"+value.empresa+"</td><td>"+value.fecha_pedido+"</td><td>"+value.monto+"</td><td>"+value.administrador+"</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }
}

function CargarPagoMoto(){
  codigo = $("#codigos").val("");  
  var tabladatos=$("#body_pago_moto");
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
          var id_moto = $("#buscar_moto").val();             
          if (id_moto == 0) {
            route = "buscar_pagos_todas_las_motos/"+fecha_inicio+"/"+fecha_fin;
          } else {
            route = "buscar_pagos_por_moto/"+id_moto+"/"+fecha_inicio+"/"+fecha_fin;            
          }
          $.get(route, function (res) {
            $('#body_pago_moto').empty();                   
            $(res).each(function (key, value) {     
              tabladatos.append("<tr align=center ><td>"+value.codigo+"</td><td>"+value.motista+"</td><td>"+value.fecha_pedido+"</td><td>"+value.monto+"</td><td>"+value.administrador+"</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }
}

$(document).keypress(function(e){
  codigo = $("#codigos").val();    
  if (!isNaN(parseInt($("#codigos").val()))) {
     if (e.which==13) {
      $('#loading').css("display","block");         
      if (parseInt($("#sw").val()) == 2) {
        $('#body_pago_empresa').empty();                   
        var tabladatos=$("#body_pago_empresa");
        route ="buscar_pagos_empresa_codigo/"+codigo; 
        $.get( route, function (response) { 
            tabladatos.append("<tr align=center ><td>"+response[0].codigo+"</td><td>"+response[0].empresa+"</td><td>"+response[0].fecha_pedido+"</td><td>"+response[0].monto+"</td><td>"+response[0].administrador+"</td></tr>");
        });
        $('#loading').css("display","none");         
      }
      if (parseInt($("#sw").val()) == 1) {
        $('#body_pago_moto').empty();                   
        var tabladatos=$("#body_pago_moto");
        route ="buscar_pagos_moto_codigo/"+codigo; 
        $.get( route, function (response) { 
            tabladatos.append("<tr align=center ><td>"+response[0].codigo+"</td><td>"+response[0].motista+"</td><td>"+response[0].fecha_pedido+"</td><td>"+response[0].monto+"</td><td>"+response[0].administrador+"</td></tr>");
        });
        $('#loading').css("display","none");         
      }     
     }
  }
});

$("#buscar_empresa").change(function(event){
    $("#codigos").val("");
});

$("#buscar_moto").change(function(event){
    $("#codigos").val("");
});