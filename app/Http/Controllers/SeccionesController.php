<?php

namespace App\Http\Controllers;

use App\Http\Middleware\CheckCamp;
use Illuminate\Http\Request;
use App\Models\Section;
use App\Models\Elector;
use App\Models\Campaign;
use App\Models\Campaign_Section;
use App\Models\Vote;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SeccionesController extends Controller
{
    protected $perPage = 10;

    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(CheckCamp::class);
    }

    function verSecciones(Request $request)
    {
        //Recibe todas las secciones
        if (Auth::user()->roles[0]->name == 'Agente') {
            \Gate::authorize('haveaccess', 'agente.perm');

            $campana = session()->get('campana');

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
                if (isset($request->busc)) {
                    $secciones = $campana->section->filter(function ($record) use ($request) {
                        $normalizeChars = array(
                            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
                            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
                            'Ï' => 'I', 'Ñ' => 'N', 'Ń' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
                            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
                            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
                            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
                            'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
                            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
                        );
                        $seccion = strtr($record->num_seccion, $normalizeChars);
                        $seccion = strtolower($seccion);
                        $municipio = strtr($record->town->nombre, $normalizeChars);
                        $municipio = strtolower($municipio);
                        $distlocal = strtr($record->local_district->cabecera, $normalizeChars);
                        $distlocal = strtolower($distlocal);
                        $distfed = strtr($record->federal_district->cabecera, $normalizeChars);
                        $distfed = strtolower($distfed);
                        $busqueda = strtr($request->busc, $normalizeChars);
                        $busqueda = strtolower($busqueda);
                        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                        $out->writeln($busqueda);
                        if (str_contains($seccion, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($municipio, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($distlocal, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($distfed, $busqueda)) {
                            return $record;
                        }
                    });

                    $path = route('secciones') . '?busc=' . $request->busc;
                    $secciones = new LengthAwarePaginator(
                        $secciones->slice((LengthAwarePaginator::resolveCurrentPage() *
                                $this->perPage) - $this->perPage,
                            $this->perPage
                        )->all(),
                        count($secciones),
                        $this->perPage,
                        null,
                        ['path' => $path]
                    );
                } else {
                    $secciones = $this->paginate($campana->section)->appends(request()->except('page'));
                }
            } else {
                $rangos = null;
                $electors = null;
                $secciones = null;
            }


            return view('usuario.secciones', ['datos' => $secciones, 'electores' => $electors, 'rangos' => $rangos]);
        } else {
            abort(403);
        }
    }

    function verSeccion($id, Request $request)
    {
        if (Auth::user()->roles[0]->name == 'Agente') {
            \Gate::authorize('haveaccess', 'agente.perm');

            $campana = session()->get('campana');

            if (!is_null($campana)) {
                $electores = Elector::where('section_id', $id)->where('campaign_id', $campana->id)->get();

                $edades = $electores->map(function ($item, $key) {
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

                if (isset($request->busc)) {
                    $electores = $electores->filter(function ($record) use ($request) {
                        $normalizeChars = array(
                            'Š' => 'S', 'š' => 's', 'Ð' => 'Dj', 'Ž' => 'Z', 'ž' => 'z', 'À' => 'A', 'Á' => 'A', 'Â' => 'A', 'Ã' => 'A', 'Ä' => 'A',
                            'Å' => 'A', 'Æ' => 'A', 'Ç' => 'C', 'È' => 'E', 'É' => 'E', 'Ê' => 'E', 'Ë' => 'E', 'Ì' => 'I', 'Í' => 'I', 'Î' => 'I',
                            'Ï' => 'I', 'Ñ' => 'N', 'Ń' => 'N', 'Ò' => 'O', 'Ó' => 'O', 'Ô' => 'O', 'Õ' => 'O', 'Ö' => 'O', 'Ø' => 'O', 'Ù' => 'U', 'Ú' => 'U',
                            'Û' => 'U', 'Ü' => 'U', 'Ý' => 'Y', 'Þ' => 'B', 'ß' => 'Ss', 'à' => 'a', 'á' => 'a', 'â' => 'a', 'ã' => 'a', 'ä' => 'a',
                            'å' => 'a', 'æ' => 'a', 'ç' => 'c', 'è' => 'e', 'é' => 'e', 'ê' => 'e', 'ë' => 'e', 'ì' => 'i', 'í' => 'i', 'î' => 'i',
                            'ï' => 'i', 'ð' => 'o', 'ñ' => 'n', 'ń' => 'n', 'ò' => 'o', 'ó' => 'o', 'ô' => 'o', 'õ' => 'o', 'ö' => 'o', 'ø' => 'o', 'ù' => 'u',
                            'ú' => 'u', 'û' => 'u', 'ü' => 'u', 'ý' => 'y', 'ý' => 'y', 'þ' => 'b', 'ÿ' => 'y', 'ƒ' => 'f',
                            'ă' => 'a', 'î' => 'i', 'â' => 'a', 'ș' => 's', 'ț' => 't', 'Ă' => 'A', 'Î' => 'I', 'Â' => 'A', 'Ș' => 'S', 'Ț' => 'T',
                        );
                        $elector = strtr($record->nombre, $normalizeChars);
                        $elector = strtolower($elector);
                        $ap_p = strtr($record->apellido_p, $normalizeChars);
                        $ap_p = strtolower($ap_p);
                        $ap_m = strtr($record->apellido_m, $normalizeChars);
                        $ap_m = strtolower($ap_m);
                        $clave_elector = strtr($record->clave_elector, $normalizeChars);
                        $clave_elector = strtolower($clave_elector);
                        $busqueda = strtr($request->busc, $normalizeChars);
                        $busqueda = strtolower($busqueda);
                        $out = new \Symfony\Component\Console\Output\ConsoleOutput();
                        $out->writeln($busqueda);
                        if (str_contains($elector, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($ap_p, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($ap_m, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($elector . " " . $ap_p, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($elector . " " . $ap_p . " " . $ap_m, $busqueda)) {
                            return $record;
                        }
                        if (str_contains($clave_elector, $busqueda)) {
                            return $record;
                        }
                    });

                    $path = route('seccion', ['id' => $id]) . '?busc=' . $request->busc;
                    $electores = new LengthAwarePaginator(
                        $electores->slice((LengthAwarePaginator::resolveCurrentPage() *
                                $this->perPage) - $this->perPage,
                            $this->perPage
                        )->all(),
                        count($electores),
                        $this->perPage,
                        null,
                        ['path' => $path]
                    );
                } else {
                    $electores = $this->paginate($electores)->appends(request()->except('page'));
                }

                $ganador = Vote::where('section_id', '=', $id)->where('position_id', '=', $campana->position_id)->orderBy('num', 'DESC')->first();
                //dd($electores);
            } else {
                $electores = null;
                $rangos = null;
            }

            $seccion = Section::find($id);
            return view('usuario.seccion', ['datosSec' => $seccion, 'electores' => $electores, 'rangos' => $rangos, 'id' => $id, 'ganador' => $ganador]);
        } else {
            abort(403);
        }
    }

    public function updCampana(Request $request, $id)
    {
        $campana = session()->get('campana');
        if (!isset($request->prioridad) || !isset($request->meta)) {
            return response()->json(['errors' => ['catch' => [0 => 'No se ha cambiado la prioridad o meta.']]], 422);
        }

        DB::beginTransaction();
        $camp_sec = Campaign_Section::where('section_id', '=', $id)->where('campaign_id', '=', $campana->id)->first();
        $camp_sec->meta = $request->meta;
        $camp_sec->prioridad = $request->prioridad;
        $camp_sec->save();

        session()->flash('status', 'Simpatizante creado con éxito!');

        DB::commit();
        return response()->json(200);
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