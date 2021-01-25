<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Town;
use App\Models\Section;
use App\Models\FederalDistrict;
use App\Models\LocalDistrict;
use App\Models\FederalEntitie;
use App\Models\Vote;
use App\Models\PoliticPartie;

//use App\Models\Campaigne;

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
        //$puesto = se saca de la sesión, de la campaña... cuando haya registros hay que ponerlo, usamos mientras uno de prueba.
        //$eleccion = se va a sacar la última donde hubo ese puesto, se usará un while y un contador hacia atrás si el resultado es nulo se pone la siguiente.
        $puesto = 2; //es el id de puesto de Gobernador
        $votos = Vote::where([['section_id','=', $id],['position_id', '=',$puesto],['election_id','=', 1]])->get();
        
        
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
