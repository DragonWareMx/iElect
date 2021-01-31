<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;
use App\Models\User;


class CuentaController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user();
        $Agents=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',2)->get();
        $brigadistas=User::join('role_user', 'users.id', '=', 'role_user.user_id')->where('role_user.role_id',3)->get();
        $userAgente=false;
        $userBrigadista=false;

        foreach ($Agents as $Agente){
            if($user->id == $Agente->user_id){
                $userAgente = true;
            }
        }

        foreach ($brigadistas as $brigadista){
            if($user->id == $brigadista->user_id){
                $userBrigadista = true;
            }
        }
        

        return view('usuario.ajustes',['agente' => $userAgente, 'brigadista' => $userBrigadista]);
    }

    public function cuenta(){
        return view('usuario.cuenta');
    }

    public function cuentaAdmin(){
        return view('admin.cuenta');
    }

    public function cuentaUpdate($id){
        $data=request()->validate([
            'passActual'=>'required|max:191',
            'password'=>'required|min:8|max:25',
        ]);
        try{
            \DB::beginTransaction();
            {
                $user=User::findOrFail($id);
                // Se actualiza la contraseña
                // Se actualiza la contraseña y la foto
                // Se actualiza la foto
                // No se actualiza la foto y solo se guarda la contraseña
                // if(request('fileField')==null || request('fileField')=='default.png' || request('fileField')=='img/test/default.png' || request('fileField')=='/img/test/default.png'){

                // } else{

                // }
        return view('usuario.cuenta');
        // return redirect('usuario.ajustes')->with('status', '¡Datos actualizados correctamente!');
    }
}


