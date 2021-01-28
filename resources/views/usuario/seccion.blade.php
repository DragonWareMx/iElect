@extends('layouts.layout')

@section('title')
Seccion
@endsection

@section('imports')
@extends('subviews.chartjs')

<!-- CSS de Seccion -->
<link rel="stylesheet" href="{{asset('css/usuario/seccion.css')}}" />
@endsection

@php
$hombres = $datosSec[0]->hombres;
$mujeres = $datosSec[0]->mujeres;
$totalSimp = $hombres+$mujeres;

$hPorc = round(($hombres * 100)/$totalSimp, 2);
$mPorc = round(($mujeres * 100)/$totalSimp, 2);

$g18 = $datosSec[0]->{18};
$g19 = $datosSec[0]->{19};
$g20 = $datosSec[0]->{'20_24'};
$g25 = $datosSec[0]->{'25_29'};
$g30 = $datosSec[0]->{'30_34'};
$g35 = $datosSec[0]->{'35_39'};
$g40 = $datosSec[0]->{'40_44'};
$g45 = $datosSec[0]->{'45_49'};
$g50 = $datosSec[0]->{'50_54'};
$g55 = $datosSec[0]->{'55_59'};
$g60 = $datosSec[0]->{'60_64'};
$g65 = $datosSec[0]->{'65_mas'};
@endphp

@section('body')
<!-- Modal Editar datos de sección -->
<div id="modal-datos-seccion" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Editar datos de sección</h2>
        </div>
        <div class="uk-modal-body">
            <div class="uk-margin">
                <div class="select">
                    <select class="select-text" required>
                        <option value="" disabled selected></option>
                        <option value="1">Alta</option>
                        <option value="2">Media</option>
                        <option value="3">Baja</option>
                    </select>
                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label class="select-label">Select</label>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Meta final de simpatizantes</span>
                        </label>
                    </div>
                </div>
            </div>

            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </button>
                <button class="uk-button uk-button-primary" type="button">
                    Enviar
                </button>
            </p>
        </div>
    </div>
</div>

<!-- Modal Datos Simpatizante -->
<div id="modal-datos-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Simpatizante #</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-text-center">
                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="150"
                            height="150" alt="Border circle" />
                    </div>
                    <div class="uk-text-bold">Nombre</div>
                    <div>José Agustín Aguilar Solórzano</div>
                    <br />
                    <div class="uk-text-bold">Domicilio</div>
                    <div>Morelia, Centro #442</div>
                    <br />
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Edad</div>
                            <div>32</div>
                            <br />
                            <div class="uk-text-bold">Ocupación</div>
                            <div>Escritor</div>
                            <br />
                            <div class="uk-text-bold">Correo electrónico</div>
                            <div>correo@ejemplo.com</div>
                            <br />
                            <div class="uk-text-bold">Sección electoral</div>
                            <div>#</div>
                            <br />
                            <div class="uk-text-bold">Clave de elector</div>
                            <div>#########</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Sexo</div>
                            <div>Masculino</div>
                            <br />
                            <div class="uk-text-bold">Teléfono</div>
                            <div>1234567891</div>
                            <br />
                            <div class="uk-text-bold">Facebook</div>
                            <div>link</div>
                            <br />
                            <div class="uk-text-bold">Twitter</div>
                            <div>link</div>
                            <br />
                            <div class="uk-text-bold">Brigadista</div>
                            <div>#######</div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <img class="uk-margin-bottom" data-src="{{asset('img/test/ine_front.jpg')}}" width="75%"
                        height="auto" alt="" uk-img />
                    <img data-src="{{asset('img/test/ine_back.jpg')}}" width="75%" height="auto" alt="" uk-img />
                </div>
            </div>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Editar
                </button>
            </p>
        </div>
    </div>
</div>

