$(document).ready(function(){
    $('#mostrar').hide();    
    $('#loading').css("display","none");    
});


////////////////////////////////////////////////////////////////////////////////
//////////////////BUSQUEDA DE LAS MOTOS/////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////
var id_moto_not = [];
var token_not = [];
var cont = 0;

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

