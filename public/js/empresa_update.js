$(document).ready(function(){
  try {
      id_adm = $("#id_empresa").val();    
      CargarEmpresa(id_adm);  
      id_user = $("#id_administrador").val();        
      CargarUsuario(id_user);    
      CargarDireccion(id_adm,id_user);
      $('#btn_cambiar').hide();   
  }
  catch (e) {//EN CASO Q VEA UN ERROR EN LOS JS
    alert(e);
    javascript:location.reload();
  }
});

function CargarEmpresa(id){  
	$.get('../../cargar_empresa/'+id, function(response){
        switch (response[0].estado) {
          case 1:
            $("#div_desbloq").hide();  
            $("#div_bloq").show(); 
            break;
          case 2:
            $("#div_bloq").hide();
            $("#div_desbloq").show();                   
            break;                                          
        }         
        $("#nombre_empres").val(response[0].nombre);        
        $("#direccion").val(response[0].direccion);
        $("#telefono_empres").val(response[0].telefono);
        $("#razon_social").val(response[0].razon_social);
        $("#nit").val(response[0].nit);   
        $("#credito").val(response[0].credito);
        $("#latitud").val(response[0].latitud);
        $("#longitud").val(response[0].longitud);  
        $("#id_administrador").val(response[0].id_administrador); 
        $("#estado").val(response[0].estado);	

        //CARGA LOS DATOS EN EL FORMULARIO DESBLOQEAR
        $("#id_empresa_desbloq").val(id); 
        $("#id_usuario_desbloq").val(response[0].id_administrador);         
        $("#token_desbloq").val(response[0].token);

        //CARGA LOS DATOS EN EL FORMULARIO BLOQEAR
        $("#id_empresa_bloq").val(id); 
        $("#id_usuario_bloq").val(response[0].id_administrador);   
        $("#token_bloq").val(response[0].token);          
	});
  document.getElementById('ruta').href = '../../empresa/'+id;  
}

function CargarUsuario(id){
    $.get('../../cargar_usuario/'+id, function(response){
        $("#nombre_administrador").val(response[0].nombre);        
        $("#apellido_administrador").val(response[0].apellido);
        $("#telefono_administrador").val(response[0].telefono);
        $("#telefono_administrador_aux").val(response[0].telefono);        
        $("#email").val(response[0].email);       
        $("#imagen").val(response[0].imagen);       
        document.getElementById('logo').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA            
    });
}

var cont = 0;
var latitud_aux = [];
var longitud_aux= [];
var nombre_empresa= [];
var detalle= [];
var id_direccion= [];
var estado = [];
var marker;   //variable del markador
var coords = {};  //coordenadas obtenidas con la geolocalizacion

function CargarDireccion(id_adm, id_user){
    $('#loading').css("display","block");    
    tabladatos = $('#lista');
    $.get('../../cargar_direccion/'+id_adm+'/'+id_user, function (res) {
      $('#lista').empty();                   
      $(res).each(function (key, value) {   
        fila = '<tr class="selected" id="fila' + cont + '" style="background: white">\n\
        <td><input name="id_direccion[]" id="id_direccion'+cont+'" value='+value.id+' type=hidden>\n\
        <input name="nombre_empresa[]" id="nombre_empresa'+cont+'" value="'+value.nombre+'" type=text class="form-control" placeholder="Ingrese el nombre"> <br> <input name="longitud_aux[]" id="longitud_aux'+cont+'" value='+value.longitud+' type=hidden></td>\n\
        <td><input name="estado[]" id="estado'+cont+'" value='+value.estado+' type=hidden>\n\
        <input name="detalle[]" id="detalle'+cont+'" value="'+value.detalle+'" type=text class="form-control" placeholder="Ingrese la direccion"> <br> <input name="latitud_aux[]" id="latitud_aux'+cont+'" value='+value.latitud+' type=hidden></td>\n\
        <td><button type="button" class="btn-sm btn-danger" title=Eliminar onclick="estado_direccion(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>'; //\n\
        //<button type="button" class="btn-sm btn-info" title=Ver onclick="ver_mapa(' + cont + ')"><i class="fa fa-eye" aria-hidden="true"></i></button></td></tr>';    
        $('#lista').append(fila);
        cont++;     
      });
      lista_direccion();  //CARGO EL MAPA CON LAS DIRECCIONES DE ESA EMPRESA
    });
}

