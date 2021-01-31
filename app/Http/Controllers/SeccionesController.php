<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Campaign;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;

class SeccionesController extends Controller
{
    function verSecciones()
    {
        //Recibe todas las secciones

        //$campana = session()->get('campana');
        $campana = Campaign::find(1);

        $seccionesTabla = Section::paginate(10);
        $seccionesComp = Section::all();

        if (!is_null($campana)) {
            $electors = Elector::where('campaign_id', $campana->id)->get();
        } else {
            $electors = null;
        }

        $secciones = $this->paginate($campana->section);

        return view('usuario.secciones', ['datos' => $secciones, 'datosBack' => $campana->section, 'electores' => $electors]);
    }

    function verSeccion($id)
    {
        //$seccion = Section::where('id', $id)->get();
        $campana = Campaign::find(1);

        if (!is_null($campana)) {
            $electores = Elector::where('section_id', $id)->where('campaign_id', $campana->id)->get();
        } else {
            $electores = null;
        }

        $seccion = Section::find($id);
        return view('usuario.seccion', ['datosSec' => $seccion, 'electores' => $electores]);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    public function paginate($items, $perPage = 10, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, [
            'path' => Paginator::resolveCurrentPath(),
            'pageName' => 'page',
        ]);
    }
}
