$(document).ready(function(){
  $('#mostrar').hide();
  $(window).scroll(function(){
      if ($(this).scrollTop() > 100) {
          $('.scrollup').fadeIn();
      } else {
          $('.scrollup').fadeOut();
      }
  });

  $('.scrollup').click(function(){
      $("html, body").animate({ scrollTop: 0 }, 600);
      return false;
  });    
  Buscar_Notificacion();
});

function Buscar_Notificacion(){
  var tabladatos=$("#body_notificacion");
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
          var route = "Cargar_Notificacion/"+fecha_inicio+"/"+fecha_fin;
          $.get(route, function (res) {
            $('#body_notificacion').empty();                   
            $(res).each(function (key, value) {  
              $('#loading').css("display","block");    
              if (value.tipo == 1) {
                tipo = "MOTISTA";
              } else{
                if (value.tipo == 2) {
                  tipo = "USUARIO";                  
                } else {
                  if (value.tipo == 3) {
                    tipo = "EMPRESA";                  
                  } else {
                    tipo = "TODOS";
                  }
                }
              } 
              tabladatos.append("<tr align=center ><td>"+value.titulo+"</td><td>"+value.mensaje+"</td><td>"+value.fecha+"</td><td>"+value.administrador+"</td><td>"+tipo+"</td></tr>");                                            
            });
            $('#loading').css("display","none");    
          });  
        }      
    }

}
