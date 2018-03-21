$(document).ready(function(){
switch (parseInt($("#sw").val())) {
  case 1:
    CargarReporteMoto();
    break;
  case 2:
    CargarReporteEmpresa();
    break;
  case 3:
    CargarGastos();
    break;    
}    
});

//REPORTE EMPRESA  CON MAS PEDIDOS 
function CargarReporteEmpresa(){
  var tabladatos=$("#body_lista_empresa");
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
      alertify.alert("ERROR",'INTRODUSCA LAS 2 FECHAS');
    } else{
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
          alertify.alert("ERROR",'LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN');
          $('#body_lista_empresa').empty();                   
        }else{
          $('#loading').css("display","block");    
          route = "lista_empresa_com_mas_pedidos/"+fecha_inicio+"/"+fecha_fin;
          $.get(route, function (res) {
            $('#body_lista_empresa').empty();                   
            $(res).each(function (key, value) {     
              tabladatos.append("<tr align=center style='font-size: 17px'><td>"+value.nombre+"</td><td>"+value.pedidos+"</td><td>"+value.monto_empresa+" Bs.</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }
}

//REPORTE MOTISTA  CON MAS PEDIDOS 
function CargarReporteMoto(){
  var tabladatos=$("#body_lista_moto");
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
      alertify.alert("ERROR",'INTRODUSCA LAS 2 FECHAS');
    } else{
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
          alertify.alert("ERROR",'LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN');
          $('#body_lista_moto').empty();                             
        }else{
          $('#loading').css("display","block");    
          route = "lista_motista_com_mas_pedidos/"+fecha_inicio+"/"+fecha_fin;
          $.get(route, function (res) {
            $('#body_lista_moto').empty();                   
            $(res).each(function (key, value) {     
              tabladatos.append("<tr align=center style='font-size: 17px'><td>"+value.motista+"</td><td>"+value.pedidos+"</td><td>"+value.monto_motista+" Bs.</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }
}

function CargarGastos(){
  var tabladatos=$("#body_lista_gastos");
  var fecha_inicio = $("#fecha_inicio").val();
  var fecha_fin = $("#fecha_fin").val();
  if (fecha_inicio == "" || fecha_fin == "") {
      alertify.alert("ERROR",'INTRODUSCA LAS 2 FECHAS');
    } else{
        var primera = Date.parse(fecha_inicio); 
        var segunda = Date.parse(fecha_fin); 
        if (primera > segunda) {
          alertify.alert("ERROR",'LA FECHA INICIO TIENE QUE SER MAYOR QUE LA FECHA FIN');
          $('#body_lista_gastos').empty();                             
        }else{
          $('#loading').css("display","block");    
          route = "lista_de_gastos/"+fecha_inicio+"/"+fecha_fin;
          $.get(route, function (res) {
            $('#body_lista_gastos').empty();                   
            $(res).each(function (key, value) {     
              tabladatos.append("<tr align=center style='font-size: 17px'><td style='font-size:30px; background: #E6F8E0'>"+value.monto_empresa+" Bs.</td>\n\
                <td style='font-size:30px; background: #E0F2F7'>"+value.monto_moto+" Bs.</td>\n\
                <td style='font-size:30px; color: red; background: #FBEFEF'>"+value.monto_total+" Bs.</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }  
}