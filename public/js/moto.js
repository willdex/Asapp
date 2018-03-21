$(document).ready(function(){
    document.getElementById('logo').src = $("#imagen").val();                   
    $('#mostrar').hide();    
    $('#loading').css("display","none");    
});

function CargarMoto(id){
    $('#loading').css("display","block");    
    $.get('cargar_moto/'+id , function (response) { 
      if (response[0].estado == 5) {
        $("#div_bloq").hide();
        $("#div_desbloq").show();                
      } else {
        $("#div_desbloq").hide();  
        $("#div_bloq").show();            
      }

        $("#id_moto").val(response[0].id);      
        //$("#id_moto").text(response[0].id);        
        $("#nombre").val(response[0].nombre);
        $("#apellido").val(response[0].apellido);
        $("#ci").val(response[0].ci);
        $("#celular").val(response[0].celular);
        $("#celular_aux").val(response[0].celular);
        $("#email").val(response[0].email);
        $("#marca").val(response[0].marca);
        $("#modelo").val(response[0].modelo);
        $("#placa").val(response[0].placa);
        $("#color").val(response[0].color);
        $("#direccion").val(response[0].direccion);
        $("#referencia").val(response[0].referencia);
        $("#telefono").val(response[0].telefono);
        $("#codigo").val(response[0].codigo);
        $("#credito").val(response[0].credito);
        $("#latitud").val(response[0].latitud);
        $("#longitud").val(response[0].longitud);
        $("#login").val(response[0].login);
        $("#estado").val(response[0].estado);
        $("#token").val(response[0].token);
        $("#imagen").val(response[0].imagen); 
        document.getElementById('logo').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA
        // document.getElementById('foto').src = 'data:image/jpeg;base64,'+response[0].imagen; 

        //CARGA A LO DE NOTIFICACION        
        document.getElementById('logo_not').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA
        $("#id_moto_not").val(response[0].id); 
        $("#nombre_not").text(response[0].nombre+" "+response[0].apellido); 
        $("#ci_not").text(response[0].ci); 
        $("#placa_not").text(response[0].placa); 
        $("#modelo_not").text(response[0].modelo); 
        $("#color_not").text(response[0].color); 
        $("#token_not").val(response[0].token);

        //CARGA LOS DATOS EN EL FORMULARIO DESBLOQEAR
        $("#id_moto_desbloq").val(response[0].id); 
        $("#token_desbloq").val(response[0].token);

        //CARGA LOS DATOS EN EL FORMULARIO BLOQEAR
        $("#id_moto_bloq").val(response[0].id); 
        $("#token_bloq").val(response[0].token);
       /* document.getElementById('logo_bloq').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA
        $("#nombre_bloq").text(response[0].nombre+" "+response[0].apellido); 
        $("#ci_bloq").text(response[0].ci); 
        $("#placa_bloq").text(response[0].placa); 
        $("#modelo_bloq").text(response[0].modelo); 
        $("#color_bloq").text(response[0].color); */       
      $('#loading').css("display","none");    
    });
    //CAMBIAR ENLACE DE LA URL
    document.getElementById('ruta').href = 'moto/'+id;     
}

$("#id_mot").change(function(event){
    $('#loading').css("display","block");    
    var id_moto = $("#id_mot").val();   
    if (id_moto == "") {
        $("#body_moto").show();
        $("#mostrar").hide(); 
        $('#body_moto_2').empty();                                     
        $('#loading').css("display","none");              
    } else {
        var tabladatos=$("#body_moto_2");
        $("#mostrar").show();
        $("#body_moto").hide();
        $.get("cargar_moto/"+id_moto, function (res) {
          $('#body_moto_2').empty();                   
          $(res).each(function (key, value) {
          if (value.estado == 0) {  
              estado = "INACTIVO";                 
          } else {
            if (value.estado==1) {
              estado = "ACTIVO";                 
            } else {
              if (value.estado == 2) {
                estado = "CARRERA";
              } else {
                estado = "BLOQUEADO";                                               
              }
            }
          }     
            tabladatos.append("<tr align=center ><td>"+value.nombre+"</td><td>"+value.apellido+"</td><td>"+value.ci+"</td><td>"+value.marca+"</td><td>"+value.placa+"</td><td>"+value.modelo+"</td><td>"+value.color+"</td><td>"+value.celular+"</td><td>"+value.credito+" Bs.</td><td>"+estado+"</td>\n\
                <td><button class='btn btn-primary' data-toggle='modal' data-target='#ModalMoto' onclick='CargarMoto("+value.id+")'>VER MAS</button>\n\
                <button class='btn btn-info' data-toggle='modal' data-target='#ModalNotificacion' onclick='CargarMoto("+value.id+")'>NOTIFICACION</button></td></tr>");              
          });
          $('#loading').css("display","none");              
          //<button class='btn btn-danger' data-toggle='modal' data-target='#ModalBloquearMoto' onclick='CargarMoto("+value.id+")'>BLOQUEAR</button>;
          //<a class='btn btn-warning' href='moto/"+value.id+"'>CARRERAS</a>\n\          
        });
    }
});

