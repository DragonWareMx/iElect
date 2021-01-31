<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Section;
use App\Models\Elector;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

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
}
