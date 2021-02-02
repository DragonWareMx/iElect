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
if(!is_null($electores)){

$simpatizantes = 0;
$porcentaje = 0;
$countS = array_count_values($electores->pluck('sexo')->toArray());
$simp_ocup = array_count_values($electores->pluck('job.nombre')->toArray());
$ocupaciones = array_keys($simp_ocup);
$simp_ocup = array_values($simp_ocup);

//Metodo para obtener colores Random
$rand = array('0', '1', '2', '3', '4', '5', '6', '7', '8', '9', 'a', 'b', 'c', 'd', 'e', 'f');
$colores = [];
foreach ($ocupaciones as $key) {
$color ='#'.$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)].$rand[rand(0,15)];
array_push($colores, $color);
}

if(isset($countS['h'])){
$hombres = $countS['h'];
}else{
$hombres = 0;
}

if(isset($countS['m'])){
$mujeres = $countS['m'];
}else{
$mujeres = 0;
}

$total = $hombres + $mujeres;

if($total != 0){
$porcH = round(($hombres * 100)/$total, 2);
$porcM = round(($mujeres * 100)/$total, 2);
}else{
$porcH = 0;
$porcM = 0;
}

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
}else{
$hombres = 0;
$mujeres = 0;
$total = 0;
$porcH = 0;
$porcM = 0;

$g18 = 0;
$g19 = 0;
$g20 = 0;
$g25 = 0;
$g30 = 0;
$g35 = 0;
$g40 = 0;
$g45 = 0;
$g50 = 0;
$g55 = 0;
$g60 = 0;
$g65 = 0;
}

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
                        <option value="" disabled></option>
                        <option value="1" @php if($datosSec->campaign[0]->pivot->prioridad=="Alta"){
                            echo('selected');
                            }
                            @endphp>Alta</option>
                        <option value="2" @php if($datosSec->campaign[0]->pivot->prioridad=="Media"){
                            echo('selected');
                            }
                            @endphp>Media</option>
                        <option value="3" @php if($datosSec->campaign[0]->pivot->prioridad=="Baja"){
                            echo('selected');
                            }
                            @endphp>Baja</option>
                    </select>
                    <span class="select-highlight"></span>
                    <span class="select-bar"></span>
                    <label class="select-label">Prioridad</label>
                </div>
            </div>
            <div class="uk-margin">
                <div class="uk-form-controls">
                    <div class="omrs-input-group">
                        <label class="omrs-input-underlined input-outlined">
                            <input required value="{{$datosSec->campaign[0]->pivot->meta}}" />
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
            <h2 class="uk-modal-title" id="simp_edit_id">Simpatizante #</h2>
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
                    <div id="simp_edit_nombre">José Agustín Aguilar Solórzano</div>
                    <br />
                    <div class="uk-text-bold">Domicilio</div>
                    <div id="simp_edit_domicilio">Morelia, Centro #442</div>
                    <br />
                    <!--Grid DATOS-->
                    <div uk-grid>
                        <div class="uk-width-expand@m">
                            <div class="uk-text-bold">Edad</div>
                            <div id="simp_edit_edad">32</div>
                            <br />
                            <div class="uk-text-bold">Ocupación</div>
                            <div id="simp_edit_job">Escritor</div>
                            <br />
                            <div class="uk-text-bold">Correo electrónico</div>
                            <div id="simp_edit_email">correo@ejemplo.com</div>
                            <br />
                            <div class="uk-text-bold">Sección electoral</div>
                            <div id="simp_edit_section">#</div>
                            <br />
                            <div class="uk-text-bold">Clave de elector</div>
                            <div id="simp_edit_celector">#########</div>
                            <br />
                        </div>
                        <div class="uk-width-1-2@m">
                            <div class="uk-text-bold">Sexo</div>
                            <div id="simp_edit_genero">Masculino</div>
                            <br />
                            <div class="uk-text-bold">Teléfono</div>
                            <div id="simp_edit_tel">1234567891</div>
                            <br />
                            <div class="uk-text-bold">Facebook</div>
                            <div id="simp_edit_face">link</div>
                            <br />
                            <div class="uk-text-bold">Twitter</div>
                            <div id="simp_edit_tw">link</div>
                            <br />
                            <div class="uk-text-bold">Brigadista</div>
                            <div>#######</div>
                            <br />
                        </div>
                    </div>
                </div>
                <div class="uk-width-1-2@m">
                    <img id="simp_edit_front" class="uk-margin-bottom" data-src="img/test/ine_front.jpg" width="75%"
                        height="auto" alt="" uk-img />
                    <img id="simp_edit_back" data-src="img/test/ine_back.jpg" width="75%" height="auto" alt="" uk-img />
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
                        {{$datosSec->num_seccion}}
                    </h3>
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
                        Sexo
                    </h5>
                    @endif

                </div>
                <!-- Grafica de barras -->
                <div class="uk-width-expand@m">
                    @if (!is_null($electores))
                    <canvas id="barChart" width="auto" height="200"></canvas>
                    @endif
                    <!--<h5 class="uk-text-bold uk-padding-small">Edad</h5>-->
                </div>
                <!-- Grafica de pastel -->
                <div class="uk-width-1-4@m">
                    @if (!is_null($electores))
                    <h5 class="uk-text-bold uk-padding-small">Ocupaciones</h5>
                    <div class="uk-flex uk-flex-middle">
                        <div>
                            <canvas id="ocupChart" width="auto" height="200"></canvas>
                        </div>
                        <div class="uk-flex-none">
                            @for ($i = 0; $i < count($ocupaciones); $i++) <div>
                                <span class="uk-badge" style="background-color: {{$colores[$i]}}"></span>
                                {{$ocupaciones[$i]}} {{round(($simp_ocup[0]*100)/$electores->count(), 0)}}%
                        </div>
                        @endfor
                    </div>
                    @else
                    <h5 class="uk-text-bold uk-padding-small">Ocupaciones</h5>
                    @endif

                </div>
            </div>
        </div>

        <hr />

        <!-- Card Datos de la sección -->
        <div class="uk-padding-small">
            <div class="uk-width-expand uk-text-right">
                <a class="uk-padding" href="#modal-datos-seccion" uk-toggle uk-icon="cog" style="padding: 0"></a>
            </div>
            @if (!is_null($electores))
            <div uk-grid>
                <div class="uk-width-auto uk-width-1-4@m uk-text-left">
                    <div class="uk-text-bold">Entidad federativa</div>
                    <div>{{$datosSec->town->federal_entitie->nombre}} - {{$datosSec->town->federal_entitie->id}}
                    </div>
                    <br />
                    <div class="uk-text-bold">Distrito federal</div>
                    <div>{{$datosSec->federal_district->cabecera}}</div>
                    <br />
                    <div class="uk-text-bold">Distrito local</div>
                    <div>Distrito Local {{$datosSec->local_district->numero}}</div>
                    <br />
                    <div class="uk-text-bold">Cabecera distrito local</div>
                    <div>{{$datosSec->local_district->cabecera}}</div>
                    <br />
                    <div class="uk-text-bold">Municipio</div>
                    <div>{{$datosSec->town->nombre}}</div>
                </div>
                <div class="uk-width-auto uk-width-1-2@m uk-text-left">
                    <div class="uk-text-bold">Prioridad</div>
                    <div class="@switch($datosSec->campaign[0]->pivot->prioridad)
                            @case('Alta')
                                uk-text-danger
                                @break
                            @case('Media')
                                uk-text-warning
                                @break
                            @case('Baja')
                                uk-text-success
                            @default
                        @endswitch">{{$datosSec->campaign[0]->pivot->prioridad}}</div>
                    <br />
                    <div class="uk-text-bold">Estatus</div>
                    <div style="display: flex">
                        @php
                        $status = round(($electores->count()*100)/$datosSec->campaign[0]->pivot->meta, 1)
                        @endphp
                        <progress class="uk-progress uk-margin-right" value="{{$status}}" max="100"
                            style="margin-bottom: 0"></progress>
                        <div>{{$status}}%</div>
                        <div class="uk-margin-left uk-hidden@m">
                            @php
                            $restantes = $datosSec->campaign[0]->pivot->meta - $electores->count();
                            echo($restantes);
                            @endphp simpatizantes faltantes para alcanzar la meta
                        </div>
                        <div class="uk-margin-left uk-text-nowrap uk-visible@m">
                            @php
                            $restantes = $datosSec->campaign[0]->pivot->meta - $electores->count();
                            echo($restantes);
                            @endphp simpatizantes faltantes para alcanzar la meta
                        </div>
                    </div>
                    <br />
                    <div class="uk-text-bold"># Simpatizantes</div>
                    <div>@php
                        echo($electores->count());
                        @endphp</div>
                    <br />
                    <div class="uk-text-bold">Meta final</div>
                    <div>{{$datosSec->campaign[0]->pivot->meta}} simpatizantes</div>
                    <br />
                    <div class="uk-text-bold">Ganador elecciones 2018</div>
                    <div class="uk-text-middle">
                        <img class="uk-border-circle" src="{{asset('img/test/avatar.jpg')}}" width="50" height="50"
                            alt="Border circle" />
                        <span class="uk-text-middle">Nombre del partido NDP</span>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <hr />

        <!-- Card de SIMPATIZANTES -->
        <div class="uk-padding-small">
            @if (!is_null($electores))
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
                    <tbody id="tabla-simps">
                        @foreach ($electores as $elector)

                        <tr data-id="{{$elector->id}}">
                            <td>#{{$elector->id}}</td>
                            <td>{{$elector->nombre}} {{$elector->apellido_p}} {{$elector->apellido_m}}</td>
                            <td>{{$elector->sexo}}</td>
                            <td>{{\Carbon\Carbon::parse($elector->fecha_nac)->diff(Carbon\Carbon::now())->format('%y')}}
                                Años
                            </td>
                            <td>{{$elector->job->nombre}}</td>
                            <td>{{$elector->section->num_seccion}}</td>
                            <td>{{$elector->clave_elector}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!!$electores->links()!!}
            </div>
            @else
            <div class="uk-card-title">
                <h5 class="uk-text-bold">Información por sección</h5>
            </div>
            @endif

        </div>
    </div>
