<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use App\Models\User;
use App\Models\Town;
use App\Models\Section;
use App\Models\FederalDistrict;
use App\Models\LocalDistrict;
use App\Models\FederalEntitie;
use App\Models\Vote;
use App\Models\PoliticPartie;
use App\Models\Campaigne;


class mapaSeccionalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        
        Gate::authorize('haveaccess', 'agente.perm');
        $campana = session()->get('campana');

        if ($campana->position->id == 3){
            $municipios = Town::findOrFail($campana->section[0]->town_id);
            $estados = FederalEntitie::get();
            return view('usuario.mapa_seccional', ['municipios' => $municipios, 'estados'=> $estados ]);
        }
        else if($campana->position->id == 4){
            $dFederales = FederalDistrict::findOrFail($campana->section[0]->federal_district_id);  
            $estados = FederalEntitie::get(); 
            return view('usuario.mapa_seccional', ['dFederales'=> $dFederales, 'estados'=> $estados ]);
        }
        else if($campana->position->id == 5){
            $dLocales = LocalDistrict::findOrFail($campana->section[0]->local_district_id);  
            $estados = FederalEntitie::get();
            return view('usuario.mapa_seccional', ['dLocales'=> $dLocales, 'estados'=> $estados ]);
        }
        else{
            $municipios = Town::get();
            $dFederales = FederalDistrict::get();
            $dLocales = LocalDistrict::get();
            $estados = FederalEntitie::get();

            return view('usuario.mapa_seccional', ['municipios' => $municipios, 'dFederales'=> $dFederales, 
                    'dLocales'=> $dLocales, 'estados'=> $estados ]);
        }

    }

    public function seccion($id){
        Gate::authorize('haveaccess', 'agente.perm');
        $campana = session()->get('campana');
        $seccion = Section::find($id);
        //$eleccion = se va a sacar la última donde hubo ese puesto, se usará un while y un contador hacia atrás si el resultado es nulo se pone la siguiente.
        $puesto = $campana->position_id; //es el id de puesto
        $votos = Vote::where([['section_id','=', $id],['position_id', '=',$puesto],['election_id','=', 1]])->orderBy('num', 'desc')->get();
        
        
        $partidos=[];
        $num = [];
        $colores =[];
        $i=0;

        
        foreach ($votos as $voto) {
            $ejemplo[$i]=$voto->section->id;
            $partidos[$i]=$voto->politic_partie->siglas;
            $num[$i]=$voto->num;
            $colores[$i]=$voto->politic_partie->color;
            $i++;
        }
        
        
        return response(['seccion'=>$seccion, 'partidos'=>$partidos, 'num'=>$num, 'colores'=>$colores]);
    }
    public function secDF($id){
        Gate::authorize('haveaccess', 'agente.perm');
        $secciones = Section::where('Federal_District_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
    public function secDL($id){
        Gate::authorize('haveaccess', 'agente.perm');
        $secciones = Section::where('Local_District_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
    public function secM($id){
        Gate::authorize('haveaccess', 'agente.perm');
        $secciones = Section::where('Town_id',$id)->get();
        return response(['secciones'=>$secciones]);
    }
}
