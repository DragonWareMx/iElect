<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Elector;

class SeccionesController extends Controller
{
    function verSecciones()
    {
        //Recibe todas las secciones
        $seccionesTabla = Section::paginate(10);
        $seccionesComp = Section::all();

        return view('usuario.secciones', ['datos' => $seccionesTabla, 'datosBack' => $seccionesComp]);
    }

    function verSeccion($id)
    {
        $seccion = Section::where('id', $id)->get();
        $electores = Elector::where('section_id', $id)->get();
        return view('usuario.seccion', ['datosSec' => $seccion, 'electores' => $electores]);
    }
}
