total_debe = 0;
total_haber = 0;

debe_e = [];
haber_e = [];
cuenta_e = [];
codigo_e = [];
contador_e = 0;

bool = 0;
function reporte_libro_diario(verificar) {

    total_total_debe = 0;
    total_total_haber = 0;
    if (verificar == 1) {
        var fecha1 = $('#fecha').val();
    } else {
        var fecha1 = $('#fecha_inicial').val();
    }
    $('#tabla').empty();


    fecha2 = $('#fecha1').val();
    tabla = $('#tabla');
    numero1 = "";
    numero2 = "";
    total_columna = 0;
    activar = 1;
    $('#loading').css("display", "block");
    $.get('reporte_libro_diario/' + fecha1 + '/' + fecha2, function (response) {
        total_columna = response.length;
        for (i = 0; i < response.length; i++) {
            if (numero1 == numero2 && i == 0) {
                tabla.append("<tr style='background-color: #2ECCFA'><td>" + response[i].numero + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].fecha + "</td><td>egreso</td>\n\
<td style='background-color: #A9D0F'>" + response[i].glosa + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].codigo + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].nombre + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                total_debe = total_debe + parseInt(response[i].debe);
                total_haber = total_haber + parseInt(response[i].haber);
                total_total_debe = total_total_debe + parseInt(response[i].debe);
                total_total_haber = total_total_haber + parseInt(response[i].haber);
            } else {
                if (numero1 == numero2) {
                    tabla.append("<tr align=center><td></td><td></td><td>egreso</td>\n\
<td></td>\n\
<td>" + response[i].codigo + "</td>\n\
<td>" + response[i].nombre + "</td>\n\
<td>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                    total_debe = total_debe + parseInt(response[i].debe);
                    total_haber = total_haber + parseInt(response[i].haber);
                    total_total_debe = total_total_debe + parseInt(response[i].debe);
                    total_total_haber = total_total_haber + parseInt(response[i].haber);
                } else {
                    if (numero1 != numero2 && i != 0 && activar == 1) {


                        tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");

                        total_debe = 0;
                        total_haber = 0;

                        tabla.append("<tr align=center style='background-color: #2ECCFA'><td>" + response[i].numero + "</td><td>" + response[i].fecha + "</td><td>egreso</td>\n\
<td>" + response[i].glosa + "</td>\n\
<td>" + response[i].codigo + "</td>\n\
<td>" + response[i].nombre + "</td>\n\
<td>" + response[i].debe + "</td>\n\
<td>" + response[i].haber + "</td><tr>");
                        total_debe = total_debe + parseInt(response[i].debe);
                        total_haber = total_haber + parseInt(response[i].haber);
                        total_total_debe = total_total_debe + parseInt(response[i].debe);
                        total_total_haber = total_total_haber + parseInt(response[i].haber);

                    }
                }
            }
            if (i + 1 < total_columna) {
                numero1 = response[i].numero;
                numero2 = response[i + 1].numero;
            } else {
                tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");
                tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td><td></td>\n\
<td></td>\n\
<td></td>\n\
<td></td>\n\
<td><b>" + total_total_debe + "</b></td>\n\
<td><b>" + total_total_haber + "</b></td><tr>");

            }
        }


        $('#loading').css("display", "none");

    });

}



