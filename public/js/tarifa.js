$(document).ready(function(){
    $('#loading').css("display","none");    
});


function CargarTarifa(id){
    $('#loading').css("display","block");    
    $.get('cargar_tarifa/'+id , function (response) { 
        $("#id_tarifa").val(response[0].id);         
        $("#distancia").val(response[0].distancia);
        $("#monto").val(response[0].monto);
        $("#porcentaje_moto").val(response[0].porcentaje_moto);
        $("#costo_fijo_moto").val(response[0].costo_fijo_moto);
        $("#porcentaje_empresa").val(response[0].porcentaje_empresa);
        $("#gasto_fijo_empresa").val(response[0].gasto_fijo_empresa);
        $("#impuesto").val(response[0].impuesto);
        $('#loading').css("display","none");    
    });
}

function CargarEliminarTarifa(id){
    $('#loading').css("display","block");    
    $.get('cargar_tarifa/'+id , function (response) { 
        $("#id_tarifa_eli").val(response[0].id);         
        $('#loading').css("display","none");    
    });
}

