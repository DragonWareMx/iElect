@extends('layouts.layout')

@section('title')
Inicio
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@php
if(!is_null($electores) && !is_null($campana)){
$count = 0;
$simpatizantes = 0;
$porcentaje = 0;
$countS = array_count_values($electores->pluck('sexo')->toArray());
if(count($countS) != 0){
if (isset($countS['h'])) {
$hombres = $countS['h'];
}else{
$hombres = 0;
}

if (isset($countS['m'])) {
$mujeres = $countS['m'];
}else{
$mujeres = 0;
}

$total = $hombres + $mujeres;
$porcH = round(($hombres * 100)/$total, 2);
$porcM = round(($mujeres * 100)/$total, 2);
}else{
$hombres = 0;
$mujeres = 0;
$total = 0;
$porcH = 0;
$porcM = 0;
}

}

@endphp

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-grid uk-grid-match">
        <!-- Card de SECCIONES -->
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-card-body uk-overflow-auto">
                @if (!is_null($electores) && !is_null($campana))
                <h3 class="uk-card-title uk-text-bold">Secciones</h3>
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-small uk-table-divider">
                        <thead class="uk-background-muted">
                            <tr>
                                <th>Número de Sección</th>
                                <th>Municipio</th>
                                <th>Estatus</th>
                                <th># Simpatizantes</th>
                                <th>Meta final</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($campana->section as $seccion)
                            @php
                            if ($count < 3) { $simpatizantes=$electores->where('section_id', $seccion->id)->count();

                                if ($seccion->pivot->meta > 0) {
                                $porcentaje = round(($simpatizantes*100)/$seccion->pivot->meta, 1);
                                }else{
                                $porcentaje = 0;
                                }
                                $count++;
                                }else {
                                break;
                                }

                                @endphp
                                <tr>
                                    <td>{{$seccion->num_seccion}}</td>
                                    <td>{{$seccion->town->federal_entitie->nombre}}</td>
                                    <td>
                                        <progress class="uk-progress" value="{{$porcentaje}}" max="100"
                                            style="margin: 0"></progress>
                                        <div class="uk-align-right">{{$porcentaje}}%</div>
                                    </td>
                                    <td>{{$simpatizantes}}</td>
                                    <td>{{$seccion->pivot->meta}}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                    <p class="uk-text-right">
                        <a href="{{route('secciones')}}">Ver todo</a>
                    </p>
                </div>
                @else
                <h3 class="uk-card-title uk-text-bold">Sin Secciones</h3>
                @endif

            </div>
        </div>
        <!-- Card de SIMPATIZANTES -->
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body">
                @if (!is_null($electores) && !is_null($campana))
                <h3 class="uk-card-title uk-text-bold" style="margin: 0">
                    Simpatizantes
                </h3>
                <div>Total: {{$total}}</div>
                <div class="uk-flex uk-flex-middle">
                    <div>
                        <canvas id="simpChart" width="auto" height="200"></canvas>
                    </div>
                    <div class="uk-flex-none">
                        <div>
                            <span class="uk-badge" style="background-color: #9b51e0"></span>
                            Hombres {{$porcH}}%
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #fb8832"></span>
                            Mujeres {{$porcM}}%
                        </div>
                    </div>
                </div>
                @else
                <h3 class="uk-card-title uk-text-bold" style="margin: 0">
                    Sin Simpatizantes
                </h3>
                @endif
            </div>
        </div>
    </div>

    @if (!is_null($campana))
    <!-- Card de PARTIDO ELECTORAL -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">
                Campaña
            </h3>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-5@m">

                <!-- Avatar circulo -->
                <div class="uk-grid uk-child-width-1">
                    @foreach ($campana->politic_partie as $pp)
                    <div class="uk-flex uk-flex-middle uk-margin-bottom">
                        <img class="uk-border-circle" src="{{asset('img/logoPartidos/'.$pp->logo)}}" width="80" height="80"
                            alt="{{$pp->siglas}}" />
                        <div class="uk-margin-left">
                            {{$pp->siglas}}
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            <div class="uk-width-auto uk-width-expand@m uk-text-left">
                <div class="uk-text-bold">Nombre de la campaña</div>
                <div>{{$campana->name}}</div>
                <br />
                <div class="uk-text-bold">Postulación</div>
                <div>{{$campana->position->name}}</div>
                <br />
                <div class="uk-text-bold">Candidato(a)</div>
                <div>{{$campana->candidato}}</div>
                <br />
                <div class="uk-text-bold">Municipio, estado</div>
                <div>
                    @php
                    $towns = [];
                    foreach ($campana->section as $section) {
                    if (!in_array($section->town->id, $towns)) {
                    echo ($section->town->nombre.', ');
                    echo ($section->town->federal_entitie->nombre);
                    echo "<br>";
                    array_push($towns, $section->town->id);
                    }
                    }

                    @endphp
                </div>
                <br />
                <div class="uk-text-bold">Código de campaña</div>
                <div>{{$campana->codigo}}</div>
                <div class="uk-text-muted">
                    Este código deberá ser proporcionado a los brigadistas para que
                    puedan registrarse en iElecet
                </div>
            </div>
        </div>
    </div>
    @else
    <!-- Card de PARTIDO ELECTORAL -->
    <div class="uk-card uk-card-default uk-card-body uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">
                Sin campaña
            </h3>
        </div>
    </div>
    @endif

</div>
@endsection

@section('scripts')
var simpCanvas = document.getElementById("simpChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var simpData = {
labels: ["Hombres", "Mujeres"],
datasets: [
{
@if (!is_null($electores) && !is_null($campana))
data: [{{$hombres}}, {{$mujeres}}],
@else

@endif
backgroundColor: ["#9B51E0", "#FB8832"],
},
],
};

var pieChart = new Chart(simpCanvas, {
type: "pie",
data: simpData,
});
@endsection