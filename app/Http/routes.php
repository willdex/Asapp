<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/


//LOGIN
Route::resource('/','LoginController');
Route::resource('login','LoginController@store');
Route::resource('logout','LoginController@logout');

//CREAR ADMINISTRADORES
Route::resource("administrador","UserController");
Route::get("administradr","UserController@index_2");
Route::get("administradr/create_","UserController@create_2");
Route::post('crear_administrador', 'UserController@store_2');//ENVIAR NOTIFICACION A UN SOLO MOTISTA



//MOTO
Route::resource("moto","MotoController");
Route::get("cargar_moto/{id_moto}","MotoController@cargar_moto");
Route::get("historial_carrera/{id_moto}/{fecha_inicio}/{fecha_fin}","MotoController@historial_carrera");
Route::get("historial_carrera_detalle/{id_pedido}","MotoController@historial_carrera_detalle");
Route::get("historial_carrera_cancelado/{id_moto}/{fecha_inicio}/{fecha_fin}","MotoController@historial_carrera_cancelado");
Route::post('Bloquear_Motista', 'MotoController@Bloquear_Motista');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 
Route::post('Desbloquear_Motista', 'MotoController@Desbloquear_Motista');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 
//Route::get("buscar_moto/{id_moto}","MotoController@buscar_moto");


//USUARIOS
Route::resource("usuario","UsuarioController");
Route::get("cargar_usuario/{id_usuario}","UsuarioController@cargar_usuario");
Route::get("buscar_usuario/{id_usuario}","UsuarioController@buscar_usuario");
Route::get("historial_carrera_usuario/{id_usuario}/{fecha_inicio}/{fecha_fin}","UsuarioController@historial_carrera_usuario");
Route::get("historial_carrera_detalle_usuario/{id_pedido}","UsuarioController@historial_carrera_detalle_usuario");
//Route::get("actualizar_usuario","UsuarioController@actualizar_usuario");
Route::post('actualizar_usuario', 'UsuarioController@actualizar_usuario');
Route::post('Bloquear_Usuario', 'UsuarioController@Bloquear_Usuario');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 
Route::post('Desbloquear_Usuario', 'UsuarioController@Desbloquear_Usuario');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 


//EMPRESA
Route::resource("empresa","EmpresaController");
Route::get("cargar_empresa/{id_empresa}","EmpresaController@cargar_empresa");
Route::get("historial_pedido_empresa/{id_empresa}/{fecha_inicio}/{fecha_fin}","EmpresaController@historial_pedido_empresa");
Route::post('Bloquear_Empresa', 'EmpresaController@Bloquear_Empresa');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 
Route::post('Desbloquear_Empresa', 'EmpresaController@Desbloquear_Empresa');//ENVIAR NOTIFICACION AL MOTISTA Y LO BLOQUEA Y DESLOGUA 

//BUSQUEDA MOTISTA
Route::get("busqueda_motista","MotoController@busqueda_motista");
Route::get("buscar_activos_moto","MotoController@buscar_activos_moto");
Route::get("buscar_inactivos_moto","MotoController@buscar_inactivos_moto");
Route::get("buscar_todas_las_moto","MotoController@buscar_todas_las_moto");
Route::get("buscar_carrera_moto","MotoController@buscar_carrera_moto");
Route::get("buscar_una_moto/{id_moto}","MotoController@buscar_una_moto");



//BUSQUEDA USUARIO
Route::get("busqueda_usuario","UsuarioController@busqueda_usuario");

//BUSQUEDA EMPRESA
Route::get("busqueda_empresa","EmpresaController@busqueda_empresa");


//PAGO DEL MOTISTA
Route::resource("pago_motista","PagarMotistaController");
Route::get("cargar_lista_motista/{id_moto}","MotoController@cargar_lista_motista");
Route::get("cargar_pago_motista/{id_moto}","MotoController@cargar_pago_motista");

//PAGO DE LA EMRPESA
Route::resource("pago_empresa","PagarEmpresaController");
Route::get("cargar_lista_empresa/{id_empresa}","PagarEmpresaController@cargar_lista_empresa");
Route::get("cargar_pago_empresa/{id_empresa}","PagarEmpresaController@cargar_pago_empresa");
Route::get("cargar_lista_empresa_paga","PagarEmpresaController@cargar_lista_empresa_paga");
Route::get("cargar_empresa_paga/{id_empresa}","PagarEmpresaController@cargar_empresa_paga");



//DIRECCION
Route::get("cargar_direccion/{id_emp}/{id_user}","EmpresaController@cargar_direccion");

//TARIFAS
Route::resource("tarifa","TarifaController");
Route::get("cargar_tarifa/{id_tar}","TarifaController@cargar_tarifa");
Route::post('actualizar_tarifa', 'TarifaController@actualizar_tarifa');


//BUSCAR PAGOS EMPRESA
Route::get("lista_pago_empresa","PagosController@lista_pago_empresa");
Route::get("buscar_pagos_todas_las_empresas/{fecha_inicio}/{fecha_fin}","PagosController@buscar_pagos_todas_las_empresas");
Route::get("buscar_pagos_por_empresas/{id_empresa}/{fecha_inicio}/{fecha_fin}","PagosController@buscar_pagos_por_empresas");
Route::get("buscar_pagos_empresa_codigo/{codigo}","PagosController@buscar_pagos_empresa_codigo");

//LISTA PAGOS MOTISTA
Route::get("lista_pago_moto","PagosController@lista_pago_moto");
Route::get("buscar_pagos_todas_las_motos/{fecha_inicio}/{fecha_fin}","PagosController@buscar_pagos_todas_las_motos");
Route::get("buscar_pagos_por_moto/{id_moto}/{fecha_inicio}/{fecha_fin}","PagosController@buscar_pagos_por_moto");
Route::get("buscar_pagos_moto_codigo/{codigo}","PagosController@buscar_pagos_moto_codigo");


//REPORTES
Route::get("reporte_gastos","ReportesController@reporte_gastos");
Route::get("lista_de_gastos/{fecha_inicio}/{fecha_fin}","ReportesController@lista_de_gastos");
Route::get("reporte_motista_com_mas_pedidos","ReportesController@reporte_motista_com_mas_pedidos");
Route::get("lista_motista_com_mas_pedidos/{fecha_inicio}/{fecha_fin}","ReportesController@lista_motista_com_mas_pedidos");

Route::get("reporte_empresa_com_mas_pedidos","ReportesController@reporte_empresa_com_mas_pedidos");
Route::get("lista_empresa_com_mas_pedidos/{fecha_inicio}/{fecha_fin}","ReportesController@lista_empresa_com_mas_pedidos");


//NOTIFICACION
//Route::post('notificacion', 'MotoController@notificacion');//PRUEBAS
Route::resource("notificacion","NotificacionController");
Route::get("Cargar_Notificacion/{fecha_inicio}/{fecha_fin}","NotificacionController@Cargar_Notificacion");

Route::post('notificacion_busqueda_motista', 'MotoController@notificacion_busqueda_motista');//ENVIAR NNOTIFICACION A VARIOS MOTOSTA EN BUSQUEDA
Route::post('notificacion_motista', 'MotoController@notificacion_motista');//ENVIAR NOTIFICACION A UN SOLO MOTISTA
Route::post('notificacion_usuario', 'UsuarioController@notificacion_usuario');//ENVIAR NOTIFICACION A UN SOLO USUAIRO
Route::post('notificacion_empresa', 'EmpresaController@notificacion_empresa');//ENVIAR NOTIFICACION A UN SOLO USUAIRO







