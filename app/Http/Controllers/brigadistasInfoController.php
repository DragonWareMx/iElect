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
use Exception;
use Illuminate\Database\QueryException;

class brigadistasInfoController extends Controller
{ 
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
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
                            ->get();

        return view('usuario.brigadistasInfo',['brigadistas' => $brigadistas, 'campana' => $campana]);
    }

    public function solicitudes(){
        return view('usuario.brigadistas_solicitudes');
    }
}