<!-- Modal Agregar Simpatizante -->
<div id="modal-agregar-simp" class="uk-modal-container" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title">Agregar simpatizante</h2>
        </div>
        <div class="uk-modal-body">
            <div uk-grid>
                <!-- Lado izquierdo -->
                <div class="uk-width-1-2@m">
                    <!-- Avatar -->
                    <div class="avatar-wrapper uk-margin-bottom">
                        <img class="profile-pic uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="200"
                            height="200" alt="Border circle" />
                        <div class="upload-text">
                            Editar foto
                            <span class="uk-margin-small-left" uk-icon="upload"></span>
                        </div>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Nombre completo</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Domicilio</span>
                        </label>
                    </div>
                    <!--Grid Edad, Sexo, Ocupación, Teléfono-->
                    <div uk-grid>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Edad</span>
                                </label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Ocupación</span>
                                </label>
                            </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Sexo</span>
                                </label>
                            </div>
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Teléfono</span>
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Correo electrónico</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Selección electoral</span>
                        </label>
                    </div>
                    <div class="omrs-input-group uk-margin">
                        <label class="omrs-input-underlined input-outlined">
                            <input required />
                            <span class="omrs-input-label">Clave de elector</span>
                        </label>
                    </div>
                    <div uk-grid>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Facebook</span>
                                </label>
                            </div>
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="omrs-input-group uk-margin">
                                <label class="omrs-input-underlined input-outlined">
                                    <input required />
                                    <span class="omrs-input-label">Twitter</span>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Lado derecho -->
                <div class="uk-width-1-2@m">
                    <p>Fotografías</p>
                    <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                        <span class="uk-text-middle">Foto de credencial anverso</span>
                        <span uk-icon="icon: cloud-upload"></span>
                        <div uk-form-custom>
                            <input type="file" multiple />
                            <span class="uk-link">Selecciona una</span>
                        </div>
                    </div>

                    <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                    <div class="js-upload uk-placeholder uk-text-center" style="height: 150px">
                        <span class="uk-text-middle">Foto de credencial inverso</span>
                        <span uk-icon="icon: cloud-upload"></span>
                        <div uk-form-custom>
                            <input type="file" multiple />
                            <span class="uk-link">Selecciona una</span>
                        </div>
                    </div>

                    <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                </div>
            </div>
            <p class="uk-text-muted">
                El ciudadano involucrado será notificado sobre la carga de su
                información personal al sistema iElect brindandole transparencia
                total y la posibilidad de solicitud de eliminación de la misma.
            </p>
            <p class="uk-position-medium uk-position-bottom-left">
                <button class="uk-button uk-button-default uk-modal-close uk-text-danger uk-text-bold" type="button">
                    Eliminar
                </button>
            </p>
            <p class="uk-text-right">
                <button class="uk-button uk-button-default uk-modal-close" type="button">
                    Cancelar
                </button>
                <button class="uk-button uk-button-primary" type="button">
                    Enviar
                </button>
            </p>
        </div>
    </div>
</div>

