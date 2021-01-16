@extends('layouts.layout')

@section('title')
Usuarios
@endsection

@section('imports')
@extends('subviews.chartjs')
@endsection

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

<!-- Modal Agregar Agente -->
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
                    <h3 class="uk-card-title uk-text-bold">Administradores</h3>
                </div>
                <div>
                    <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom"
                        style="
                justify-content: center;
                align-items: center;
                display: flex;
                max-height: 55px !important;
              " uk-toggle="target: #modal-agregar-simp">
                        Agregar agente
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
                <div class="uk-position-small uk-position-top-right uk-visible@m" style="display: flex">
                    <button class="uk-button uk-button-default uk-background-muted uk-margin-right" style="
                justify-content: center;
                align-items: center;
                display: flex;
                max-height: 55px !important;
              " uk-toggle="target: #modal-agregar-simp">
                        Agregar agente
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
            </div>

            <!-- Sección ADMINISTRADORES -->
            <div class="uk-padding-small uk-grid-column-small uk-grid-row-large uk-child-width-1-4@s" uk-grid
                style="margin-top: 0 !important">
                <div>
                    <!-- Tarjeta administrador -->
                    <div class="uk-card uk-card-default uk-padding-small">
                        <div uk-grid>
                            <div class="uk-width-auto@m">
                                <div>
                                    <img class="uk-border-circle uk-align-center" width="100" height="100"
                                        src="{{asset('img/test/avatar.jpg')}}" style="margin-bottom: 0" />
                                </div>
                                <div class="uk-background-primary uk-margin-small-top uk-text-center"
                                    style="color: white; border-radius: 4px">
                                    <p style="padding: 2px; margin: 0">Administrador</p>
                                </div>
                            </div>
                            <div class="uk-width-expand@m">
                                <p class="uk-text-bold uk-margin-remove-bottom uk-text-center uk-text-left@m">
                                    José Agustín Aguilar Solórzano
                                </p>
                                <p class="uk-text-meta uk-margin-remove-top uk-text-center uk-text-left@m"
                                    style="margin: 0">
                                    Correo electrónico
                                </p>
                                <div class="uk-margin-small-top uk-text-center uk-align-center uk-align-left@m" style="
                      background-color: #62d69e;
                      color: white;
                      border-radius: 4px;
                      width: fit-content;
                      min-width: 6rem;
                    ">
                                    <p style="padding: 2px; margin: 0">Activo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <!-- Tarjeta administrador -->
                    <div class="uk-card uk-card-default uk-padding-small">
                        <div uk-grid>
                            <div class="uk-width-auto@m">
                                <div>
                                    <img class="uk-border-circle uk-align-center" width="100" height="100"
                                        src="{{asset('img/test/avatar.jpg')}}" style="margin-bottom: 0" />
                                </div>
                                <div class="uk-background-primary uk-margin-small-top uk-text-center"
                                    style="color: white; border-radius: 4px">
                                    <p style="padding: 2px; margin: 0">Administrador</p>
                                </div>
                            </div>
                            <div class="uk-width-expand@m">
                                <p class="uk-text-bold uk-margin-remove-bottom uk-text-center uk-text-left@m">
                                    José Agustín Aguilar Solórzano
                                </p>
                                <p class="uk-text-meta uk-margin-remove-top uk-text-center uk-text-left@m"
                                    style="margin: 0">
                                    Correo electrónico
                                </p>
                                <div class="uk-margin-small-top uk-text-center uk-align-center uk-align-left@m" style="
                      background-color: #f4e55d;
                      color: white;
                      border-radius: 4px;
                      width: fit-content;
                      min-width: 6rem;
                    ">
                                    <p style="padding: 2px; margin: 0">Inactivo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Datos de la sección -->
    <div class="uk-card uk-card-default uk-padding-small">
        <!-- Graficas -->
        <div uk-grid class="">
            <!-- Grafica de barras -->
            <div class="uk-width-expand@m">
                <!-- Tabla Agentes-->
                <h3 class="uk-text-bold">Agentes</h3>
                <div class="uk-overflow-auto">
                    <table class="uk-table uk-table-small uk-table-divider">
                        <thead class="uk-background-muted">
                            <tr>
                                <th>#</th>
                                <th>Nombre</th>
                                <th>Correo electrónico</th>
                                <th>Partido</th>
                                <th>Secciones</th>
                                <th>Estatus</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>José Agustín Aguilar Solórzano</td>
                                <td>correo@ejemplo.com</td>
                                <td>NDP</td>
                                <td>178</td>
                                <td>Activo</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>José Agustín Aguilar Solórzano</td>
                                <td>correo@ejemplo.com</td>
                                <td>NDP</td>
                                <td>178</td>
                                <td>Activo</td>
                            </tr>
                            <tr onclick="myFunction(this)">
                                <td>#1</td>
                                <td>José Agustín Aguilar Solórzano</td>
                                <td>correo@ejemplo.com</td>
                                <td>NDP</td>
                                <td>178</td>
                                <td>Activo</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- Grafica de pastel -->
            <div class="uk-width-1-3@m">
                <h5 class="uk-text-bold uk-padding-small">Ocupaciones</h5>
                <div class="uk-flex uk-flex-middle">
                    <div>
                        <canvas id="ocupChart" width="auto" height="200"></canvas>
                    </div>
                    <div class="uk-flex-none">
                        <div>
                            <span class="uk-badge" style="background-color: #ffd43a"></span>
                            NDP
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #04be65"></span>
                            PAN
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #2d9b94"></span>
                            PRI
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #007aff"></span>
                            PRD
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #c8194b"></span>
                            PT
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #adadad"></span>
                            PES
                        </div>
                    </div>
                </div>
                <p style="margin-top: 0 !important">
                    Partidos políticos presentes en iElect
                </p>
            </div>
        </div>
    </div>

    <!-- Card de SIMPATIZANTES -->
    <div class="uk-card uk-card-default uk-padding-small">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">Brigadistas</h3>
        </div>
        <!-- Tabla -->
        <div class="uk-overflow-auto">
            <table class="uk-table uk-table-small uk-table-divider">
                <thead class="uk-background-muted">
                    <tr>
                        <th>#</th>
                        <th>Nombre</th>
                        <th>Correo electronico</th>
                        <th>Partido</th>
                        <th>Simpatizantes registrados</th>
                        <th>Estatus</th>
                    </tr>
                </thead>
                <tbody>
                    <tr onclick="myFunction(this)">
                        <td>#1</td>
                        <td>José Agustín Aguilar Solórzano</td>
                        <td>correo@ejemplo.com</td>
                        <td>NDP</td>
                        <td>178</td>
                        <td>Activo</td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>#2</td>
                        <td>Leonardo Daniel López López</td>
                        <td>correo@ejemplo.com</td>
                        <td>NDP</td>
                        <td>86</td>
                        <td>Inactivo</td>
                    </tr>
                    <tr onclick="myFunction(this)">
                        <td>#4</td>
                        <td>Oscar André Huerta García</td>
                        <td>correo@ejemplo.com</td>
                        <td>NDP</td>
                        <td>178</td>
                        <td>Activo</td>
                    </tr>
                </tbody>
            </table>
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