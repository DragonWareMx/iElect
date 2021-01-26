<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Order;
use App\Rules\Codigo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function brigadista(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|max:255',
                'email' => 'required|email',
                'password' => 'required|min:8|confirmed',
                'codigo' => new Codigo
            ]
        );
        DB::beginTransaction();
        try {
            $camp = Campaign::where('codigo', '=', $request->codigo)->first();
            $solicitud = new Order();
            $solicitud->name = $request->nombre;
            $solicitud->email = $request->email;
            $solicitud->password = Hash::make($request->password);
            $solicitud->campaign_id = $camp->id;
            $solicitud->save();

            DB::commit();
            return response()->json(200);
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['error' => $ex->getMessage()], 500);
        }
    }
}