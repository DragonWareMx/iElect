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
// Route::get('/lays', function () {
//     Mail::to('lopez_lopez_daniel@hotmail.com')->send(new NewSimpMail(23));
//     return 'ya';
// })->name('lay');


//esta ruta es de ejemplo para poner el gate pa checar el rol vaya :v
// Route::get('/test', function () {
//     Gate::authorize('haveaccess', 'admin.perm');
//     return 'hola we';
// })->name('lay')->middleware('auth');
// Route::get('/crear/elector', function () {
//     $elector = new Elector();
//     $elector->uuid = Uuid::generate()->string;
//     $elector->nombre = 'Leonardo';
//     $elector->apellido_p = 'Lopez';
//     $elector->apellido_m = 'Lopez';
//     $elector->job_id = '1';
//     $elector->edo_civil = 'soltero';
//     $elector->fecha_nac = '1999-04-12';
//     $elector->telefono = '4433998915';
//     $elector->email = 'lopez_lopez_daniel@hotmail.com';
//     $elector->red_social = '@LeoLopez';
//     $elector->calle = 'Antono Alzate';
//     $elector->ext_num = '142';
//     $elector->int_num = 'A';
//     $elector->colonia = 'Centro';
//     $elector->localidad = 'Morelia';
//     $elector->municipio = 'Morelia';
//     $elector->cp = '58000';
//     $elector->section_id = '1';
//     $elector->campaign_id = '1';
//     $elector->user_id = '1';
//     $elector->clave_elector = 'LASOASDASLD';
//     $elector->foto_elector = 'foto.jpg';
//     $elector->credencial_a = 'foto1.jpg';
//     $elector->credencial_r = 'foto2.jpg';
//     $elector->save();
//     return 'se hizo';
// });


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
Route::get('/mapa_seccional', 'mapaSeccionalController@index')->middleware(CheckCamp::class)->name('mapa_seccional');
//Ruta Obten sección seleccionada o secciones según el caso
Route::get('/seccion_mapa/{id}/{election}', 'mapaSeccionalController@seccion')->name('seccion_mapa');
Route::get('/dF_mapa/{id}', 'mapaSeccionalController@secDF')->name('dF_mapa');
Route::get('/dL_mapa/{id}', 'mapaSeccionalController@secDL')->name('dL_mapa');
Route::get('/mN_mapa/{id}', 'mapaSeccionalController@secM')->name('mN_mapa');
//Ruta Ajustes
Route::get('/ajustes', 'CuentaController@index')->name('ajustes');

//Ruta Cuenta
Route::get('/ajustes/cuenta', 'CuentaController@cuenta')->name('ajustes_cuenta');

// Ruta para actualizar cuenta de agente y brigadista
Route::patch('/ajustes/cuenta/{id}', 'CuentaController@cuentaUpdate')->name('cuentaUpdate');

//Ruta Partido Electoral
Route::get('/ajustes/partido_electoral', function () {
    return view('usuario.partido_elect');
})->name('ajustes_partido_elect');

/****** SECCIONES ******/
//Secciones
Route::get('/secciones', 'SeccionesController@verSecciones')->name('secciones');

//Seccion
Route::get('/seccion/{id}', 'SeccionesController@verSeccion')->name('seccion');
Route::patch('/seccion/{id}', 'SeccionesController@updCampana')->name('actualizar-campana');

/****** BRIGADISTAS ******/
//Brigadistas
Route::get('/brigadistas', 'brigadistasInfoController@index')->name('brigadistas')->middleware(CheckCamp::class); 

Route::get('/brigadistas/solicitudes', 'brigadistasInfoController@solicitudes')->name('brigadistas_sol');

Route::post('/brigadistas/solicitudes/accion', 'brigadistasInfoController@accion')->name('brigadistas_accion');

/****** SIMPATIZANTES ******/
//Simpatizantes
Route::get('/simpatizantes', 'SimpatizanteController@simpatizantes')->name('simpatizantes')->middleware('auth')->middleware(CheckCamp::class);
//Simpatizantes no aprobados
Route::get('/simpatizantes/no_aprobados', 'SimpatizanteController@simpatizantes_no_aprobados')->name('simpatizantes_no_aprobados')->middleware('auth')->middleware(CheckCamp::class);
//aprobar simpatizantes
Route::patch('/simpatizantes/aprobar', 'SimpatizanteController@aprobarSimpatizantes')->name('aprobar-simpatizante')->middleware('auth')->middleware(CheckCamp::class);
//editar simpatizante (Vista)
Route::get('/simpatizantes/editar/{id}', 'SimpatizanteController@editarSimpatizantes')->name('editar-simpatizante')->middleware('auth');
//editar simpatizante
Route::patch('/simpatizantes/editar/{id}', 'SimpatizanteController@editarSimpatizante')->name('update-simpatizante')->middleware('auth');
//mandar mensaje a simpatizantes
Route::post('/simpatizantes/mensaje', 'SimpatizanteController@mandarMensaje')->name('mensaje-simpatizante')->middleware('auth');
//Simpatizantes
// Route::get('/simpatizantes/solicitudes', function () {
//     return view('usuario.simpatizantes_eliminar');
// })->name('simpatizantes_eliminar')->middleware('auth');