//PARA VER TODAS LAS POSICIONES Q SE CREARON
function lista_direccion(){
  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 12,
    center: new google.maps.LatLng(-17.7833843, -63.1805470),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });


  for (var i = 0; i <= cont; i++) {
    if (!isNaN(parseFloat($("#latitud_aux"+i).val()))) {
        infowindow = new google.maps.InfoWindow();

      marker = new google.maps.Marker({
        map:map,
        draggable: true,
        animation: google.maps.Animation.DROP,        
        position: new google.maps.LatLng(parseFloat($("#latitud_aux"+i).val()), parseFloat($("#longitud_aux"+i).val())),
        title: String($("#nombre_empresa"+i).val())
      });
        infowindow.setContent(String($("#nombre_empresa"+i).val()));
        infowindow.open(map, marker);

      if ( isNaN(parseInt($("#id_direccion"+i).val())) ) {   
          marker.setIcon('../../images/nueva_ubicacion.png');  //ICONO DE LAS NUEVAS UBICACIONES Q SE AGREGARON
      }else{
        if (parseInt($("#estado"+i).val()) == 0) {   
            marker.setIcon('../../images/ubicacion_eliminada.png');  //ICONO CUANDO ESTA CON EL ESTADO 0 SIGNIFICA Q ESTA ELIMINADA
        }        
      }


        google.maps.event.addListener(marker, 'dragend', (function(marker, i) {
          return function() {
            infowindow.setContent(String($("#nombre_empresa"+i).val()));
            infowindow.open(map, marker);
            $("#latitud_aux"+i).val(this.getPosition().lat());
            $("#longitud_aux"+i).val(this.getPosition().lng()); 
          }
        })(marker, i));

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(String($("#nombre_empresa"+i).val()));
            infowindow.open(map, marker);
            //marker.setIcon('../../images/ubicacion.png');  //AQUI SE PONE LA IMAGEN
            if ( !isNaN(parseInt($("#id_direccion"+i).val())) ) {   
              estado_dir = $("#estado"+i).val();
              if ( estado_dir == 1) {
                  $('#fila'+i).css("background","#F6CED8");      
                  $('#estado'+i).val(0); 
                  marker.setIcon('../../images/ubicacion_eliminada.png');  //AQUI SE PONE LA IMAGEN                
              } else {
                  $('#fila'+i).css("background","white");      
                  $('#estado'+i).val(1);      
                  marker.setIcon('');  //AQUI SE PONE LA IMAGEN                
              }
              //estado_direccion(i);
            }
          }
        })(marker, i));
    }
  }
  $('#loading').css("display","none");      
}


//PARA LOS MAPAS 
function nuevo() {
    $('#loading').css("display","block");      
    $('#bt_add').hide();  
    $('#nueva_head').show();  
    cont++;
    initMap();
}

//ESTA FUNCCION ES CUANDO DA CLICK EN EL BOTON DEL OJO Y MUESTRA LA UBICACION DE ESA FILA
function ver_mapa(id){
  $("#btn_ver").show();
  lat = parseFloat($("#latitud_aux"+id).val());
  lon = parseFloat($("#longitud_aux"+id).val());

  var map = new google.maps.Map(document.getElementById('map'), {
    zoom: 13,
    center: new google.maps.LatLng(lat, lon),
    mapTypeId: google.maps.MapTypeId.ROADMAP
  });

  var infowindow = new google.maps.InfoWindow();
  var marker;
  

  nombre_emp = String($("#nombre_empresa"+id).val() +" - "+ $("#detalle"+id).val());

  marker = new google.maps.Marker({
    map:map,            
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(lat, lon),
    //title: nombre_emp          
  });   

  infowindow.setContent(nombre_emp);//ESTO ES PARA Q APARESCA DCON SU NOMBRE DE EMPRESA
  infowindow.open(map, marker);//ESTO ES PARA Q APARESCA DCON SU NOMBRE DE EMPRESA

  marker.addListener('click', toggleBounce);  //ESTA LINES DE CODIGO ES PARA Q SALTE LA UBICACION 

  //ESTO ES PARA ARRASTRAR LA UBICACION Y OBTENER SU OBICACION ACTUAL
  marker.addListener('dragend', function (event) {
    //escribimos las cordenadas de la position actual del marcador dentro del input #coords
    var lati = $("#latitud_aux"+id).val(this.getPosition().lat());
    var longi = $("#longitud_aux"+id).val(this.getPosition().lng()); 
  });

  //cuando da click aparece de nuevo  el nombre de la empresa
  google.maps.event.addListener(marker, 'click', (function(marker) {
    return function() {
      infowindow.setContent(nombre_emp);
      infowindow.open(map, marker);
    }
  })(marker));       
}