<!-- Contenido de la página -->
<div class="uk-margin uk-margin-left uk-margin-right">
    <!-- Card de SECCION -->
    <div class="uk-width-expand@m">
        <div class="uk-card uk-card-default">
            <!-- HEADER -->
            <div class="uk-padding-small" uk-grid style="display: flex; align-items: center">
                <div>
                    <h3 class="uk-card-title uk-text-bold">
                        <a class="uk-margin-right" href="{{route('secciones')}}" uk-icon="arrow-left"></a>Seccion
                        {{$datosSec[0]->num_seccion}}
                    </h3>
                </div>
                <div>
                    <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                        style="
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    max-height: 55px !important;
                  " uk-toggle="target: #modal-agregar-simp">
                        Agregar simpatizante
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
                <div class="uk-hidden@m">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined input-trail-icon">
                            <input required />
                            <span class="input-trail-icon" uk-icon="search"></span>
                        </label>
                    </div>
                </div>
                <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                    <button class="uk-button uk-button-default uk-background-muted uk-margin-right" style="
                    justify-content: center;
                    align-items: center;
                    display: flex;
                    max-height: 55px !important;
                  " uk-toggle="target: #modal-agregar-simp">
                        Agregar simpatizante
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                    <div class="uk-visible@m">
                        <div class="omrs-input-group">
                            <label class="omrs-input-underlined input-outlined input-trail-icon">
                                <input required />
                                <span class="input-trail-icon" uk-icon="search"></span>
                            </label>
                        </div>
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
                                Hombres {{$hPorc}}%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #fb8832"></span>
                                Mujeres {{$mPorc}}%
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Grafica de barras -->
                <div class="uk-width-expand@m">
                    <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                    <canvas id="barChart" width="auto" height="200"></canvas>
                </div>
                <!-- Grafica de pastel -->
                <div class="uk-width-1-4@m">
                    <h5 class="uk-text-bold uk-padding-small">Ocupaciones</h5>
                    <div class="uk-flex uk-flex-middle">
                        <div>
                            <canvas id="ocupChart" width="auto" height="200"></canvas>
                        </div>
                        <div class="uk-flex-none">
                            <div>
                                <span class="uk-badge" style="background-color: #ffd43a"></span>
                                Estudiantes 25%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #04be65"></span>
                                Vigilantes 3%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #2d9b94"></span>
                                Contratistas 10%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #007aff"></span>
                                Hogar 4%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #c8194b"></span>
                                Profesores 56%
                            </div>
                            <div>
                                <span class="uk-badge" style="background-color: #adadad"></span>
                                Otros 2%
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

            <!-- Card Datos de la sección -->
            <div class="uk-padding-small">
                <a class="uk-position-right uk-padding" href="#modal-datos-seccion" uk-toggle uk-icon="cog"></a>
                <div uk-grid>
                    <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                        <div class="uk-text-bold">Entidad federativa</div>
                        <div>Michoacán - 16 ##FALTA VER</div>
                        <br />
                        <div class="uk-text-bold">Distrito federal</div>
                        <div>Distrito federal {{$datosSec[0]->federal_district_id}} ##FALTA VER</div>
                        <br />
                        <div class="uk-text-bold">Distrito local</div>
                        <div>Distrito local {{$datosSec[0]->local_district_id}} ##FALTA VER</div>
                        <br />
                        <div class="uk-text-bold">Cabecera distrito local</div>
                        <div>{{$datosSec[0]->local_district->cabecera}} ##FALTA VER</div>
                        <br />
                        <div class="uk-text-bold">Municipio</div>
                        <div>Morelia</div>
                    </div>
                    <div class="uk-width-auto uk-width-1-2@m uk-text-left">
                        <div class="uk-text-bold">Prioridad</div>
                        <div class="uk-text-danger">{{$datosSec[0]->prioridad}} ##FALTA VER</div>
                        <br />
                        <div class="uk-text-bold">Estatus</div>
                        <div style="display: flex">
                            <progress class="uk-progress uk-margin-right" value="50" max="100"
                                style="margin-bottom: 0"></progress>
                            <div>50%</div>
                            <div class="uk-margin-left uk-hidden@m">
                                n simpatizantes faltantes para alcanzar la meta
                            </div>
                            <div class="uk-margin-left uk-text-nowrap uk-visible@m">
                                n simpatizantes faltantes para alcanzar la meta
                            </div>
                        </div>
                        <br />
                        <div class="uk-text-bold"># Simpatizantes</div>
                        <div>@php

                            echo($totalSimp);
                            @endphp ##FALTA VER simpatizantes</div>
                        <br />
                        <div class="uk-text-bold">Meta final</div>
                        <div>485 simpatizantes</div>
                        <br />
                        <div class="uk-text-bold">Ganador elecciones 2018</div>
                        <div class="uk-text-middle">
                            <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="50" height="50"
                                alt="Border circle" />
                            <span class="uk-text-middle">Nombre del partido NDP</span>
                        </div>
                    </div>
                </div>
            </div>

            <hr />

            <!-- Card de SIMPATIZANTES -->
            <div class="uk-padding-small">
                <div class="uk-card-title">
                    <h5 class="uk-text-bold">Información por sección</h5>
                </div>
                <!-- Tabla -->
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-small uk-table-divider">
                        <thead class="uk-background-muted">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Sexo</th>
                                <th>Edad</th>
                                <th>Ocupación</th>
                                <th>Sección electoral</th>
                                <th>Clave de elecetor</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>José Agustín Aguilar Solórzano</td>
                                <td>Masculino</td>
                                <td>32</td>
                                <td>Escritor</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#2</td>
                                <td>Leonardo Daniel López López</td>
                                <td>Masculino</td>
                                <td>21</td>
                                <td>Profesor</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#3</td>
                                <td>Fernando Adrián García Sánchez</td>
                                <td>Masculino</td>
                                <td>18</td>
                                <td>Estudiante</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#4</td>
                                <td>Oscar André Huerta García</td>
                                <td>Masculino</td>
                                <td>57</td>
                                <td>Estudiante</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#5</td>
                                <td>Dulce Gabriela Marín Rendón</td>
                                <td>Femenino</td>
                                <td>47</td>
                                <td>Contratista</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>José Agustín Aguilar Solórzano</td>
                                <td>Masculino</td>
                                <td>32</td>
                                <td>Escritor</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#2</td>
                                <td>Leonardo Daniel López López</td>
                                <td>Masculino</td>
                                <td>21</td>
                                <td>Profesor</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#3</td>
                                <td>Fernando Adrián García Sánchez</td>
                                <td>Masculino</td>
                                <td>18</td>
                                <td>Estudiante</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#4</td>
                                <td>Oscar André Huerta García</td>
                                <td>Masculino</td>
                                <td>57</td>
                                <td>Estudiante</td>
                                <td>#</td>
                                <td>#########</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#5</td>
                                <td>Dulce Gabriela Marín Rendón</td>
                                <td>Femenino</td>
                                <td>47</td>
                                <td>Contratista</td>
                                <td>#</td>
                                <td>#########</td>
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
    </div>
