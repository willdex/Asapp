$(document).ready(function(){
    $('#mostrar').hide();
    CargarListaEmpresa();
});


function CargarListaEmpresa(){
  $('#loading').css("display","block");          
  var tabladatos=$("#body_empresa");
  $.get("cargar_lista_empresa_paga", function (res) {
    $('#body_empresa').empty();                   
    $(res).each(function (key, value) {        
      if (value.dias >= 40) {
          color='#F5A9A9';
      } else {
          color='#F2F5A9';              
      }     
        tabladatos.append("<tr align=center style='background:"+color+"'><td>"+value.nombre+"</td><td>"+value.telefono+"</td><td>"+value.razon_social+"</td><td>"+value.nit+"</td><td>"+value.administrador+"</td><td>"+value.credito+" Bs.</td>\n\
        <td><button class='btn btn-success' data-toggle='modal' data-target='#ModalPagoEmpresa' onclick='CargarPagoEmpresa("+value.id+")'>PAGAR</button></td></tr>");                            
    });
    $('#loading').css("display","none");          
  });
}

//CUANDO SELECCIONA EN EL COMBO BOX
$("#buscar_empresa").change(function(event){
    $('#loading').css("display","block");          
    var id_empresa = $("#buscar_empresa").val();   
    if (id_empresa == "") {
          $('#body_empresa').empty();                           
          $('#loading').css("display","none");          
    } else {
        var tabladatos=$("#body_empresa");
        $.get("cargar_empresa_paga/"+id_empresa, function (res) {
          $('#body_empresa').empty();                   
          $(res).each(function (key, value) {  
            if (value.dias >= 40) {
                color='#F5A9A9';
            } else {
                if (value.dias >=30) {
                  color='#F2F5A9';                  
                } else {
                  color='white';
                }            
            } 
            tabladatos.append("<tr align=center style='background:"+color+"'><td>"+value.nombre+"</td><td>"+value.telefono+"</td><td>"+value.razon_social+"</td><td>"+value.nit+"</td><td>"+value.administrador+"</td><td>"+value.credito+" Bs.</td>\n\
                <td><button class='btn btn-success' data-toggle='modal' data-target='#ModalPagoEmpresa' onclick='CargarPagoEmpresa("+value.id+")'>PAGAR</button></td></tr>");              
            $('#loading').css("display","none");          
          });
          $('#mostrar').show();          
        });
    }
});

var cont = 0;
var id_pedido = [];
var monto_pag= [];
function CargarPagoEmpresa(id){
  $('#loading').css("display","block");          
  $("#btn_pagar").hide();
    $("#id_empresa").val(id);
    $.get('cargar_pago_empresa/'+id , function (response) { 
        $("#monto_pagar").text(response[0].monto_empresa);
        $("#monto_aux").val(response[0].monto_empresa);        
        if (isNaN(parseFloat(response[0].monto_empresa))) {
          $("#btn_pagar").hide();    
          $("#monto_pagar").text(0);      
        } else {
          $("#btn_pagar").show();          
        }
    });
//CARGAR TABLA PARA PAGAR A OS MOTISTAS   
    $('#body_pagar').empty();
    var tabladatos = $('#body_pagar');
    var route = "cargar_lista_empresa/"+id;
    $.get(route, function (res) {
    $(res).each(function (key, value) {
          tabladatos.append('<tr align="center"><td><input name="id_pedido[]" id="id_pedido'+ cont +'" type=text size=3 value='+value.id+'></td>\n\
            <td><input name="monto_pag[]" id="monto_pag'+ cont +'" readonly="" type="text" size=3 onkeypress="return bloqueo_de_punto(event)" style="text-align:center" maxlength="6" value='+value.monto_empresa_aux+'></tr>');
            cont++;           
        });
      $('#loading').css("display","none");          
    });
}

function ocultar(){
    $("#btn_pagar").hide();
    $('#loading').css("display","block");
}