//CUANDO QUIERE AGREGAR UNA NUEVA DIRECCION
initMap = function(){
tabladatos = $('#nueva_lista');
var fila = '<tr class="selected" id="fila' + cont + '" style="background: white">\n\
    <td><input name="id_direccion[]" id="id_direccion'+cont+'" type=hidden>\n\
    <input name="nombre_empresa[]" id="nombre_empresa'+cont+'" type=text class="form-control" placeholder="Ingrese el nombre"> <br> <input name="longitud_aux[]" id="longitud_aux'+cont+'" type=hidden></td>\n\
    <td><input name="detalle[]" id="detalle'+cont+'" type=text class="form-control" placeholder="Ingrese la direccion"> <br> <input name="latitud_aux[]" id="latitud_aux'+cont+'" type=hidden></td>\n\
    <td><button type="button" class="btn-sm btn-danger" id="btnestado('+cont+')" title=Eliminar onclick="eliminar_lista(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button></td></tr>'; //\n\
    //<button type="button" class="btn-sm btn-info" title=Ver onclick="ver_mapa(' + cont + ')"><i class="fa fa-eye" aria-hidden="true"></i></button></td></tr>';    
$('#nueva_lista').append(fila);

  //usamos la API para geolocalizar el usuario
 /* navigator.geolocation.getCurrentPosition(
    function(position){
      coords = {
        lng: position.coords.longitude,
        lat: position.coords.latitude
      };
      setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa

    },function(error){
        alert("CON LA CONEXION DE GOOGLE MAPS");
        console.log(error);
    });*/
    coords = {
      lng: -63.18166284516599,//position.coords.longitude,
      lat: -17.78385432340922,//position.coords.latitude
    };
    setMapa(coords);  //pasamos las coordenadas al metodo para crear el mapa     
}
//CON ESTA FUNCION SE CREA UNA NUEVA DIRECCION
function setMapa (coords){
  //se crea una nueva instancia del objeto mapa
  var map = new google.maps.Map(document.getElementById('map'),
  {
    zoom: 13,
    center: new google.maps.LatLng(coords.lat, coords.lng),
  });

  if (cont>0) {
  for (var i = 0; i <= cont; i++) {
    if (!isNaN(parseFloat($("#latitud_aux"+i).val()))) {
      infowindow = new google.maps.InfoWindow();
      marker = new google.maps.Marker({
        map:map,
        draggable: true,
        animation: google.maps.Animation.DROP,        
        position: new google.maps.LatLng(parseFloat($("#latitud_aux"+i).val()), parseFloat($("#longitud_aux"+i).val())),
        title: String($("#nombre_empresa"+i).val())
      });

      if ( isNaN(parseInt($("#id_direccion"+i).val())) ) {   
          marker.setIcon('../../images/nueva_ubicacion.png');  //ICONO DE LAS NUEVAS UBICACIONES Q SE AGREGARON
      }else{
        if (parseInt($("#estado"+i).val()) == 0) {   
            marker.setIcon('../../images/ubicacion_eliminada.png');  //ICONO CUANDO ESTA CON EL ESTADO 0 SIGNIFICA Q ESTA ELIMINADA
        }        
      }
        infowindow.setContent(String($("#nombre_empresa"+i).val()));
        infowindow.open(map, marker);
        google.maps.event.addListener(marker, 'dragend', (function(marker, i) {
          return function() {
            infowindow.setContent(String($("#nombre_empresa"+i).val()));
            infowindow.open(map, marker);
            $("#latitud_aux"+i).val(this.getPosition().lat());
            $("#longitud_aux"+i).val(this.getPosition().lng()); 
          }
        })(marker, i));

        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(String($("#nombre_empresa"+i).val()));
            infowindow.open(map, marker);
            estado_direccion(i);
            //marker.setIcon('../../images/ubicacion.png');  //AQUI SE PONE LA IMAGEN   
            $('#bt_add').show();                            
          }
        })(marker, i));
    }
  }
    $('#loading').css("display","none");      
  }else{
    $('#loading').css("display","none");          
  }
  //creamos el marcador en el mapa con sis propiedades
  //para nuestro objetivo tenemos q poner el atributo draggable en true
  //position pondremos las mismas coordenadas q obtuvimos en la geolalizacion
  marker = new google.maps.Marker({
    map:map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(coords.lat, coords.lng),
  });
  
  marker.setIcon('../../images/ubicacion.png');  //AQUI SE PONE LA IMAGEN
  marker.setAnimation(google.maps.Animation.BOUNCE);      

  //agregamos un evento al marcador junto con la funcion callback al igual q el evento dragend q indica cuando el usuario a soltado el marcador
  marker.addListener('click', toggleBounce);
  marker.addListener('dragend', function (event) {
    //escribimos las cordenadas de la position actual del marcador dentro del input #coords
    //document.getElementById("coords").value=this.getPosition().lat()+" , "+this.getPosition().lng(); //para obtener latitud y longitud en un solo texto
    var lati = $("#latitud_aux"+cont).val(this.getPosition().lat());
    var longi = $("#longitud_aux"+cont).val(this.getPosition().lng());  
    $('#bt_add').show();                
    $('#btn_ver').show();                
  });
}

