var cont = 0;
var latitud_aux = [];
var longitud_aux= [];
var nombre_empresa= [];
var detalle= [];
var marker;   //variable del markador
var coords = {};  //coordenadas obtenidas con la geolocalizacion

function nuevo() {
    $('#loading').css("display","block");    
    $('#bt_add').hide();  
    cont++;
    initMap();
    //nuevo_marker();
    //ver_mapa();
}

//ESTA FUNCCION ES CUANDO DA CLICK EN EL BOTON DEL OJO Y MUESTRA LA UBICACION DE ESA FILA
function ver_mapa(id){
 if (!isNaN(parseFloat($("#longitud_aux"+id).val()))) {
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
      $("#latitud_aux"+id).val(this.getPosition().lat());
      $("#longitud_aux"+id).val(this.getPosition().lng()); 
    });
    //cuando da click aparece de nuevo  el nombre de la empresa
        google.maps.event.addListener(marker, 'click', (function(marker) {
          return function() {
            infowindow.setContent(nombre_emp);
            infowindow.open(map, marker);
          }
        })(marker));   
   }    
}

    //funcion principal
    initMap = function(){ 
    document.getElementById('logo').src = $("#imagen").val();                         
    $('#loading').css("display","block");        
    tabladatos = $('#lista');
    var fila = '<tr class="selected" id="fila' + cont + '">\n\
        <td><input name="nombre_empresa[]" id="nombre_empresa'+cont+'" type=text class="form-control" placeholder="Ingrese el nombre">  <input name="longitud_aux[]" id="longitud_aux'+cont+'" type=hidden></td>\n\
        <td><input name="detalle[]" id="detalle'+cont+'" type=text class="form-control" placeholder="Ingrese la direccion"> <input name="latitud_aux[]" id="latitud_aux'+cont+'" type=hidden></td>\n\
        <td><button type="button" id="btn_eli'+cont+'" class="btn-sm btn-danger" title=Eliminar onclick="eliminar_lista(' + cont + ')"><i class="fa fa-trash-o" aria-hidden="true"></i></button>\n\
        <button type="button" hidden="" id="btn_ver_uno'+cont+'" class="btn-sm btn-info" title=Ver onclick="ver_mapa(' + cont + ')"><i class="fa fa-eye" aria-hidden="true"></i></button></td></tr>';    
    $('#lista').append(fila);

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

    function setMapa (coords){
    //$('#loading').css("display","none");    
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
  //creamos el marcador en el mapa con sis propiedades para nuestro objetivo tenemos q poner el atributo draggable en true position pondremos las mismas coordenadas q obtuvimos en la geolalizacion
  marker = new google.maps.Marker({
    map:map,
    draggable: true,
    animation: google.maps.Animation.DROP,
    position: new google.maps.LatLng(coords.lat, coords.lng),
  });
  
  marker.setIcon('../images/ubicacion.png');  //AQUI SE PONE LA IMAGEN
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
    $('#btn_eli'+cont).show();                   
    $('#btn_ver_uno'+cont).show();   
  });
}

    //callback al hacer click en el marcador l que hace es quitar y poner la animation BOUNCE
    function toggleBounce(){
     // $('#fila'+id).css("background","red");      
      if (marker.getAnimation() !== null) {
        marker.setAnimation(null);
      } else {
        marker.setAnimation(google.maps.Animation.BOUNCE);
      }
    }

    function eliminar_lista(index){
       latitud_aux[index]=0;
       longitud_aux[index]=0;   
       $('#fila' + index).remove();
       lista_direccion();
      $('#bt_add').show();                
    }

//PARA VER TODAS LAS POSICIONES Q SE CREARON
function lista_direccion(){
  $("#bt_add").show();
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
            //estado_direccion(i);
          }
        })(marker, i));
    }
  }
}


//////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////PARA CARGAR LAS IMAGENES//////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////

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