function ver_todos(){
    $('#loading').css("display","block");              
    $('#body_moto_2').empty();                       
    $("#body_moto").show();   
    $("#mostrar").hide();            
    $('#loading').css("display","none");              
}

//ESTE ES EL CODIGO PARA CORTAR LA IMAGEN AL 100 X 100
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
        //cargando(true);
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
            $('#loading').css("display","none");                
          };
          img.src = reader.result;           
        };
        reader.readAsDataURL(input.files[0]);
    }
}

/*function cargando(estado){ // CARGARNDO DE LA IMAGEN 100 x 100
    if(estado){
         var elemento="<div  id='cargando' style='z-index: 2;'>"
                        +"<div>"
                        +"<img src='"+imagenCargando+"' title='CARGANDO'/>"
                        +"<span class='negrillaenter centrar'>CARGANDO</span>"
                        +"</div>";
                        +"</div>";
        $("body").append(elemento);
    }else{
        $("#cargando").remove();
    }
}*/



////////////////////////////////////////////////////////////////////////////////
//////////////////PAGO DEL MOTISTA/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
$("#id_motista").change(function(event){
    $('#loading').css("display","block");                
    var id_moto = $("#id_motista").val();   
    if (id_moto == "") {
          $('#body_moto').empty();                           
          $('#loading').css("display","none");                
    } else {
        var tabladatos=$("#body_moto");
        $.get("cargar_moto/"+id_moto, function (res) {
          $('#body_moto').empty();                   
          $(res).each(function (key, value) {        
            tabladatos.append("<tr align=center ><td>"+value.nombre+"</td><td>"+value.apellido+"</td><td>"+value.ci+"</td><td>"+value.placa+"</td><td>"+value.modelo+"</td><td>"+value.color+"</td><td>"+value.celular+"</td><td>"+value.credito+" Bs.</td>\n\
                <td><img src="+value.imagen+" width=150px height=150px class='img-circle'></td><td><button class='btn btn-success' data-toggle='modal' data-target='#ModalPagarMoto' onclick='CargarPagoMoto("+value.id+")'>PAGAR</button></td></tr>");              
            $('#loading').css("display","none");                
          });
        });
    }
});

var cont = 0;
var id_carrera = [];
var monto_pag= [];
function CargarPagoMoto(id){
  $('#loading').css("display","block");                
  $("#btn_pagar").hide();
    $("#id_moto_fac").val(id);
    $.get('cargar_pago_motista/'+id , function (response) { 
        $("#id_moto_pag").val(response[0].id);      
        $("#monto_pagar").text(response[0].credito);
        $("#monto_aux").val(response[0].credito);        
        if (parseFloat(response[0].credito)==0) {
          $("#btn_pagar").hide();          
        } else {
          $("#btn_pagar").show();          
        }
        $('#loading').css("display","none");                
    });
/*
//CARGAR TABLA PARA PAGAR A OS MOTISTAS   
    $('#body_pagar').empty();
    var tabladatos = $('#body_pagar');
    var route = "cargar_lista_motista/"+id;
    $.get(route, function (res) {
    $(res).each(function (key, value) {
          tabladatos.append('<tr align="center"><td><input name="id_carrera[]" id="id_carrera'+ cont +'" type=text size=3 value='+value.id+'></td>\n\
            <td><input name="monto_pag[]" id="monto_pag'+ cont +'" readonly="" type="text" size=3 onkeypress="return bloqueo_de_punto(event)" style="text-align:center" maxlength="6" value='+value.monto_motista_aux+'></tr>');
            cont++;           
        });
    });*/
}

function ocultar(){
    $('#loading').css("display","block");                
    $("#btn_pagar").hide();
    $('#loading').css("display","block");
}



////////////////////////////////////////////////////////////////////////////////
//////////////////BUSQUEDA DE LAS MOTOS/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var id_moto_not = [];
var token_not = [];

