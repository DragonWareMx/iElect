<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Campaign;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Order;
use Carbon\Carbon;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Pagination\LengthAwarePaginator;

class brigadistasInfoController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth'); 
    }

    public function index(Request $request){
        // if(!$request->page && !$request->busc){
            // Obtener todas las campañas del usuario loggeado [CÓDIGO]
            $usuario = Auth::user();
            $campana = session()->get('campana');
            // dd($campana);
            // Obtener todos los brigadistas de dichas campañas
            $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
                                ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
                                ->where('role_user.role_id',3)
                                ->where('campaign_user.campaign_id',session()->get('campana')->id)
                                ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha')
                                ->paginate(10);

            return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana]);
        // }
        // else{
        //     // Obtener todas las campañas del usuario loggeado [CÓDIGO]
        //     $usuario = Auth::user();
        //     $campana = session()->get('campana');
        //     // dd($campana);
        //     // Obtener todos los brigadistas de dichas campañas
        //     $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
        //                         ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
        //                         ->where('role_user.role_id',3)
        //                         ->where('campaign_user.campaign_id',session()->get('campana')->id)
        //                         ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha')
        //                         ->get();

        //     //si hay request de la busqueda deal se obtienen solo los simpatizantes que coinciden
        //     if(isset($request->busc)){
        //         $brigadistas = $brigadistas->get()->filter(function($record) use($request) {
        //             $normalizeChars = array(
        //                 'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
        //                 'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
        //                 'Ï'=>'I', 'Ñ'=>'N', 'Ń'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
        //                 'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
        //                 'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
        //                 'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ń'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
        //                 'ú'=>'u', 'û'=>'u', 'ü'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f',
        //                 'ă'=>'a', 'î'=>'i', 'â'=>'a', 'ș'=>'s', 'ț'=>'t', 'Ă'=>'A', 'Î'=>'I', 'Â'=>'A', 'Ș'=>'S', 'Ț'=>'T',
        //             );
        //             $nombre = strtr( $record->nombre, $normalizeChars );
        //             $nombre = strtolower ($nombre);
        //             $busqueda = strtr( $request->busc, $normalizeChars );
        //             $busqueda = strtolower ($busqueda);
        //             $out = new \Symfony\Component\Console\Output\ConsoleOutput();
        //             $out->writeln($busqueda);
        //             if(str_contains($nombre, $busqueda)) {
        //                 return $record;
        //             }
        //         });

        //         //this code simulates: ->paginate(5)
        //         $path = route('brigadistas').'?busc='.$request->busc;
        //         $brigadistas = new LengthAwarePaginator(
        //             $brigadistas->slice((LengthAwarePaginator::resolveCurrentPage() *
        //             $this->perPage)-$this->perPage,
        //             $this->perPage)->all(), count($brigadistas),
        //             $this->perPage, null, ['path' => $path]);
        //         /*
        //         ->where('nombre','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('apellido_p','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('apellido_m','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('edo_civil','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('fecha_nac','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('electors.email','like','%'.Crypt::encryptString($request->busc).'%')
        //         ->orWhere('telefono','like','%'.Crypt::encryptString($request->busc).'%');*/
        //     }
        //     else{
        //         $brigadistas = $brigadistas->paginate(2)->appends(request()->except('page'));
        //     }
        //     return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana]);

        // }
    }

    public function solicitudes(){
        $campana = session()->get('campana');
        $soli = Order::where('campaign_id', $campana->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('usuario.brigadistas_solicitudes',['solicitudes' => $soli]);
    }

    public function accion(Request $request){
        // dd($request);
        if(!$request->b){
            return redirect('brigadistas/solicitudes')->withErrors(['Selecciona al menos un brigadista.']);
        }
        else{
            $cantidad=sizeof($request->b);
            
            if($request->action == "eliminar"){
                try{
                    \DB::beginTransaction();
                    {
                        // ELIMINARLOS 
                        for($i=0 ; $i< $cantidad; $i++) {
                            DB::table('orders')->where('id',$request->b[$i] )->delete();
                        }
                        \DB::commit();

                        return redirect('brigadistas/solicitudes')->with('status', 'Brigadistas eliminados correctamente');
                    } 
                } 
                catch(QueryException $ex){
                    \DB::rollback();
                    return redirect('brigadistas/solicitudes')->withErrors(['Ocurrió un error inesperado, intentalo más tarde.']);
                }
            }

            else{
                try{
                    \DB::beginTransaction();
                    {
                        $brigadista;
                        for($i=0 ; $i< $cantidad; $i++) {
                            // Se obtienen los datos del brigadista que se va a aceptar
                            $brigadista = Order::where('id', $request->b[$i])->get();

                            // GUARDARLOS COMO USUARIO
                            $newUser = new User();
                            $newUser->name = $brigadista[0]->name;
                            $newUser->email = $brigadista[0]->email;
                            $newUser->password = $brigadista[0]->password;
                            // $newUser->password = Hash::make($brigadista[0]->password);
                            $newUser->status = 'activo';
                            $newUser->save();
                            
                            // Obtener el id de la inserción de arriba
                            $idUser = User::latest('id')->first();
                            $fechaNow = Carbon::now();
                            // dd($fechaNow);
                            // GUARDARLO EN ROL DE USUARIO
                            DB::table('role_user')->insert([
                                'role_id' => 3,
                                'user_id' => $idUser->id,
                                'created_at' => $fechaNow
                            ]);
                            
                            // ASIGNARLO A LA CAMPAÑA
                            DB::table('campaign_user')->insert([
                                'campaign_id' => $brigadista[0]->campaign_id,
                                'user_id' => $idUser->id,
                                'created_at' => $fechaNow
                            ]);
                            
                            // ELIMINARLO DE ORDERS
                            DB::table('orders')->where('id',$request->b[$i] )->delete();
                            // dd('SE ELIMINO'); 
                        }
                        \DB::commit();
                        return redirect('brigadistas/solicitudes')->with('status', 'Brigadistas aceptados correctamente');
                    } 
                } 
                catch(QueryException $ex){
                    \DB::rollback();
                    return redirect('brigadistas/solicitudes')->withErrors(['Ocurrió un error inesperado, intentalo más tarde.']);
                }
            }
        }
    }
}
