<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use Illuminate\Http\Request;

class SimpatizanteController extends Controller
{
    //
    public function index($uuid)
    {
        $elector = Elector::where('uuid', '=', $uuid)->first();
        if (!$elector)
            abort(404);
        return view('simpatizante.solicitud_baja');
    }
}