//BUSQUEDA INDIVUAL DE UN SOLO MOTISTA
$("#buscar_moto_unico").change(function(event){
    $('#loading').css("display","block");
    $('select[name=buscar_mot]').val('0');
    var id_moto = $("#buscar_moto_unico").val();
    $("#btn_sel_todos").hide(); 
    if (id_moto == "") {
        $('#body_bus_moto').empty();    
        document.getElementById("mapa").innerHTML="";
        $("#btn_not").hide();   
        Esconder_Textos();                                              
        $('#loading').css("display","none");
    } else {
      $("#btn_not").show(); 
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 12,
        center: new google.maps.LatLng(-17.7833843, -63.1805470),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
        infowindow = new google.maps.InfoWindow();
        $.get("buscar_una_moto/"+id_moto, function (res) {
          $('#body_bus_moto').empty();                   
          $(res).each(function (key, value) {        
              nombre_emp = String(value.nombre+" "+value.apellido);
              marker = new google.maps.Marker({
                position: new google.maps.LatLng(parseFloat(value.latitud), parseFloat(value.longitud)),
                map: map,
              }); 
              infowindow.setContent(String(value.nombre +" "+value.apellido));  //COLOCA EL NOMBRE Y APELLIDOA LAS UBICACIONES
              infowindow.open(map, marker);  //COLOCA EL NOMBRE Y APELLIDOA LAS UBICACIONES
              tabladatos=$("#body_bus_moto");                       
              tabladatos.append('<tr> <td> <input name="id_moto_not[]" id="id_moto_not0" value='+value.id+' type=hidden size=2>\n\
              '+value.nombre+' '+value.apellido+'</td><td>'+value.ci+'</td><td>'+value.placa+'</td><td>'+value.modelo+'</td><td>'+value.color+'</td><td>'+value.celular+' <br><input type="hidden" name="token_not[]" id="token_not'+cont+'"  value="'+value.token+'"></td></tr>');                            
            $('#loading').css("display","none");
          });
        });            
    }
});

//BUSCAR POR ACTIVOS - INACTIVOS - TODOS - CARRERAS
$("#buscar_mot").change(function(event){
    $('#loading').css("display","block");
    var opcion = $("#buscar_mot").val();   
    //var tabladatos=$("#body_bus_moto"); 
    cont = 0;          
    $('#body_bus_moto').empty();               
    if (opcion == 0) { //NINGUNO
        $("#btn_sel_todos").hide();      
        $('#body_bus_moto').empty();    
        document.getElementById("mapa").innerHTML="";
        $("#btn_not").hide();  
        $("#btn_sel_todos").hide();           
        Esconder_Textos();             
    }
    else{ //CASO CONTRARIO SIGNIFICA Q SELECCIONO UNA DE LAS DEMAS OPCIONES
        Cargar_Mapa_Lista(0,opcion); 
        $("#btn_not").show();   
        $("#btn_sel_todos").show();   
    }  
});

sw=0;//PARA VERIFICAR SI YA EXISTE ESE MOTISTA EN LA LISTA SW = 0 Q NO EXISTE Y SW = 1 Q YA EXISTE EN LA LISTA

