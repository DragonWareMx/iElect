<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

//Ruta layou
/*Route::get('/lay', function () {
    return view('layouts.layout');
})->name('lay');
*/

/****** LOGIN ******/
//Ruta Login
Route::get('/', function () {
    return view('login.index');
})->name('index');

//Ruta Recuperar contraseña
Route::get('/recuperar_contrasena', function () {
    return view('login.recuperar_contrasena');
})->name('recuperar_contra');

//Ruta Recuperar contraseña
Route::get('/registro_brigadista', function () {
    return view('login.registro_brig');
})->name('registro_brig');


//Home
Route::get('/inicio', function () {
    return view('usuario.home');
})->name('home');

//Ruta Mapa Seccional
Route::get('/mapa_seccional','mapaSeccionalController@index' )->name('mapa_seccional');
//Ruta Obten sección seleccionada o secciones según el caso
Route::get('/seccion_mapa/{id}','mapaSeccionalController@seccion')->name('seccion_mapa');
Route::get('/dF_mapa/{id}','mapaSeccionalController@secDF')->name('dF_mapa');
Route::get('/dL_mapa/{id}','mapaSeccionalController@secDL')->name('dL_mapa');
Route::get('/mN_mapa/{id}','mapaSeccionalController@secM')->name('mN_mapa');
//Ruta Ajustes
Route::get('/ajustes', function () {
    return view('usuario.ajustes');
})->name('ajustes');

//Ruta Cuenta
Route::get('/ajustes/cuenta', function () {
    return view('usuario.cuenta');
})->name('ajustes_cuenta');

//Ruta Partido Electoral
Route::get('/ajustes/partido_electoral', function () {
    return view('usuario.partido_elect');
})->name('ajustes_partido_elect');

/****** SECCIONES ******/
//Secciones
Route::get('/secciones', function () {
    return view('usuario.secciones');
})->name('secciones');

//Seccion
Route::get('/seccion', function () {
    return view('usuario.seccion');
})->name('seccion');

/****** BRIGADISTAS ******/
//Brigadistas
Route::get('/brigadistas', function () {
    return view('usuario.brigadistas');
})->name('brigadistas');

Route::get('/brigadistas/solicitudes', function () {
    return view('usuario.brigadistas_solicitudes');
})->name('brigadistas_sol');

/****** SIMPATIZANTES ******/
//Simpatizantes
Route::get('/simpatizantes', function () {
    return view('usuario.simpatizantes');
})->name('simpatizantes');

//Simpatizantes
Route::get('/simpatizantes/solicitudes', function () {
    return view('usuario.simpatizantes_eliminar');
})->name('simpatizantes_eliminar');

/****** HISTORICO ******/
//Historico
Route::get('/historico', 'historicoController@index')->name('historico');
Route::get('/historico_seccion/{id}','historicoController@seccion')->name('historicoSc');

/********************/
/***    ADMIN    ****/
/********************/
//Admin | Inicio
Route::get('/admin/404', function () {
    return view('admin.404');
})->name('admin-404');

//Admin | Inicio
Route::get('/admin/inicio', function () {
    return view('admin.inicio');
})->name('admin-inicio');

//Admin | Cuenta
Route::get('/admin/cuenta', function () {
    return view('admin.cuenta');
})->name('admin-cuenta');

//Admin | Seccion
Route::get('/admin/seccion', function () {
    return view('admin.seccion');
})->name('admin-seccion');

//Admin | Usuarios
Route::get('/admin/usuarios', function () {
    return view('admin.usuarios');
})->name('admin-usuarios');

//Admin | Usuario
Route::get('/admin/usuarios/usuario', function () {
    return view('admin.usuario');
})->name('admin-usuario');

//Admin | Editar usuario
Route::get('/admin/usuarios/usuario/edit', function () {
    return view('admin.usuario_editar');
})->name('admin-usuario_edit');

/*******************/
/*** BRIGADISTAS ***/
/*******************/

//Brigadistas | Simpatizantes
Route::get('/brigadistas/inicio', function () {
    return view('brigadista.simpatizantes');
})->name('brigadistas-inicio');

/********************/
/**  SIMPATIZANTE  **/
/********************/

//Simpatizante | Aviso de privacidad
Route::get('/simpatizante/aviso', function () {
    return view('simpatizante.aviso_datos');
})->name('simpatizante-aviso');

//Simpatizante | Solicitud de baja
Route::get('/simpatizante/baja', function () {
    return view('simpatizante.solicitud_baja');
})->name('simpatizante-solicitud_baja');
