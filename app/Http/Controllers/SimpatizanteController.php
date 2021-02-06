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
use Illuminate\Support\Facades\Mail;
use App\Mail\NewSimpMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Pagination\LengthAwarePaginator;

class SimpatizanteController extends Controller
{
    //
    protected $perPage = 10;

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

    public function simpatizantes(Request $request)
    {

        if(Auth::user()->roles[0]->name == 'Agente'){
            \Gate::authorize('haveaccess', 'agente.perm');
            //si no hay request se muestran todos los simpatizantes
            if(!$request->page && !$request->busc){
                //se obtiene la campaña seleccionada por el agente
                $campana = session()->get('campana');

                //Obtiene todos los simpatizantes aprobados
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('campaign_id','=',$campana->id)
                                        ->where('aprobado',1)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10);

                //Cuenta el total de simpatizantes registrados
                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',1)
                                ->get()->count();

                //Cuenta el total de simpatizantes no aprobados
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA]);
            }
            //si no...
            else{
                //se obtiene la campaña
                $campana = session()->get('campana');

                //Obtiene todos los simpatizantes aprobados
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('campaign_id','=',$campana->id)
                                        ->where('aprobado',1)
                                        ->orderBy('created_at', 'DESC');

                //Cuenta el total de simpatizantes registrados
                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',1)->get()->count();
                
                //Cuenta el total de simpatizantes no aprobados
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                //si hay request de la busqueda deal se obtienen solo los simpatizantes que coinciden
                if(isset($request->busc)){
                    $simpatizantes = $simpatizantes->get()->filter(function($record) use($request) {
                        //sustituye los caracteres especiales por caracteres sin acento
                        $normalizeChars = array(
                            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
                            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
                            'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
                            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
                            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
                            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
                            'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
                            'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
                        );
                        $nombre = strtr( $record->nombre, $normalizeChars );
                        $nombre = strtolower ($nombre);
                        $apellido_p = strtr( $record->apellido_p, $normalizeChars );
                        $apellido_p = strtolower ($apellido_p);
                        $apellido_m = strtr( $record->apellido_m, $normalizeChars );
                        $apellido_m = strtolower ($apellido_m);
                        $clave_elector = strtr( $record->clave_elector, $normalizeChars );
                        $clave_elector = strtolower ($clave_elector);
                        $telefono = strtr( $record->telefono, $normalizeChars );
                        $telefono = strtolower ($telefono);
                        $email = strtr( $record->email, $normalizeChars );
                        $email = strtolower ($email);
                        $busqueda = strtr( $request->busc, $normalizeChars );
                        $busqueda = strtolower ($busqueda);
                        if(str_contains($nombre, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($email, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_p, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($nombre." ".$apellido_p." ".$apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($clave_elector, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($telefono, $busqueda)) {
                            return $record;
                        }
                    });

                    //this code simulates: ->paginate(10)
                    $path = route('simpatizantes').'?busc='.$request->busc;
                    $simpatizantes = new LengthAwarePaginator(
                        $simpatizantes->slice((LengthAwarePaginator::resolveCurrentPage() *
                        $this->perPage)-$this->perPage,
                        $this->perPage)->all(), count($simpatizantes),
                        $this->perPage, null, ['path' => $path]);
                    /*
                    ->where('nombre','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_p','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_m','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('edo_civil','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('fecha_nac','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('electors.email','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('telefono','like','%'.Crypt::encryptString($request->busc).'%');*/
                }
                else{
                    //si no existe la busqueda solo se paginan
                    $simpatizantes = $simpatizantes->paginate(10)->appends(request()->except('page'));
                }

                $busc = $request->busc;
                //se manda la vista
                return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA, 'busqueda'=>$busc]);
            }
        }
        elseif(Auth::user()->roles[0]->name == 'Administrador'){
            \Gate::authorize('haveaccess', 'admin.perm');
            //si no hay request se muestran todos los simpatizantes
            if(!$request->page && !$request->busc){

                //Obtiene todos los simpatizantes aprobados
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('aprobado',1)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10);

                //Cuenta el total de simpatizantes registrados
                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',1)
                                ->get()->count();

                //Cuenta el total de simpatizantes no aprobados
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA]);
            }
            //si no...
            else{
                //se obtiene la campaña
                $campana = session()->get('campana');

                //Obtiene todos los simpatizantes aprobados
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('aprobado',1)
                                        ->orderBy('created_at', 'DESC');

                //Cuenta el total de simpatizantes registrados
                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',1)->get()->count();
                
                //Cuenta el total de simpatizantes no aprobados
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                //si hay request de la busqueda deal se obtienen solo los simpatizantes que coinciden
                if(isset($request->busc)){
                    $simpatizantes = $simpatizantes->get()->filter(function($record) use($request) {
                        //sustituye los caracteres especiales por caracteres sin acento
                        $normalizeChars = array(
                            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
                            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
                            'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
                            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
                            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
                            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
                            'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
                            'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
                        );
                        $nombre = strtr( $record->nombre, $normalizeChars );
                        $nombre = strtolower ($nombre);
                        $apellido_p = strtr( $record->apellido_p, $normalizeChars );
                        $apellido_p = strtolower ($apellido_p);
                        $apellido_m = strtr( $record->apellido_m, $normalizeChars );
                        $apellido_m = strtolower ($apellido_m);
                        $clave_elector = strtr( $record->clave_elector, $normalizeChars );
                        $clave_elector = strtolower ($clave_elector);
                        $telefono = strtr( $record->telefono, $normalizeChars );
                        $telefono = strtolower ($telefono);
                        $email = strtr( $record->email, $normalizeChars );
                        $email = strtolower ($email);
                        $busqueda = strtr( $request->busc, $normalizeChars );
                        $busqueda = strtolower ($busqueda);
                        if(str_contains($nombre, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($email, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_p, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($nombre." ".$apellido_p." ".$apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($clave_elector, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($telefono, $busqueda)) {
                            return $record;
                        }
                    });

                    //this code simulates: ->paginate(10)
                    $path = route('simpatizantes').'?busc='.$request->busc;
                    $simpatizantes = new LengthAwarePaginator(
                        $simpatizantes->slice((LengthAwarePaginator::resolveCurrentPage() *
                        $this->perPage)-$this->perPage,
                        $this->perPage)->all(), count($simpatizantes),
                        $this->perPage, null, ['path' => $path]);
                    /*
                    ->where('nombre','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_p','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_m','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('edo_civil','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('fecha_nac','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('electors.email','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('telefono','like','%'.Crypt::encryptString($request->busc).'%');*/
                }
                else{
                    //si no existe la busqueda solo se paginan
                    $simpatizantes = $simpatizantes->paginate(10)->appends(request()->except('page'));
                }

                $busc = $request->busc;
                //se manda la vista
                return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA, 'busqueda'=>$busc]);
            }
        }
        else{
            abort(403);
        }
    }

    public function simpatizantes_no_aprobados(Request $request)
    {
        if(Auth::user()->roles[0]->name == 'Agente'){
            //si no hay request se muestran todas las propiedades
            if(!$request->page && !$request->busc){
                $campana = session()->get('campana');

                //Recibe todas las secciones
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('campaign_id','=',$campana->id)
                                        ->where('aprobado',0)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10);

                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                return view('usuario.simpatizantes_no_aprobados', ['simpatizantes' => $simpatizantes, 'totalNA' => $totalNA]);
            }
            //si no...
            else{
                $campana = session()->get('campana');

                //Recibe todas las secciones
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('campaign_id','=',$campana->id)
                                        ->where('aprobado',0)
                                        ->orderBy('created_at', 'DESC');

                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',1)->get()->count();
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('campaign_id','=',$campana->id)
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                //si hay request de la busqueda se obtienen solo los simpatizantes que coinciden
                if(isset($request->busc)){
                    $simpatizantes = $simpatizantes->get()->filter(function($record) use($request) {
                        $normalizeChars = array(
                            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
                            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
                            'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
                            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
                            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
                            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
                            'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
                            'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
                        );
                        $nombre = strtr( $record->nombre, $normalizeChars );
                        $nombre = strtolower ($nombre);
                        $apellido_p = strtr( $record->apellido_p, $normalizeChars );
                        $apellido_p = strtolower ($apellido_p);
                        $apellido_m = strtr( $record->apellido_m, $normalizeChars );
                        $apellido_m = strtolower ($apellido_m);
                        $clave_elector = strtr( $record->clave_elector, $normalizeChars );
                        $clave_elector = strtolower ($clave_elector);
                        $telefono = strtr( $record->telefono, $normalizeChars );
                        $telefono = strtolower ($telefono);
                        $email = strtr( $record->email, $normalizeChars );
                        $email = strtolower ($email);
                        $busqueda = strtr( $request->busc, $normalizeChars );
                        $busqueda = strtolower ($busqueda);
                        if(str_contains($nombre, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($email, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_p, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($nombre." ".$apellido_p." ".$apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($clave_elector, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($telefono, $busqueda)) {
                            return $record;
                        }
                    });

                    //this code simulates: ->paginate(5)
                    $path = route('simpatizantes').'?busc='.$request->busc;
                    $simpatizantes = new LengthAwarePaginator(
                        $simpatizantes->slice((LengthAwarePaginator::resolveCurrentPage() *
                        $this->perPage)-$this->perPage,
                        $this->perPage)->all(), count($simpatizantes),
                        $this->perPage, null, ['path' => $path]);
                    /*
                    ->where('nombre','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_p','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_m','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('edo_civil','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('fecha_nac','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('electors.email','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('telefono','like','%'.Crypt::encryptString($request->busc).'%');*/
                }
                else{
                    $simpatizantes = $simpatizantes->paginate(10)->appends(request()->except('page'));
                }

                $busc = $request->busc;

                //se manda la vista
                return view('usuario.simpatizantes_no_aprobados', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA,'busqueda'=>$busc]);
            }
        }
        elseif(Auth::user()->roles[0]->name == 'Administrador'){
            //si no hay request se muestran todas las propiedades
            if(!$request->page && !$request->busc){
                //Recibe todas las secciones
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('aprobado',0)
                                        ->orderBy('created_at', 'DESC')
                                        ->paginate(10);

                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                return view('usuario.simpatizantes_no_aprobados', ['simpatizantes' => $simpatizantes, 'totalNA' => $totalNA]);
            }
            //si no...
            else{
                $campana = session()->get('campana');

                //Recibe todas las secciones
                $simpatizantes = Elector::select('users.name', 'electors.*')
                                        ->join('users', 'users.id', '=', 'electors.user_id')
                                        ->where('aprobado',0)
                                        ->orderBy('created_at', 'DESC');

                $total = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',1)->get()->count();
                $totalNA = Elector::select('users.name', 'electors.*')
                                ->join('users', 'users.id', '=', 'electors.user_id')
                                ->where('aprobado',0)
                                ->get()
                                ->count();

                //si hay request de la busqueda se obtienen solo los simpatizantes que coinciden
                if(isset($request->busc)){
                    $simpatizantes = $simpatizantes->get()->filter(function($record) use($request) {
                        $normalizeChars = array(
                            'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
                            'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
                            'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
                            'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
                            'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
                            'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
                            'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
                            'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
                        );
                        $nombre = strtr( $record->nombre, $normalizeChars );
                        $nombre = strtolower ($nombre);
                        $apellido_p = strtr( $record->apellido_p, $normalizeChars );
                        $apellido_p = strtolower ($apellido_p);
                        $apellido_m = strtr( $record->apellido_m, $normalizeChars );
                        $apellido_m = strtolower ($apellido_m);
                        $clave_elector = strtr( $record->clave_elector, $normalizeChars );
                        $clave_elector = strtolower ($clave_elector);
                        $telefono = strtr( $record->telefono, $normalizeChars );
                        $telefono = strtolower ($telefono);
                        $email = strtr( $record->email, $normalizeChars );
                        $email = strtolower ($email);
                        $busqueda = strtr( $request->busc, $normalizeChars );
                        $busqueda = strtolower ($busqueda);
                        if(str_contains($nombre, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($email, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_p, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($nombre." ".$apellido_p." ".$apellido_m, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($clave_elector, $busqueda)) {
                            return $record;
                        }
                        if(str_contains($telefono, $busqueda)) {
                            return $record;
                        }
                    });

                    //this code simulates: ->paginate(5)
                    $path = route('simpatizantes').'?busc='.$request->busc;
                    $simpatizantes = new LengthAwarePaginator(
                        $simpatizantes->slice((LengthAwarePaginator::resolveCurrentPage() *
                        $this->perPage)-$this->perPage,
                        $this->perPage)->all(), count($simpatizantes),
                        $this->perPage, null, ['path' => $path]);
                    /*
                    ->where('nombre','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_p','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('apellido_m','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('edo_civil','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('fecha_nac','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('electors.email','like','%'.Crypt::encryptString($request->busc).'%')
                    ->orWhere('telefono','like','%'.Crypt::encryptString($request->busc).'%');*/
                }
                else{
                    $simpatizantes = $simpatizantes->paginate(10)->appends(request()->except('page'));
                }

                $busc = $request->busc;

                //se manda la vista
                return view('usuario.simpatizantes_no_aprobados', ['simpatizantes' => $simpatizantes, 'total' => $total,'totalNA' => $totalNA,'busqueda'=>$busc]);
            }
        }
        else{
            abort(403);
        }
    }

    public function agregarSimpatizante(Request $request)
    {
        \Gate::authorize('haveaccess', 'brig.perm');

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

        //verifica que el elector esté en la edad permitida
        if(intval(\Carbon\Carbon::parse($request->fecha_de_nacimiento)->diff(\Carbon\Carbon::now())->format('%y')) < 17){
            return response()->json(['errors' => ['catch' => [0 => 'La fecha de nacimiento debe ser de una persona de 17 años o más.']]], 422);
        }

        //variables que guardan los nombres de los archivos en caso que haya un error
        $nfotoa = null;
        $nfotor = null;
        $nfotoe = null;
        $nfotod = null;

        DB::beginTransaction();
        try {
            //se obtiene la campana
            $campana = session()->get('campana');
            //se obtiene la seccion
            $seccion = Section::find($request->seccion);
            //SI NO EXISTE LA SECCION SE MANDA ERROR
            if(is_null($seccion)){
                DB::rollBack();
                return response()->json(['errors' => ['catch' => [0 => 'La sección: '.$request->seccion.' no existe en la base de datos.']]], 500);
            }

            //VERIFICA QUE LA SECCION FORME PARTE DE LA CAMPAÑA
            $existe = $seccion->campaign->contains($campana->id);
            
            if(!$existe){
                DB::rollBack();
                return response()->json(['errors' => ['catch' => [0 => 'La sección: '.$request->seccion.' no está relacionada con la campaña.']]], 500);
            }

            //VERIFICA QUE NO EXISTA UN ELECTOR CON LA MISMA CLAVE EN LA MISMA CAMPAÑA
            $simpVal = Elector::where('campaign_id',$campana->id)->get()->filter(function($record) use($request) {
                if($record->clave_elector == $request->clave_elector){
                    return $record;
                }
            });
            if(!is_null($simpVal) && count($simpVal) > 0){
                //simpatizante ya registrado
                DB::rollBack();
                return response()->json(['errors' => ['catch' => [0 => 'El simpatizante con la clave de elector: '.$request->clave_elector.' ya ha sido registrado en esta campaña.']]], 500);
            }

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

            $simpatizante->localidad = $seccion->local_district->numero;
            $simpatizante->municipio = $seccion->town->numero;
            $simpatizante->section_id = $seccion->id;
            $simpatizante->campaign_id = $campana->id;
            $simpatizante->user_id = auth()->user()->id;

            //OTROS DATOS
            $simpatizante->facebook = $request->facebook;
            $simpatizante->twitter = $request->twitter;

            if ($request->foto_anverso) {
                $file = $request->file('foto_anverso');

                // Get File Content
                $fileContent = $file->get();

                // Encrypt the Content
                $encryptedContent = encrypt($fileContent);

                $fileNameWithTheExtension = request('foto_anverso')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                $newFileName = $fileName . '_' . time();

                // Store the encrypted Content
                \Storage::put('/public/files/' . $campana->id . '/' . $newFileName . '.dat', $encryptedContent);

                $nfotoa = $newFileName;
                $simpatizante->credencial_a = $newFileName;
            }
            if ($request->foto_inverso) {
                $file = $request->file('foto_inverso');

                // Get File Content
                $fileContent = $file->get();

                // Encrypt the Content
                $encryptedContent = encrypt($fileContent);

                $fileNameWithTheExtension = request('foto_inverso')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                $newFileName = $fileName . '_' . time();

                // Store the encrypted Content
                \Storage::put('/public/files/' . $campana->id . '/' . $newFileName . '.dat', $encryptedContent);

                $nfotor = $newFileName;
                $simpatizante->credencial_r = $newFileName;
            }
            if ($request->foto_de_elector) {
                $file = $request->file('foto_de_elector');

                // Get File Content
                $fileContent = $file->get();

                // Encrypt the Content
                $encryptedContent = encrypt($fileContent);

                $fileNameWithTheExtension = request('foto_de_elector')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                $newFileName = $fileName . '_' . time();

                // Store the encrypted Content
                \Storage::put('/public/files/' . $campana->id . '/' . $newFileName . '.dat', $encryptedContent);

                $nfotoe = $newFileName;
                $simpatizante->foto_elector = $newFileName;
            }
            if ($request->foto_de_firma) {
                $file = $request->file('foto_de_firma');

                // Get File Content
                $fileContent = $file->get();

                // Encrypt the Content
                $encryptedContent = encrypt($fileContent);

                $fileNameWithTheExtension = request('foto_de_firma')->getClientOriginalName();
                $fileName = pathinfo($fileNameWithTheExtension, PATHINFO_FILENAME);
                $newFileName = $fileName . '_' . time();

                // Store the encrypted Content
                \Storage::put('/public/files/' . $campana->id . '/' . $newFileName . '.dat', $encryptedContent);

                $nfotod = $newFileName;
                $simpatizante->documento = $newFileName; 
            }
            $simpatizante->save();

            Mail::to($simpatizante->email)->send(new NewSimpMail($simpatizante->id));

            session()->flash('status', 'Simpatizante creado con éxito!');

            DB::commit();
            return response()->json(200);
        } catch (QueryException $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);

            //ELIMINA LAS FOTOS SUBIDAS AL SERVIDOR
            if($nfotoa){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoa . '.dat');
            }
            if($nfotor){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotor . '.dat');
            }
            if($nfotoe){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoe . '.dat');
            }
            if($nfotod){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotod . '.dat');
            }

            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        } catch (Exception $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);

            //ELIMINA LAS FOTOS SUBIDAS AL SERVIDOR
            if($nfotoa){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoa . '.dat');
            }
            if($nfotor){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotor . '.dat');
            }
            if($nfotoe){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoe . '.dat');
            }
            if($nfotod){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotod . '.dat');
            }

            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        } catch (Throwable $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);

            //ELIMINA LAS FOTOS SUBIDAS AL SERVIDOR
            if($nfotoa){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoa . '.dat');
            }
            if($nfotor){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotor . '.dat');
            }
            if($nfotoe){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoe . '.dat');
            }
            if($nfotod){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotod . '.dat');
            }

            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
        catch (Error $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);

            //ELIMINA LAS FOTOS SUBIDAS AL SERVIDOR
            if($nfotoa){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoa . '.dat');
            }
            if($nfotor){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotor . '.dat');
            }
            if($nfotoe){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotoe . '.dat');
            }
            if($nfotod){
                \Storage::delete('/public/files/' . $campana->id . '/' . $nfotod . '.dat');
            }

            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
    }

    public function aprobarSimpatizantes(Request $request)
    {
        \Gate::authorize('haveaccess', 'agente.perm');

        //FALTA: VALIDAR EL ROL
        $data = request()->validate([
            'seleccion.*' => 'nullable|exists:electors,id'
        ]);

        if(!isset($request->seleccion)){
            return response()->json(['errors' => ['catch' => [0 => 'No se ha seleccionado ningún simpatizante.']]], 422);
        }

        DB::beginTransaction();
        try {
            $contador = 0;
            foreach ($request->seleccion as $id) {
                $elector = Elector::find($id);
                $elector->aprobado = 1;
                $elector->save();
                $contador++;
            }
            
            session()->flash('status', 'Simpatizante creado con éxito!');

            DB::commit();
            return response()->json(200);
        } catch (QueryException $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        } catch (Exception $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        } catch (Throwable $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
        catch (Error $ex) {
            $out = new \Symfony\Component\Console\Output\ConsoleOutput();
            $out->writeln($ex);
            DB::rollBack();
            return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
        }
        DB::rollBack();
        return response()->json(['errors' => ['catch' => [0 => 'Ocurrió un error inesperado, intentalo más tarde.']]], 500);
    }

    public function editarSimpatizantes($id)
    {
        $simpatizante = Elector::findOrFail($id);

        $ocupaciones = Job::all();

        $secciones = Section::whereHas('campaign', function (Builder $query) use ($simpatizante) {
            $query->where('campaigns.id', '=', $simpatizante->campaign->id);
        })->get();

        $campanas = Campaign::all();

        //se manda la vista
        return view('usuario.simpatizante_editar', ['simpatizante' => $simpatizante, 'secciones'=>$secciones,'ocupaciones'=>$ocupaciones, 'campanas'=>$campanas]);
    }

    public function editarSimpatizante(Request $request)
    {
        $simpatizante = Elector::findOrFail($id);

        $ocupaciones = Job::all();

        $secciones = Section::whereHas('campaign', function (Builder $query) use ($simpatizante) {
            $query->where('campaigns.id', '=', $simpatizante->campaign->id);
        })->get();

        //se manda la vista
        return view('usuario.simpatizante_editar', ['simpatizante' => $simpatizante, 'secciones'=>$secciones,'ocupaciones'=>$ocupaciones]);
    }
}