/****** HISTORICO ******/
//Historico
Route::get('/historico', 'historicoController@index')->middleware(CheckCamp::class)->name('historico');
Route::get('/historico_seccion/{id}/{election}','historicoController@seccion')->name('historicoSc');

/********************/
/***    ADMIN    ****/
/********************/
//Admin | Inicio
Route::get('/admin/404', function () {
    return view('admin.404');
})->name('admin-404');

//Admin | Inicio
Route::get('/admin/inicio', 'adminController@inicio')->name('admin-inicio');  /////////////////////////////////////////////////////////////////

//Admin | agregar usuario
Route::post('/admin/agregar/usuario', 'adminController@agregarUsuario')->name('agregar-usuario');  /////////////////////////////////////////////////

//Admin | editar usuario
Route::patch('/admin/editar/usuario/{id}', 'adminController@editarUsuario')->name('editar-usuario');  ////////////////////////////////////////////////

//Admin | eliminar usuario
Route::delete('/admin/eliminar/usuario/{id}', 'adminController@eliminarUsuario')->name('eliminar-usuario');  /////////////////////////////////////////

//Admin | Usuarios
Route::get('/admin/usuarios', 'adminController@verUsuarios')->name('admin-usuarios');  /////////////////////////////////////////////////

//Admin | agregar campaña
Route::post('/admin/agregar/campana', 'adminController@agregarCampana')->name('agregar-campana'); ///////////////////////////////////////////////

//Admin | eliminar campaña a usuario
Route::patch('/admin/eliminar/campana/{idCampana}/usuario/{idUser}', 'adminController@eliminarCampanaUsuario')->name('eliminar-campanaUsuario');

//Admin | asignar campaña a usuario
Route::patch('/admin/asignar/campana/usuario/{id}', 'adminController@asignarCampana')->name('editar-usuario-campana');

//Admin | Cuenta
Route::get('/admin/cuenta', 'CuentaController@cuentaAdmin')->name('admin-cuenta');

// Admin  | Cuentas Update
Route::patch('/admin/cuenta/{id}', 'CuentaController@cuentaUpdateAdmin')->name('cuentaUpdateAdmin');

//Admin | Seccion
Route::get('/admin/seccion', function () {
    return view('admin.seccion');
})->name('admin-seccion');

//Admin | Usuario
Route::get('/admin/usuarios/usuario/{id}', 'adminController@verUsuario')->name('admin-usuario'); ////////////////////////////////////////////////

//Admin | Editar usuario
Route::get('/admin/usuarios/usuario/edit', function () {
    return view('admin.usuario_editar');
})->name('admin-usuario_edit');

/*******************/
/*** BRIGADISTAS ***/
/*******************/

//Brigadistas | Simpatizantes

//RUTA OBSOLETA--------------------------------------------

//Route::get('/brigadistas/inicio', 'SimpatizanteController@simpatizantes')->name('brigadistas-inicio')->middleware('auth');

//agregar simpatizante
Route::post('/simpatizantes/agregar', 'SimpatizanteController@agregarSimpatizante')->name('agregar-simpatizante')->middleware('auth');

/********************/
/**  SIMPATIZANTE  **/
/********************/

//Simpatizante | Aviso de privacidad
Route::get('/simpatizante/aviso', function () {
    return view('simpatizante.aviso_datos');
})->name('simpatizante-aviso');

Route::get('/aviso-de-privacidad', function () {
    return view('simpatizante.aviso_privacidad');
})->name('avisoprivacidad');

Route::get('/terminos-y-condiciones', function () {
    return view('simpatizante.aviso_terminos');
})->name('terminoscondiciones');

//Simpatizante | Solicitud de baja
Route::get('/simpatizante/baja/{uuid}', 'SimpatizanteController@index')->name('simpatizante-solicitud_baja');

Route::delete('/simpatizante/baja/{uuid}', 'SimpatizanteController@delete')->name('solicitud_baja-delete');

//Ruta para elegir campaña
Route::get('/campana/elegir', 'HomeController@campana')->name('campana-select');

Route::post('/campana/elegir', 'HomeController@campSession')->name('campana-select-post');

//Rutas para ver campañas
Route::get('/admin/campanas', 'adminController@verCampanas')->name('ver.campanas');

//Rutas para borrar campañas
Route::delete('/admin/eliminar/campana/{id}', 'adminController@eliminarCampana')->name('eliminar-campana');

//Rutas para ver campaña
Route::get('/admin/campana/{id}', 'adminController@verCampana')->name('ver-campana');

//Rutas para ver campaña
Route::patch('/admin/editar/seccion/{id}', 'adminController@editarSeccion')->name('editar-secction');
