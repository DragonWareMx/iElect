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
            <div class="uk-card uk-card-default uk-padding-small uk-overflow-auto">
                <h3 class="uk-card-title uk-text-bold uk-margin-remove">Usuarios</h3>
                <p class="uk-margin-remove-top">Total:5185</p>
                <div>
                    <button class="uk-button uk-button-default uk-background-muted uk-hidden@m uk-margin-small-bottom" style="
                  justify-content: center;
                  align-items: center;
                  display: flex;
                  max-height: 55px !important;
                " uk-toggle="target: #modal-agregar-user">
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
                        " uk-toggle="target: #modal-agregar-user">
                        Agregar agente
                        <span uk-icon="icon: plus" class="uk-margin-left"></span>
                    </button>
                </div>
                <div uk-grid>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/admin.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Administradores</p>
                        <p class="uk-margin-remove">2</p>
                    </div>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/agente.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Agentes</p>
                        <p class="uk-margin-remove">61</p>
                    </div>
                    <div class="uk-width-1-4@m uk-text-center">
                        <img src="{{asset('img/icons/brigadista.png')}}" style="max-width: 120px; width: 100%;" />
                        <p class="uk-text-bold uk-margin-remove">Brigadistas</p>
                        <p class="uk-margin-remove">61</p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Card de SIMPATIZANTES -->
        <div class="uk-width-1-3@m">
            <div class="uk-card uk-card-default uk-padding-small">
                <h3 class="uk-card-title uk-text-bold" style="margin: 0">
                    Simpatizantes
                </h3>
                <div>Total: 6</div>
                <div class="uk-flex uk-flex-middle">
                    <div>
                        <canvas id="simpChart" width="auto" height="200"></canvas>
                    </div>
                    <div class="uk-flex-none">
                        <div>
                            <span class="uk-badge" style="background-color: #FFD43A"></span>
                            NDP
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #04BE65"></span>
                            PAN
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #2D9B94"></span>
                            PRI
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #3201C8"></span>
                            PRD
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #C8194B"></span>
                            PT
                        </div>
                        <div>
                            <span class="uk-badge" style="background-color: #ADADAD"></span>
                            PES
                        </div>
                    </div>
                </div>
                <p>
                    Partidos políticos presentes en iElect
                </p>
            </div>
        </div>
    </div>
    <!-- Card de PARTIDO ELECTORAL -->
    <div class="uk-card uk-card-default uk-padding-small uk-margin-top">
        <div class="uk-card-title">
            <h3 class="uk-text-bold">Zonas cubiertas</h3>
            <a class="uk-position-right uk-padding" href="" uk-icon="cog"></a>
        </div>

        <div class="uk-child-width-expand@s uk-text-center" uk-grid>
            <div class="uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Entidades federativas</div>
                <div>5 entidades cubiertas</div>
                <br />
                <div class="uk-text-bold">Distritos federales</div>
                <div>24 distritos cubiertos</div>
                <br />
                <div class="uk-text-bold">Distritos locales</div>
                <div>53 distritos cubierto</div>
                <br />
                <div class="uk-text-bold">Municipios</div>
                <div>89 municipios cubiertos</div>
            </div>
            <div class="uk-width-auto@m uk-text-left">
                <div class="uk-text-bold">Secciones</div>
                <div>2578 secciones cubiertas</div>
            </div>
            <div class="uk-width-1-3@m">
                <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                <canvas id="barChart" width="auto" height="200"></canvas>
            </div>
        </div>
    </div>

    <!-- Modal Agregar Usuario -->
    <div id="modal-agregar-user" class="uk-modal-container" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-header">
                <h2 class="uk-modal-title">Agregar agente</h2>
            </div>
            <form class="uk-modal-body">
                <div uk-grid>
                    <div class="uk-width-1">
                        <!-- Avatar -->
                        <div class="avatar-wrapper uk-margin-bottom">
                            <img class="profile-pic uk-border-circle uk-flex" style="margin-left:auto; margin-right:auto;" src="{{asset('img/test/avatar.jpg')}}" width="200"
                                height="200" alt="Border circle" />
                            <div class=" uk-text-center" style="cursor: pointer">
                                Agregar foto
                                <span class="uk-margin-small-left" uk-icon="upload"></span>
                            </div>
                        </div>
                        <div uk-grid>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">NOMBRE</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required />
                                        <span class="omrs-input-label">Nombre completo</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CORREO</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required />
                                        <span class="omrs-input-label">Correo electrónico</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required />
                                        <span class="omrs-input-label">Contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">CONFIRMAR CONTRASEÑA</h6>
                                <div class="omrs-input-group uk-margin">
                                    <label class="omrs-input-underlined input-outlined">
                                        <input required />
                                        <span class="omrs-input-label">Confirmar contraseña</span>
                                    </label>
                                </div>
                            </div>
                            <div class="uk-width-1-2@m">
                                <h6 class="uk-margin-remove uk-text-bold">TIPO</h6>
                                <div class="uk-form-controls omrs-input-group uk-margin">
                                    <select class="uk-select" i>
                                        <option value="agente">Agente</option> 
                                        <option value="administrador">Administrador</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="uk-text-right">
                    <button class="uk-button uk-button-default uk-modal-close" type="button">
                        Cancelar
                    </button>
                    <button class="uk-button uk-button-primary" type="submit">
                        Enviar
                    </button>
                </p>
            </form>
        </div>
    </div>
</div>

@endsection

@section('scripts')
var simpCanvas = document.getElementById("simpChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var simpData = {
datasets: [
{
data: [13, 10, 1, 2, 10, 8],
backgroundColor: ["#C8194B", "#FFD43A", "#ADADAD", "#3201C8", "#2D9B94", "#04BE65"],
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
labels: ["DF", "MICH", "SLP", "OAX", "DRG", "SNL"],
datasets: [
{
data: [200, 153, 60, 180, 130, 175],
backgroundColor: ["#9B51E0", "#FB8832", "#FFCB01", "#C8194B", "#2D9B94", "#3201C8"],
},
],
},
options: {
maintainAspectRatio: false,
scales: {
yAxes: [{
ticks: {
beginAtZero: true
}
}]
}
},
});

@endsection