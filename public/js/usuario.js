$(document).ready(function(){
    if (isNaN($("#imagen").val())) {
        document.getElementById('logo').src = $("#imagen").val();               
    }                  
    $('#mostrar').hide();    
    $('#loading').css("display","none");    
});

function CargarUsuario(id){
    $('#loading').css("display","block");  
    $.get('cargar_usuario/'+id, function(response){
        $("#btn_actualizar").show(); 
        switch (response[0].estado) {
            case 1:
                $("#div_desbloq").hide();  
                $("#div_bloq").show(); 
                break;
            case 2:
                $("#div_bloq").hide();
                $("#div_desbloq").show();                   
                break;   
            case 3:
                $("#div_desbloq").hide();  
                $("#div_bloq").hide(); 
                $("#btn_actualizar").hide(); 
                break;                                           
        }
        $("#id_user").val(response[0].id);        
        $("#nombre").val(response[0].nombre);
        $("#apellido").val(response[0].apellido);
        $("#telefono").val(response[0].telefono);
        $("#telefono_aux").val(response[0].telefono);
        $("#email").val(response[0].email);
        $("#id_empresa").val(response[0].id_empresa);
        $("#latitud").val(response[0].latitud);
        $("#longitud").val(response[0].longitud);
        $("#id_casa").val(response[0].id_casa);
        $("#id_trabajo").val(response[0].id_trabajo);
        $("#imagen").val(response[0].imagen);
        $("#token").val(response[0].token);
        $("#estado").val(response[0].estado);
        //document.getElementById('foto').src = 'data:image/jpeg;base64,'+response[0].imagen;
        document.getElementById('foto').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA

        //CARGA A LO DE NOTIFICACION        
        document.getElementById('logo_not').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA
        $("#id_usuario_not").val(response[0].id); 
        $("#nombre_not").text(response[0].nombre+" "+response[0].apellido); 
        $("#telefono_not").text(response[0].telefono); 
        $("#email_not").text(response[0].email); 
        $("#empresa_not").text(response[0].nombre_emp); 
        $("#id_empresa_not").text(response[0].id_empresa); 
        $("#token_not").val(response[0].token);  

        //CARGA LOS DATOS EN EL FORMULARIO DESBLOQEAR
        $("#id_usuario_desbloq").val(response[0].id); 
        $("#token_desbloq").val(response[0].token);

        //CARGA LOS DATOS EN EL FORMULARIO BLOQEAR
        $("#id_usuario_bloq").val(response[0].id); 
        $("#token_bloq").val(response[0].token);                      
        $('#loading').css("display","none");    
    });
        //CARGAR LA URL DE CARRERA USUARIO
    document.getElementById('ruta').href = 'usuario/'+id;    
}

$("#id_usuario").change(function(event){
    $('#loading').css("display","block");        
    var id_user = $("#id_usuario").val();    
    if (id_user == "") {
        $("#body_user").show();
        $("#mostrar").hide(); 
        $('#body_user_2').empty();                                     
        $('#loading').css("display","none");              
    } else {
        var tabladatos=$("#body_user_2");
        $("#mostrar").show();
        $("#body_user").hide();
        $.get("buscar_usuario/"+id_user, function (res) {
          $('#body_user_2').empty();                   
          $(res).each(function (key, value) {  
            switch (value.estado) {
                case 1:
                    estado='ACTIVO';
                    break;
                case 2:
                    estado='BLOQUEADO';
                    break;   
                case 3:
                    estado='BAJA';
                    break;                                           
            }      
            if (value.estado == 3) {
                tabladatos.append("<tr align=center ><td>"+value.nombre_user+"</td><td>"+value.apellido+"</td><td>"+value.telefono+"</td><td>"+value.email+"</td><td>"+value.nombre_emp+"</td><td>"+estado+"</td>\n\
                <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalUsuario' onclick='CargarUsuario("+value.id+")'>VER MAS</button></td></tr>");              
            } else {
                tabladatos.append("<tr align=center ><td>"+value.nombre_user+"</td><td>"+value.apellido+"</td><td>"+value.telefono+"</td><td>"+value.email+"</td><td>"+value.nombre_emp+"</td><td>"+estado+"</td>\n\
                <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalUsuario' onclick='CargarUsuario("+value.id+")'>VER MAS</button>\n\
                <button class='btn btn-info' data-toggle='modal' data-target='#ModalUsuarioNotificacion' onclick='CargarUsuario("+value.id+")'>NOTIFICACION</button></td></tr>");              
            }
          });
          //<a class='btn btn-warning' href='usuario/"+value.id+"'>CARRERAS</a>
            $('#loading').css("display","none");              
        });

    }
});

function ver_todos(){
    $('#loading').css("display","block");        
    $('#body_user_2').empty();                       
    $("#body_user").show();   
    $("#mostrar").hide();            
    $('#loading').css("display","none");    
}

function ver(){
var ver = $("#files").val();
    alert(ver);
}

//PARA CARGAR LA IMAGEN CON CANVA
var imagenAModificar;
function cargarImagen(input, tipo) {
    if (tipo === 1 || tipo === "1") {
        imagenAModificar = $(input);
        $("body").append("<input type='file' name='fotocargar' onchange='cargarImagen(this,2)' id='fotocargar' style='display: none;'/>\n\
            <canvas id='canvas' style='display: block;'></canvas>");
        $('#fotocargar').click();
        return;
    }

    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#loading').css("display","block");                    
            var canvas = document.getElementById("canvas");
            var ctx = canvas.getContext('2d');
            var img = new Image();
            img.onload = function () {
                canvas.width = 200;
                canvas.height = 200;
                ctx.drawImage(img, 0, 0, 200, 200);
                imagenAModificar.attr("src", canvas.toDataURL(input.files[0].type));
                $("#imagen").val(canvas.toDataURL(input.files[0].type));
                //cargando(false);
                $("#fotocargar").remove();
                $("#canvas").remove();
            };
            img.src = reader.result;           
            $('#loading').css("display","none");            
        };
        reader.readAsDataURL(input.files[0]);
    }
}


