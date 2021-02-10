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
        $user = Auth::user();
        $Agents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get();
        $Admins=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',1)->get();
        $userAgente=false;
        $userAdmin=false;

        foreach ($Agents as $Agente){
            if($user->id == $Agente->user_id){
                $userAgente = true;
            }
        }

        foreach ($Admins as $admin){
            if($user->id == $admin->user_id){
                $userAdmin = true;
            }
        }
        
        
        if($request->search){
            if($userAgente == true){
                $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
                                ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
                                ->where('role_user.role_id',3)
                                ->where('campaign_user.campaign_id',session()->get('campana')->id)
                                ->where('users.name','like','%'.$request->search.'%')
                                ->orWhere('users.email','like','%'.$request->search.'%')
                                ->orWhere('users.created_at','like','%'.$request->search.'%')
                                ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha', 'campaign_user.campaign_id as id_campaign')
                                ->paginate(10)->appends(request()->except('page'));
                $campana = session()->get('campana');
                return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana, 'agente' => $userAgente, 'admin' => $userAdmin]);
            }
            else if($userAdmin == true){
                $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
                                ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
                                ->where('role_user.role_id',3)
                                // ->where('campaign_user.campaign_id',session()->get('campana')->id)
                                ->where('users.name','like','%'.$request->search.'%')
                                ->orWhere('users.email','like','%'.$request->search.'%')
                                ->orWhere('users.created_at','like','%'.$request->search.'%')
                                ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha', 'campaign_user.campaign_id as id_campaign')
                                ->paginate(10)->appends(request()->except('page'));
                $campana = Campaign::find(1);
                return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana, 'agente' => $userAgente, 'admin' => $userAdmin]);
            }
            // Si el usuario es brigadista no puede entrar
            else{
                abort(404);
            }
            
        }
        else{
            $usuario = Auth::user();
            if($userAgente == true){
                
                $campana = session()->get('campana');
                // Obtener todos los brigadistas de dichas campañas
                $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
                                    ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
                                    ->where('role_user.role_id',3)
                                    ->where('campaign_user.campaign_id',session()->get('campana')->id)
                                    ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha', 'campaign_user.campaign_id as id_campaign')
                                    ->paginate(10);
                                    return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana, 'agente' => $userAgente, 'admin' => $userAdmin]);
            }
            else if($userAdmin == true){
                $brigadistas =  User::join('role_user', 'users.id', '=', 'role_user.user_id')
                                    ->join('campaign_user', 'users.id', '=', 'campaign_user.user_id')
                                    ->where('role_user.role_id',3)
                                    // ->where('campaign_user.campaign_id',session()->get('campana')->id)
                                    ->select('users.id as id', 'users.name as bName', 'users.email as bEmail', 'users.created_at as bFecha', 'campaign_user.campaign_id as id_campaign')
                                    ->paginate(10);
                $campana = Campaign::find(1);
                return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana, 'agente' => $userAgente, 'admin' => $userAdmin]);
            }
            // Si el usuario es brigadista no puede entrar
            else{
                abort(404);
            }
            
        }
    }

    public function solicitudes(Request $request){
        \Gate::authorize('haveaccess', 'agente.perm');
        if($request->search){
            $campana = session()->get('campana');
            $soli = Order::where('campaign_id', $campana->id)
                        ->where('name','like','%'.$request->search.'%')
                        ->orWhere('email','like','%'.$request->search.'%')
                        ->orWhere('campaign_id','like','%'.$request->search.'%')
                        ->orWhere('created_at','like','%'.$request->search.'%')
                        ->orderBy('created_at', 'desc')
                        ->paginate(10)->appends(request()->except('page'));

        return view('usuario.brigadistas_solicitudes',['solicitudes' => $soli]);
        }
        else{
            $campana = session()->get('campana');
            $soli = Order::where('campaign_id', $campana->id)
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);
        return view('usuario.brigadistas_solicitudes',['solicitudes' => $soli]);
        }
    }

    public function accion(Request $request){
        \Gate::authorize('haveaccess', 'agente.perm');
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
