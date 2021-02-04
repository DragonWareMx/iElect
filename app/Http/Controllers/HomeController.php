<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Job;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (Auth::user()->roles[0]->name == 'Brigadista') {
            \Gate::authorize('haveaccess', 'brig.perm');
            $campana = session()->get('campana');

            //Recibe todas las secciones
            $simpatizantes = Elector::select('users.name', 'electors.*')
                ->join('users', 'users.id', '=', 'electors.user_id')
                ->where('campaign_id', '=', $campana->id)
                ->where('electors.user_id', '=', Auth::user()->id)
                ->paginate(10);

            $ocupaciones = Job::all();

            if (!is_null($campana)) {
                $secciones = Section::whereHas('campaign', function (Builder $query) use ($campana) {
                    $query->where('campaigns.id', '=', $campana->id);
                })->get();
            } else {
                $secciones = null;
            }

            return view('usuario.simpatizantes', ['simpatizantes' => $simpatizantes, 'secciones' => $secciones, 'ocupaciones' => $ocupaciones]);
        } else if (Auth::user()->roles[0]->name == 'Agente') {
            $user = Auth::user();
            //$campana = session()->get('campana');
            $campana = Campaign::find(1);
            if (!is_null($campana)) {
                $electors = Elector::where('campaign_id', $campana->id)->get();
            } else {
                $electors = null;
            }

            return view('usuario.home', ['campana' => $campana, 'electores' => $electors]);
        } elseif (Auth::user()->roles[0]->name == 'Administrador') {
            return redirect()->route('admin-inicio');
        } else {
            abort(403);
        }
    }

    public function campana()
    {
        $usuario = Auth::user();
        $campanas = $usuario->campaign;
        return view('usuario.campana_select', ['campanas' => $campanas]);
    }

    public function campSession(Request $request)
    {
        $camp = Campaign::findOrFail($request->campana);
        if (!$camp) {
            return Redirect::back()->withErrors(['msg', 'Algo inesperado ocurrió, por favor, intentalo de nuevo.']);
        } else {
            session()->put('campana', $camp);
            return redirect()->route('home');
        }
    }
}