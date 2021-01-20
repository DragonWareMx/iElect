@extends('layouts.layout')

@section('title')
Secciones
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

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
            <div uk-grid class="uk-padding-small">
                <div class="uk-width-1-4@m">
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
                                Hombres 47%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #fb8832"></span>
                                Mujeres 53%
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grafica de barras -->
                <div class="uk-width-expand@m">
                    <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                    <canvas id="barChart" width="auto" height="200"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- Card de SIMPATIZANTES -->
    <div class="uk-card uk-card-default uk-padding-small">
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
                    <tr>
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>458</td>
                        <td>Alta</td>
                    </tr>
                    <tr>
                        <td>#3530</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="100" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">100%</div>
                        </td>
                        <td>325</td>
                        <td>325</td>
                        <td>Media</td>
                    </tr>
                    <tr>
                        <td>#4540</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="23" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">23%</div>
                        </td>
                        <td>178</td>
                        <td>578</td>
                        <td>Baja</td>
                    </tr>
                    <tr>
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>458</td>
                        <td>Alta</td>
                    </tr>
                    <tr>
                        <td>#3530</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="100" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">100%</div>
                        </td>
                        <td>325</td>
                        <td>325</td>
                        <td>Media</td>
                    </tr>
                    <tr>
                        <td>#4540</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="23" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">23%</div>
                        </td>
                        <td>178</td>
                        <td>578</td>
                        <td>Baja</td>
                    </tr>
                    <tr>
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>458</td>
                        <td>Alta</td>
                    </tr>
                    <tr>
                        <td>#3530</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="100" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">100%</div>
                        </td>
                        <td>325</td>
                        <td>325</td>
                        <td>Media</td>
                    </tr>
                    <tr>
                        <td>#4540</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="23" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">23%</div>
                        </td>
                        <td>178</td>
                        <td>578</td>
                        <td>Baja</td>
                    </tr>
                    <tr>
                        <td>#2458</td>
                        <td>1</td>
                        <td>1</td>
                        <td>Michoacán</td>
                        <td>
                            <progress class="uk-progress" value="52" max="100" style="margin: 0"></progress>
                            <div class="uk-align-right">52%</div>
                        </td>
                        <td>257</td>
                        <td>458</td>
                        <td>Alta</td>
                    </tr>
                </tbody>
            </table>
            <ul class="uk-pagination uk-flex-center" uk-margin>
                <li>
                    <a href="#"><span uk-pagination-previous></span></a>
                </li>
                <li><a href="#">1</a></li>
                <li class="uk-disabled"><span>...</span></li>
                <li><a href="#">5</a></li>
                <li><a href="#">6</a></li>
                <li class="uk-active"><span>7</span></li>
                <li><a href="#">8</a></li>
                <li>
                    <a href="#"><span uk-pagination-next></span></a>
                </li>
            </ul>
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