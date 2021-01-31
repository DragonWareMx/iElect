@extends('layouts.layout')

@section('title')
Secciones
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@php

if(!is_null($electores)){
$simpatizantes = 0;
$porcentaje = 0;
$countS = array_count_values($electores->pluck('sexo')->toArray());
$hombres = $countS['h'];
$mujeres = $countS['m'];
$total = $hombres + $mujeres;

$porcH = round(($hombres * 100)/$total, 2);
$porcM = round(($mujeres * 100)/$total, 2);

$g18 = $rangos['18'];
$g19 = $rangos['19'];
$g20 = $rangos['20_24'];
$g25 = $rangos['25_29'];
$g30 = $rangos['30_34'];
$g35 = $rangos['35_39'];
$g40 = $rangos['40_44'];
$g45 = $rangos['45_49'];
$g50 = $rangos['50_54'];
$g55 = $rangos['55_59'];
$g60 = $rangos['60_64'];
$g65 = $rangos['65_mas'];

}
@endphp

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCIONES -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small" uk-grid style="display: flex; align-items: center">
                <div>
                    <h3 class="uk-text-bold">Secciones</h3>
                </div>
                <div class="omrs-input-group uk-hidden@m">
                    <label class="omrs-input-underlined input-outlined input-trail-icon">
                        <input required />
                        <span class="input-trail-icon" uk-icon="search"></span>
                    </label>
                </div>
                <div class="uk-position-small uk-position-top-right uk-visible@m">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input required />
                            <span class="input-trail-icon" uk-icon="search"></span>
                        </label>
                    </div>
                </div>
            </div>

            <!-- Graficas -->
            <div uk-grid class="uk-padding-small" style="margin-top: 0">
                <div class="uk-width-1-4@m">
                    @if (!is_null($electores))
                    <h5 class="uk-text-bold uk-padding-small" style="padding-top: 0">
                        Sexo
                    </h5>
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
                    <h5 class="uk-text-bold uk-padding-small" style="padding-top: 0">
                        Sin datos
                    </h5>
                    @endif
                </div>
                <!-- Grafica de barras -->
                <div class="uk-width-1-2@m">
                    <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                    <canvas id="barChart" width="auto" height="200"></canvas>
                </div>
            </div>

            <hr />

            <div class="uk-padding-small">
                @if (!is_null($datos))
                <div class="uk-card-title">
                    <h5 class="uk-text-bold">Información por sección, listado nominal</h5>
                </div>
                <!-- Tabla -->
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-small uk-table-divider">
                        <thead class="uk-background-muted">
                            <tr>
                                <th>Número de Sección</th>
                                <th>Distrito federal</th>
                                <th>Distrito local</th>
                                <th>Municipio</th>
                                <th>Estatus</th>
                                <th># Simpatizantes</th>
                                <th>Meta final</th>
                                <th>Prioridad</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($datos as $seccion)
                            @php
                            $simpatizantes = $electores->where('section_id', $seccion->id)->count();
                            $porcentaje = round(($simpatizantes*100)/$seccion->pivot->meta, 1)
                            @endphp

                            <tr onclick="abrirSeccion(this)" data-route="{{ route('seccion', ['id'=>$seccion->id]) }}">
                                <td>{{ $seccion->num_seccion }}</td>
                                <td>{{ $seccion->federal_district->cabecera }}</td>
                                <td>{{ $seccion->local_district->cabecera }}</td>
                                <td>{{ $seccion->town->nombre }}</td>
                                <td>
                                    <progress class="uk-progress" value="{{$porcentaje}}" max="100"
                                        style="margin: 0"></progress>
                                    <div class="uk-align-right">{{$porcentaje}}%</div>
                                </td>
                                <td>
                                    {{$simpatizantes}}
                                </td>
                                <td>{{ $seccion->pivot->meta }}</td>
                                <td>{{ $seccion->pivot->prioridad }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                {!! $datos->links() !!}
                @else
                <div class="uk-card-title">
                    <h5 class="uk-text-bold">Sin datos</h5>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')

//Abrir sección
function abrirSeccion(x) {
window.location = x.getAttribute('data-route');
}

//Grafica de pastel
var simpCanvas = document.getElementById("simpChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var simpData = {
labels: ["Hombres", "Mujeres"],
datasets: [
{
@if (!is_null($electores))
data: [{{$hombres}}, {{$mujeres}}],
@endif
backgroundColor: ["#9B51E0", "#FB8832"],
},
],
};

var pieChart = new Chart(simpCanvas, {
type: "pie",
data: simpData,
});

//Grafica de barras
var ctx = document.getElementById("barChart").getContext("2d");
var barChart = new Chart(ctx, {
type: "bar",
data: {
labels: [
"18",
"19",
"20-24",
"25-29",
"30-34",
"35-39",
"40-44",
"45-49",
"50-54",
"55-59",
"60-64",
"65-",
],
datasets: [
{
@if (!is_null($electores))
data: [{{$g18}}, {{$g19}}, {{$g20}}, {{$g25}}, {{$g30}}, {{$g35}}, {{$g40}}, {{$g45}}, {{$g50}}, {{$g55}}, {{$g60}},
{{$g65}}],
@endif
backgroundColor: "rgba(0,122,255,1)",
},
],
},
options: {
maintainAspectRatio: false,
},
});

//Grafica de pastel Ocupaciones
//Grafica de pastel
var ocupCanvas = document.getElementById("ocupChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var ocupData = {
labels: [
"Estudiantes",
"Vigilantes",
"Contratistas",
"Hogar",
"Profesores",
"Otros",
],
datasets: [
{
data: [25, 3, 10, 4, 56, 2],
backgroundColor: [
"#FFD43A",
"#04BE65",
"#2D9B94",
"#007AFF",
"#C8194B",
"#ADADAD",
],
},
],
};

var ocupChart = new Chart(ocupCanvas, {
type: "pie",
data: ocupData,
});
@endsection