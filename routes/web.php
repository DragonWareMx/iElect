<?php

use Illuminate\Support\Facades\Route;

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

//Ruta Login
Route::get('/', function () {
    return view('login.index');
})->name('index');

//Ruta Recuperar contraseña
Route::get('/recuperar_contrasena', function () {
    return view('login.recuperar_contrasena');
})->name('recuperar_contra');


//Ruta Cuenta
Route::get('/cuenta', function () {
    return view('usuario.cuenta');
})->name('cuenta');