function reporte_libro_mayor(verificar) {

    total_total_debe = 0;
    total_total_haber = 0;
    if (verificar == 1) {
        var fecha1 = $('#fecha').val();
    } else {
        var fecha1 = $('#fecha_inicial').val();
    }


    var fecha2 = $('#fecha1').val();
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    $('#tabla').empty();
    var tabla = $('#tabla');
    $('#loading').css("display", "block");
    bool = 0;
    $.get('reporte_libro_mayor/' + fecha1 + '/' + fecha2, function (response) {
        total_columna = response[0][0].length;
        for (i = 0; i < response.length; i++) {
            for (j = 0; j < response[i].length; j++) {
                if (j == 0) {
                    tabla.append("<tr style='background-color: #2ECCFA'><td><b>" + response[i][j].codigo + "</b></td>\n\
<td style='background-color: #A9D0F'><b>" + response[i][j].nombre + "<b></td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].numero + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].debe + "</td>\n\
<td style='background-color: #A9D0F'>" + response[i][j].haber + "</td>\n\
<tr>");
                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                    cuenta_e[contador_e] = response[i][j].nombre;
                    codigo_e[contador_e] = response[i][j].codigo;
                } else {
                    tabla.append("<tr ><td></td>\n\
<td></td>\n\
<td>" + response[i][j].numero + "</td>\n\
<td >" + response[i][j].debe + "</td>\n\
<td >" + response[i][j].haber + "</td>\n\
<tr>");
                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }

            }
            tabla.append("<tr align=center style='background-color: #85E1D5'><td><b>TOTAL ASIENTO DEBE, HABER</b></td><td></td><td></td>\n\
\n\
<td><b>" + total_debe + "</b></td>\n\
<td><b>" + total_haber + "</b></td><tr>");
            tabla.append("<tr ><td></td>\n\
<td></td>\n\
<td></td>\n\
<td ></td>\n\
<td ></td>\n\
<tr>");
            debe_e[contador_e] = total_debe;
            haber_e[contador_e] = total_haber;

            total_debe = 0;
            total_haber = 0;
            contador_e++;
        }
        tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td>\n\
<td></td>\n\
<td><b>" + total_total_debe + "</b></td>\n\
<td><b>" + total_total_haber + "</b></td><tr>");
        $('#loading').css("display", "none");
        bool = 1;
        return bool;
    });

}


function sumas_saldos(verificar) {

    total_total_debe = 0;
    total_total_haber = 0;
    if (verificar == 1) {
        var fecha1 = $('#fecha').val();
    } else {
        var fecha1 = $('#fecha_inicial').val();
    }
    var deudor = "";
    var acreedor = "";
    var total_deudor = 0;
    var total_acreedor = 0;
    var fecha2 = $('#fecha1').val();
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    $('#tabla_e').empty();
    var tabla = $('#tabla_e');
    $('#loading').css("display", "block");
    $.get('reporte_libro_mayor/' + fecha1 + '/' + fecha2, function (response) {
        total_columna = response[0][0].length;
        for (i = 0; i < response.length; i++) {
            for (j = 0; j < response[i].length; j++) {
                if (j == 0) {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                    cuenta_e[contador_e] = response[i][j].nombre;
                    codigo_e[contador_e] = response[i][j].codigo;
                } else {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }

            }

            if (total_debe > total_haber) {
                deudor = total_debe - total_haber;
                total_deudor = total_deudor + deudor;
            } else {
                acreedor = total_haber - total_debe;
                total_acreedor = total_acreedor + acreedor;
            }
            tabla.append("<tr ><td><b>" + codigo_e[contador_e] + "</b></td>\n\
<td style='background-color: #A9D0F'><b>" + cuenta_e[contador_e] + "<b></td>\n\
<td style='background-color: #A9D0F'>" + total_debe + "</td>\n\
<td style='background-color: #A9D0F'>" + total_haber + "</td>\n\
<td style='background-color: #A9D0F'>" + deudor + "</td>\n\
<td style='background-color: #A9D0F'>" + acreedor + "</td>\n\
<tr>");
            deudor = "";
            acreedor = ""
            total_debe = 0;
            total_haber = 0;
            contador_e++;
        }

        tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td>\n\
<td><b>" + total_total_debe + "</b></td>\n\
<td><b>" + total_total_haber + "</b></td>\n\
<td><b>" + total_deudor + "</b></td>\n\
\n\<td><b>" + total_acreedor + "</b></td>\n\<tr>");
        $('#loading').css("display", "none");



    });
}


function estado_resultado(verificar) {

    total_total_debe = 0;
    total_total_haber = 0;
    if (verificar == 1) {
        var fecha1 = $('#fecha').val();
    } else {
        var fecha1 = $('#fecha_inicial').val();
    }
    var deudor = "";
    var acreedor = "";
    var total_deudor = 0;
    var total_acreedor = 0;
    var fecha2 = $('#fecha1').val();
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    $('#tabla_r').empty();
    var tabla = $('#tabla_r');
    $('#loading').css("display", "block");
    $.get('reporte_estado_resultado/' + fecha1 + '/' + fecha2, function (response) {
      
        for (i = 0; i < response.length; i++) {
            for (j = 0; j < response[i].length; j++) {
                if (j == 0) {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                    cuenta_e[contador_e] = response[i][j].nombre;
                    codigo_e[contador_e] = response[i][j].codigo;
                } else {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }

            }

            if (total_debe > total_haber) {
                deudor = total_debe - total_haber;
                total_deudor = total_deudor + deudor;
            } else {
                acreedor = total_haber - total_debe;
                total_acreedor = total_acreedor + acreedor;
            }
            tabla.append("<tr ><td><b>" + codigo_e[contador_e] + "</b></td>\n\
<td style='background-color: #A9D0F'><b>" + cuenta_e[contador_e] + "<b></td>\n\
<td style='background-color: #A9D0F'>" + deudor + "</td>\n\
<td style='background-color: #A9D0F'>" + acreedor + "</td>\n\
<tr>");
            deudor = "";
            acreedor = ""
            total_debe = 0;
            total_haber = 0;
            contador_e++;
        }

        tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td>\n\
<td><b>" + total_deudor + "</b></td>\n\
\n\<td><b>" + total_acreedor + "</b></td>\n\<tr>");
        total=total_acreedor-total_deudor;
        
        tabla.append("<tr align=center style='background-color: #8CDF33'><td><b>TOTAL</b></td><td></td>\n\
<td><b></b></td>\n\
\n\<td><b>" + total + "</b></td>\n\<tr>");
        $('#loading').css("display", "none");



    });
}


function balance_general(verificar) {

    total_total_debe = 0;
    total_total_haber = 0;
    if (verificar == 1) {
        var fecha1 = $('#fecha').val();
    } else {
        var fecha1 = $('#fecha_inicial').val();
    }
    var deudor = "";
    var acreedor = "";
    var total_deudor = 0;
    var total_acreedor = 0;
    var fecha2 = $('#fecha1').val();
    var numero1 = "";
    var numero2 = "";
    var total_columna = 0;
    $('#tabla_r').empty();
    var tabla = $('#tabla_r');
    $('#loading').css("display", "block");
    $.get('reporte_estado_resultado/' + fecha1 + '/' + fecha2, function (response) {
      
        for (i = 0; i < response.length; i++) {
            for (j = 0; j < response[i].length; j++) {
                if (j == 0) {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                    cuenta_e[contador_e] = response[i][j].nombre;
                    codigo_e[contador_e] = response[i][j].codigo;
                } else {

                    total_debe = total_debe + parseInt(response[i][j].debe);
                    total_haber = total_haber + parseInt(response[i][j].haber);
                    total_total_debe = total_total_debe + parseInt(response[i][j].debe);
                    total_total_haber = total_total_haber + parseInt(response[i][j].haber);
                }

            }

            if (total_debe > total_haber) {
                deudor = total_debe - total_haber;
                total_deudor = total_deudor + deudor;
            } else {
                acreedor = total_haber - total_debe;
                total_acreedor = total_acreedor + acreedor;
            }
            tabla.append("<tr ><td><b>" + codigo_e[contador_e] + "</b></td>\n\
<td style='background-color: #A9D0F'><b>" + cuenta_e[contador_e] + "<b></td>\n\
<td style='background-color: #A9D0F'>" + deudor + "</td>\n\
<td style='background-color: #A9D0F'>" + acreedor + "</td>\n\
<tr>");
            deudor = "";
            acreedor = ""
            total_debe = 0;
            total_haber = 0;
            contador_e++;
        }

        tabla.append("<tr align=center style='background-color: #FC74A6'><td><b>TOTAL DEBE, HABER</b></td><td></td>\n\
<td><b>" + total_deudor + "</b></td>\n\
\n\<td><b>" + total_acreedor + "</b></td>\n\<tr>");
        total=total_acreedor-total_deudor;
        
        tabla.append("<tr align=center style='background-color: #8CDF33'><td><b>TOTAL</b></td><td></td>\n\
<td><b></b></td>\n\
\n\<td><b>" + total + "</b></td>\n\<tr>");
        $('#loading').css("display", "none");



    });
}