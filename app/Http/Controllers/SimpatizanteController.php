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
use Webpatser\Uuid\Uuid;

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

    public function agregarSimpatizante(Request $request)
    {
        $data = request()->validate([
            'seccion' => 'required|exists:sections,id',
            'nombre' => ['required', 'max:100', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'apellido_paterno' => ['required', 'max:100', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'apellido_materno' => ['nullable', 'max:100', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'correo_electronico' => 'nullable|max:320|email',
            'fecha_de_nacimiento' => 'required|date|before:today',
            'sexo' => ['required', Rule::in(['h', 'm']),],
            'trabajo' => 'required|exists:jobs,nombre',
            'telefono' => ['required_without:correo_electronico', 'regex:/^[0-9]{3}[ -]{0,1}[0-9]{3}[ -]{0,1}[0-9]{4}$/'],
            'estado_civil' => ['nullable', Rule::in(['soltero', 'casado', 'unionl', 'separado', 'divorciado', 'viudo']),],
            'clave_elector' => ['required', 'max:20', 'min:16', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'colonia' => ['required', 'max:100', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'calle' => ['nullable', 'max:100', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'num_exterior' => ['nullable', 'max:10', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'num_interior' => ['nullable', 'max:10', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'CP' => ['required', 'regex:/^[0-9]{5}$/'],
            'facebook' => ['nullable', 'max:50', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'twitter' => ['nullable', 'max:50', 'regex:/^([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-])+((\s*)+([0-9a-zA-ZñÑáéíóúÁÉÍÓÚ_-]*)*)+$/'],
            'foto_anverso' => 'required|mimes:jpeg,jpg,png|image',
            'foto_inverso' => 'required|mimes:jpeg,jpg,png|image',
            'foto_de_elector' => 'nullable|mimes:jpeg,jpg,png|image',
            'foto_de_firma' => 'nullable|mimes:jpeg,jpg,png|image',
        ]);

        try {
            DB::transaction(function () use ($request) {
                //SE CREA EL ELECTOR
                $simpatizante = new Elector();

                //UUID
                $simpatizante->uuid = Uuid::generate()->string;

                //DATOS PERSONALES
                $simpatizante->nombre = $request->nombre;
                $simpatizante->apellido_p = $request->apellido_paterno;
                $simpatizante->apellido_m = $request->apellido_materno;
                $simpatizante->email = $request->correo_electronico;
                $simpatizante->sexo = $request->sexo;
                //encuentra el trabajo
                $trabajo = Job::where('nombre', '=', $request->trabajo)->first();
                $simpatizante->job_id = $trabajo->id;
                $simpatizante->telefono = $request->telefono;
                $simpatizante->edo_civil = $request->estado_civil;
                $simpatizante->fecha_nac = $request->fecha_de_nacimiento;
                $simpatizante->clave_elector = $request->clave_elector;

                //DATOS DOMICILIO
                $simpatizante->colonia = $request->colonia;
                $simpatizante->calle = $request->calle;
                $simpatizante->ext_num = $request->num_exterior;
                $simpatizante->int_num = $request->num_interior;
                $simpatizante->cp = $request->CP;
                //se obtiene la seccion
                $seccion = Section::find($request->seccion);
                $simpatizante->localidad = $seccion->local_district->numero;
                $simpatizante->municipio = $seccion->town->numero;
                $simpatizante->section_id = $seccion->id;
                $simpatizante->campaign_id = 1;
                $simpatizante->user_id = 1;
                //$simpatizante->user_id = auth()->user()->id;

                //OTROS DATOS
                $simpatizante->facebook = $request->facebook;
                $simpatizante->twitter = $request->twitter;

                /*
                FALTA:
                LOCALIDAD*
                MUNICIPIO*
                USERID*
                CAMPAIGNID*
                DOCUMENTO
                */

                if ($request->foto_anverso) {
                    $fileNameWithTheExtension = request('foto_anverso')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('foto_anverso')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('foto_anverso')->storeAs('/public/uploads/', $newFileName);
                    $simpatizante->credencial_a = $newFileName;
                }

                if ($request->foto_inverso) {
                    $fileNameWithTheExtension = request('foto_inverso')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('foto_inverso')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('foto_inverso')->storeAs('/public/uploads/', $newFileName);
                    $simpatizante->credencial_r = $newFileName;
                }
                if ($request->foto_de_elector) {
                    $fileNameWithTheExtension = request('foto_de_elector')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('foto_de_elector')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('foto_de_elector')->storeAs('/public/uploads/', $newFileName);
                    $simpatizante->credencial_r = $newFileName;
                }
                if ($request->foto_de_firma) {
                    $fileNameWithTheExtension = request('foto_de_firma')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('foto_de_firma')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('foto_de_firma')->storeAs('/public/uploads/', $newFileName);
                    $simpatizante->credencial_r = $newFileName;
                }

                $simpatizante->save();
            });
            if ($request->ajax()) {
                session()->flash('status', 'Usuario creado con éxito!');
                return 200;
            }
        } catch (QueryException $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            if ($request->ajax()) {
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        } catch (Exception $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            if ($request->ajax()) {
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        } catch (Throwable $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            if ($request->ajax()) {
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        }
    }
}