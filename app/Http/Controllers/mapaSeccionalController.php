<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Town;
use App\Models\Section;
use App\Models\FederalDistrict;
use App\Models\LocalDistrict;
use App\Models\FederalEntitie;

class mapaSeccionalController extends Controller
{
    public function index(){
        $municipios = Town::get();
        $secciones = Section::get();
        $dFederales = FederalDistrict::get();
        $dLocales = LocalDistrict::get();
        $estados = FederalEntitie::get();
      

        return view('usuario.mapa_seccional', ['municipios' => $municipios, 'secciones'=> $secciones, 'dFederales'=> $dFederales, 
                    'dLocales'=> $dLocales, 'estados'=> $estados ]);

    }
    public function seccion($id){
        $seccion = Section::find($id);

        return response(['seccion'=>$seccion]);
    }
}
