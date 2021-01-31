<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Campaign;
use Carbon\Carbon;
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

            $electors->pluck('fecha_nac');

            $edades = $electors->map(function ($item, $key) {
                return Carbon::parse($item->fecha_nac)->diff(Carbon::now())->format('%y');
            });

            $rango18 = count($this->array_get_range($edades->toArray(), 18, 18));
            $rango19 = count($this->array_get_range($edades->toArray(), 19, 19));
            $rango20 = count($this->array_get_range($edades->toArray(), 20, 24));
            $rango25 = count($this->array_get_range($edades->toArray(), 25, 29));
            $rango30 = count($this->array_get_range($edades->toArray(), 30, 34));
            $rango35 = count($this->array_get_range($edades->toArray(), 35, 39));
            $rango40 = count($this->array_get_range($edades->toArray(), 40, 44));
            $rango45 = count($this->array_get_range($edades->toArray(), 45, 49));
            $rango50 = count($this->array_get_range($edades->toArray(), 50, 54));
            $rango55 = count($this->array_get_range($edades->toArray(), 55, 59));
            $rango60 = count($this->array_get_range($edades->toArray(), 60, 64));
            $rango65 = count($this->array_get_range($edades->toArray(), 65, 200));

            $rangos = [
                '18' => $rango18,
                '19' => $rango19,
                '20_24' => $rango20,
                '25_29' => $rango25,
                '30_34' => $rango30,
                '35_39' => $rango35,
                '40_44' => $rango40,
                '45_49' => $rango45,
                '50_54' => $rango50,
                '55_59' => $rango55,
                '60_64' => $rango60,
                '65_mas' => $rango65
            ];
            $secciones = $this->paginate($campana->section);
        } else {
            $rangos = null;
            $electors = null;
            $secciones = null;
        }


        return view('usuario.secciones', ['datos' => $secciones, 'electores' => $electors, 'rangos' => $rangos]);
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

    public function array_get_range($array, $min, $max)
    {
        return array_filter($array, function ($element) use ($min, $max) {
            return $element >= $min && $element <= $max;
        });
    }
}
