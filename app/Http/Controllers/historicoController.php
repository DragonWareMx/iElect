<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Section;
use App\Models\Vote;
use App\Models\PoliticPartie;


class historicoController extends Controller
{
    public function index(){
        $secciones = Section::get();//aquí se cambiará sólo por las secciones asignadas
        return view('usuario.historico', ['secciones'=>$secciones]);
    }

    public function seccion($id){
        $seccion = Section::find($id);
        //$puesto = se saca de la sesión, de la campaña... cuando haya registros hay que ponerlo, usamos mientras uno de prueba.
        //$eleccion = se va a sacar la última donde hubo ese puesto, se usará un while y un contador hacia atrás si el resultado es nulo se pone la siguiente.
        $puesto = 2; //es el id de puesto de Gobernador
        $votos = Vote::where([['section_id','=', $id],['position_id', '=',$puesto],['election_id','=', 1]])->orderBy('num', 'desc')->get();
        
        $partidos=[];
        $num = [];
        $colores =[];
        $promedios =[];
        $ganadores = [];
        $puestos = [];
        $idPuestos =[];
        $voteWin =[];
        $i=0;

        
        foreach ($votos as $voto) {
            $ejemplo[$i]=$voto->section->id;
            $partidos[$i]=$voto->politic_partie->siglas;
            $idPartie=$voto->politic_partie->id;
            $num[$i]=$voto->num;
            $colores[$i]=$voto->politic_partie->color;
            
            $promedios[$i]=0;
            $j=0;
            
            $voteXpartie=Vote::where([['section_id', '=', $id],['election_id', '=', 1],['politic_partie_id', '=', $idPartie]])->get();
            foreach ($voteXpartie as $vote){
                $promedios[$i] += $vote->num; 
                $puestos[$j] = $vote->position->name;
                $idPuestos[$j] = $vote->position->id;
                $j++;
            }
            $promedios[$i]/=$j;
            $k=0;
            foreach($puestos as $p){
                $winXpos=Vote::where([['section_id','=', $id],['position_id', '=',$idPuestos[$k]],['election_id','=', 1]])->orderBy('num', 'desc')->first();
                $ganadores[$k]=$winXpos->politic_partie->siglas; //cambiar por logo después, no?
                $voteWin[$k]=$winXpos->num;
                $k++;
            }
            
            $i++;
        }
        
        return response(['seccion'=>$seccion, 'partidos'=>$partidos, 'num'=>$num, 'colores'=>$colores, 'promedios'=>$promedios, 
        'ganadores'=>$ganadores, 'puestos'=>$puestos, 'voteWin'=>$voteWin]);
    }
}