//MUESTRA  LOS MOTISTAS ACTIVOS
function Cargar_Mapa_Lista(ver,opcion) {
  var tabladatos=$("#body_bus_moto");   
  var map = new google.maps.Map(document.getElementById('mapa'), {
    zoom: 12,
    center: new google.maps.LatLng(-17.7833843, -63.1805470),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });
  var infowindow = new google.maps.InfoWindow();
  var marker, i;
  if (opcion == 1) {
    route = "buscar_activos_moto"; //MOSTOS ACTIVOS
  } else {
    if (opcion == 2 ) {
      route = "buscar_inactivos_moto";  //MOTOS INACTIVOS    
    } else {
      if (opcion == 3) {
        route = "buscar_todas_las_moto";  //TODAS LAS MOTOS            
      } else {
        route = "buscar_carrera_moto";  //LAS MOTOS EN CARRERA
      }
    }
  }
  $.get(route, function (res) { //CONSULTA DE TODOS LOS MOTISTAS ACTIVOS
      for (var i = 0; i < res.length; i++) {  
        infowindow = new google.maps.InfoWindow();
        marker = new google.maps.Marker({ //SE CREA UN NUEVO MARKER
          map:map,
          animation: google.maps.Animation.DROP,        
          position: new google.maps.LatLng(parseFloat(res[i].latitud), parseFloat(res[i].longitud)),
          title: String(res[i].nombre)
        });
        if (ver == 1) { //SI ES UNO SIGNIFICA Q SELCCIONE Q MIESTRE TODOS Y EL ICONO CAMBIA DE IMAGEN
          marker.setIcon('images/notificacion.png');  //AQUI SE PONE LA IMAGEN                                                                                     
        }
        //infowindow.setContent(String(res[i].nombre +" "+res[i].apellido));  //COLOCA EL NOMBRE Y APELLIDOA LAS UBICACIONES
        //infowindow.open(map, marker);  //COLOCA EL NOMBRE Y APELLIDOA LAS UBICACIONES

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(String(res[i].nombre +" "+res[i].apellido));
            infowindow.open(map, marker);
            id_m = res[i].id;
            for (var k = 0; k <= cont; k++) {
              if (!isNaN(parseInt($("#id_moto_not"+k).val()))) { //VERIFICO SI EXISTE ESE TEXTO               
                if (parseInt($("#id_moto_not"+k).val()) == id_m) {  //SI EXISTE, VERIFICO SI YA SE A DADO CLICK EN ESA UBICACION
                  sw=1; //SW = 1 SIGNIFICA QUE YA EXISTE ENTONCE SE ELIMINARA
                  break; //SE TERMINA EL FOR
                } 
              } 
            }
            if (sw == 0) {  //SW = 0 SIGNIFICA Q NO EXISTE Y SE AGREGA A LA LISTA
              tabladatos.append('<tr id="fila'+cont+'"> <td> <input name="id_moto_not[]" id="id_moto_not'+cont+'" value='+res[i].id+' type=hidden size=2>\n\
              '+res[i].nombre+' '+res[i].apellido+'</td><td>'+res[i].ci+'</td><td>'+res[i].placa+'</td><td>'+res[i].modelo+'</td><td>'+res[i].color+'</td><td>'+res[i].celular+' <br><input type="hidden" name="token_not[]" id="token_not'+cont+'"  value="'+res[i].token+'"></td></tr>');              
              cont++;
              $("#btn_sel_todos").show(); 
              marker.setIcon('images/notificacion.png');  //AQUI SE PONE LA IMAGEN                                                                           
            } 
            else {// CASO CONTRARIO SIGNIFICA Q YA EXISTE Y LO ELIMINA DE LA LISTA
              eliminar_lista(k);
              sw=0;  
              marker.setIcon(''); //PARA Q VUELVA AL ICONO ORIGINAL                                                                                                                                                              
            }
          }
        })(marker, i));
      } 
      $('#loading').css("display","none");      
  });   
}
//google.maps.event.addDomListener(window, 'load', Motistas_Activos); //ESTO ES PARA Q INICIALIZE CUANDO SE CARGA LA PAGINA

//ELIMINAR FILA
function eliminar_lista(index){
   id_moto_not[index]=0;
   $('#fila' + index).remove();
}

//ENVIAR NOTIFICACION
function Mostrar_Textos(){         
  $("#notificacion").show();
}

function Esconder_Textos(){
  $("#titulo_msn").val("");
  $("#detalle_msn").val("");
  $("#notificacion").hide();
  $('#loading').css("display","none");
}


function Seleccionar_Todos(){
  $('#loading').css("display","block");        
  var opcion = $("#buscar_mot").val();
  cont=0;  
  if (opcion == 0) { //NINGUNO
    $('#body_bus_moto').empty();    
    document.getElementById("mapa").innerHTML="";
    $("#btn_sel_todos").hide();
    $('#loading').css("display","none");      
  } else{ // CASO CONTRARIO SELECCIONO OTRAS OPCIONES
      Cargar_Mapa_Lista(1,opcion);  
      Cargar_Tabla_Lista(opcion);   
      $("#btn_sel_todos").show();      
  }    
}

function Cargar_Tabla_Lista(opcion){
  var tabladatos=$("#body_bus_moto"); 
  if (opcion == 1) {
    route = "buscar_activos_moto"; //MOSTOS ACTIVOS
  } else {
    if (opcion == 2 ) {
      route = "buscar_inactivos_moto";  //MOTOS INACTIVOS    
    } else {
      if (opcion == 3) {
        route = "buscar_todas_las_moto";  //TODAS LAS MOTOS            
      } else {
        route = "buscar_carrera_moto";  //LAS MOTOS EN CARRERA
      }
    }
  }   
  $.get(route, function (res) {
    $('#body_bus_moto').empty();               
    $(res).each(function (key, value) {        
      tabladatos.append('<tr id="fila'+cont+'"> <td> <input name="id_moto_not[]" id="id_moto_not'+cont+'" value='+value.id+' type=hidden size=2>\n\
      '+value.nombre+' '+value.apellido+'</td><td>'+value.ci+'</td><td>'+value.placa+'</td><td>'+value.modelo+'</td><td>'+value.color+'</td><td>'+value.celular+' <br><input type="hidden" name="token_not[]" id="token_not'+cont+'"  value="'+value.token+'"></td></tr>');              
      cont++;
    });
    $('#loading').css("display","none");      
    $("#btn_sel_todos").show();                
  });   
}

