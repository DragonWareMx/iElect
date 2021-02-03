<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

use App\Models\User;
use App\Models\Campaign;
use App\Permission\Models\Role;
use App\Models\Position;
use App\Models\PoliticPartie;
use App\Models\LocalDistrict;
use App\Models\FederalDistrict;
use App\Models\Town;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Campaign_Section;

class adminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function inicio()
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $totalUsers=User::get()->count();
        $totalAdmins=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',1)->get()->count();
        $totalAgents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get()->count();
        $totalBrigadists=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',3)->get()->count();
        $totalCampanas=Campaign::get()->count();
        $positions=Position::get();
        $parties=PoliticPartie::get();
        $agents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('status','activo')->where('role_user.role_id',2)->get();
        $federales=FederalDistrict::get();
        $locales=LocalDistrict::get();
        $municipios=Town::get();
        $campanas=Campaign::orderBy('id','DESC')->limit(4)->get();
        $graficaPastel=[];
        $i=0;
        foreach($parties as $partie){
            $graficaPastel[$i]=0;
            if($partie->campaign->count()>0){
                foreach($partie->campaign as $campana){
                    $graficaPastel[$i]+=$campana->elector->where('aprobado',1)->count();
                }
            }
            else{
                $graficaPastel[$i]+=0;
            }
            $i++;
        }
        $totalSimps=Elector::where('aprobado',1)->get()->count();
        $seccionesCubiertas=Section::join('campaign_section','sections.id','=','campaign_section.section_id')->get()->count();
        $federalesCubiertos=Section::select('federal_district_id')->join('campaign_section','sections.id','=','campaign_section.section_id')->groupBy('sections.federal_district_id')->get()->count();
        $localesCubiertos=Section::select('local_district_id')->join('campaign_section','sections.id','=','campaign_section.section_id')->groupBy('sections.local_district_id')->get()->count();
        $municipiosCubiertos=Section::select('town_id')->join('campaign_section','sections.id','=','campaign_section.section_id')->groupBy('sections.town_id')->get()->count();
        $entidadesCubiertas=Section::select('federal_entitie_id')->join('campaign_section','sections.id','=','campaign_section.section_id')->join('towns','sections.town_id','=','towns.id')->groupBy('towns.federal_entitie_id')->get()->count();
        return view('admin.inicio',[
            'totalUsers'=>$totalUsers,
            'totalAdmins'=>$totalAdmins,
            'totalAgents'=>$totalAgents,
            'totalBrigadists'=>$totalBrigadists,
            'totalCampanas'=>$totalCampanas,
            'positions'=>$positions,
            'parties'=>$parties,
            'agents'=>$agents,
            'federales'=>$federales,
            'locales'=>$locales,
            'municipios'=>$municipios,
            'campanas'=>$campanas,
            'graficaPastel'=>$graficaPastel,
            'totalSimps'=>$totalSimps,
            'seccionesCubiertas'=>$seccionesCubiertas,
            'federalesCubiertos'=>$federalesCubiertos,
            'localesCubiertos'=>$localesCubiertos,
            'municipiosCubiertos'=>$municipiosCubiertos,
            'entidadesCubiertas'=>$entidadesCubiertas
        ]);
    }

    public function agregarUsuario(Request $request)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $data = request()->validate([
            'name' => 'required | max:255',
            'email' => 'required|max:255|unique:users,email',
            'password' => 'required|max:255|min:8|required_with:password-confirm|same:password-confirm',
            'password-confirm' => 'max:255|min:8',
            'fileField' => 'mimes:jpeg,jpg,png,gif|image'
        ]);
        try {
            DB::transaction(function () use ($request) {
                $usuario = new User();
                $usuario->name = $request->name;
                $usuario->email = $request->email;
                $usuario->password = Hash::make($request->password);
                if ($request->fileField) {
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileField')->storeAs('/public/uploads/', $newFileName);
                    $usuario->avatar = $newFileName;
                }
                $usuario->save();
                if ($request->type == "admin")
                    $usuario->roles()->sync(1);
                else
                    $usuario->roles()->sync(2);
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

    public function verUsuarios()
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $administradores = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', 1)->get();
        $agentes = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', 2)->get();
        $brigadistas = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id', 3)->get();
        return view('admin.usuarios', [
            'administradores' => $administradores,
            'agentes' => $agentes,
            'brigadistas' => $brigadistas
        ]);
    }

    public function verUsuario($id)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $usuario = User::findOrFail($id);
        if ($usuario->roles[0]->id == 1 || $usuario->roles[0]->id == 2)
            return view('admin.usuario', ['usuario' => $usuario]);
        else
            return redirect('/admin/usuarios');
    }

    public function editarUsuario(Request $request, $id)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $data = request()->validate([
            'name' => 'required | max:255 ',
            'email' => ['required', 'max:255', function ($attribute, $value, $fail) use ($id) {
                $usuario = User::findOrFail($id);
                if ($usuario->email != $value) {
                    $emailRepetido = User::where('email', $value)->first();
                    if ($emailRepetido) {
                        return $fail(__('El correo ingresado pertenece a otra cuenta.'));
                    }
                }
            }],
            'actualPassword' => ['nullable', function ($attribute, $value, $fail) use ($id) {
                $user = User::findOrFail($id);
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('La contraseña actual es incorrecta.'));
                }
            }],
            'password' => 'nullable|max:255|min:8|same:password-confirm',
            'password-confirm' => 'nullable|max:255|min:8',
            'fileField' => 'mimes:jpeg,jpg,png,gif|image'
        ]);
        try {
            DB::transaction(function () use ($request, $id) {
                $usuario = User::findOrFail($id);
                $usuario->name = $request->name;
                $usuario->email = $request->email;
                if ($request->password) {
                    $usuario->password = Hash::make($request->password);
                }
                if ($request->fileField) {
                    $oldFile = public_path() . '/storage/uploads/' . $usuario->avatar;
                    if (file_exists($oldFile)) {
                        unlink($oldFile);
                    }
                    $fileNameWithTheExtension = request('fileField')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileField')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileField')->storeAs('/public/uploads/', $newFileName);
                    $usuario->avatar = $newFileName;
                }
                $usuario->save();
            });
            if ($request->ajax()) {
                session()->flash('status', 'Usuario editado con éxito!');
                return 200;
            }
        } catch (QueryException $ex) {
            if ($request->ajax()) {
                return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
            }
        }
    }

    public function eliminarUsuario($id)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        try {
            DB::transaction(function () use ($id) {
                $usuario = User::findOrFail($id);
                $usuario->status = "inactivo";
                $usuario->save();
            });
            return 200;
        } catch (QueryException $ex) {
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function agregarCampana(Request $request)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $data = request()->validate([
            'name_camp' => 'required | max:100 ',
            'name_cand' => 'required|max:255',
            'secciones' => 'required|numeric',
            'input_partidos' => [function ($attribute, $value, $fail) {
                if (!$value) {
                    return $fail(__('Debe agregar al menos 1 partido (para agregar presione el botón agregar).'));
                }
            }],
            'input_agentes' => [function ($attribute, $value, $fail) {
                if (!$value) {
                    return $fail(__('Debe agregar al menos 1 agente (para agregar presione el botón agregar).'));
                }
            }],
            'fileLogo' => 'mimes:jpeg,jpg,png,gif|image'
        ]);
        try {
            DB::transaction(function () use ($request) {
                $campana = new Campaign();
                $campana->name = $request->name_camp;
                $campana->candidato = $request->name_cand;
                switch ($request->secciones) {
                    case 1:
                        $campana->position_id = 5;
                        break;
                    case 2:
                        $campana->position_id = 4;
                        break;
                    case 3:
                        $campana->position_id = 3;
                        break;
                    case 4:
                        $campana->position_id = 2;
                        break;
                }

                if ($request->fileLogo) {
                    $fileNameWithTheExtension = request('fileLogo')->getClientOriginalName();
                    $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                    $extension = request('fileLogo')->getClientOriginalExtension();
                    $newFileName = $fileName . '_' . time() . '.' . $extension;
                    $path = request('fileLogo')->storeAs('/public/uploads/', $newFileName);
                    $campana->logo = $newFileName;
                }
                //Vamos a generar el código de la campaña
                //primero se obtienen 3 caracteres al azar del nombre de la campaña
                //es necesario hacer uppercase, quitar espacios y hacer trim
                $str = $request->name_camp;
                $str = str_replace(' ', '', $str);
                $str = strtoupper($str);
                $str = trim($str);
                //String para generar el subfijo del código
                $str2 = '0123456789';
                //En do while generamos el código aleatoriamente hasta que no exista un código igual en la base de datos
                do {
                    $prefix = $str[rand(0, strlen($str) - 1)] . $str[rand(0, strlen($str) - 1)] . $str[rand(0, strlen($str) - 1)];
                    $subfix = $str2[rand(0, strlen($str2) - 1)] . $str2[rand(0, strlen($str2) - 1)] . $str2[rand(0, strlen($str2) - 1)] . $str2[rand(0, strlen($str2) - 1)];
                    $codigo = $prefix . $subfix;
                    $codigoExistente = Campaign::where('codigo', $codigo)->first();
                } while ($codigoExistente);
                //Guardamos el código en la campaña
                $campana->codigo = $codigo;
                $partidos = explode(',', $request->input_partidos);
                $agentes = explode(',', $request->input_agentes);

                if ($request->secciones != 4) {
                    if ($request->local) {
                        $secciones = [];
                        $localId = LocalDistrict::find($request->local);
                        foreach ($localId->section as $section) {
                            $secciones[] = $section->id;
                        }
                    } elseif ($request->federal) {
                        $secciones = [];
                        $federalId = FederalDistrict::find($request->federal);
                        foreach ($federalId->section as $section) {
                            $secciones[] = $section->id;
                        }
                    } elseif ($request->municipio) {
                        $secciones = [];
                        $municipioId = Town::find($request->municipio);
                        foreach ($municipioId->section as $section) {
                            $secciones[] = $section->id;
                        }
                    }
                } else {
                    $secciones = Section::pluck('id')->toArray();
                }
                $campana->save();
                $campana->section()->sync($secciones);
                $campana->politic_partie()->sync($partidos);
                $campana->user()->sync($agentes);
            });
            return response()->json(200);
        } 
        catch (QueryException $ex) {
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function verCampanas()
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $campanas = Campaign::with('user')->paginate(10);
        $numcamp = Campaign::count();
        $parties = PoliticPartie::get();
        $agents = User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('status', 'activo')->where('role_user.role_id', 2)->get();
        $locales = LocalDistrict::get();
        $federales = FederalDistrict::get();
        $municipios = Town::get();
        $positions = Position::get();
        return view('admin.campanas', ['campanas' => $campanas, 'parties' => $parties, 'agents' => $agents, 'locales' => $locales, 'federales' => $federales, 'municipios' => $municipios, 'positions' => $positions, 'numcamp' => $numcamp]);
    }

    public function eliminarCampana($id){
        Gate::authorize('haveaccess', 'admin.perm');
        DB::beginTransaction();
        try{
            $campana=Campaign::findOrFail($id);
            if($campana->logo){
                $oldFile=public_path().'/storage/uploads/'.$campana->logo;
                if(file_exists($oldFile)){
                    unlink($oldFile);
                }
            }
            $campana->delete();
            DB::commit();
            return response()->json(200);
        }
        catch (\Exception $ex) {
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function verCampana($id)
    {
        Gate::authorize('haveaccess', 'admin.perm');
        $campana = Campaign::findOrFail($id);
        $secciones=$campana->section()->paginate(20);
        return view('admin.campana', ['campana' => $campana,'secciones'=>$secciones]);
    }

    public function editarSeccion(Request $request, $id){
        Gate::authorize('haveaccess', 'admin.perm');
        $data = request()->validate([
            'meta' => 'required|numeric',
            'prioridad' => 'required|in:Alta,Media,Baja'
        ]);
        DB::beginTransaction();
        try{
            $seccion=Campaign_Section::findOrFail($id);
            $seccion->meta=$request->meta;
            $seccion->prioridad=$request->prioridad;
            $seccion->save();
            DB::commit();
            return response()->json(200);
        }
        catch(\Exception $ex){
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }
}