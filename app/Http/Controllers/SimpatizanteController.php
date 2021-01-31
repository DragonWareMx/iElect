<?php

namespace App\Http\Controllers;

use App\Models\Elector;
use App\Models\Section;
use App\Models\Campaign;
use App\Models\Job;
use App\Models\LocalDistrict;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Builder;

class SimpatizanteController extends Controller
{
    //
    public function index($uuid)
    {
        $elector = Elector::where('uuid', '=', $uuid)->first();
        if (!$elector)
            abort(404);
        return view('simpatizante.solicitud_baja', ['uuid' => $uuid]);
    }

    public function delete(Request $request, $uuid)
    {
        DB::beginTransaction();
        try {
            if ($uuid != $request->uuid)
                throw new Exception();
            $elector = Elector::where('uuid', '=', $uuid)->first();
            $elector->delete();
            DB::commit();
            return response()->json(200);
        } catch (\Exception $ex) {
            //throw $th;
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function simpatizantes(){
        //$campana = session()->get('campana');
        $campana = Campaign::find(1);

        //Recibe todas las secciones
        $simpatizantes = Elector::paginate(10);

        $ocupaciones = Job::all();

        if(!is_null($campana))
        {    
            $secciones = Section::whereHas('campaign', function (Builder $query) use ($campana) {
                $query->where('campaigns.id', '=', $campana->id);
            })->get();
        }
        else{
            $secciones = null;
        }

        /*
        $localidades = LocalDistrict::whereHas('section', function (Builder $query) use ($campana) {
            $query->where('section.id', '=', $campana->id);
        })->get();*/

        return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'secciones' => $secciones, 'ocupaciones' => $ocupaciones]);
    }

    public function agregarSimpatizante(){
        $data=request()->validate([
            'nombre'=>'required | max:100 | alpha',
            'apellido_p'=>'max:100 | alpha',
            'apellido_m'=>'max:100 | alpha',
            'email'=>'required|max:320|email',
            'sexo'=>['required',Rule::in(['h', 'm']),],
            'trabajo'=>'required|exists:job,nombre',
            'telefono'=>'required|regex:/[0-9]{3}[ -]*[0-9]{3}[ -]*[0-9]{4}/',
            'clave_elector'=>'required|max:20|min:16|alpha_num',
            'colonia'=>'max:100 | alpha_num',
            'calle'=>'max:100 | alpha_num',
            'num_ext'=>'max:10 | alpha_num',
            'num_int'=>'max:10 | alpha_num',
            'cp'=>'max:5 | alpha_num | numeric',
            'facebook'=>'max:50 | alpha_num',
            'twitter'=>'max:50 | alpha_num',
            'fileField'=>'mimes:jpeg,jpg,png,gif|image'
        ]);

        dd(request());

        try{
            DB::transaction(function () use ($request) {
                $usuario=new User();
                $usuario->name=$request->name;
                $usuario->email=$request->email;
                $usuario->password=Hash::make($request->password);
                if($request->fileField){
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo( $fileNameWithTheExtension,PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName=$fileName.'_'.time().'.'.$extension;
                    $path = request('fileField')->storeAs('/public/uploads/',$newFileName);
                    $usuario->avatar=$newFileName;
                }
                $usuario->save();
                if($request->type=="admin")
                    $usuario->roles()->sync(1);
                else
                    $usuario->roles()->sync(2);
            });
            if($request->ajax()){
                session()->flash('status','Usuario creado con éxito!');
                return 200;
            }
        }
        catch(QueryException $ex){
            if($request->ajax()){
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        }
    }
}