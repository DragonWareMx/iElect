@extends('layouts.layout')

@section('title')
Mapa seccional
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

@section('body')
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de CUENTA -->
    <div class="uk-card uk-card-default uk-margin-top uk-padding-small">
        <div class="uk-flex uk-flex-middle">
            <h3 class="uk-text-bold uk-margin-remove">Mapa seccional</h3>
            <a href="#" class="uk-margin-left">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mexico.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos federales
            </a>
            <a href="#" class="uk-margin-left">
                <img class="uk-margin-small-right" src="{{asset('img/icons/mich.png')}}"
                    style="max-height: 18px; max-width: 26px; width: 100%;" />
                Distritos locales
            </a>
            <a href="#" class="uk-margin-left">
                <img class="uk-margin-small-right" src="{{asset('img/icons/section.png')}}"
                    style="max-height: 24px; max-width: 24px; width: 100%;" />
                Secciones
            </a>
        </div>

        <div class="uk-child-width-expand@s uk-margin" uk-grid>
            <div class="uk-width-auto uk-width-1-4@m">
                <h6 class="uk-margin-remove uk-text-bold">ENTIDAD FEDERATIVA</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>Michoacán de Ocampo - 16</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <h6 class="uk-margin-remove uk-text-bold">DISTRITO FEDERAL</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>12</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <h6 class="uk-margin-remove uk-text-bold">DISTRITO LOCAL</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>17</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <h6 class="uk-margin-remove uk-text-bold">SECCIÓN</h6>
                <div class="uk-margin-bottom">
                    <div class="uk-form-controls">
                        <select class="uk-select" id="form-stacked-select">
                            <option>1278</option>
                            <option>Option 02</option>
                        </select>
                    </div>
                </div>
                <hr />
                <h5 class="uk-margin-remove uk-text-bold">LISTADO NOMINAL</h5>
                <p class="uk-margin-small uk-margin-remove-bottom">Total: 760</p>
                <div class="uk-flex-inline">
                    <p class="uk-margin-small-right">Prioridad: </p>
                    <p class="uk-text-danger uk-margin-remove">Alta</p>
                </div>

                <!-- GRAFICA SEXO -->
                <h5 class="uk-text-bold uk-margin-remove" style="padding-top: 0">
                    Sexo
                </h5>
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
                <div class="uk-text-right">
                    <a class="uk-text-small info" uk-toggle="target: .info">Más información <span
                            uk-icon="icon: chevron-right; ratio: 0.8"></span></a>
                </div>
            </div>
            <div class="uk-width-expand@m info">
                <!--MAPA SECCIONAL-->
                <h1>MAPA</h1>
            </div>
            <div class="uk-width-expand@m info" hidden>
                <!--GRÁFICAS-->
                <p class="uk-text-bold">Edad</p>
                <canvas id="barChart" width="auto" height="200" style="max-height: 250px"></canvas>
                <p class="uk-text-center uk-text-small uk-margin-remove">Rango de edades</p>
                <hr />
                <p class="uk-text-bold">Información histórica</p>
                <div class="uk-margin-top uk-text-center elec_resp" style="top: -50px; position: relative;">
                    <div class=" uk-flex-inline uk-flex-middle">
                        <a href="" uk-icon="chevron-left"></a>
                        <p class="uk-margin-remove uk-text-bold">Elecciones 2018</p>
                        <a href="" uk-icon="chevron-right"></a>
                    </div>
                    <p class="uk-margin-remove">Gobernador estatal de Michoacán</p>
                </div>
                <div class="uk-margin-top" uk-grid>
                    <!-- Grafica de barras -->
                    <div class="uk-width-1-2@m">
                        <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                        <canvas id="barHistoric" width="auto" height="200" style="max-height: 200px"></canvas>
                        <p class="uk-text-center uk-text-small uk-margin-remove">Rango de edades</p>
                    </div>

                    <div class="uk-width-expand@m">
                        <div class="uk-overflow-auto">
                            <table class="uk-table uk-table-small uk-table-divider">
                                <thead class="uk-background-muted">
                                    <tr>
                                        <th>Partido</th>
                                        <th>#Votos</th>
                                        <th>Puesto por sección</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>NDP</td>
                                        <td>183</td>
                                        <td>Primer lugar</td>
                                    </tr>
                                    <tr>
                                        <td>PRI</td>
                                        <td>#</td>
                                        <td>Segundo lugar</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="uk-text-right">
                    <a class="uk-text-small" uk-toggle="target: .info"><span
                            uk-icon="icon: chevron-left; ratio: 0.8"></span> Menos información</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
//Grafica de pastel
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
label: "data-1",
data: [200, 153, 60, 180, 130, 175, 112, 124, 180, 55, 45, 150],
backgroundColor: "rgba(0,122,255,1)",
},
],
},
options: {
maintainAspectRatio: false,
},
});

//Grafica de barras
Chart.defaults.global.legend.display = false;
var ctx = document.getElementById("barHistoric").getContext("2d");
var barHistoric = new Chart(ctx, {
type: "bar",
data: {
labels: [
"PRI",
"PAN",
"PRD",
"PT",
"PES",
"NDP",
],
datasets: [
{
label: "data-1",
data: [200, 153, 60, 180, 130, 175],
backgroundColor: ["#029336", "#06338E", "#FFCB01", "#DA251D", "#5A2A7C"],
},
],
},
options: {
maintainAspectRatio: false,
},
});

@endsection