</div>
</div>

<script>
    function _calculateAge(birthday) { // birthday is a date
        var ageDifMs = Date.now() - birthday.getTime();
        var ageDate = new Date(ageDifMs); // miliseconds from epoch
        return Math.abs(ageDate.getUTCFullYear() - 1970);
    }

    $(document).ready(function () {
        var simps={!! json_encode($electores); !!};
        var simps=simps['data'];

        $('#tabla-simps tr').click(function(){
            var id = $(this).data('id');
            for(var key in simps){
                var obj=simps[key];
                if(obj["id"] == id){
                    break;
                }
            }
            //console.log(obj);
            //falta la foto principal
            $('#simp_edit_id').html('Simpatizante ' + obj['id']);
            $('#simp_edit_nombre').html(obj['nombre']+ " " + obj['apellido_p']+ " " + obj['apellido_m']);
            $('#simp_edit_domicilio').html(obj['calle']+ " " + obj['ext_num']+ " " + obj['int_num']+ " " + obj['colonia']+ " " + obj['cp']);
            var d = new Date(obj['fecha_nac']);
            $('#simp_edit_edad').html(_calculateAge(d));
            $('#simp_edit_job').html(obj['job']['nombre']);
            $('#simp_edit_email').html(obj['email']);
            $('#simp_edit_section').html(obj['section']['num_seccion']);
            $('#simp_edit_celector').html(obj['clave_elector']);
            $('#simp_edit_genero').html(obj['sexo'] == 'h' ? "Masculino" : "Femenino" );
            $('#simp_edit_tel').html(obj['telefono']);
            $('#simp_edit_face').html(obj['facebook']);
            $('#simp_edit_tw').html(obj['twitter']);
            //aqui falta lo del brigadista

            //aqui empieza lo de las fotos del ine
            $("#simp_edit_front").attr("data-src","storage/uploads/"+obj['credencial_a']);
            $("#simp_edit_back").attr("data-src","storage/uploads/"+obj['credencial_r']);
            UIkit.modal("#modal-datos-simp").toggle();
        });
    });
</script>

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
@if (!is_null($electores))
var ocupCanvas = document.getElementById("ocupChart");

Chart.defaults.global.defaultFontFamily = "Lato";
Chart.defaults.global.defaultFontSize = 18;
Chart.defaults.global.legend.display = false;

var ocupData = {
labels: {!!json_encode($ocupaciones)!!},
datasets: [
{
data: {!!json_encode(array_values($simp_ocup))!!},
backgroundColor: {!! json_encode(array_values($colores)) !!},
},
],
};

var ocupChart = new Chart(ocupCanvas, {
type: "pie",
data: ocupData,
});
@endif

@endsection