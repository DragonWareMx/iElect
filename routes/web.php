<?php

//use Illuminate\Support\Facades\Gate;

use App\Http\Controllers\SeccionesController;
use App\Http\Middleware\CheckCamp;
use App\Models\Elector;

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Auth;


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
// Route::get('/lay', function () {
//     Mail::to('lopez_lopez_daniel@hotmail.com')->send(new NewSimpMail(1));
//     return 'ya';
// })->name('lay');


//esta ruta es de ejemplo para poner el gate pa checar el rol vaya :v
// Route::get('/test', function () {
//     Gate::authorize('haveaccess', 'admin.perm');
//     return 'hola we';
// })->name('lay')->middleware('auth');
Route::get('/crear/elector', function () {
    $elector = new Elector();
    $elector->uuid = Uuid::generate()->string;
    $elector->nombre = 'Leonardo';
    $elector->apellido_p = 'Lopez';
    $elector->apellido_m = 'Lopez';
    $elector->job_id = '1';
    $elector->edo_civil = 'soltero';
    $elector->fecha_nac = '1999-04-12';
    $elector->telefono = '4433998915';
    $elector->email = 'lopez_lopez_daniel@hotmail.com';
    $elector->red_social = '@LeoLopez';
    $elector->calle = 'Antono Alzate';
    $elector->ext_num = '142';
    $elector->int_num = 'A';
    $elector->colonia = 'Centro';
    $elector->localidad = 'Morelia';
    $elector->municipio = 'Morelia';
    $elector->cp = '58000';
    $elector->section_id = '1';
    $elector->campaign_id = '1';
    $elector->user_id = '1';
    $elector->clave_elector = 'LASOASDASLD';
    $elector->foto_elector = 'foto.jpg';
    $elector->credencial_a = 'foto1.jpg';
    $elector->credencial_r = 'foto2.jpg';
    $elector->save();
    return 'se hizo';
});


//Ruta principal
Route::get('/', function () {
    return redirect()->route('home');
})->name('index');

/****** LOGIN ******/
Auth::routes(['register' => false]);
//Ruta registro brigadista
Route::get('/registro/brigadista', function () {
    return view('login.registro_brig');
})->name('registro_brig');

Route::post('/registro/brigadista', 'OrderController@brigadista')->name('registro.brig');

//Home
Route::get('/inicio', 'HomeController@index')->middleware(CheckCamp::class)->name('home');

//Ruta Mapa Seccional
Route::get('/mapa_seccional', 'mapaSeccionalController@index')->name('mapa_seccional');
//Ruta Obten sección seleccionada o secciones según el caso
Route::get('/seccion_mapa/{id}', 'mapaSeccionalController@seccion')->name('seccion_mapa');
Route::get('/dF_mapa/{id}', 'mapaSeccionalController@secDF')->name('dF_mapa');
Route::get('/dL_mapa/{id}', 'mapaSeccionalController@secDL')->name('dL_mapa');
Route::get('/mN_mapa/{id}', 'mapaSeccionalController@secM')->name('mN_mapa');
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
Route::get('/secciones', 'SeccionesController@verSecciones')->name('secciones');

//Seccion
Route::get('/seccion/{id}', 'SeccionesController@verSeccion')->name('seccion');

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
Route::get('/simpatizantes', 'simpatizanteController@simpatizantes')->name('simpatizantes');

//agregar simpatizante
Route::post('/simpatizantes/agregar', 'simpatizanteController@agregarSimpatizante')->name('agregar-simpatizante');

//Simpatizantes
Route::get('/simpatizantes/solicitudes', function () {
    return view('usuario.simpatizantes_eliminar');
})->name('simpatizantes_eliminar');

/****** HISTORICO ******/
//Historico
Route::get('/historico', function () {
    return view('usuario.historico');
})->name('historico');


/********************/
/***    ADMIN    ****/
/********************/
//Admin | Inicio
Route::get('/admin/404', function () {
    return view('admin.404');
})->name('admin-404');

//Admin | Inicio
Route::get('/admin/inicio', 'adminController@inicio')->name('admin-inicio');

//Admin | agregar usuario
Route::post('/admin/agregar/usuario', 'adminController@agregarUsuario')->name('agregar-usuario');

//Admin | editar usuario
Route::patch('/admin/editar/usuario/{id}', 'adminController@editarUsuario')->name('editar-usuario');

//Admin | eliminar usuario
Route::delete('/admin/eliminar/usuario/{id}', 'adminController@eliminarUsuario')->name('eliminar-usuario');

//Admin | Cuenta
Route::get('/admin/cuenta', function () {
    return view('admin.cuenta');
})->name('admin-cuenta');

//Admin | Seccion
Route::get('/admin/seccion', function () {
    return view('admin.seccion');
})->name('admin-seccion');

//Admin | Usuarios
Route::get('/admin/usuarios', 'adminController@verUsuarios')->name('admin-usuarios');

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
})->name('brigadistas-inicio')->middleware('auth');

/********************/
/**  SIMPATIZANTE  **/
/********************/

//Simpatizante | Aviso de privacidad
Route::get('/simpatizante/aviso', function () {
    return view('simpatizante.aviso_datos');
})->name('simpatizante-aviso');

//Simpatizante | Solicitud de baja
Route::get('/simpatizante/baja/{uuid}', 'SimpatizanteController@index')->name('simpatizante-solicitud_baja');

Route::delete('/simpatizante/baja/{uuid}', 'SimpatizanteController@delete')->name('solicitud_baja-delete');

//Ruta para elegir campaña
Route::get('/campana/elegir', 'HomeController@campana')->name('campana-select');

Route::post('/campana/elegir', 'HomeController@campSession')->name('campana-select-post');