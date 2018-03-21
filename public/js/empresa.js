$(document).ready(function(){
    $('#mostrar').hide();   
    $('#loading').css("display","none");    
});

function CargarEmpresa(id){
    $('#loading').css("display","block");    
	$.get('cargar_empresa/'+id, function(response){       
        $("#id_empresa_not").val(response[0].id_empresa);
        $("#id_administrador_not").val(response[0].id_administrador);
        $("#empresa_not").text(response[0].nombre);
        $("#telefono_not").text(response[0].telefono);
        $("#nit_not").text(response[0].nit);
        $("#administrador_not").text(response[0].administrador);
        document.getElementById('logo_not').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA      
        $("#token_not").val(response[0].token);
        $('#loading').css("display","none");    
	});
}

$("#id_empres").change(function(event){
    $('#loading').css("display","block");    
    var id_moto = $("#id_empres").val();   
    if (id_moto == "") {
        $("#body_empresa").show();
        $("#mostrar").hide();     
        $('#body_empresa_2').empty();                                 
        $('#loading').css("display","none");    
    } else {
        var tabladatos=$("#body_empresa_2");
        $("#mostrar").show();
        $("#body_empresa").hide();
        $.get("cargar_empresa/"+id_moto, function (res) {
          $('#body_empresa_2').empty();                   
          $(res).each(function (key, value) {
            switch (value.estado) {
                case 1:                       
                    estado='ACTIVO';
                    break;
                case 2:                             
                    estado='BLOQUEADO';                                                                
                break;                                                  
            }     
            tabladatos.append("<tr align=center ><td>"+value.nombre+"</td><td>"+value.telefono+"</td><td>"+value.razon_social+"</td><td>"+value.nit+"</td><td>"+value.credito+" Bs.</td><td>"+value.administrador+"</td><td>"+estado+"</td>\n\
                <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalEmpresa' onclick='CargarEmpresa("+value.id+")'>VER MAS</button>\n\
                <button class='btn btn-info' data-toggle='modal' data-target='#ModalNotificacionEmpresa' onclick='CargarEmpresa("+value.id+")'>NOTIFICACION</button></td></tr>");              
          });
          //<a class='btn btn-warning' href='empresa/"+value.id+"'>CARRERAS</a>
        $('#loading').css("display","none");    
        });
    }
});

function ver_todos(){
    $('#body_empresa_2').empty();                       
    $("#body_empresa").show();   
    $("#mostrar").hide();            
}






