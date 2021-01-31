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
use Illuminate\Validation\Rule;

class SimpatizanteController extends Controller
{
    //
    public function index($uuid)
    {
        $elector = Elector::where('uuid', '=', $uuid)->first();
        if (!$elector)
            abort(404);
        return view('simpatizante.solicitud_baja', ['uuid' => $uuid, 'campaign' => $elector->campaign->name]);
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

    public function simpatizantes()
    {
        //$campana = session()->get('campana');
        $campana = Campaign::find(1);

        //Recibe todas las secciones
        $simpatizantes = Elector::paginate(10);

        $ocupaciones = Job::all();

        if (!is_null($campana)) {
            $secciones = Section::whereHas('campaign', function (Builder $query) use ($campana) {
                $query->where('campaigns.id', '=', $campana->id);
            })->get();
        } else {
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
            'nombre'=>['required','max:100','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'apellido_paterno'=>['nullable','max:100','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'apellido_materno'=>['nullable','max:100','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'correo_electronico'=>'required|max:320|email',
            'sexo'=>['required',Rule::in(['h', 'm']),],
            'trabajo'=>'required|exists:jobs,nombre',
            'telefono'=>['required','regex:/^[0-9]{3}[ -]*[0-9]{3}[ -]*[0-9]{4}$/'],
            'estado_civil'=>['required',Rule::in(['soltero', 'casado', 'unionl', 'separado', 'divorciado', 'viudo']),],
            'clave_elector'=>['required','max:20','min:16','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'colonia'=>['required','max:100','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'calle'=>['nullable','max:100','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'num_exterior'=>['nullable','max:10','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'num_interior'=>['nullable','max:10','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'CP'=>['required','regex:/^[0-9]{5}$/'],
            'facebook'=>['nullable','max:50','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'twitter'=>['nullable','max:50','regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'foto_anverso'=>'mimes:jpeg,jpg,png,gif|image',
            'foto_inverso'=>'mimes:jpeg,jpg,png,gif|image',
        ]);

        try {
            DB::transaction(function () use ($request) {
                $simpatizante=new Elector();
                $simpatizante->uuid = Uuid::generate()->string;
                $simpatizante->nombre=$request->nombre;
                $simpatizante->apellido_p=$request->apellido_paterno;
                $simpatizante->apellido_m=$request->apellido_materno;
                $simpatizante->email=$request->correo_electronico;
                $simpatizante->sexo=$request->sexo;

                //encuentra el trabajo
                $trabajo = Job::where('nombre','=',$request->trabajo);

                $simpatizante->job_id=$request->trabajo;
                $simpatizante->telefono=$request->telefono;
                $simpatizante->edo_civil=$request->estado_civil;

                //FALTA: obtener fecha de nacimiento
                $simpatizante->fecha_nac='1999-06-05';

                $simpatizante->clave_elector=$request->clave_elector;

                //DATOS DOMICILIO
                $simpatizante->colonia=$request->colonia;
                $simpatizante->calle=$calle->calle;
                $simpatizante->ext_num=$request->num_exterior;
                $simpatizante->int_num=$request->num_interior;
                $simpatizante->cp=$request->CP;

                /*
                FALTA:
                REDES SOCIALES
                LOCALIDAD
                MUNICIPIO
                SECTION ID
                CAMPAIGNID
                USER ID
                DOCUMENTO
                */
                
                /*
                if($request->foto_anverso){
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileField')->storeAs('/public/uploads/', $newFileName);
                    $usuario->avatar = $newFileName;
                }

                if($request->foto_anverso){
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo( $fileNameWithTheExtension,PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName=$fileName.'_'.time().'.'.$extension;
                    $path = request('fileField')->storeAs('/public/uploads/',$newFileName);
                    $usuario->avatar=$newFileName;
                }*/

                $simpatizante->save();
            });
            if ($request->ajax()) {
                session()->flash('status', 'Usuario creado con éxito!');
                return 200;
            }
        } catch (QueryException $ex) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        }
    }
}