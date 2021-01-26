<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;

class SeccionesController extends Controller
{
    function verSecciones()
    {
        //Recibe todas las secciones
        $secciones = Section::all();
        //dd($secciones);

        return view('usuario.secciones', ['datos' => $secciones]);
    }
}