//callback al hacer click en el marcador l que hace es quitar y poner la animation BOUNCE ES PARA Q EL MARKKER SALTE
function toggleBounce(){
  if (marker.getAnimation() !== null) {
    marker.setAnimation(null);
  } else {
    marker.setAnimation(google.maps.Animation.BOUNCE);
  }
}

//ESTA FUNCION ES PARA CAMBIAR EL ESTADO DE LAS DIRECCIONES
function estado_direccion(id){
    var estado_dir = $("#estado"+id).val();
    if ( estado_dir == 1) {
        $('#fila'+id).css("background","#F6CED8");      
        $('#estado'+id).val(0); 
    } else {
        $('#fila'+id).css("background","white");      
        $('#estado'+id).val(1);      
    }
    lista_direccion();
}

//ESTA FUNCION ES PARA ELIMIAR LA NUEVA FIRECCION Q SE CREO
function eliminar_lista(index){
   latitud_aux[index]=0;
   longitud_aux[index]=0;   
   $('#fila' + index).remove();
   lista_direccion();  
   $("#bt_add").show(); 
}

//PARA CARGAR LA IMAGEN
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



    /*function initialize() { //EJEMPLO DE VARIOS MARKERS
      var marcadores = [
        ['León', 42.603, -5.577],               
        ['Salamanca', 40.963, -5.669],
        ['Zamora', 41.503, -5.744]
      ];
      var map = new google.maps.Map(document.getElementById('mapa'), {
        zoom: 7,
        center: new google.maps.LatLng(41.503, -5.744),
        mapTypeId: google.maps.MapTypeId.ROADMAP
      });
      var infowindow = new google.maps.InfoWindow();
      var marker, i;
      for (i = 0; i < marcadores.length; i++) {  
        marker = new google.maps.Marker({
          position: new google.maps.LatLng(marcadores[i][1], marcadores[i][2]),
          map: map
        });
        google.maps.event.addListener(marker, 'click', (function(marker, i) {
          return function() {
            infowindow.setContent(marcadores[i][0]);
            infowindow.open(map, marker);
          }
        })(marker, i));
      }
    }*/


////////////////////////////////
/////CAMBIAR ADMINISTRADOR//////
////////////////////////////////
$("#id_admin").change(function(event){
    $('#loading').css("display","block");    
    var id_user = $("#id_admin").val();
    if (id_user == "") {
        $("#btn_cambiar").hide();  
        $("#telefono_cam").val("");          
        $("#logo_cam").hide();               
        $('#loading').css("display","none");    
    } else {                    
      $.get('../../cargar_usuario/'+id_user, function(response){
        $("#id_empresa_cam").val(response[0].id_empresa);          
        //document.getElementById('foto').src = 'data:image/jpeg;base64,'+response[0].imagen;
        document.getElementById('logo_cam').src = response[0].imagen; //ESTA ES LA FORMA PARA PODER MOSTRA CUANDO YA LO GUARDO CON LO DE CANVA
        $('#loading').css("display","none");    
      });
        $("#btn_cambiar").show();
        $("#logo_cam").show(); 
    }
});


function ucultar_boton(){
  $("#btn_cambiar").hide();
  $('#loading').css("display","block");    
}