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
        $dFederales = FederalDistrict::get();
        $dLocales = LocalDistrict::get();
        $estados = FederalEntitie::get();
      

        return view('usuario.mapa_seccional', ['municipios' => $municipios, 'dFederales'=> $dFederales, 
                    'dLocales'=> $dLocales, 'estados'=> $estados ]);

    }
    public function seccion($id){
        $seccion = Section::find($id);
        return response(['seccion'=>$seccion]);
    }
    public function secDF($id){
        $secciones = Section::where('Federal_District_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
    public function secDL($id){
        $secciones = Section::where('Local_District_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
    public function secM($id){
        $secciones = Section::where('Town_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
}
