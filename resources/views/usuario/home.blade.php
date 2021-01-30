@extends('layouts.layout')

@section('title')
Inicio
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <div class="uk-grid uk-grid-match">
        <!-- Card de SECCIONES -->
        <div class="uk-width-expand@m">
            <div class="uk-card uk-card-default uk-card-body uk-overflow-auto">
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
                            <tr>
                                <td>#2458</td>
                                <td>Michoacán</td>
                                <td>
                                    <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                                    <div class="uk-align-right">52%</div>
                                </td>
                                <td>257</td>
                                <td>458</td>
                            </tr>
                            <tr>
                                <td>#3530</td>
                                <td>Michoacán</td>
                                <td>
                                    <progress class="uk-progress" value="100" max="100" style="margin: 0"></progress>
                                    <div class="uk-align-right">100%</div>
                                </td>
                                <td>325</td>
                                <td>325</td>
                            </tr>
                            <tr>
                                <td>#4540</td>
                                <td>Michoacán</td>
                                <td>
                                    <progress class="uk-progress" value="23" max="100" style="margin: 0"></progress>
                                    <div class="uk-align-right">23%</div>
                                </td>
                                <td>178</td>
                                <td>578</td>
                            </tr>
                        </tbody>
                    </table>
                    <p class="uk-text-right">
                        <a>Ver todo</a>
                    </p>
                </div>
            </div>
        </div>
        <!-- Card de SIMPATIZANTES -->
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-card-body">
                <h3 class="uk-card-title uk-text-bold" style="margin: 0">
                    Simpatizantes
                </h3>
                <div>Total: 760</div>
                <div class="uk-flex uk-flex-middle">
                    <div>
                        <canvas id="simpChart" width="auto" height="200"></canvas>
                    </div>
                    <div class="uk-flex-none">
                        <div>
                            <span class="uk-badge" style="background-color: #9b51e0"></span>
                            Hombres 47%
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #fb8832"></span>
                            Mujeres 53%
                        </div>
                    </div>
                </div>
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
            <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto uk-width-1-5@m">

                <!-- Avatar circulo -->
                <div class="uk-grid uk-child-width-1">
                    @foreach ($campana->politic_partie as $pp)
                    <div class="uk-flex uk-flex-middle uk-margin-bottom">
                        <img class="uk-border-circle" src="{{$pp->logo}}" width="80" height="80" alt="Border circle" />
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
                <div>@foreach ($campana->section as $section){{$section->town->nombre}},
                    {{$section->town->federal_entitie->nombre}}
                    <br />
                    @endforeach</div>
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
            <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a>
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
data: [47, 53],
backgroundColor: ["#9B51E0", "#FB8832"],
},
],
};

var pieChart = new Chart(simpCanvas, {
type: "pie",
data: simpData,
});
@endsection