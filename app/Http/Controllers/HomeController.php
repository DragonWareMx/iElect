<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Section;
use App\Models\Elector;
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
        $user = Auth::user();
        //$campana = session()->get('campana');
        $campana = Campaign::find(1);
        if (!is_null($campana)) {
            $electors = Elector::where('campaign_id', $campana->id)->get();
        } else {
            $electors = null;
        }

        return view('usuario.home', ['campana' => $campana, 'electores' => $electors]);
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