</div>
@endsection

@section('scripts')
//Modal de la tabla
function myFunction(x) {
UIkit.modal("#modal-datos-simp").toggle();
}

//Subir imagen
var bar = document.getElementById("js-progressbar");

UIkit.upload(".js-upload", {
url: "",
multiple: true,

beforeSend: function () {
console.log("beforeSend", arguments);
},
beforeAll: function () {
console.log("beforeAll", arguments);
},
load: function () {
console.log("load", arguments);
},
error: function () {
console.log("error", arguments);
},
complete: function () {
console.log("complete", arguments);
},

loadStart: function (e) {
console.log("loadStart", arguments);

bar.removeAttribute("hidden");
bar.max = e.total;
bar.value = e.loaded;
},

progress: function (e) {
console.log("progress", arguments);

bar.max = e.total;
bar.value = e.loaded;
},

loadEnd: function (e) {
console.log("loadEnd", arguments);

bar.max = e.total;
bar.value = e.loaded;
},

completeAll: function () {
console.log("completeAll", arguments);

setTimeout(function () {
bar.setAttribute("hidden", "hidden");
}, 1000);

alert("Upload Completed");
},
});

//Grafica de pastel
var simpCanvas = document.getElementById("simpChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var simpData = {
labels: ["Hombres", "Mujeres"],
datasets: [
{
data: [{{$hombres}}, {{$mujeres}}],
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
data: [{{$g18}}, {{$g19}}, {{$g20}}, {{$g25}}, {{$g30}}, {{$g35}}, {{$g40}}, {{$g45}}, {{$g50}}, {{$g55}}, {{$g60}},
{{$g65}}],
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